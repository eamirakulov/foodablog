<?php get_header(); ?>
<?php 
$term = get_queried_object();
?>
<?php if(get_field('cta_type', $term) == 'Slide Out CTA') : ?>
    <?php $slideOutCta = get_field('slide_out_cta', $term); ?>
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
<?php if(get_field('cta_type', $term) == 'Lightbox CTA') : ?>
    <?php $lightboxCta = get_field('lightbox_cta', $term); ?>
    <div class="lightbox-cta" data-delay="<?php echo $lightboxCta['delay_time']; ?>">
        <div class="inner">
            <a href="#" class="close-cta"><img src="<?php bloginfo('template_url'); ?>/img/closed.svg"></a>
            <h2><?php echo $lightboxCta['title']; ?></h2>
            <div class="text"><?php echo $lightboxCta['text']; ?></div>
        </div>
    </div>
<?php endif; ?>
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
    'posts_per_page' => 15,
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

<div class="adv">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Category Bottom Area") ) : ?>
<?php endif;?>
</div>
</main>

<?php get_footer(); ?>