<?php
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 500;

$themecolors = array(
	'bg' => 'ffffff',
	'text' => '000000',
	'link' => '0060ff'
);

/** Tell WordPress to run snowsummit_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'snowsummit_setup' );

if ( ! function_exists( 'snowsummit_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * To override snowsummit_setup() in a child theme, add your own snowsummit_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Snow Summit 1.0
 */
function snowsummit_setup() {

	// This theme has some pretty cool theme options
	require_once ( get_template_directory() . '/inc/theme-options.php' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'snowsummit', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'snowsummit' ),
		'top' => __( 'Top Navigation', 'snowsummit' ),
	) );

	// This theme allows users to set a custom background
	add_custom_background();

	// Your changeable header business starts here
	define( 'HEADER_TEXTCOLOR', '000' );
	// No CSS, just an IMG call. The %s is a placeholder for the theme template directory URI.
	define( 'HEADER_IMAGE', '%s/images/headers/header-2.png' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to snowsummit_header_image_width and snowsummit_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'snowsummit_header_image_width', 940 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'snowsummit_header_image_height', 130 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 940 pixels wide by 130 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See snowsummit_admin_header_style(), below.
	add_custom_image_header( 'snowsummit_header_style', 'snowsummit_admin_header_style', 'snowsummit_admin_header_image' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'header' => array(
			'url' => '%s/images/headers/header.png',
			'thumbnail_url' => '%s/images/headers/header-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Snowy Mountain 1', 'snowsummit' )
		),
		'header2' => array(
			'url' => '%s/images/headers/header-2.png',
			'thumbnail_url' => '%s/images/headers/header-2-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Snowy Mountain 2', 'snowsummit' )
		),

	) );
}
endif;

if ( ! function_exists( 'snowsummit_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @since Snow Summit 1.0
 */
function snowsummit_header_style() {
	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		#site-title,
		#site-description {
			position: absolute;
			left: -9000px;
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;


if ( ! function_exists( 'snowsummit_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in snowsummit_setup().
 *
 * @since Snow Summit 1.0
 */
function snowsummit_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		background: #<?php echo get_background_color(); ?>;
		border: none;
	}

	#headimg h1 {
		margin: 0;
	font-size: 30px;
	line-height: 36px;
	margin: 0 0 18px 0;
	float:left;
	}
	#headimg h1 a {
	color: #000;
	font-weight: bold;
	text-decoration: none;
	}
	#desc {
	clear: right;
	float: right;
	font-style: italic;
	margin:0;
	width: 220px;
	display:none;
	}
	<?php
		// If the user has set a custom color for the text use that
		if ( get_header_textcolor() != HEADER_TEXTCOLOR ) :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?>;
		}
	<?php endif; ?>
	#headimg img {
		max-width: 940px;
		width: 100%;

	}
	</style>
<?php
}
endif;

if ( ! function_exists( 'snowsummit_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in snowsummit_setup().
 *
 * @since Snow Summit 1.0
 */
function snowsummit_admin_header_image() { ?>
	<div id="headimg">
		<?php
		if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<img src="<?php esc_url ( header_image() ); ?>" alt="" />
	</div>
<?php }
endif;

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since Snow Summit 1.0
 */
function snowsummit_page_menu_args( $args ) {
	$args['show_home'] = false;
	return $args;
}
add_filter( 'wp_page_menu_args', 'snowsummit_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * @since Snow Summit 1.0
 * @return int
 */
function snowsummit_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'snowsummit_excerpt_length' );

/**
 * Returns a "Read more" link for excerpts
 *
 * @since Snow Summit 1.0
 * @return string "Read more" link
 */
function snowsummit_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Read more <span class="meta-nav">&raquo;</span>', 'snowsummit' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and snowsummit_continue_reading_link().
 *
 * @since Snow Summit 1.0
 * @return string An ellipsis
 */
function snowsummit_auto_excerpt_more( $more ) {
	return ' &hellip;' . snowsummit_continue_reading_link();
}
add_filter( 'excerpt_more', 'snowsummit_auto_excerpt_more' );

/**
 * Adds a pretty "Read more" link to custom post excerpts.
 *
 * @since Snow Summit 1.0
 * @return string Excerpt with a pretty "Read more" link
 */
function snowsummit_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= snowsummit_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'snowsummit_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Snow Summit's style.css.
 *
 * @since Snow Summit 1.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
function snowsummit_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'snowsummit_remove_gallery_css' );

if ( ! function_exists( 'snowsummit_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own snowsummit_comment(), and that function will be used instead.
 *
 * @since Snow Summit 1.0
 */
function snowsummit_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 48 ); ?>

			<cite class="fn"><?php comment_author_link(); ?></cite>

			<span class="comment-meta commentmetadata">
				|
				<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php
					/* translators: 1: date, 2: time */
					printf( __( '%1$s at %2$s', 'snowsummit' ),
						get_comment_date(),
						get_comment_time()
					); ?></a>
					|
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					<?php edit_comment_link( __( 'Edit', 'snowsummit' ), ' | ' );
				?>
			</span><!-- .comment-meta .commentmetadata -->
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'snowsummit' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-body"><?php comment_text(); ?></div>

	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'snowsummit' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'snowsummit' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * @since Snow Summit 1.0
 * @uses register_sidebar
 */
function snowsummit_widgets_init() {


	// Area 1, located to the right of the site name.
	register_sidebar( array(
		'name' => __( 'Header Widget Area', 'snowsummit' ),
		'id' => 'header-widget-area',
		'description' => __( 'Widget area in header located right of site name', 'snowsummit' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );

	// Area 2, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'snowsummit' ),
		'id' => 'sidebar-1',
		'description' => __( 'The primary widget area', 'snowsummit' ),
		'before_widget' => '<div class="infobox">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 3, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'snowsummit' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area appears in 3-column layouts', 'snowsummit' ),
		'before_widget' => '<div class="infobox">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 4, located above the primary and secondary sidebars in Content-Sidebar-Sidebar and Sidebar-Sidebar-Content layouts. Empty by default.
	register_sidebar( array(
		'name' => __( 'Feature Widget Area', 'snowsummit' ),
		'id' => 'feature-widget-area',
		'description' => __( 'The feature widget above the sidebars in Content-Sidebar-Sidebar and Sidebar-Sidebar-Content layouts', 'snowsummit' ),
		'before_widget' => '<div class="infobox">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'snowsummit' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'snowsummit' ),
		'before_widget' => '<div class="infobox">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'snowsummit' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'snowsummit' ),
		'before_widget' => '<div class="infobox">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 7, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'snowsummit' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'snowsummit' ),
		'before_widget' => '<div class="infobox">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 8, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'snowsummit' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'snowsummit' ),
		'before_widget' => '<div class="infobox">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
	// Area 9, Leader Board widget area under header Image
	register_sidebar( array(
		'name' => __( 'Header 728 by 90 Ad Widget Area', 'snowsummit' ),
		'id' => 'leaderboard-widget-area-header',
		'description' => __( 'Widget area for 728 by 90 ad under header image', 'snowsummit' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );


	// Area 10, Footer widget area for 728 by 90 ad or other element
	register_sidebar( array(
		'name' => __( 'Footer 728 by 90 Ad Widget Area', 'snowsummit' ),
		'id' => 'leaderboard-widget-area-footer',
		'description' => __( 'Widget area for 728 by 90 ad between footer nav menu and footer widgets', 'snowsummit' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
}
/** Register sidebars by running snowsummit_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'snowsummit_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * @since Snow Summit 1.0
 */
function snowsummit_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'snowsummit_remove_recent_comments_style' );

if ( ! function_exists( 'snowsummit_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Snow Summit 1.0
 */
function snowsummit_posted_on() {
printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'snowsummit' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'snowsummit' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'snowsummit_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Snow Summit 1.0
 */
function snowsummit_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'snowsummit' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'snowsummit' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'snowsummit' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

/**
 *  Returns the current Snow Summit color scheme as selected in the theme options
 *
 * @since Snow Summit 1.0
 */
function snowsummit_current_color_scheme() {
	$options = get_option( 'snowsummit_theme_options' );

	return $options['color_scheme'];
}

/**
 * Register our color schemes and add them to the queue
 */
function snowsummit_color_registrar() {
	if ( 'black' == snowsummit_current_color_scheme() ) {
		wp_register_style( 'black', get_template_directory_uri() . '/colors/black.css', null, null );
		wp_enqueue_style( 'black' );
	}
	if ( 'pink' == snowsummit_current_color_scheme() ) {
		wp_register_style( 'pink', get_template_directory_uri() . '/colors/pink.css', null, null );
		wp_enqueue_style( 'pink' );
	}
	if ( 'blue' == snowsummit_current_color_scheme() ) {
		wp_register_style( 'blue', get_template_directory_uri() . '/colors/blue.css', null, null );
		wp_enqueue_style( 'blue' );
	}
	if ( 'green' == snowsummit_current_color_scheme() ) {
		wp_register_style( 'green', get_template_directory_uri() . '/colors/green.css', null, null );
		wp_enqueue_style( 'green' );
	}
	if ( 'purple' == snowsummit_current_color_scheme() ) {
		wp_register_style( 'purple', get_template_directory_uri() . '/colors/purple.css', null, null );
		wp_enqueue_style( 'purple' );
	}
	if ( 'red' == snowsummit_current_color_scheme() ) {
		wp_register_style( 'red', get_template_directory_uri() . '/colors/red.css', null, null );
		wp_enqueue_style( 'red' );
	}
}
add_action( 'wp_print_styles', 'snowsummit_color_registrar' );

/**
 *  Returns the current Snow Summit layout as selected in the theme options
 *
 * @since Snow Summit 1.0
 */
function snowsummit_current_layout() {
	$options = get_option( 'snowsummit_theme_options' );
	$current_layout = $options['theme_layout'];

	$two_columns = array( 'content-sidebar', 'sidebar-content' );


	if ( in_array( $current_layout, $two_columns ) )
		return 'two-column ' . $current_layout;
	else
		return 'three-column ' . $current_layout;
}

/**
 *  Adds snowsummit_current_layout() to the array of body classes
 *
 * @since Snow Summit 1.0
 */
function snowsummit_body_class($classes) {
	$classes[] = snowsummit_current_layout();

	return $classes;
}
add_filter( 'body_class', 'snowsummit_body_class' );

function snowsummit_top_nav()
{
?>
<ul>
<li>Today's date: <?php echo date('l M d Y');?></li>
</ul>
<?php
}