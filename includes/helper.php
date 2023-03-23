<?php
namespace MblEssen\Includes;

if ( ! defined( 'ABSPATH' ) ) exit;

class Helper {

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
        add_action( 'wp_head', [ $this, 'preload_contents' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'load_scripts' ] );
        add_action( 'mbl_essen_after_featured_section', [ $this, 'modal_button' ] );
        add_action( 'wp_footer', [ $this, 'image_gallery' ] );
        add_action( 'pre_get_posts', [ $this, 'add_my_post_types_to_query' ] );
	}

 
    public function add_my_post_types_to_query( $query ) {
        if ( is_home() && $query->is_main_query() )
            $query->set( 'post_type', array( 'post', 'phone' ) );
        return $query;
    }

    public function preload_contents() {}

    public function load_scripts() {
        wp_enqueue_style( 'mbl-essen-style', MBLESSEN_URL . 'assets/style.css', array(), MBLESSEN_VERSION, 'all' );
        wp_enqueue_script( 'mbl-essen-script', MBLESSEN_URL . 'assets/scripts.js', array(), MBLESSEN_VERSION, true );
    }

    public function modal_button() {
        echo wp_kses( '<span class="mbl-modal-button" role="button">See Images</span>', array(
            'span' => array(
                'class' => array(),
                'role' => array(),
            ),
        ) );
    }

    public function image_gallery() {
        ?>
        <!-- Image Gallery -->
        <div id="phone-images-modal" class="phone-images">
            <span class="close-modal">&times;</span>
            <div class="pim-modal-content">
                <div class="pim-slider-inner">
                    <?php
                    $slider_items = [];
                    if (
                        get_field( 'gallery_image_1' ) ||
                        get_field( 'gallery_image_2' ) ||
                        get_field( 'gallery_image_3' ) ||
                        get_field( 'gallery_image_4' ) ||
                        get_field( 'gallery_image_5' ) ||
                        get_field( 'gallery_image_6' ) ||
                        get_field( 'gallery_image_7' ) ||
                        get_field( 'gallery_image_8' ) ||
                        get_field( 'gallery_image_9' ) ||
                        get_field( 'gallery_image_10' )
                    ) {
                        for( $i = 1; $i <= 10; $i++ ) {
                            if ( get_field( 'gallery_image_' . $i ) ) {
                                $srcset = wp_get_attachment_image_srcset( get_field( 'gallery_image_' . $i ) );
                                $slider_items[] = wp_get_attachment_image_url( get_field( 'gallery_image_' . $i ) );
                                ?>
                                <div class="pim-slides">
                                    <span class="steps"><?php echo esc_html( $i ); ?> / <span class="total">4</span></span>
                                    <img src="<?php echo wp_get_attachment_image_url( get_field( 'gallery_image_' . $i ), 'medium_large' ); ?>" srcset="<?php echo esc_attr( $srcset ); ?>">
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                    <!-- Next/previous controls -->
                    <a class="prev">&#10094;</a>
                    <a class="next">&#10095;</a>
                </div>
                <!-- Caption text -->
                <!-- <div class="caption-container">
                    <p id="caption"></p>
                </div> -->

                <div class="dot-nav">
                    <?php
                    if ( $slider_items ){
                        foreach( $slider_items as $key => $item ){
                            ?>
                            <div class="column">
                                <img class="dotb" data-index="<?php echo esc_attr( $key + 1 ); ?>" src="<?php echo esc_url( $item ); ?>" alt="Nature">
                            </div>
                            <?php
                        }
                    }
                    ?>
                    
                </div>
            </div>
        </div>
        <!-- Image Gallery -->
        <?php
    }
}