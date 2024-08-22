<?php

class Simple_Most_Commented_Post_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'simple_most_commented_post_widget',
            __('Simple Most Commented Post', 'diditho-simple-most-commented-post'),
            array('description' => __('A widget to show the latest post with the most commented post.', 'diditho-simple-most-commented-post'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];

        $post_count = get_option('simple_most_commented_post_count', 5);
        $excerpt_length = !empty($instance['excerpt_length']) ? absint($instance['excerpt_length']) : 20;

        $query_args = array(
            'posts_per_page' => $post_count,
            'orderby' => 'comment_count',
            'order' => 'DESC'
        );
        $query = new WP_Query($query_args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post(); ?>
                <div class="simple-widget">
                    <div class="simple-widget-content">
                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <p><?php echo wp_trim_words(get_the_excerpt(), $excerpt_length); ?></p>
                        <p><?php echo get_the_date(); ?></p>
                    </div>
                </div>
                <style>
                    .simple-widget {
                        margin-bottom: 20px;
                    }
                    .simple-widget-content h4 {
                        margin: 0 0 10px;
                    }
                </style>
            <?php endwhile;
        endif;

        wp_reset_postdata();

        echo $args['after_widget'];
    }

    public function form($instance) {
        $excerpt_length = !empty($instance['excerpt_length']) ? $instance['excerpt_length'] : 20;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('excerpt_length'); ?>"><?php _e('Excerpt Length:', 'diditho-simple-most-commented-post'); ?></label>
            <input type="number" id="<?php echo $this->get_field_id('excerpt_length'); ?>" name="<?php echo $this->get_field_name('excerpt_length'); ?>" value="<?php echo esc_attr($excerpt_length); ?>" min="1" />
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['excerpt_length'] = (!empty($new_instance['excerpt_length'])) ? absint($new_instance['excerpt_length']) : 20;

        return $instance;
    }
}

function register_simple_most_commented_post_widget() {
    register_widget('Simple_Most_Commented_Post_Widget');
}
add_action('widgets_init', 'register_simple_most_commented_post_widget');
