<?php
function hbwp_fetch_media( $file, $post_id, $desc ) {
	// Set variables for storage, fix file filename for query strings.
	preg_match( '/[^\?]+\.(jpe?g|jpe|gif|png)\b/i', $file, $matches );
	if ( ! $matches ) {
		return new WP_Error( 'image_sideload_failed', __( 'Invalid image URL' ) );
	}

	$file_array         = array();
	$file_array['name'] = basename( $matches[0] );

	// Download file to temp location.
	if (!preg_match("~^(?:f|ht)tps?://~i", $file)) {
		$file = "http://" . $file;
	}

	//parse_url($file, PHP_URL_SCHEME) === null ? 'http://' . $file : $file;

	$file_array['tmp_name'] = download_url( $file );

	// If error storing temporarily, return the error.
	if ( is_wp_error( $file_array['tmp_name'] ) ) {
		return $file_array['tmp_name'];
	}

	// Do the validation and storage stuff.
	$id = media_handle_sideload( $file_array, $post_id, $desc );


	// If error storing permanently, unlink.
	if ( is_wp_error( $id ) ) {
		@unlink( $file_array['tmp_name'] );
		return $id;
	}

	return set_post_thumbnail( $post_id, $id );
}

add_action( 'admin_menu', 'hbwp_add_admin_menu' );
add_action( 'admin_init', 'hbwp_settings_init' );


function hbwp_add_admin_menu() {
	add_menu_page( 'HubSpot Blog to WordPress', 'HubSpot Blog to WordPress', 'manage_options', 'hubspot_blog_to_wordpress', 'hbwp_options_page' );
}


function hbwp_settings_init() {

	register_setting( 'pluginPage', 'hbwp_settings' );

	add_settings_section(
		'hbwp_pluginPage_section',
		__( '', 'hbwp' ),
		'hbwp_settings_section_callback',
		'pluginPage'
	);
	add_settings_field(
		'hbwp_text_field_0',
		__( 'Please enter your API key here.', 'hbwp' ),
		'hbwp_text_field_0_render',
		'pluginPage',
		'hbwp_pluginPage_section'
	);
	add_settings_field(
		'hbwp_text_field_1',
		__( 'Please enter total number of posts you need to import', 'hbwp' ),
		'hbwp_text_field_1_render',
		'pluginPage',
		'hbwp_pluginPage_section'
	);
}


function hbwp_text_field_0_render() {
	$options = get_option( 'hbwp_settings' );
	?><input type='text' id="main_api_key" name='hbwp_settings[hbwp_text_field_0]'  value='<?php echo $options['hbwp_text_field_0']; ?>'><?php
}

function hbwp_text_field_1_render() {
	$options = get_option( 'hbwp_settings' );
	?><input type='text' id="total_posts" name='hbwp_settings[hbwp_text_field_1]' value='<?php echo $options['hbwp_text_field_1']; ?>'><?php
}


function hbwp_settings_section_callback() {
	echo __( 'Please get your API key of your hubspot account from <a href="https://app.hubspot.com/keys/get" target="_blank">API key section</a>', 'hbwp' );
}

function hbwp_import_ajax_request() {

	// The $_REQUEST contains all the data sent via ajax
	if ( isset( $_REQUEST ) ) {

		$apikey     = $_REQUEST['apikey'];
		$totalposts = $_REQUEST['totalposts'];

		// Now we'll return it to the javascript function
		$url = 'https://api.hubapi.com/content/api/v2/blog-posts?hapikey=' . $apikey . '&limit=' . $totalposts;
		//Convert our JSON into a PHP Array
		$array = json_decode( file_get_contents( $url ), true );
		//var_dump($array);
		if ( $array ) {

			foreach ( $array['objects'] as $row ) {
				$categories_all = array();

				if ( ! post_exists( $row['html_title'] ) ) {

                    foreach ( $row['topic_ids'] as $key ) {
						$topics_array = json_decode( file_get_contents( "https://api.hubapi.com/blogs/v3/topics/" . $key . "?hapikey=" . $apikey ), true );
						$topic_name   = $topics_array['name'];
						$term         = term_exists( $topic_name, 'category' );
						if ( $term !== 0 && $term !== null ) {
							//array_push($categories_all, $term->term_id);
							array_push( $categories_all, $term['term_id'] );
						} else {
							$terms_id = wp_create_category( $topic_name );
							array_push( $categories_all, $terms_id );
						}
					}

				    //print_r( $categories_all );

					$post_arr  = array(
						'post_title'    => $row['html_title'],
						//Title of post
						'post_type'     => 'post',
						//could be any custom post type
						'post_content'  => $row['post_body'],
						'post_category' => $categories_all,
						'post_status'   => 'publish',
						'post_date'     => date( 'Y-m-d H:i:s', $row['created_time'] / 1000 ) // Must be divided by 1000 to get secconds not milliseconds
					);

					$posted_id = wp_insert_post( $post_arr, true );

					if ( ! empty( $row['featured_image'] ) ) {
						hbwp_fetch_media( $row['featured_image'], $posted_id, $row['featured_image_alt_text'] );
					}
				}
			}
		}

		// If you're debugging, it might be useful to see what was sent in the $_REQUEST
		//print_r($_REQUEST);

	}
	// Always die in functions echoing ajax content
	wp_die();
}

add_action( 'wp_ajax_hbwp_import_ajax_request', 'hbwp_import_ajax_request' );
add_action( 'wp_ajax_nopriv_hbwp_import_ajax_request', 'hbwp_import_ajax_request' );

function hbwp_options_page() {

	?>
    <script>
        jQuery(document).ready(function ($) {
            $('#submit').on('click', function (event) {
                $(".results-here").show();
                // This does the ajax request
                $.ajax({
                    url: ajaxurl,
                    data: {
                        'action': 'hbwp_import_ajax_request',
                        'apikey': $("#main_api_key").val(),
                        'totalposts': $("#total_posts").val()
                    },
                    success: function (data) {
                        $(".results-here").html(data);
                    },
                    error: function (errorThrown) {
                        console.log(errorThrown);
                    }
                });
            });
        });
    </script>
    <form action='options.php' method='post' id="hubto_wp">
        <h1>HubSpot Blog to WordPress</h1>
		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		?>
        <p class="submit"><input type="button" name="submit" id="submit" class="button button-primary" value="Start import now"></p>
        <div class="results-here" style="display:none;">
            Importing please wait
        </div>
    </form>
	<?php

}

?>