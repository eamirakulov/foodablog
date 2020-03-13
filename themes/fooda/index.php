<?php get_header(); ?>

<main>
	<div class="container">
		<div class="filter">
			<i class="fa fa-search"></i>
			<i class="fa fa-bars"></i>
			<span>Filter</span>
		</div>
		<div class="featured">
			<div class="img" style="background: url(<?php bloginfo('template_url'); ?>/img/main-banner.png) no-repeat center; background-size: cover;"></div>
			<div class="f-content">
				<div class="cat"><a href="#">Favorite Restaurants</a></div>
				<h2 class="title">Best of Fooda Boston 2019</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<div class="more"><a href="#">Read more</a></div>
			</div>
		</div>
<?php 
$args = array(
	'post_type' => 'post',
	'posts_per_page' => 1
	);
// the query
$the_query = new WP_Query( $args ); ?>
 
<?php if ( $the_query->have_posts() ) : ?>
 	<div class="row posts-grid">
    <!-- the loop -->
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    	<div class="col-sm-4 article">
    		<div class="thumb" style="background: url(<?php echo get_the_post_thumbnail_url(); ?>) no-repeat center; background-size: cover; ?>"></div>
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
    		<h3><?php echo the_title(); ?></h3>
    		<p><?php echo the_excerpt(); ?></p>
    		<div class="more"><a href="<?php echo the_permalink(); ?>">Read more</a></div>
    	</div>
    	<div class="col-sm-4 article popular">
    		<div class="thumb" style="background: url(<?php echo get_the_post_thumbnail_url(); ?>) no-repeat center; background-size: cover; ?>">
    			<div class="popular-flag">POPULAR</div>
    		</div>
    		<div class="cat">
    			<a href="#">
    				<?php
	    				$categories = get_the_category(); 
						$cat_name = $categories[0]->cat_name;
						echo $cat_name;
    				?>
    			</a>
    		</div>
    		<h3><?php echo the_title(); ?></h3>
    		<p><?php echo the_excerpt(); ?></p>
    		<div class="more"><a href="<?php echo the_permalink(); ?>">Read more</a></div>
    	</div>
    	<div class="col-sm-4 article type-blue">
    		<div class="inner">
    			<div class="graphics"><i class="fa fa-book"></i></div>
	    		<h3><?php echo the_title(); ?></h3>
	    		<div class="more"><a href="<?php echo the_permalink(); ?>">Read more</a></div>
	    	</div>
    	</div>
    	<div class="col-sm-4 article type-blue">
    		<div class="inner">
    			<div class="graphics"><i class="fa fa-book"></i></div>
	    		<h3><?php echo the_title(); ?></h3>
	    		<div class="more"><a href="<?php echo the_permalink(); ?>">Read more</a></div>
	    	</div>
    	</div>
    	<div class="col-sm-4 article">
    		<div class="thumb" style="background: url(<?php echo get_the_post_thumbnail_url(); ?>) no-repeat center; background-size: cover; ?>"></div>
    		<div class="cat">
    			<a href="#">
    				<?php
	    				$categories = get_the_category(); 
						$cat_name = $categories[0]->cat_name;
						echo $cat_name;
    				?>
    			</a>
    		</div>
    		<h3><?php echo the_title(); ?></h3>
    		<p><?php echo the_excerpt(); ?></p>
    		<div class="more"><a href="<?php echo the_permalink(); ?>">Read more</a></div>
    	</div>
    	<div class="col-sm-4 article popular">
    		<div class="thumb" style="background: url(<?php echo get_the_post_thumbnail_url(); ?>) no-repeat center; background-size: cover; ?>">
    			<div class="popular-flag">POPULAR</div>
    		</div>
    		<div class="cat">
    			<a href="#">
    				<?php
	    				$categories = get_the_category(); 
						$cat_name = $categories[0]->cat_name;
						echo $cat_name;
    				?>
    			</a>
    		</div>
    		<h3><?php echo the_title(); ?></h3>
    		<p><?php echo the_excerpt(); ?></p>
    		<div class="more"><a href="<?php echo the_permalink(); ?>">Read more</a></div>
    	</div>
    	<div class="col-sm-4 article">
    		<div class="thumb" style="background: url(<?php echo get_the_post_thumbnail_url(); ?>) no-repeat center; background-size: cover; ?>"></div>
    		<div class="cat">
    			<a href="#">
    				<?php
	    				$categories = get_the_category(); 
						$cat_name = $categories[0]->cat_name;
						echo $cat_name;
    				?>
    			</a>
    		</div>
    		<h3><?php echo the_title(); ?></h3>
    		<p><?php echo the_excerpt(); ?></p>
    		<div class="more"><a href="<?php echo the_permalink(); ?>">Read more</a></div>
    	</div>
    	<div class="col-sm-4 article type-blue">
    		<div class="inner">
    			<div class="graphics"><i class="fa fa-book"></i></div>
	    		<h3><?php echo the_title(); ?></h3>
	    		<div class="more"><a href="<?php echo the_permalink(); ?>">Read more</a></div>
	    	</div>
    	</div>
    	<div class="col-sm-4 article popular">
    		<div class="thumb" style="background: url(<?php echo get_the_post_thumbnail_url(); ?>) no-repeat center; background-size: cover; ?>">
    			<div class="popular-flag">POPULAR</div>
    		</div>
    		<div class="cat">
    			<a href="#">
    				<?php
	    				$categories = get_the_category(); 
						$cat_name = $categories[0]->cat_name;
						echo $cat_name;
    				?>
    			</a>
    		</div>
    		<h3><?php echo the_title(); ?></h3>
    		<p><?php echo the_excerpt(); ?></p>
    		<div class="more"><a href="<?php echo the_permalink(); ?>">Read more</a></div>
    	</div>
    <?php endwhile; ?>
    <!-- end of the loop -->
 	</div>

	<?php 
		if (function_exists("wp_numeric_posts_nav")) {
			wp_numeric_posts_nav($the_query->max_num_pages);
	    } 
    ?>
 
    <?php wp_reset_postdata(); ?>
 
<?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>