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
 * @package Catch Themes
 * @subpackage Catch_Evolution_Pro
 */


get_header(); 
 
?>            	

<?php 

query_posts('showposts=3&cat=49'); 
 if ( have_posts() ) ;
 $counter =0; ?>
 <div class="row news">
 <?php
while ( have_posts() ) : the_post(); 
?>
<div class="col-lg-4 col-md-4 col-sm-4 featured">
<div class="col-md-12 col-lg-12  col-sm-12 news_img"><?php the_post_thumbnail( $size, $attr ); ?> </div>
<div class="col-md-12 col-lg-12  col-sm-12">
<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<p></p><p><?php the_excerpt(); ?></p>
<p></p>
</div>
</div>
<?php 
//endif;

$counter++;
endwhile;
wp_reset_query();
?>

</div>
			<?php
			
			 if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

				<?php catchevolution_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'catchevolution' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'catchevolution' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; 
			
			
			?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>