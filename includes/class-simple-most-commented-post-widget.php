<?php

class Simple_Most_Commented_Post_Widget extends WP_Widget {

    public $some_property;

    public function __construct() {
        parent::__construct(
            'simple_most_commented_post_widget',
            __('Simple Most Commented Post', 'diditho-simple-most-commented-post'),
            array('description' => __('A widget to show the latest post with the most commented post.', 'diditho-simple-most-commented-post'))
        );
        $this->some_property = 'value'; // Initialize the property
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];

        $post_count = get_option('simple_most_commented_post_count', 5);

        $query_args = array(
            'posts_per_page' => $post_count,
            'orderby' => 'comment_count',
            'order' => 'DESC'
        );
        $query = new WP_Query($query_args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post(); ?>
                <div class="simple-widget">
                    <div class="simple-widget-thumbnail">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('thumbnail'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="simple-widget-content">
                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                        <p><?php echo get_the_date(); ?></p>
                    </div>
                </div>
                <style>
                    .simple-widget {
                        display: flex;
                        align-items: center;
                    }
                    .simple-widget-thumbnail {
                        margin-right: 10px;
                    }
                    .simple-widget-content h4 {
                        margin: 0;
                    }
                </style>
            <?php endwhile;
        endif;

        wp_reset_postdata();

        echo $args['after_widget'];
    }

    public function form($instance) {
        // Admin form
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        return $instance;
    }
}

function register_simple_most_commented_post_widget() {
    register_widget('Simple_Most_Commented_Post_Widget');
}
add_action('widgets_init', 'register_simple_most_commented_post_widget');
