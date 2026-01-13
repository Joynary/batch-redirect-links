<?php
/*
Plugin Name: Guide
Description: Smart website navigation widget for Elementor with auto logo/name detection, batch import, and hover description.
Version: 1.0
Author: Joynary
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if (!defined('ABSPATH'))
    exit;

define('GUIDE_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('GUIDE_PLUGIN_URL', plugin_dir_url(__FILE__));

// Load assets for frontend
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('guide-style', GUIDE_PLUGIN_URL . 'assets/style.css', [], '8.4');
    wp_enqueue_script('guide-script', GUIDE_PLUGIN_URL . 'assets/script.js', ['jquery'], '3.6', true);
});

// Load assets for Elementor editor
add_action('elementor/editor/before_enqueue_scripts', function () {
    wp_enqueue_style('guide-style', GUIDE_PLUGIN_URL . 'assets/style.css', [], '8.4');
    wp_enqueue_script('guide-script', GUIDE_PLUGIN_URL . 'assets/script.js', ['jquery'], '3.5', true);
});

// Load assets for Elementor preview
add_action('elementor/preview/enqueue_styles', function () {
    wp_enqueue_style('guide-style', GUIDE_PLUGIN_URL . 'assets/style.css', [], '8.4');
    wp_enqueue_script('guide-script', GUIDE_PLUGIN_URL . 'assets/script.js', ['jquery'], '3.5', true);
});

// Elementor widget registration
add_action('elementor/widgets/widgets_registered', function () {
    require_once GUIDE_PLUGIN_DIR . 'includes/elementor-widget.php';
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Guide_Elementor_Widget());
});

// Admin/batch import

require_once GUIDE_PLUGIN_DIR . 'includes/admin.php';
