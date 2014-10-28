<?php
/*
Plugin Name:  Ubuntu Download Wizard
Plugin URI: http://ubuntu.com/wordpress/whatever
Description: Add Ubuntu Download wizard for Ubuntu Finland home page.
Version: 0.0.1
Author: Ubuntu fi
Author URI: http://ubuntu-fi.org/
License: GPL v2
Text Domain: google-analytics-for-wordpress
Domain Path: /languages
*/


define( 'UBDW_VERSION', '0.0.1' );
define( 'UBDW_FILE', __FILE__ );

function ap_action_init()
{
    load_plugin_textdomain('ubuntudownloadwizard', false, basename( dirname( __FILE__ ) ) . '/languages' );
}

// Add actions
add_action('widgets_init', 'init_ubuntu_download_widget');

function init_ubuntu_download_widget ()
{
    register_widget( 'UbuntuDwnldWizardWidget' );
}

class UbuntuDwnldWizardWidget extends WP_Widget {

    function UbuntuDwnldWizardWidget ()
    {
        /* Widget settings. */
        $widget_ops = array( 'classname' => 'example', 'description' => __('An example widget that displays a person\'s name and sex.', 'example') );
        /* Widget control settings. */
        $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'example-widget' );
        /* Create the widget. */
        $this->WP_Widget( 'ubuntu-download-wizard', __('Ubuntu Download Wizard Widget', 'example'), $widget_ops, $control_ops );
    }

    /**
     * How to display the widget on the screen.
     */
    function widget( $args, $instance ) {
        extract( $args );

        /* Our variables from the widget settings. */
        $title = apply_filters('widget_title', $instance['title'] );
        $name = $instance['name'];
        $sex = $instance['sex'];
        $show_sex = isset( $instance['show_sex'] ) ? $instance['show_sex'] : false;

        /* Before widget (defined by themes). */
        echo $before_widget;

        /* Display the widget title if one was input (before and after defined by themes). */
        if ( $title )
            echo $before_title . $title . $after_title;

        /* Display name from widget settings if one was input. */
        if ( $name )
            printf( '<p>' . __('Hello. My name is %1$s.', 'example') . '</p>', $name );

        /* If show sex was selected, display the user's sex. */
        if ( $show_sex )
            printf( '<p>' . __('I am a %1$s.', 'example.') . '</p>', $sex );

        /* After widget (defined by themes). */
        echo $after_widget;
    }

    /**
     * Update the widget settings.
     */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        /* Strip tags for title and name to remove HTML (important for text inputs). */
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['name'] = strip_tags( $new_instance['name'] );

        /* No need to strip tags for sex and show_sex. */
        $instance['sex'] = $new_instance['sex'];
        $instance['show_sex'] = $new_instance['show_sex'];

        return $instance;
    }


	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Example', 'example'), 'name' => __('John Doe', 'example'), 'sex' => 'male', 'show_sex' => true );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<!-- Your Name: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e('Your Name:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" value="<?php echo $instance['name']; ?>" style="width:100%;" />
		</p>

		<!-- Sex: Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'sex' ); ?>"><?php _e('Sex:', 'example'); ?></label>
			<select id="<?php echo $this->get_field_id( 'sex' ); ?>" name="<?php echo $this->get_field_name( 'sex' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'male' == $instance['format'] ) echo 'selected="selected"'; ?>>male</option>
				<option <?php if ( 'female' == $instance['format'] ) echo 'selected="selected"'; ?>>female</option>
			</select>
		</p>

		<!-- Show Sex? Checkbox -->
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_sex'], true ); ?> id="<?php echo $this->get_field_id( 'show_sex' ); ?>" name="<?php echo $this->get_field_name( 'show_sex' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_sex' ); ?>"><?php _e('Display sex publicly?', 'example'); ?></label>
		</p>

	<?php
	}
}