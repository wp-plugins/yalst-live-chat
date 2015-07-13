<?php

  class yalst_widget extends WP_Widget
  {

    // constructor
    function yalst_widget()
      {
        parent::__construct('live_chat', // Base ID
        	__('Yalst Live Chat', 'yalst_text'), // Name
 	        array( 'description' => __( 'Eingabe von Einbindungscode für den Live Chat', 'yalst_text' ), ) // Args
		);
      }

    // widget form creation
    function form($instance)
      {
        
        // Check values
        if( $instance)
          {
             $textarea = esc_textarea($instance['textarea']);
          }
        else
          {
             $textarea = '';
          }
        ?>
   
    
        <p>
        <label for="<?php echo $this->get_field_id('textarea'); ?>"><?php _e('Einbindungscode:', 'yalst_text'); ?></label>
        <textarea class="widefat" id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>"><?php echo $textarea; ?></textarea>
        </p>
      <?php
      }

    // update widget
    function update($new_instance, $old_instance)
      {
        $instance = $old_instance;
        // Fields
        $instance['textarea'] = $new_instance['textarea'];
        return $instance;
      }


    // display widget
    public function widget($args, $instance)
      {
      
        extract( $args );
        // these are the widget options
        $textarea = $instance['textarea'];
        
        echo $before_widget;
        // Display the widget
        echo '<div class="widget-text wp_widget_plugin_box">';       
  
        // Check if textarea is set
        if( $textarea )
        {
          echo $textarea;
        }
        echo '</div>';
        echo $after_widget;
      }
  }

// register widget
add_action('widgets_init', create_function('', 'return register_widget("yalst_widget");'));

?>