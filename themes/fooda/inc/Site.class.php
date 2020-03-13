<?php

if ( ! defined( 'WPINC' ) ) {
	die;
}

class Site {

	public function __construct() {
		$this->register_actions();
	}

	private function register_actions() {
		add_action( 'after_setup_theme', array( $this, 'setup_theme_support' ), 1 );
		add_action( 'admin_menu', array( $this, 'fooda_add_admin_page' ));
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
	}

	public function setup_theme_support() {
		add_theme_support( 'title-tag' );

		$markup = array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', );
		add_theme_support( 'html5', $markup );
		//add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'card-thumbnail', 720, 0, false ); // 220 pixels wide by 180 pixels tall, soft proportional crop mode
	}

	public function register_navs() {
		register_nav_menus( array(
			'main-nav' => 'Main Navigation',
			'footer-left' => 'Footer left',
			'footer-center' => 'Footer center',
			'footer-right' => 'Footer right',
		) );
	}

	public function fooda_add_admin_page() {
		add_posts_page( 'Fooda Posts list', 'Fooda Posts list', 'manage_options', 'fooda-posts-list', array($this, 'fooda_add_posts_list') );
	}

	public function fooda_add_posts_list() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		$q = new WP_Query(array(
			'post_type'=>'post',
			'posts_per_page' => -1,
			'post_status' => array('publish', 'private', 'draft')
		));
		if($q->have_posts()){
			echo '<div class="wrap"><pre>';
			while ($q->have_posts()){
				$q->the_post();
				echo get_the_title(get_the_ID()) . ', ' . get_permalink(get_the_ID()) . "\n";
			}
			echo '</pre></div>';
		}
	}
}