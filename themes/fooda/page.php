<?php
    the_post();
    get_header();
    $self_id = get_the_ID();
	if(has_post_thumbnail()) {
		$image_id = get_post_thumbnail_id( get_the_ID() );
		$image    = wp_get_attachment_image_src( $image_id );
		echo '<span class="featured-image single-post-hero" style="background-image:url(' . $image[0] . ')"></span>';
	}
?>

    <article class="the-post">
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <nav class="share-links">
            <a href="https://twitter.com/intent/tweet?text=<?php the_title_attribute(); ?>&url=<?php the_permalink() ?>" class="genericon genericon-twitter share-twitter" title="Tweet this article"></a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>" class="genericon genericon-facebook-alt share-facebook" title="Share on Facebook"></a>
            <a href="https://plus.google.com/share?url=<?php the_permalink() ?>" class="genericon genericon-googleplus share-gplus" title="Share on G+"></a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&summary=&title=<?php the_title_attribute(); ?>&url=<?php the_permalink(); ?>" class="genericon genericon-linkedin share-linkedin" title="Share on LinkedIn"></a>
            <a href="mailto:&body=Read this post at <?php the_permalink() ?>?subject=<?php the_title(); ?>" class="genericon genericon-mail share-email" title="Share by Email"></a>
        </nav>
        <script>
            jQuery(document).ready(function($){
                $('.share-links a').on('click', function(e) {
                    e.preventDefault();
                    var url = $(this).attr('href');
                    var windowName = '_blank';
                    var windowSizeX = '600';
                    var windowSizeY = '460';
                    var windowSize = 'width=' + windowSizeX + ',height=' + windowSizeY;
                    window.open(url, windowName, windowSize);
                });
            });
        </script>
        <div class="copy">
			<?php the_content(); ?>
        </div>
    </article>

<?php
get_footer();