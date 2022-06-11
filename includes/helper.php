<?php
namespace MblEssen\Includes;

if ( ! defined( 'ABSPATH' ) ) exit;

class Helper {

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
        // add_action( 'wp_head', [ $this, 'preload_contents' ] );
        add_action( 'init', [ $this, 'woocommerce_catalog_mode' ] );
        add_filter( 'woocommerce_product_tabs', [ $this, 'specifications_tab' ], 10 );
        add_filter( 'woocommerce_product_tabs', [ $this, 'remove_additional_tabs' ], 98 );
	}

    public function specifications_tab( $tabs ) {
        
        $tabs['specifications'] = array(
            'title' => __( 'Specifications', 'mbl-essen' ),
            'priority' => 5,
            'callback' => [ $this, 'specifications_tab_callback' ]
        ); 
        
        return $tabs;
    }

    public function remove_additional_tabs( $tabs ) {
        unset( $tabs['additional_information'] ); // To remove the additional information tab
        return $tabs;
    }

    public function specifications_tab_callback() {
        self::mbl_essen_get_template_part( 'content', 'phone' );
    }

	/**
	 * Fires after WordPress has finished loading but before any headers are sent.
	 *
	 */
	public function woocommerce_catalog_mode() : void {
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	}

    public function preload_contents() {}

    public function load_scripts() {
        wp_enqueue_style( 'mbl-essen-style', MBLESSEN_URL . 'assets/style.css', array(), MBLESSEN_VERSION, 'all' );
        wp_enqueue_script( 'mbl-essen-script', MBLESSEN_URL . 'assets/scripts.js', array(), MBLESSEN_VERSION, true );
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
}