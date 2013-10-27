<?php
/**
 * @package web2feel
 * @since web2feel 1.0
 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class('portfolio-box grid_3'); ?>>
			
			<?php
				$thumb = get_post_thumbnail_id();
				$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
				$image = aq_resize( $img_url, 255, 255, true ); //resize & crop the image
			?>
								
            <a href="<?php the_permalink(); ?>" class="hoverblock">	
			<?php if($image) : ?><img class="portpic" src="<?php echo $image ?>"/><?php endif; ?>
			</a>
                <div class="cover coverbg"></div>
                <div class="cover">
                    <div class="coverinfo">
                        <h2><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'web2feel' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'web2feel' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
                        <?php wpe_excerpt('wpe_excerptlength_index', ''); ?>
                        </a>
                    </div>
                </div>
</article>
					
