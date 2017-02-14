<?php

/**

 * The template for displaying content in the single.php template

 *

 * @package Catch Themes

 * @subpackage Catch_Evolution_Pro

 * @since Catch Evolution 1.0

 */

?>

<p class="text-right">

			<a href="/blog">&lt;- Blog Home</a>

		</p>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<span class="cat-links mycatlinks"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'twentyfourteen' ) ); ?></span>	

<header class="entry-header">

		<h1 class="entry-title"><?php the_title(); ?></h1>



		<?php if ( 'post' == get_post_type() ) : ?>

            <div class="title-meta">

                <?php catchevolution_posted_on(); ?>

                <?php if ( comments_open() && ! post_password_required() ) : ?>

                    <span class="sep"> &mdash; </span>

                    <span class="comments-link">

                        <?php comments_popup_link(__('Leave a reply', 'catchevolution'), __('1 Comment &darr;', 'catchevolution'), __('% Comments &darr;', 'catchevolution')); ?>

                    </span>

                <?php endif; ?>

            </div><!-- .entry-meta -->

		<?php endif; ?>

	</header><!-- .entry-header -->

          

	<div class="entry-content">

               <?php the_post_thumbnail(); ?>

		<?php the_content(); ?>

		<?php wp_link_pages( array( 

			'before'		=> '<div class="page-link"><span class="pages">' . __( 'Pages:', 'catchevolution' ) . '</span>',

			'after'			=> '</div>',

			'link_before' 	=> '<span>',

			'link_after'   	=> '</span>',

		) ); 

		?>

	</div><!-- .entry-content -->



	<footer class="entry-meta">

		<?php

			/* translators: used between list items, there is a space after the comma */

			$categories_list = get_the_category_list( __( ', ', 'catchevolution' ) );



			/* translators: used between list items, there is a space after the comma */

			$tag_list = get_the_tag_list( '', __( ', ', 'catchevolution' ) );

			if ( '' != $tag_list ) {

				$utility_text = __( 'This entry was posted in %1$s and tagged %2$s by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'catchevolution' );

			} elseif ( '' != $categories_list ) {

				$utility_text = __( 'This entry was posted in %1$s by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'catchevolution' );

			} else {

				$utility_text = __( 'This entry was posted by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'catchevolution' );

			}



			printf(

				$utility_text,

				$categories_list,

				$tag_list,

				esc_url( get_permalink() ),

				the_title_attribute( 'echo=0' ),

				get_the_author(),

				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )

			);

		?>

		<?php edit_post_link( __( 'Edit', 'catchevolution' ), '<span class="edit-link">', '</span>' ); ?>



		

	</footer><!-- .entry-meta -->

</article><!-- #post-<?php the_ID(); ?> -->



<?php if ( get_the_author_meta( 'description' ) && ( ! function_exists( 'is_multi_author' ) || is_multi_author() ) ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries ?>

		<div id="author-info">

			<div id="author-avatar">

				<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'catchevolution_author_bio_avatar_size', 68 ) ); ?>

			</div><!-- #author-avatar -->

			<div id="author-description">

				<h2><?php printf( __( 'About %s', 'catchevolution' ), get_the_author() ); ?></h2>

				<?php the_author_meta( 'description' ); ?>

				<div id="author-link">

					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">

						<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'catchevolution' ), get_the_author() ); ?>

					</a>

				</div><!-- #author-link	-->

			</div><!-- #author-description -->

		</div><!-- #entry-author-info -->

<?php endif; ?>        