<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Assets {

	public function __construct() {
		$this->register_actions();
	}

	private function register_actions() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts_and_styles' ), 1 );
	}

	public function enqueue_scripts_and_styles() {
		global $wp_query;

		wp_deregister_script( 'wp-embed' );
		//scripts
		wp_enqueue_script( 'jquery' );
		wp_localize_script( 'fooda-load-more', 'foodaloadmore', array('url'   => admin_url( 'admin-ajax.php' ), 'query' => $wp_query->query));
		wp_enqueue_script( 'fooda-site', get_stylesheet_directory_uri() . '/js.build/bundle.min.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_style( 'fooda-css', get_template_directory_uri() .'/styles/index.css', array(), null );
	}


	static public function get_fooda_header_and_footer($fragment){
		$transient_key = 'fooda_page_elements';
		//if($_GET['clearCache'] == 'now'){
			//delete_transient($transient_key);
		//}
		$fooda_page_elements = get_transient( $transient_key );
		if ( $fooda_page_elements === false ) {
			$request = wp_remote_request( 'https://www.fooda.com/page-elements.json' );
			if(!is_wp_error($request)){
				$fooda_page_elements = $request['body'];
				set_transient( $transient_key, $fooda_page_elements, HOUR_IN_SECONDS );
			}
		}
		$result = json_decode( $fooda_page_elements );
		$html = str_replace('src="/sites/', 'src="//www.fooda.com/sites/', $result->{$fragment});
		$html = str_replace('href="/', 'href="https://www.fooda.com/', $html);
		return "\n<!--start {$fragment}-->\n" . $html . "\n<!--end {$fragment}-->\n";
	}

}