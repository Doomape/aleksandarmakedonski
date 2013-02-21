<?php
/**
 * @package WordPress
 * @subpackage Snow Summit
 * @since Snow Summit 1.0
 */
?>

<?php /* next/previous nav top*/ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<div id="nav-above" class="navigation">
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'snowsummit' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&raquo;</span>', 'snowsummit' ) ); ?></div>
	</div><!-- #nav-above -->
<?php endif; ?>

<?php /* 404 handler */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'snowsummit' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Could not find the item you were trying to reach.', 'snowsummit' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php
	// Loop begins
	$options = get_option( 'snowsummit_theme_options' ); while ( have_posts() ) : the_post(); ?>

<?php /* Gallery cat handler. */ ?>

	<?php if ( isset( $options['gallery_category'] ) && '0' != $options['gallery_category'] && in_category( $options['gallery_category'] ) ) : ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class( 'category-gallery' ); ?>>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'snowsummit' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-meta">
				<?php snowsummit_posted_on(); ?> <span class="meta-sep">|</span> <?php edit_post_link( __( 'Edit', 'snowsummit' ), '', '' ); ?>
			</div><!-- .entry-meta -->

			<div class="entry-content">
			<?php if ( post_password_required() ) : ?>
				<?php the_content(); ?>
			<?php else : ?>
				<?php
					$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
					if ( $images ) :
						$total_images = count( $images );
						$image = array_shift( $images );
						$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
				?>
						<div class="gallery-thumb">
							<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
						</div><!-- .gallery-thumb -->
						<p><em><?php printf( __( 'This gallery contains <a %1$s>%2$s photos</a>.', 'snowsummit' ),
								'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'snowsummit' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
								$total_images
							); ?></em></p>
				<?php endif; ?>
					<?php the_excerpt(); ?>
			<?php endif; ?>
			</div><!-- .entry-content -->

			<div class="entry-info">
			</div><!-- .entry-info -->
		</div><!-- #post-## -->

<?php /* Asides cat handler */ ?>

	<?php elseif ( isset( $options['aside_category'] ) && '0' != $options['aside_category'] && in_category( $options['aside_category'] ) ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class( 'category-asides' ); ?>>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'snowsummit' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-meta">
				<?php snowsummit_posted_on(); ?><span class="comments-link"><span class="meta-sep">|</span> <?php comments_popup_link( __( 'Leave a comment', 'snowsummit' ), __( '1 Comment', 'snowsummit' ), __( '% Comments', 'snowsummit' ) ); ?> <span class="meta-sep">|</span> <?php edit_post_link( __( 'Edit', 'snowsummit' ), '', '' ); ?></span>
			</div><!-- .entry-meta -->
		<?php if ( is_archive() || is_search() ) : // if archive or search show post excerpt ?>
			<div class="entry-summary aside">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php else : ?>
			<div class="entry-content aside">
				<?php the_content( __( 'Read more <span class="meta-nav">&raquo;</span>', 'snowsummit' ) ); ?>
			</div><!-- .entry-content -->
		<?php endif; ?>

			<div class="entry-info">
				<!--p><?php snowsummit_posted_on(); ?></p-->
				<!--?php edit_post_link( __( 'Edit', 'snowsummit' ), '', '' ); ?-->
			</div><!-- .entry-info -->
		</div><!-- #post-## -->

<?php /* Regular posts. */ ?>

	<?php else : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'snowsummit' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-meta">
				<?php snowsummit_posted_on(); ?><span class="comments-link"><span class="meta-sep">|</span> <?php comments_popup_link( __( 'Leave a comment', 'snowsummit' ), __( '1 Comment', 'snowsummit' ), __( '% Comments', 'snowsummit' ) ); ?></span>
			</div><!-- .entry-meta -->

	<?php if ( is_search() ) : // If search show excerpt ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
	<?php else : ?>
			<div class="entry-content">
				<?php the_content( __( 'Read more <span class="meta-nav">&raquo;</span>', 'snowsummit' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'snowsummit' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
	<?php endif; ?>

			<div class="entry-info">
				<?php if ( count( get_the_category() ) ) : ?>
					<p class="cat-links">
						<?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'snowsummit' ), 'entry-info-prep entry-info-prep-cat-links', get_the_category_list( ', ' ) ); ?>
					</p>
				<?php endif; ?>
				<?php
					$tags_list = get_the_tag_list( '', ', ' );
					if ( $tags_list ):
				?>
					<p class="tag-links">
						<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'snowsummit' ), 'entry-info-prep entry-info-prep-tag-links', $tags_list ); ?>
					</p>
				<?php endif; ?>
				<?php edit_post_link( __( 'Edit', 'snowsummit' ), '<p class="edit-link">', '</p>' ); ?>
			</div><!-- .entry-info -->
		</div><!-- #post-## -->

		<?php comments_template( '', true ); ?>

	<?php endif; // Close cat/aside conditional ?>

<?php endwhile; // Loop ends ?>

<?php /* next/previous nav bottom */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'snowsummit' ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&raquo;</span>', 'snowsummit' ) ); ?></div>
				</div><!-- #nav-below -->
<?php endif; ?>