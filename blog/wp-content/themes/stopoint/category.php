<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package Catch Themes
 * @subpackage Catch_Evolution_Pro
 * @since Catch Evolution 1.0
 */

get_header(); 


?>
<?php $cur_cat_id = get_cat_id( single_cat_title("",false) ); ?>
<?php query_posts('showposts=3&cat='.$cur_cat_id); 
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
			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php
						printf( __( 'Category Archives: %s', 'catchevolution' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					?></h1>

					<?php
						$category_description = category_description();
						if ( ! empty( $category_description ) )
							echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
					?>
				</header>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

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

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
