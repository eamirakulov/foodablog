<?php get_header(); ?>

<main class="cat-page">
	<div class="container">
		<?php
		if ( function_exists('yoast_breadcrumb') ) {
		  yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
		}
		?>
		<div class="cat-desc">
			<div class="inner">
				<h2><?php echo single_cat_title(); ?></h2>
				<p>Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
				<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
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

	<div class="adv">
		<a href="#"><img src="<?php bloginfo('template_url'); ?>/img/catad.png" style="width: 100%; height: 100%;"></a>
	</div>
	</div>
</main>

<?php get_footer(); ?>