<?php
/**
 * The Template for displaying all single posts.
 *
 * @package web2feel
 * @since web2feel 1.0
 */

get_header(); ?>

		<div id="primary" class="content-area grid_6 equal_height">
			<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
		<div id="tirtiary" class="content-area grid_3 equal_height" >

            <?php while(has_sub_field('reports')): ?>
                <div class="report">
                    <?php 
                        $report_object = get_sub_field('report');
                        $url = $report_object["url"];
                        $title = $report_object["title"];
                        $cover_object = get_sub_field('cover');
                        $cover_url = $cover_object["url"];
                        $width = 120;
                        $height = 170;
                        $cover = aq_resize( $cover_url, $width, $height, true ); //resize & crop thumbnail if necessary
                        echo "<a href=\"$url\" title=\"$title\">";
                        echo "<img class=\"report shadow\" src=\"$cover\" alt=\"$title\"/>";
                        echo "</a>";
                    ?>
                    <div class="caption">
                    <?php 
                        echo "<a href=\"$url\" title=\"$title\">";
                        echo $title; 
                        echo "</a>";
                    ?>
                    </div>
                </div>
            <?php endwhile; ?>

		</div><!-- #tirtiary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
