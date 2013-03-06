<?php
/*
Plugin Name: Random Posts Widget Configurable
Plugin URI: http://www.huurautohuren.com
Version: 1.13
Description: Widget which displays random posts
Author: Tim Lorders
License: GPLv2

*/

define("DefNoOfPosts", "5"); // default number of random posts to display

class RandomPostsWidgetConfigurable extends WP_Widget {

	function RandomPostsWidgetConfigurable()
	{
		parent::WP_Widget( false, 'Random Posts Configurable',  array('description' => 'Random posts widget') );
	}

	function widget($args, $instance)
	{
		global $NewRandomPostsConfigurable;
		$title = empty( $instance['title'] ) ? 'Random Posts Configurable' : $instance['title'];
		echo $args['before_widget'];
		echo $args['before_title'] . $title . $args['after_title'];
		echo $NewRandomPostsConfigurable->GetRandomPostsConfigurable(  empty( $instance['ShowPosts'] ) ? DefNoOfPosts : $instance['ShowPosts'] );
		echo $args['after_widget'];
	}

	function update($new_instance)
	{
		return $new_instance;
	}

	function form($instance)
	{
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php echo 'Title:'; ?></label>
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('ShowPosts'); ?>"><?php echo 'Number of entries:'; ?></label>
			<input type="text" name="<?php echo $this->get_field_name('ShowPosts'); ?>" id="<?php echo $this->get_field_id('ShowPosts'); ?>" value="<?php if ( empty( $instance['ShowPosts'] ) ) { echo esc_attr(DefNoOfPosts); } else { echo esc_attr($instance['ShowPosts']); } ?>" size="3" />
		</p>

		<?php
	}

}



class RandomPostsConfigurable {

	function GetRandomPostsConfigurable($noofposts)
	{
		rewind_posts();
			query_posts('orderby=rand&showposts='.$noofposts);
			if (have_posts()) :
				echo '<ul>';
				while (have_posts()) : the_post();
					echo '<div id="post-'.get_the_ID().'"><li><a href="'.get_permalink().'">'.get_the_title().'</a></li></div>';
				endwhile;
				echo '</ul>';

			endif;

		wp_reset_query();
	}

}



$NewRandomPostsConfigurable = new RandomPostsConfigurable();

function RandomPostsConfigurable_widgets_init()
{
	register_widget('RandomPostsWidgetConfigurable');
}

add_action('widgets_init', 'RandomPostsConfigurable_widgets_init');


?>
