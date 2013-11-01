<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package web2feel
 * @since web2feel 1.0
 */

get_header(); ?>

		<div id="primary" class="content-area grid_9 equal_height">
			<div id="content" class="site-content cf" role="main">

			<?php if ( have_posts() ) : ?>

				

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'home' ); ?>

				<?php endwhile; ?>
				<div class="clear"></div>
				
				<div class="pagination">
					<?php 					
					$big = 999999999; // need an unlikely integer
					
					echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $wp_query->max_num_pages
					) );
					?>					
				</div>

			

			<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>

				<?php get_template_part( 'no-results', 'index' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->


<?php get_footer(); ?>
