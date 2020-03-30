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
				<p><?php the_archive_description(); ?></p>
			</div>
		</div>
<?php 

global $paged;
$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

$args = array(
    'post_type' => 'post',
    'posts_per_page' => 6,
    'paged' => $paged,
    'cat' => get_query_var('cat')
);

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
            <div class="thumb" style="background: url(<?php echo get_the_post_thumbnail_url(); ?>) no-repeat center; background-size: cover; ?>">
                <div class="flag-text" style="color: <?php echo $flag['text_color']; ?>;background: <?php echo $flag['background_color']; ?>"><?php echo $flag['text']; ?></div>
            </div>
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
        <?php elseif(get_field('type') == 'tile') : ?>
        <div class="col-sm-4 article <?php echo the_field('type'); ?>">
            <div class="inner">
                <div class="graphics"><img src="<?php echo $tile['icon']; ?>"></div>
                <h3><?php echo the_title(); ?></h3>
                <div class="more"><a href="<?php echo $tile['link']; ?>">Read more</a></div>
            </div>
        </div>
        <?php else : ?>
        <div class="col-sm-4 article <?php echo the_field('type'); ?>">
            <div class="thumb" style="background: url(<?php echo get_the_post_thumbnail_url(); ?>) no-repeat center; background-size: cover; ?>">
            </div>
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
        <?php endif; ?>
        <!--<div class="col-sm-4 article flag">
            <div class="thumb" style="background: url(<?php echo get_the_post_thumbnail_url(); ?>) no-repeat center; background-size: cover; ?>">
                <div class="flag-text">POPULAR</div>
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
        <div class="col-sm-4 article type-tile">
            <div class="inner">
                <div class="graphics"><i class="fa fa-book"></i></div>
                <h3><?php echo the_title(); ?></h3>
                <div class="more"><a href="<?php echo the_permalink(); ?>">Read more</a></div>
            </div>
        </div>-->
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

	<div class="adv">
		<a href="#"><img src="<?php bloginfo('template_url'); ?>/img/catad.png" style="width: 100%; height: 100%;"></a>
	</div>
	</div>
</main>

<?php get_footer(); ?>