<?php   
    /* 
    Plugin Name: Latest Posts Box
    Plugin URI: http://it.ivdimova.com
    Description: Plugin for displaying latest posts in a simple widget box
    Author: ivdimova
    Version: 1.0 
    Author URI: http://it.ivdimova.com
    */     
class LBoxWidget extends WP_Widget {
    function LBoxWidget() {
        parent::WP_Widget(false, $name = 'Latest Posts Box');
    }
    function form($instance) {
        $title = esc_attr($instance['title']);
        $num_posts = esc_attr($instance['num_posts']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('num_posts'); ?>"><?php _e('Number of Posts Displayed:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('num_posts'); ?>" name="<?php echo $this->get_field_name('num_posts'); ?>" type="text" value="<?php echo $num_posts; ?>" /></label></p>
        <?php
    }
    function widget($args, $instance) {
    extract( $args );
    $title = apply_filters('widget_title', $instance['title']);
    $num_posts = $instance['num_posts'];
    echo $before_widget; 
          if ( $title )
            echo $before_title . $title . $after_title;
      
       global $post;
        $args = array( 'numberposts' => $num_posts);
        $lposts = get_posts( $args );
        foreach( $lposts as $post ) : setup_postdata($post); ?>
       
       
       <li><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(40,40)); ?></a></li>
        <?php endforeach; ?>
    <?php echo $after_widget; 

  }
}
add_action('widgets_init', create_function('', 'return register_widget("LBoxWidget");')); ?><?php function lbox_shtc ($args, $instance) {
global $post;
        $lposts = get_posts( $args );
        foreach( $lposts as $post ) : setup_postdata($post); ?>
       <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(40,40)); ?></a>
        <?php endforeach; 
  }
   add_shortcode ('lbox','lbox_shtc');
?>