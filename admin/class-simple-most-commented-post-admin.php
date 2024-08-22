<?php

class Simple_Most_Commented_Post_Admin {

    private $plugin_name;
    private $version;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function add_plugin_admin_menu() {
        add_options_page(
            'Simple Most Commented Post Settings',
            'Simple Most Commented Post',
            'manage_options',
            'simple-most-commented-post',
            array($this, 'display_plugin_admin_page')
        );
    }

    public function display_plugin_admin_page() {
        include_once 'partials/simple-most-commented-post-admin-display.php';
    }

    public function register_settings() {
        register_setting('simple_most_commented_post_group', 'simple_most_commented_post_count');

        add_settings_section(
            'simple_most_commented_post_section',
            __('Settings', 'diditho-simple-most-commented-post'),
            null,
            'simple-most-commented-post'
        );

        add_settings_field(
            'simple_most_commented_post_count',
            __('Number of Posts', 'diditho-simple-most-commented-post'),
            array($this, 'simple_most_commented_post_count_callback'),
            'simple-most-commented-post',
            'simple_most_commented_post_section'
        );
    }

    public function simple_most_commented_post_count_callback() {
        $value = get_option('simple_most_commented_post_count', 5);
        echo '<input type="number" id="simple_most_commented_post_count" name="simple_most_commented_post_count" value="' . esc_attr($value) . '" min="1" max="10" />';
    }

    public function register_widget() {
        register_widget('Simple_Most_Commented_Post_Widget');
    }
}
