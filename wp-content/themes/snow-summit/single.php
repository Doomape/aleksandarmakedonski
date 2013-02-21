<?php
/**
 * @package WordPress
 * @subpackage Snow Summit
 * @since Snow Summit 1.0
 */

get_header(); ?>

		<div id="content-container">
			<div id="content" role="main">

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="nav-above" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'snowsummit' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'snowsummit' ) . '</span>' ); ?></div>
				</div><!-- #nav-above -->

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-meta">
						<?php snowsummit_posted_on(); ?><span class="comments-link"><span class="meta-sep">|</span> <?php comments_popup_link( __( 'Leave a comment', 'snowsummit' ), __( '1 Comment', 'snowsummit' ), __( '% Comments', 'snowsummit' ) ); ?></span>
						<?php edit_post_link( __( 'Edit', 'snowsummit' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-meta -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'snowsummit' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->

					<div class="entry-info">
						<?php snowsummit_posted_in(); ?>
						<?php edit_post_link( __( 'Edit', 'snowsummit' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-info -->
				</div><!-- #post-## -->

				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'snowsummit' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'snowsummit' ) . '</span>' ); ?></div>
				</div><!-- #nav-below -->

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #content-container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>