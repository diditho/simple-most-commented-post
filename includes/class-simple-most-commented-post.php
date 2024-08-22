<?php

class Simple_Most_Commented_Post {

    protected $loader;
    protected $plugin_name;
    protected $version;

    public function __construct() {
        $this->plugin_name = 'simple-most-commented-post';
        $this->version = SIMPLE_MOST_COMMENTED_POST_VERSION;

        $this->load_dependencies();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    private function load_dependencies() {
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-simple-most-commented-post-loader.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-simple-most-commented-post-admin.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-simple-most-commented-post-public.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-simple-most-commented-post-widget.php';

        $this->loader = new Simple_Most_Commented_Post_Loader();
    }

    private function define_admin_hooks() {
        $plugin_admin = new Simple_Most_Commented_Post_Admin($this->get_plugin_name(), $this->get_version());
        $this->loader->add_action('widgets_init', $plugin_admin, 'register_widget');
    }

    private function define_public_hooks() {
        $plugin_public = new Simple_Most_Commented_Post_Public($this->get_plugin_name(), $this->get_version());
        $this->loader->add_action('widgets_init', $plugin_public, 'register_widget');
    }

    public function run() {
        $this->loader->run();
    }

    public function get_plugin_name() {
        return $this->plugin_name;
    }

    public function get_version() {
        return $this->version;
    }
}

