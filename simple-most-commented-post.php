<?php
/**
 * Plugin Name: Simple Most Commented Post
 * Plugin URI: https://diditho.com/wordpress-simple-most-commented-post
 * Description: A widget to show the latest post with the most commented post.
 * Version: 1.0.1
 * Author: Banuardi Nugroho
 * Author URI: https://diditho.com
 * Text Domain: simple-most-commented-post
 * Domain Path: /languages
 *
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * 
 * Simple Most Commented Post is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 * 
 * Simple Most Commented Post is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with Simple Most Commented Post. If not, see <https://www.gnu.org/licenses/>.
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Define plugin version.
define('SIMPLE_MOST_COMMENTED_POST_VERSION', '1.0.1');

// Include the core plugin class.
require plugin_dir_path(__FILE__) . 'includes/class-simple-most-commented-post.php';

// Activation and deactivation hooks.
function activate_simple_most_commented_post() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-simple-most-commented-post-activator.php';
    Simple_Most_Commented_Post_Activator::activate();
}

function deactivate_simple_most_commented_post() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-simple-most-commented-post-deactivator.php';
    Simple_Most_Commented_Post_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_simple_most_commented_post');
register_deactivation_hook(__FILE__, 'deactivate_simple_most_commented_post');

// Initialize the plugin.
function run_simple_most_commented_post() {
    $plugin = new Simple_Most_Commented_Post();
    $plugin->run();
}
run_simple_most_commented_post();
