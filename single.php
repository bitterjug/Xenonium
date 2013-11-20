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
// The following depends on the custom fields being setup :-
// 'reports' is repeater containing
// 'cover', which is the thumbnail image
// 'location' is either 'local' or 'remote'
// 'report' is the uploaded report file, IF local
// 'url' is the address of the remote report if remote
// caption is the caption to display if remote
$cover_object = get_sub_field('cover');
$cover_url = $cover_object["url"];
$cover_alt = $cover_object["alt"];
$width = 120;
$height = 170;
//resize & crop thumbnail if necessary
$cover = aq_resize( $cover_url, $width, $height, true ); 
if (get_sub_field('location')=='local')
{
    $report_object = get_sub_field('report');
    $url = $report_object["url"];
    $title = $report_object["title"];
    $alt = empty($cover_alt)? $title : $cover_alt;
    $report_caption = $report_object["caption"];
    $caption = empty($report_caption)? $title : $report_caption;
} else {
    $url = get_sub_field('url');
    $caption = get_sub_field('caption');
    $title = $caption;
    $alt = $caption;
}
echo "<a href=\"$url\" title=\"$title\">";
echo "<img class=\"report shadow\" src=\"$cover\" alt=\"$alt\"/>";
echo "</a>";
                    ?>
                    <div class="caption">
                    <?php echo "<a href=\"$url\" title=\"$title\">$caption</a>"; ?>
                    </div>
                </div>
            <?php endwhile; ?>

		</div><!-- #tirtiary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
