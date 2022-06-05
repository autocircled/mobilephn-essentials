<?php
namespace MblEssen\Includes;

if ( ! defined( 'ABSPATH' ) ) exit;

class Register_Post_Templates {

    private static $instance;
    private static $template_path = 'mbl-essen/';

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
		add_filter( 'single_template', [ $this, 'load_single_template' ], 0 );
	}
    
    public static function mbl_essen_get_template_part( $slug, $name = '' ){
        if ( $name ) {
            $template = locate_template(
                array(
                    "{$slug}-{$name}.php",
                    self::$template_path . "{$slug}-{$name}.php",
                )
            );
    
            if ( ! $template ) {
                $fallback = MBLESSEN_DIR . "/templates/{$slug}-{$name}.php";
                $template = file_exists( $fallback ) ? $fallback : '';
            }
        }
        
        if ( $template ) {
            load_template( $template, false );
        }
    }
    public function load_single_template( $template ){
        global $post;
		if ( 'phone' === $post->post_type && locate_template( array( self::$template_path . 'single-phone.php' ) ) !== $template ) {
			$template = MBLESSEN_DIR . 'templates/single-phone.php';
		}
		return $template;
    }
}