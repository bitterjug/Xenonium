<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package web2feel
 * @since   web2feel 1.0
 */
?>
<div id="secondary" class="widget-area grid_3 equal_height" role="complementary">

		<header id="masthead" class="site-header" role="banner">
            <?php 
                $logo = of_get_option('masthead_logo'); 
                $alt = of_get_option('masthead_alt_text'); 
            ?>
            <a href="<?php echo home_url('/'); ?>" 
               title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"
               rel="home"><img src="<?php echo ($logo);?>" 
               alt="<?php echo ($alt); ?>"/></a>
		</header><!-- #masthead .site-header -->
        <?php dynamic_sidebar('sidebar-1') ?>	
        <div class="squarebanner cf"></div>
</div><!-- #secondary .widget-area -->
