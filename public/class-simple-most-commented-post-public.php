<?php

class Simple_Most_Commented_Post_Public {

    private $plugin_name;
    private $version;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function register_widget() {
        register_widget('Simple_Most_Commented_Post_Widget');
    }
}
