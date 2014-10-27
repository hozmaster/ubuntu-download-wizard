<?php
/*
Plugin Name:  Ubuntudownloadwizard
Plugin URI: http://ubuntu.com/wordpress/whatever
Description: Add Ubuntu Download wizard for Ubuntu Finland home page.
Version: 0.0.1
Author: Ubuntu fi
Author URI: http://ubuntu-fi.org/
*/

function ap_action_init()
{
    load_plugin_textdomain('ubuntudownloadwizard', false, basename( dirname( __FILE__ ) ) . '/languages' );
}

// Add actions
add_action('init', 'ap_action_init');

function hello_wizard ()
