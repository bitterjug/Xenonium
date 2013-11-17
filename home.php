<?php
/**
 * Custom home page template
 * Displays the energy section first and then the 
 * other section
 */
get_header(); ?>
		<div id="primary" class="content-area grid_9 equal_height">
			<div id="content" class="site-content cf" role="main">
                <?php 
                query_posts("post_type=project"); 
                while ( have_posts() ) : 
                    the_post(); 
                    get_template_part( 'content', 'home' ); 
                endwhile; 
                ?>
                <div class="clear"></div>
			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
<?php get_footer(); ?>
