<?php
use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;


/*Category color*/
Container::make( 'term_meta', 'Category Properties' )
         ->show_on_taxonomy( 'category' )
         ->add_fields( array(
	         Field::make( 'color', 'fooda_category_color' ),
	         Field::make( 'text', 'fooda_category_order' )
         ) );

/*Single post custom fields*/
Container::make( 'post_meta', 'Post Meta' )
         ->show_on_post_type( 'post' )
         ->set_context( 'advanced' )
         ->set_priority( 'core' )
         ->add_fields( array(
	         Field::make( 'textarea', 'post_intro' )->set_rows( 6 )->help_text( 'If exists - this will show under the post\'s title as an H2' ),
	         Field::make( 'text', 'post_teaser' )->help_text( 'This is used if this post is featured on the home page hero' ),
	         Field::make( 'image', 'post_hero_image' )->help_text( 'This is used for the hero image' ),
         ) );

/*General theme options*/
Container::make( 'theme_options', 'Fooda Settings' )
         ->set_page_parent( 'index.php' )
         ->add_fields( array(
	         Field::make( 'relationship', 'home_featured_story' )->set_post_type( 'post' )->set_max( 1 )
         ) );