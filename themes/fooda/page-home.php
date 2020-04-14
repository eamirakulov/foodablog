<?php get_header(); ?>
<?php 
	global $paged;
	if ( get_query_var( 'paged' ) ) { 
		$paged = get_query_var( 'paged' ); 
	} elseif ( get_query_var( 'page' ) ) { 
		$paged = get_query_var( 'page' ); 
	} else { 
		$paged = 1; 
	}
?>
<main>
	<?php if(get_field('cta_type') == 'Slide Out CTA') : ?>
		<?php $slideOutCta = get_field('slide_out_cta'); ?>
		<div class="fade-area">
			<div class="slide-out-cta" data-delay="<?php echo $slideOutCta['delay_time']; ?>">
				<a href="#" class="close-cta"><img src="<?php bloginfo('template_url'); ?>/img/closew.svg"></a>
				<div class="top" style="background: <?php echo $slideOutCta['header_color']; ?>">
					<?php
						echo $slideOutCta['title'];
					?>
	 			</div>
				<div class="text">
					<h3><?php echo $slideOutCta['subtitle']; ?></h3>
					<p><?php echo $slideOutCta['text']; ?></p>
				</div>
				
				<div class="buttons">
					<?php if(isset($slideOutCta['accept_btn'])) : ?>
						<a class="button-main" href="<?php echo $slideOutCta['link']; ?>"><?php echo $slideOutCta['accept_btn']; ?></a>
					<?php endif; ?>
					<?php if(isset($slideOutCta['additional_button_text'])) : ?>
						<a href="#" class="button-alt"><?php echo $slideOutCta['additional_button_text']; ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<?php if(get_field('cta_type') == 'Lightbox CTA') : ?>
		<?php $lightboxCta = get_field('lightbox_cta'); ?>
		<div class="lightbox-cta" data-delay="<?php echo $lightboxCta['delay_time']; ?>">
			<div class="inner">
				<a href="#" class="close-cta"><img src="<?php bloginfo('template_url'); ?>/img/closed.svg"></a>
				<h2><?php echo $lightboxCta['title']; ?></h2>
				<div class="text"><?php echo $lightboxCta['text']; ?></div>
			</div>
		</div>
	<?php endif; ?>
	<div class="filter-box">
		<a href="#" class="close-filter"><img src="<?php bloginfo('template_url'); ?>/img/filtercross.svg"></a>
		
		<div class="container">
			<h2>Filter</h2>
			<div class="cloud">
				<?php

				$taxonomy = 'category';
				$tax_terms = get_terms($taxonomy);
				?>
				<?php
				foreach ($tax_terms as $tax_term) {
				echo '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all posts in %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a>';
				}
				?>
			</div>
		</div>
	</div>
	<div class="filter">
		<div class="container">
			<span class="toggle-search">
				<i class="fa fa-search"></i>
				<form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
					<input type="text" placeholder="Search Fooda Blog" value="" name="s" id="s" />
					<input style="display: none;" name="submit" type="submit" />
				</form>
			</span>
			<span class="toggle-filter">
				<i class="fa fa-bars"></i>
				<span>Filter</span>
			</span>
		</div>
	</div>
	<div class="container">
		<?php 
			if($paged == 1) :
				$the_query = new WP_Query( array( 'posts_per_page' => 1, 'meta_key' => '_is_ns_featured_post', 'meta_value' => 'yes' ) ); ?>

				<?php if ( $the_query->have_posts() ) : ?>
				    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<div class="featured">
							<div class="img" style="background: url(<?php echo get_the_post_thumbnail_url(); ?>) no-repeat center; background-size: cover;"></div>
							<div class="f-content">
								<div class="cat">
					    			<?php 
						    				$categories = get_the_category(); 
											$cat_name = $categories[0]->cat_name;
											$cat_url = get_category_link($categories[0]->term_id);
									?>
					    			<a href="<?php echo $cat_url; ?>">
					    				<?php
											echo $cat_name;
					    				?>
					    			</a>
								</div>
								<h2 class="title"><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h2>
								<p><?php echo the_excerpt(); ?></p>
								<div class="more"><a href="<?php echo the_permalink(); ?>">Read more</a></div>
							</div>
						</div>
				    <?php endwhile; ?>
				    <?php wp_reset_postdata(); wp_reset_query();?>
				 
				<?php else : ?>
				    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<?php endif; ?>
			<?php endif; ?>

<?php 
run_query_change();

if(!empty($_GET['s'])) {
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 15,
		'paged' => $paged,
		'meta_query' => array(
	        'relation' => 'AND',
	        array(
	            'key' => '_is_ns_featured_post',
	            'value'   => 'yes',
	            'compare' => 'NOT EXISTS',
	        ),
	    ),
		's' => $_GET['s']
	);
}
else {
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 15,
		'paged' => $paged,
		'meta_query' => array(
	        'relation' => 'AND',
	        array(
	            'key' => '_is_ns_featured_post',
	            'value'   => 'yes',
	            'compare' => 'NOT EXISTS',
	        ),
	    ),
	);
}

// the query
$the_query = new WP_Query( $args ); ?>
 
<?php if ( $the_query->have_posts() ) : ?>
 	<div class="row posts-grid">
    <!-- the loop -->
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    	<?php 
    		$flag = get_field('flag'); 
    		$tile = get_field('tile');
    	?>
    	<?php if(get_field('type') == 'default') : ?>
    	<div class="col-sm-4 article <?php echo the_field('type'); ?>">
    		 <a href="<?php the_permalink(); ?>"><div class="thumb" style="background: url(<?php echo get_the_post_thumbnail_url(); ?>) no-repeat center; background-size: cover; ?>">
    			<?php if(!empty($flag['text'])) : ?>
    			<div class="flag-text" style="color: <?php echo $flag['text_color']; ?>;background: <?php echo $flag['background_color']; ?>"><?php echo $flag['text']; ?></div>
    			<?php endif; ?>
    		</div></a>
    		<div class="cat">
    			<?php 
	    				$categories = get_the_category(); 
						$cat_name = $categories[0]->cat_name;
						$cat_url = get_category_link($categories[0]->term_id);
				?>
    			<a href="<?php echo $cat_url; ?>">
    				<?php
						echo $cat_name;
    				?>
    			</a>
    		</div>
    		<h3><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
    		<p><?php echo the_excerpt(); ?></p>
    		<div class="more"><a href="<?php echo the_permalink(); ?>">Read more</a></div>
    	</div>
    	<?php elseif(get_field('type') == 'tile') : ?>
		<div class="col-sm-4 article <?php echo the_field('type'); ?>">
    		<div class="inner">
    			<div class="graphics"><img src="<?php echo $tile['icon']; ?>"></div>
	    		<h3><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
	    		<div class="more"><a href="<?php echo $tile['link']; ?>"><?php echo $tile['link_text']; ?></a></div>
	    	</div>
    	</div>
    	<?php else : ?>
    	<div class="col-sm-4 article <?php echo the_field('type'); ?>">
    		 <a href="<?php the_permalink(); ?>"><div class="thumb" style="background: url(<?php echo get_the_post_thumbnail_url(); ?>) no-repeat center; background-size: cover; ?>">
    		</div></a>
    		<div class="cat">
    			<?php 
	    				$categories = get_the_category(); 
						$cat_name = $categories[0]->cat_name;
						$cat_url = get_category_link($categories[0]->term_id);
				?>
    			<a href="<?php echo $cat_url; ?>">
    				<?php
						echo $cat_name;
    				?>
    			</a>
    		</div>
    		<h3><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
    		<p><?php echo the_excerpt(); ?></p>
    		<div class="more"><a href="<?php echo the_permalink(); ?>">Read more</a></div>
    	</div>
    	<?php endif; ?>
    <?php endwhile; ?>
    <!-- end of the loop -->
 	</div>

	<?php 
		if (function_exists("theme_pagination")) {
			theme_pagination($the_query->max_num_pages);
	    } 
    ?>
 
    <?php wp_reset_postdata(); wp_reset_query();?>
 
<?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>