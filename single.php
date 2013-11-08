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
                <?php 
                    foreach(range(0,3) as $no) {
                        $report_object = get_field("report_$no");
                        if($report_object){
                ?>
                            <div class="report">
                                <?php echo pdf_link(
                                        $report_object["url"],
                                        $report_object["title"],
                                        "pdf shadow"); 
                                ?>
                                <div class="caption">
                                <?php echo $report_object["title"]; ?>
                                </div>
                            </div>
                    <?php }
                    }
                    $report_url = get_field("report_4");
                    if ($report_url){ ?>
                            <div class="report">
                                <?php echo pdf_link(
                                        $report_url,
                                        "report",
                                        "pdf shadow"); 
                                ?>
                                <div class="caption">
                                <?php echo $report_url; ?>
                                </div>
                            </div>
                    <? }
                ?>
		</div><!-- #tirtiary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
