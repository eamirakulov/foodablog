<?php

if ( ! defined( 'WPINC' ) ) {
	die;
}

class SVGSupport {

	public function __construct() {
		$this->init();
	}

	private function init() {
		$this->register_actions();
		$this->register_filters();
	}

	private function register_actions() {
		add_action( 'admin_head', array( $this, 'add_svg_css' ) );
	}

	private function register_filters() {
		add_filter( 'upload_mimes', array( $this, 'add_svg_to_mime_types' ) );
	}

	public function add_svg_to_mime_types( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}

	public function add_svg_css() {
		echo '<style>td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail{ ' .
		     'width: 100% !important; height: auto !important; }</style>';
	}
}