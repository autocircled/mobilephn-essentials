<?php
namespace MblEssen\Includes;

if ( ! defined( 'ABSPATH' ) ) exit;

class Register_Post_Type {

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
		add_action( 'init', [ $this, 'phones_post_type' ], 0 );
        add_action( 'init', [ $this, 'brand_tax_generator' ], 0 );
	}

    // Register Custom Post Type
    public function phones_post_type() {
    
        $labels = array(
            'name'                  => _x( 'Phones', 'Post Type General Name', 'mbl-essen' ),
            'singular_name'         => _x( 'Phone', 'Post Type Singular Name', 'mbl-essen' ),
            'menu_name'             => __( 'Phones', 'mbl-essen' ),
            'name_admin_bar'        => __( 'Phones', 'mbl-essen' ),
            'archives'              => __( 'Phones Archives', 'mbl-essen' ),
            'attributes'            => __( 'Phone Attributes', 'mbl-essen' ),
            'parent_item_colon'     => __( 'Parent Phone:', 'mbl-essen' ),
            'all_items'             => __( 'All Phones', 'mbl-essen' ),
            'add_new_item'          => __( 'Add New Phone', 'mbl-essen' ),
            'add_new'               => __( 'Add New', 'mbl-essen' ),
            'new_item'              => __( 'New Phone', 'mbl-essen' ),
            'edit_item'             => __( 'Edit Phone', 'mbl-essen' ),
            'update_item'           => __( 'Update Phone', 'mbl-essen' ),
            'view_item'             => __( 'View Phone', 'mbl-essen' ),
            'view_items'            => __( 'View Phones', 'mbl-essen' ),
            'search_items'          => __( 'Search Phone', 'mbl-essen' ),
            'not_found'             => __( 'Not found', 'mbl-essen' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'mbl-essen' ),
            'featured_image'        => __( 'Featured Image', 'mbl-essen' ),
            'set_featured_image'    => __( 'Set featured image', 'mbl-essen' ),
            'remove_featured_image' => __( 'Remove featured image', 'mbl-essen' ),
            'use_featured_image'    => __( 'Use as featured image', 'mbl-essen' ),
            'insert_into_item'      => __( 'Insert into Phone', 'mbl-essen' ),
            'uploaded_to_this_item' => __( 'Uploaded to this phone', 'mbl-essen' ),
            'items_list'            => __( 'Phones list', 'mbl-essen' ),
            'items_list_navigation' => __( 'Phones list navigation', 'mbl-essen' ),
            'filter_items_list'     => __( 'Filter phones list', 'mbl-essen' ),
        );

        $args = array(
            'label'                 => __( 'Phone', 'mbl-essen' ),
            'description'           => __( 'Post Type Description', 'mbl-essen' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => 'all-phones',
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
            'show_in_rest'          => true,
        );
        register_post_type( 'phone', $args );
    
    }

    // Register Custom Taxonomy
    public function brand_tax_generator() {
    
        $labels = array(
            'name'                       => _x( 'Brands', 'Taxonomy General Name', 'mbl-essen' ),
            'singular_name'              => _x( 'Brand', 'Taxonomy Singular Name', 'mbl-essen' ),
            'menu_name'                  => __( 'Brands', 'mbl-essen' ),
            'all_items'                  => __( 'All Brands', 'mbl-essen' ),
            'parent_item'                => __( 'Parent Brand', 'mbl-essen' ),
            'parent_item_colon'          => __( 'Parent Brand:', 'mbl-essen' ),
            'new_item_name'              => __( 'New Brand Name', 'mbl-essen' ),
            'add_new_item'               => __( 'Add New Brand', 'mbl-essen' ),
            'edit_item'                  => __( 'Edit Brand', 'mbl-essen' ),
            'update_item'                => __( 'Update Brand', 'mbl-essen' ),
            'view_item'                  => __( 'View Brand', 'mbl-essen' ),
            'separate_items_with_commas' => __( 'Separate brands with commas', 'mbl-essen' ),
            'add_or_remove_items'        => __( 'Add or remove brands', 'mbl-essen' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'mbl-essen' ),
            'popular_items'              => __( 'Popular Brands', 'mbl-essen' ),
            'search_items'               => __( 'Search Brands', 'mbl-essen' ),
            'not_found'                  => __( 'Not Found', 'mbl-essen' ),
            'no_terms'                   => __( 'No Brands', 'mbl-essen' ),
            'items_list'                 => __( 'Brands list', 'mbl-essen' ),
            'items_list_navigation'      => __( 'Brands list navigation', 'mbl-essen' ),
        );
        $rewrite = array(
            'slug'                       => 'brand',
            'with_front'                 => false,
            'hierarchical'               => false,
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => false,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            'rewrite'                    => $rewrite,
            'show_in_rest'               => true,
        );
        register_taxonomy( 'brand', array( 'phone' ), $args );
    
    }

}
