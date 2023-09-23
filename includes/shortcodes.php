<?php
namespace MblEssen\Includes;

if ( ! defined( 'ABSPATH' ) ) exit;

class Shortcodes {

    private static $instance;

	/**
	 * Allows for accessing single instance of class. Class should only be constructed once per call.
	 *
	 * @since 0.1
	 * @static
	 * @return self Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->setup();
		}
		return self::$instance;
	}

	/**
	 * Setup new our custom post type
	 *
	 * @since 0.1
	 */
	protected function setup() {
        add_action( 'body_class', [ $this, 'body_class' ] );
        add_shortcode( 'phones', [ $this, 'phones_post_type' ] );
    }
    
    public function body_class( $classes ) {
            global $post;
            if ( has_shortcode( $post->post_content, 'phones') ){
                $classes[] = 'mbl-recent-phones-widget';
            }
            return $classes;
        }
        
    public function phones_post_type( $args ) {
        // WP_Query arguments
        $args = shortcode_atts(
            array(
                'post_type'              => array( 'phone' ),
                'post_status'            => array( 'publish' ),
                'nopaging'               => false,
                'ignore_sticky_posts'    => true,
                'order'                  => 'DESC',
            ),
            $args
        );

        // The Query
        $phone_query = new \WP_Query( $args );
        echo '<div class="container">';
        echo '<div class="row">';
        // The Loop
        if ( $phone_query->have_posts() ) {
            while ( $phone_query->have_posts() ) {
                $phone_query->the_post();
                // do something
                // echo '<a href="' . esc_url( get_the_permalink() ) . '">' . esc_html( get_the_title() ) . '</a>';
                require MBLESSEN_DIR . 'templates/recent-phones.php';
            }
        } else {
            // no posts found
        }
        echo '</div>';
        echo '</div>';

        // Restore original Post Data
        wp_reset_postdata();
    }



}