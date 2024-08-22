
<div class="wrap">
    <h1><?php _e('Simple Most Commented Post Settings', 'diditho-simple-most-commented-post'); ?></h1>
    <form method="post" action="options.php">
        <?php
        settings_fields('simple_most_commented_post_group');
        do_settings_sections('simple-most-commented-post');
        submit_button();
        ?>
    </form>
</div>
