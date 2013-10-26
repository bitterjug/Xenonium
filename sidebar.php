<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package web2feel
 * @since web2feel 1.0
 */
?>
<div id="secondary" class="widget-area grid_3 equal_height" role="complementary">

		<header id="masthead" class="site-header" role="banner">
			<div class="logo">
			<h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2><?php bloginfo( 'description' ); ?></h2>
			</div>
		</header><!-- #masthead .site-header -->
		
		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>	<?php endif; // end sidebar widget area ?>
		
		<?php get_template_part( 'sponsors' ); ?>
		<?php get_search_form(); ?>
		
</div><!-- #secondary .widget-area -->
