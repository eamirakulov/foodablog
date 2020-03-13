<?php get_header(); ?>
	<main class="individual">
      	<?php if(have_posts()): the_post(); ?>
            <div class="container">
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
                                <div class="name"><?php echo get_the_author_meta('display_name'); ?></div>
                            </div>
                        </div>
    				</div>
    			</article>
    		</div>

            <div class="container">
                <article class="post single">
                    <div class="entry_content">
                        <?php the_content(); ?>
                    </div>
                </article>
            </div>
    	<?php endif; ?>
    </main>

<?php get_footer(); ?>