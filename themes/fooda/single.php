<?php get_header(); ?>
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5e823be4f8001300197231cd&product=inline-share-buttons" async="async"></script>

	<main class="individual">
            
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
        <?php $sideCta = get_field('cta_item'); ?>
        <?php
            if( have_rows('cta_item') ):
                while ( have_rows('cta_item') ) : the_row(); ?>
                    <div class="side-cta hidden-xs" style="top: <?php echo the_sub_field('position'); ?>%;">
                        <?php if(get_sub_field('header_image')) : ?>
                            <div class="thumb"><img src="<?php echo the_sub_field('header_image'); ?>"></div>
                        <?php endif; ?>
                        <h3><?php echo the_sub_field('text'); ?></h3>
                        <div><a href="<?php echo the_sub_field('button_link'); ?>"><?php echo the_sub_field('button'); ?></a></div>
                    </div>
                <?php endwhile;
            else :
                // no rows found
            endif;

            ?>
      	<?php if(have_posts()): the_post(); ?>
            <div class="container">
                <div class="share hidden-xs">
                    <div data-network="twitter" class="st-custom-button"><img src="<?php bloginfo('template_url'); ?>/img/twitter.svg"></div>
                    <div data-network="facebook" class="st-custom-button"><img src="<?php bloginfo('template_url'); ?>/img/facebook.svg"></div> 
                    <div data-network="email" class="st-custom-button"><img src="<?php bloginfo('template_url'); ?>/img/email.svg"></div> 
                    <div data-network="linkedin" class="st-custom-button"><img src="<?php bloginfo('template_url'); ?>/img/linkedin.svg"></div>
                </div>
    			<article class="post single">
    				<div class="banner" style="background: url(<?php echo get_the_post_thumbnail_url(); ?>) no-repeat center; background-size: cover;">
    				</div>

    				<div class="entry_header">
                        <?php
                        if ( function_exists('yoast_breadcrumb') ) {
                          yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
                        }
                        ?>


                        <h2 class="entry_title">
                            <?php the_title(); ?>
                        </h2>

                        <div class="auth">
                            <img src="<?php bloginfo('template_url'); ?>/img/person.jpg">

                            <div>
                                This post was written by:
                                <div class="name"><?php echo get_the_author_meta('display_name'); ?>, <br><?php echo the_author_meta('description'); ?></div>

                            </div>
                        </div>
    				</div>
    			</article>
    		</div>

            <div class="container">
                <article class="post single">
                    <div class="entry_content">
                        <div class="share-mobile visible-xs">
                            <div data-network="twitter" class="st-custom-button"><img src="<?php bloginfo('template_url'); ?>/img/twitter.svg"></div>
                            <div data-network="facebook" class="st-custom-button"><img src="<?php bloginfo('template_url'); ?>/img/facebook.svg"></div> 
                            <div data-network="email" class="st-custom-button"><img src="<?php bloginfo('template_url'); ?>/img/email.svg"></div> 
                            <div data-network="linkedin" class="st-custom-button"><img src="<?php bloginfo('template_url'); ?>/img/linkedin.svg"></div>
                        </div>
                        <?php the_content(); ?>
                    </div>
                </article>
            </div>
    	<?php endif; ?>
    </main>
    <div class="related-container">
        <?php $sideCta = get_field('cta_item'); ?>
        <?php
            if( have_rows('cta_item') ):
                while ( have_rows('cta_item') ) : the_row(); ?>
                    <div class="side-cta visible-xs" style="top: <?php echo the_sub_field('position'); ?>%;">
                        <?php if(get_sub_field('header_image')) : ?>
                            <div class="thumb"><img src="<?php echo the_sub_field('header_image'); ?>"></div>
                        <?php endif; ?>
                        <h3><?php echo the_sub_field('text'); ?></h3>
                        <div><a href="<?php echo the_sub_field('button_link'); ?>"><?php echo the_sub_field('button'); ?></a></div>
                    </div>
                <?php endwhile;
            else :
                // no rows found
            endif;

            ?>
        <h3 class="heading">Related Articles</h3>
        <?php
        $args = array(
            'post__not_in' => array($post->ID),
            'posts_per_page' => 3,
            'caller_get_posts' => 1,
            'category__in' => wp_get_post_categories($post->ID)
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
            <?php endwhile; ?>
            <!-- end of the loop -->
            </div>
            <?php wp_reset_postdata(); wp_reset_query();?>
         
        <?php else : ?>
            <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
        <?php endif; ?>
    </div>

<?php get_footer(); ?>