<?php
/**
 * Custom home page template
 * Displays the energy section first and then the 
 * other section
 */

function loop( $section ){
    query_posts("section_name=$section"); 
    while ( have_posts() ) : 
        the_post(); 
        get_template_part( 'content', 'home' ); 
    endwhile; 
}

get_header(); ?>

		<div id="primary" class="content-area grid_9 equal_height">
			<div id="content" class="site-content cf" role="main">
                <?php loop( of_get_option('primary_section') )?>
                <div class="clear"></div>
                <?php loop( of_get_option('secondary_section') )?>
                <div class="clear"></div>
			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
<?php get_footer(); ?>
