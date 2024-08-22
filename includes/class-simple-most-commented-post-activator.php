<?php

class Simple_Most_Commented_Post_Activator {

    public static function activate() {
        if (get_option('simple_most_commented_post_count') === false) {
            update_option('simple_most_commented_post_count', 5);
        }
    }
}
