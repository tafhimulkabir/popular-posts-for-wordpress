<?php
/*
Plugin Name: Popular Posts for WordPress
Version: 1.0
Plugin URI: https://wordpress.org/plugins/popular-posts-for-wordpress/
Author: Tafhimul kabir
Author URI: http://www.upwork.com/o/profiles/users/_~01a0097719a5f77810/
Description: Popular Posts for WordPress is a highly customizable widget that displays the most popular posts on your blog.
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: popular posts for wordpress, custom widgets for popular posts
*/

# Exit if accessed directly ...
if ( !defined ( 'ABSPATH' ) ) {
    exit;
}

# Enqueue CSS files ...
function ppw_enqueue_style () {
    wp_enqueue_style( 'ppw-grid', plugins_url( 'css/grid.css', __FILE__ ), array(), '1.0.0', 'all'  );
    wp_enqueue_style( 'ppw-main', plugins_url( 'css/main.css', __FILE__ ), array(), '1.0.0', 'all'  );
}
//add_action( 'admin_enqueue_scripts', 'ppw_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'ppw_enqueue_style' );

# Require external files ...
require_once ( plugin_dir_path(__FILE__) . 'inc/function.php' );
require_once ( plugin_dir_path(__FILE__) . 'inc/shortcode.php' );
require_once ( plugin_dir_path(__FILE__) . 'inc/widgets.php' );