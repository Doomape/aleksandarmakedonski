<?php
/**
 * @package WordPress
 * @subpackage Snow Summit
 * @since Snow Summit 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if (gt IE 6) | (!IE)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>

<?php global $page, $paged; wp_title( '|', true, 'right' ); bloginfo( 'name' );

	// Conditional page description
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
		
	// Conditional page number
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'snowsummit' ), max( $paged, $page ) );

	?>
	
</title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	// For threaded comments
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// For any plugins that need to add to page header via wp_head filter
	wp_head();
?>
</head>

<body <?php body_class(); ?> >
<div id="outerwrap">

<?php // The top navigation menu custom nav defaults to show current date and current time ?>
<div id="topnav">
<div id="site-description"><?php bloginfo( 'description' ); ?></div>
<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'fallback_cb' => 'snowsummit_top_nav', 'theme_location' => 'top' ) ); ?>
</div><!-- #topnav -->

<div id="wrapper">

<div id="container" class="hfeed">
		
	<div id="header">
		<div id="masthead" role="banner">
		<?php // The site/blog name ?>
		
			<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
			<<?php echo $heading_tag; ?> id="site-title">
				<span>
					<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</span>
			</<?php echo $heading_tag; ?>>
			
			<?php // Begin header widget space ?>
			<div id="header-widget-area">
					<?php if ( is_active_sidebar( 'header-widget-area' ) ) : ?>

		<div id="header-widget">	
				<?php dynamic_sidebar( 'header-widget-area' ); ?>
		</div><!-- #feature.widget-area -->

		<?php endif; ?>
		</div>
		<?php // End header widget space ?>
		</div><!-- #masthead -->


		<div id="branding">
			<?php // The header image stuff ?>
			<?php if ( get_header_image() != '' ) : ?>
			<a href="<?php echo home_url( '/' ); ?>">
				<?php
					if ( is_singular() &&
					has_post_thumbnail( $post->ID ) &&
					( $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
					$image[1] >= HEADER_IMAGE_WIDTH ) :					
					echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
					else : ?>
					<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
				<?php endif; ?>
			</a>
			<?php endif; ?>
			
			
		<?php // The second custom navigation menu. Defaults to wp_list_pages ?>
		<div id="access" role="navigation">
			<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
		</div><!-- #access -->
	
	<?php // The search bar under second custom navigation menu ?>
	<div class="hsearch"><?php get_search_form(); ?></div>

			
		</div><!-- #branding -->
		
		
		<?php
	// leaderboard widget area under search bar
	if ( is_active_sidebar( 'leaderboard-widget-area-header' ) ) : ?>

		<div id="waleader">
		<?php dynamic_sidebar( 'leaderboard-widget-area-header' ); ?>
		</div><!-- #waleader -->

<?php endif; ?>	
	</div><!-- #header -->

	<div id="contentblock">
