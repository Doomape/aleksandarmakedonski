<?php

add_action( 'admin_init', 'snowsummit_theme_options_init' );
add_action( 'admin_menu', 'snowsummit_theme_options_add_page' );

/**
 * Add theme options page styles
 */
wp_register_style( 'snowsummit', get_template_directory_uri() . '/inc/theme-options.css', '', '0.1' );
if ( isset( $_GET['page'] ) && $_GET['page'] == 'theme_options' ) {
	wp_enqueue_style( 'snowsummit' );
}

/**
 * Init plugin options to white list our options
 */
function snowsummit_theme_options_init(){
	register_setting( 'snowsummit_options', 'snowsummit_theme_options', 'snowsummit_theme_options_validate' );
}

/**
 * Load up the menu page
 */
function snowsummit_theme_options_add_page() {
	add_theme_page( __( 'Theme Options' ), __( 'Theme Options' ), 'edit_theme_options', 'theme_options', 'snowsummit_theme_options_do_page' );
}

/**
 * Return array for our color schemes
 */
function snowsummit_color_schemes() {
	$color_schemes = array(
		'white' => array(
			'value' =>	'white',
			'label' => __( 'White' )
		),
		'black' => array(
			'value' =>	'black',
			'label' => __( 'Black' )
		),
		'pink' => array(
			'value' =>	'pink',
			'label' => __( 'Pink' )
		),
		'blue' => array(
			'value' =>	'blue',
			'label' => __( 'Blue' )
		),
		'green' => array(
			'value' =>	'green',
			'label' => __( 'Green' )
		),
		'purple' => array(
			'value' =>	'purple',
			'label' => __( 'Purple' )
		),
		'red' => array(
			'value' =>	'red',
			'label' => __( 'Red' )
		),		
		
	);

	return $color_schemes;
}

/**
 * Return array for our layouts
 */
function snowsummit_layouts() {
	$theme_layouts = array(
		'sidebar-content-sidebar' => array(
			'value' => 'sidebar-content-sidebar',
			'label' => __( 'Sidebar-Content-Sidebar' )
		),	
		'content-sidebar' => array(
			'value' => 'content-sidebar',
			'label' => __( 'Content-Sidebar' ),
		),
		'sidebar-content' => array(
			'value' => 'sidebar-content',
			'label' => __( 'Sidebar-Content' )
		),
		'content-sidebar-sidebar' => array(
			'value' => 'content-sidebar-sidebar',
			'label' => __( 'Content-Sidebar-Sidebar' )
		),
		'sidebar-sidebar-content' => array(
			'value' => 'sidebar-sidebar-content',
			'label' => __( 'Sidebar-Sidebar-Content' )
		),
	);

	return $theme_layouts;
}

/**
 * Set default options
 */
function snowsummit_default_options() {
	$options = get_option( 'snowsummit_theme_options' );

	if ( ! isset( $options['color_scheme'] ) ) {
		$options['color_scheme'] = 'light';
		update_option( 'snowsummit_theme_options', $options );
	}

	if ( ! isset( $options['theme_layout'] ) ) {
		$options['theme_layout'] = 'sidebar-content-sidebar';
		update_option( 'snowsummit_theme_options', $options );
	}
}
add_action( 'init', 'snowsummit_default_options' );

/**
 * Create the options page
 */
function snowsummit_theme_options_do_page() {

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . sprintf( __( '%1$s Theme Options', 'snowsummit' ), get_current_theme() )
		 . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'snowsummit_options' ); ?>
			<?php $options = get_option( 'snowsummit_theme_options' ); ?>

			<table class="form-table">

				<?php
				/**
				 * Snow Summit Color Scheme
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Color Scheme' ); ?></th>
					<td>
						<select name="snowsummit_theme_options[color_scheme]">
							<?php
								$selected = $options['color_scheme'];
								$p = '';
								$r = '';

								foreach ( snowsummit_color_schemes() as $option ) {
									$label = $option['label'];

									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
						<label class="description" for="snowsummit_theme_options[color_scheme]"><?php _e( 'Select a default color scheme' ); ?></label>
					</td>
				</tr>

				<?php
				/**
				 * Snow Summit Layout
				 */
				?>
				<tr valign="top" id="coraline-layouts"><th scope="row"><?php _e( 'Default Layout' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Default Layout' ); ?></span></legend>
						<?php
							if ( ! isset( $checked ) )
								$checked = '';
							foreach ( snowsummit_layouts() as $option ) {
								$radio_setting = $options['theme_layout'];

								if ( '' != $radio_setting ) {
									if ( $options['theme_layout'] == $option['value'] ) {
										$checked = "checked=\"checked\"";
									} else {
										$checked = '';
									}
								}
								?>
								<div class="layout">
								<label class="description">
									<input type="radio" name="snowsummit_theme_options[theme_layout]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> />
									<span>
										<img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $option['value']; ?>.png"/>
										<?php echo $option['label']; ?>
									</span>
								</label>
								</div>
								<?php
							}
						?>
						</fieldset>
					</td>
				</tr>

				<?php
				/**
				 * Snow Summit Aside Category
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Aside Category' ); ?></th>
					<td>
						<select name="snowsummit_theme_options[aside_category]">
							<option value="0"><?php _e( 'Select a category &hellip;' ); ?></option>
							<?php
								if(isset($options['aside_category']) && !empty($options['aside_category'])){
								$selected = $options['aside_category'];
								}else { $selected='';}
								
								$p = '';
								$r = '';

								foreach ( get_categories( array( 'hide_empty' => 0 ) ) as $category ) {

									if ( $selected == $category->cat_name ) // Make default first in list
										$p = "\n\t<option selected='selected' value='" . esc_attr( $category->cat_name ) . "'>$category->category_nicename</option>";
									else
										$r .= "\n\t<option value='" . esc_attr( $category->cat_name ) . "'>$category->category_nicename</option>";
								}
								echo $p . $r;
							?>
						</select>
						<label class="description" for="snowsummit_theme_options[aside_category]"><?php _e( 'Select a category to use for shorter aside posts' ); ?></label>
					</td>
				</tr>

				<?php
				/**
				 * Snow Summit Gallery Category
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Gallery Category' ); ?></th>
					<td>
						<select name="snowsummit_theme_options[gallery_category]">
							<option value="0"><?php _e( 'Select a category &hellip;' ); ?></option>
							<?php
								if(isset($options['gallery_category']) && !empty($options['gallery_category'])){
								$selected = $options['gallery_category'];
								}else { $selected='';}								
								$p = '';
								$r = '';

								foreach ( get_categories( array( 'hide_empty' => 0 ) ) as $category ) {

									if ( $selected == $category->cat_name ) // Make default first in list
										$p = "\n\t<option selected='selected' value='" . esc_attr( $category->cat_name ) . "'>$category->category_nicename</option>";
									else
										$r .= "\n\t<option value='" . esc_attr( $category->cat_name ) . "'>$category->category_nicename</option>";
								}
								echo $p . $r;
							?>
						</select>
						<label class="description" for="snowsummit_theme_options[gallery_category]"><?php _e( 'Select a category to use for posts with image galleries' ); ?></label>
					</td>
				</tr>


			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function snowsummit_theme_options_validate( $input ) {

	// Our color scheme option must actually be in our array of color scheme options
	if ( ! array_key_exists( $input['color_scheme'], snowsummit_color_schemes() ) )
		$input['color_scheme'] = null;

	// Our radio option must actually be in our array of radio options
	if ( ! isset( $input['theme_layout'] ) )
		$input['theme_layout'] = null;
	if ( ! array_key_exists( $input['theme_layout'], snowsummit_layouts() ) )
		$input['theme_layout'] = null;

	// Our aside category option must actually be in our array of categories
	if ( array_search( $input['aside_category'], get_categories() ) != 0 )
		$input['aside_category'] = null;

	// Our gallery category option must actually be in our array of categories
	if ( array_search( $input['gallery_category'], get_categories() ) != 0 )
		$input['gallery_category'] = null;

	return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/