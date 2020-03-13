<?php

if ( ! defined( 'WPINC' ) ) {
	die;
}

class ShortCodes{

	public function __construct() {
		add_shortcode('cta', array($this, 'shortcode_cta'));
	}

	public function shortcode_cta($atts){
		return '<p><a href="'.$atts['url'].'" class="btn-primary btn-cta">'.$atts['label'].'</a></p>';
	}

}