<?php
	if ( ! defined( 'WPINC' ) ) {
		die;
	}

	foreach ( glob( get_template_directory() . '/inc/*.php' ) as $file ){
		require_once $file;
	}

	new Site();
	new Assets();
	new SVGSupport();



	/*Util to get first item of array*/
	function get_first($arr, $key){
		if(count($arr) > 0){
			return $arr[0]->$key;
		} else {
			return null;
		}
	}

	function get_posts_grid($page_num, $category_id, $num_posts, $posts_not_in){
		$featured_post_id = carbon_get_theme_option('home_featured_story');
		$post__not_in = array_merge( $featured_post_id, explode('|', $posts_not_in));
		$query = array(
			'post_type' => 'post',
			'posts_per_page' => $num_posts,
			'post_status' => 'publish',
			'ignore_sticky_posts' => true,
			'post__not_in' => $post__not_in
		);
		if($category_id > 0){
			$query['cat'] = $category_id;
		}
		$blog = new WP_Query($query);
		$html = '';
		if($blog->have_posts()){
			while ($blog->have_posts()){
				$blog->the_post();
				$thumbnail_id = get_post_thumbnail_id(get_the_ID());
				$thumbnail = wp_get_attachment_image_src($thumbnail_id, 'card-thumbnail');
				$cats = wp_list_pluck(get_the_category(get_the_ID()), 'name');
				$cat_id = get_the_category(get_the_ID());
				$color = carbon_get_term_meta($cat_id[0]->term_id, 'fooda_category_color');
				if($color == ''){
					$color = '#ffffff';
				}
				$html .= '<article class="' . join( ' ', get_post_class( 'post-card is-visible', get_the_ID())) . '" data-postid="'.get_the_ID().'" data-cat="'.$cat_id[0]->term_id.'">' .
						 '<a href="'.get_permalink(get_the_ID()).'">'.
				         '<span class="featured-image" style="background-image:url('.$thumbnail[0].')"></span>' .
						 '<span class="card-cat">'.implode(', ', $cats).'<span class="cat-color-code" style="background-color:'.$color.'"></span></span>' .
						 '<h3 class="card-title">'.get_the_title(get_the_ID()).'</h3>'.
				         '</a></article>';
			}
		}
		wp_reset_postdata();
		return $html;
	}


	/**
	 * AJAX Load More
	 * @link http://www.billerickson.net/infinite-scroll-in-wordpress
	 */
	function fooda_ajax_load_more() {
		//$data = get_posts_grid(esc_attr( $_POST['page'] ), intval($_POST['category']), 3);
		$data = get_posts_grid(intval( $_POST['offset'] ), intval($_POST['category']), 9, esc_attr($_POST['postsNotIn']));
		wp_send_json_success( $data );
		wp_die();
	}

	add_action( 'wp_ajax_fooda_ajax_load_more', 'fooda_ajax_load_more' );
	add_action( 'wp_ajax_nopriv_fooda_ajax_load_more', 'fooda_ajax_load_more' );

	// change [] on excerpt
	if ( ! function_exists( 'dyad_excerpt_continue_reading' ) ) {
		function dyad_excerpt_continue_reading() {
			return '';
		}
	} 
	add_filter( 'excerpt_more', 'dyad_excerpt_continue_reading' );

	// Filter except length to 35 words.
	function wp_custom_excerpt_length( $length ) {
		return 35;
	}
	add_filter( 'excerpt_length', 'wp_custom_excerpt_length', 999 );

	// filter cat pagination
	function custom_ppp( $query ) {
	    if ( !is_admin() && $query->is_category() && $query->is_main_query() ) {
	        $query->set( 'posts_per_page', '2' );
	    }
	}
	add_action( 'pre_get_posts', 'custom_ppp' );
	
	// pagination
	function theme_pagination($pages = '', $range = 3) {
	      global $wp_query;
	      if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
	      elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
	      else { $paged = 1; }

	      $showitems = ($range * 2)+1;  

	      if(empty($paged)) $paged = 1;

	      if($pages == '' && $pages != 0)
	      {
	         global $wp_query;
	         $pages = $wp_query->max_num_pages;
	         if(!$pages)
	         {
	             $pages = 1;
	         }
	     }   

	     if(1 != $pages)
	     {
	         echo '<div class="navigation"><ul>';
	         if($paged > 1 && $showitems < $pages) echo "<li class='previous'><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

	         for ($i=1; $i <= $pages; $i++)
	         {
	             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
	             {
	                 echo ($paged == $i)? "<li class='active'><a>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."'>".$i."</a></li>";
	             }
	         }

	         if ($paged < $pages && $showitems < $pages) echo "<li class='next'><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";  
	         echo "</ul></div>\n";
	     }

	}
