<?php
/**
 * @package WordPress
 * @subpackage Snow Summit
 * @since Snow Summit 1.0
 */
?>
	</div><!-- #contentblock -->
			<div id="access" role="navigation">
				<?php /* Our foter navigation menu.  The menu assiged to the footer position is the one used. Blank if none assigned */ ?>
				<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'fallback_cb' => false, 'theme_location' => 'footer' ) ); ?>
			</div><!-- #access -->
<?php
	// leaderboard footer widget area
	if ( is_active_sidebar( 'leaderboard-widget-area-footer' ) ) : ?>

		<div class="clear"></div><div id="waleaderfooter">
		<?php dynamic_sidebar( 'leaderboard-widget-area-footer' ); ?>
		</div><!-- #waleader -->

<?php endif; ?>
	<div id="footer" role="contentinfo">
		<?php get_sidebar( 'footer' ); ?>

		<div id="colophon">
			<?php printf( __( '%1$s by %2$s' ), 'Snow Summit', '<a href="http://weddingthemes.marriagescene.com/wedding-themes/snow-summit/">weddingthemes.marriagescene</a>' ); ?> <span class="generator-link"><a href="<?php echo esc_url( __( 'http://wordpress.org/', 'snowsummit' ) ); ?>" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'snowsummit' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s.', 'snowsummit' ), 'WordPress' ); ?></a></span>
		</div><!-- #colophon -->
	</div><!-- #footer -->

</div><!-- #container -->
</div><!-- #wrapper -->
</div><!-- #outerwrap -->

<?php wp_footer(); ?>
</body>
</html>