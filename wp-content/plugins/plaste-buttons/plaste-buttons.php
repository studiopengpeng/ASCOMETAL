<?php

/*
 * @link              http://www.plaste.fr
 * @since             1.0.0
 * @package           plaste-button
 *
 * @wordpress-plugin
 * Plugin Name:       Add custom buttons
 * Plugin URI:        http://www.plaste.fr/wordpress/plugins/plaste_buttons
 * Description:       Add a custom buttom, using your theme's CSS styles.
 * Version:           1.0.0
 * Author:            Nicolas Mercier
 * Author URI:        http://www.plaste.fr
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       plaste_buttons
 * Domain Path:       /languages
*/

// traduction
load_plugin_textdomain('plaste-buttons', false, dirname( plugin_basename( __FILE__ ) ). '/languages/');

// register plaste_buttons widget
function register_plaste_buttons() {
    register_widget( 'plaste_buttons' );
}
add_action( 'widgets_init', 'register_plaste_buttons' );

/**
 * Adds plaste_buttons widget.
 */
class plaste_buttons extends WP_Widget {
    
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'plaste_buttons', // Base ID
			__( 'Add custom buttons', 'plaste-buttons' ), // Name
			array( 'description' => __( 'Add custom buttons in your sidebars, matching the styles created in your own CSS files.', 'plaste-buttons' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
        

        // nombre de boutons ?
        if ( ! empty( $instance['totalbts'] ) ) {
            $totalbts = $instance['totalbts'];
        } else {
             $totalbts=0; // masque tout si pas de données
        }
        
        echo $args['before_widget'];
        echo "<div class='pbuttons_group'>";
        
        for ($x=1;$x<=$instance['totalbts'];$x++) {
            
            if ( ! empty( $instance['title'.$x] ) ) {
                $title=apply_filters( 'widget_title', $instance['title'.$x] );
            } else {
                $title='';
            }
			
			if ( ! empty( $instance['subtitle'.$x] ) ) {
                $subtitle=apply_filters( 'widget_title', $instance['subtitle'.$x] );
            } else {
                $subtitle='';
            }

            if ( ! empty( $instance['link'.$x] ) ) {
                $hrefBlock='href="'.stripslashes($instance['link'.$x]).'"';
            } else {
                 $hrefBlock='';
            }
            if ( ! empty( $instance['type'.$x] ) ) {
                $type=$instance['type'.$x];
            } else {
                $type="simple";
            }
            
            if ( ! empty( $instance['blank'.$x] ) ) {
                $blank = $instance['blank'.$x] ? " target='_blank' " : "";
            } else {
                 $blank='';
            }

            switch ($type) {
            case 'simple':
                $addclass="simple-btn";
                $finaltitle=$title."<br/>".$subtitle;
                break;
            case 'telechargement':
                $addclass="dl-btn";
				$title=$title."<br/>".$subtitle;
                //if (preg_match("#guitare#", $title)) {
                $finaltitle=preg_replace('/(\(.+\))/i', "<span class='filetype'>$1</span>", $title);
                break;
            case 'iCal':
                $addclass="cal-btn";
                $finaltitle=$title."<br/>".$subtitle;
                $hrefBlock='href="'.tribe_get_single_ical_link().'"';
                break;
            case 'googleCal':
                $addclass="cal-btn";
                $finaltitle=$title."<br/>".$subtitle;
                $hrefBlock='href="'.tribe_get_gcal_link().'"';
                break;
            }

            echo '<a '.$hrefBlock.' title="'.addslashes($title).'" class="button groupe long '.$addclass.'" '.$blank.'>'.$finaltitle.'</a>';
 
        }
        
        echo "</div>";
        echo $args['after_widget'];
    }

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
        
        // nb de bts
         if( $instance) {
             $totalbts = $instance['totalbts'];
             if ($totalbts>5) $totalbts=5;
        } else {
             $totalbts = 1;
        }
        
        ?>
        <p>
		<label for="<?php echo $this->get_field_id( 'totalbts' ); ?>"><?php _e( 'How many buttons ? (5 max)', 'plaste-buttons' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'totalbts' ); ?>" name="<?php echo $this->get_field_name( 'totalbts' ); ?>" type="text" value="<?php echo $totalbts ?>">
		</p>
        <?php
		
        
        for ($x=1;$x<=$totalbts;$x++) {

            // Check values
             ${'title'.$x} = ! empty( $instance['title'.$x] ) ? $instance['title'.$x] : __( 'New title', 'plaste-buttons' );
             ${'subtitle'.$x} = ! empty( $instance['subtitle'.$x] ) ? $instance['subtitle'.$x] : __( 'New subtitle', 'plaste-buttons' );
            if( $instance) {
                 ${'link'.$x} = esc_attr($instance['link'.$x]);
                 ${'type'.$x} = esc_attr($instance['type'.$x]);
                 ${'blank'.$x} = $instance['blank'.$x] ? 0 : 1;
                 $checked_blank = $instance['blank'.$x] ? 'checked="checked"' : '';
                 //${'target'.$x} = 'target="_blank"' : '';
            } else {
                 ${'link'.$x} = '';
                 ${'type'.$x} = '';
                 ${'blank'.$x} = '';
            }
            ?>
            <hr /><div><b>Bouton <?php echo $x; ?></b></div>
            <p>
            <label for="<?php echo $this->get_field_id( 'title' .$x); ?>"><?php _e( 'Title:', 'plaste-buttons' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' .$x); ?>" name="<?php echo $this->get_field_name( 'title'.$x ); ?>" type="text" value="<?php echo esc_attr( ${'title'.$x} ); ?>">
            </p>
			<p>
            <label for="<?php echo $this->get_field_id( 'subtitle' .$x); ?>"><?php _e( 'Subtitle:', 'plaste-buttons' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'subtitle' .$x); ?>" name="<?php echo $this->get_field_name( 'subtitle'.$x ); ?>" type="text" value="<?php echo esc_attr( ${'subtitle'.$x} ); ?>">
            </p>
            <p>
            <label for="<?php echo $this->get_field_id( 'link'.$x ); ?>"><?php _e( 'Link:', 'plaste-buttons' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'link'.$x ); ?>" name="<?php echo $this->get_field_name( 'link'.$x ); ?>" type="text" value="<?php echo ${'link'.$x} ?>">
            </p>
            <p>
            <input class="checkbox" type="checkbox" <?php echo $checked_blank; ?> id="<?php echo $this->get_field_id('blank'.$x); ?>" name="<?php echo $this->get_field_name('blank'.$x); ?>" />
            <label for="<?php echo $this->get_field_id('blank'.$x); ?>"><?php _e('Open in a new window', 'plaste-buttons'); ?></label>
            </p>

            <p>
            <label for="<?php echo $this->get_field_id('type'.$x); ?>"><?php _e('type', 'wp_widget_plugin'); ?></label>
            <select name="<?php echo $this->get_field_name('type'.$x); ?>" id="<?php echo $this->get_field_id('type'.$x); ?>" class="widefat">
            <?php
                $options = array('simple', 'telechargement', 'iCal', 'googleCal');
                foreach ($options as $option) {
                echo '<option value="' . $option . '" id="' . $option . '"', ${'type'.$x} == $option ? ' selected="selected"' : '', '>', $option, '</option>';
                } 
            ?>
            </select>
            </p>

<?php
        }
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
        global $totalbts;
		$instance = array();
        $instance['totalbts'] = strip_tags($new_instance['totalbts']);
        for ($x=1;$x<=$instance['totalbts'];$x++) {
		$instance['title'.$x] = ( ! empty( $new_instance['title'.$x] ) ) ? strip_tags( $new_instance['title'.$x] ) : '';
		$instance['subtitle'.$x] = ( ! empty( $new_instance['subtitle'.$x] ) ) ? strip_tags( $new_instance['subtitle'.$x] ) : '';
        $instance['link'.$x] = strip_tags($new_instance['link'.$x]);
        $instance['type'.$x] = strip_tags($new_instance['type'.$x]);
        $instance['blank'.$x] = $new_instance['blank'.$x] ? 1 : 0;
        }
		return $instance;
	}
    

} // class plaste_buttons

?>