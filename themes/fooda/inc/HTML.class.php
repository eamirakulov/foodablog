<?php

if ( ! defined( 'WPINC' ) ) {
	die;
}

class HTML {

	public static function tag($the_var, $before = '', $after = '', $to_echo = false){
		if(isset($the_var) && $the_var != ''){
			$the_var = $before . $the_var . $after;
			if($to_echo){
				echo $the_var;
			} else {
				return $the_var;
			}
		} else {
			return '';
		}
	}

	public static function button($url, $label, $title = '', $css = '', $to_echo = false){
		if(isset($url) && $url != '' && isset($label) && $label != ''){
			$button = '<a href="'.$url.'" title="'.$title.'" class="'.$css.'">'.$label.'</a>';
			if($to_echo){
				echo $button;
			} else {
				return $button;
			}
		} else {
			return '';
		}
	}

	public static function img($post_id, $size = 'thumbnail', $attributes = array('css'=>'', 'alt'=>''), $to_echo = false){
		$image_id = get_post_thumbnail_id($post_id);
		$image_src = wp_get_attachment_image_src($image_id, $size);
		$css = implode(' ', wp_parse_args(array('gci-thumbnail'), $attributes['css']));
		$alt = $attributes['alt'];
		return self::tag($image_src[0], '<img src="', '" class="'.$css.'" alt="'.$alt.'" />', $to_echo);
	}

	public static function pre($the_var){
		echo '<pre class="pre">';
		var_dump($the_var);
		echo '</pre>';
	}

	public static function show_custom_fields(){
		foreach (get_post_custom_keys() as $field){
			echo '<div style="margin:30px; padding:30px; border:1px solid">';
			echo '<strong>' . $field . ':</strong>' . var_dump(get_field($field));
			echo '</div>';
		}
	}
}