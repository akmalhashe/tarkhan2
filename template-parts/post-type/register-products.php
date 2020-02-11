<?php
//---------------------------------------------------------------------------------------- Custom Post Type for Products
/*
* Creating a function to create our CPT
*/

function cpt_products() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Products', 'Post Type General Name', 'hashe' ),
		'singular_name'       => _x( 'Product', 'Post Type Singular Name', 'hashe' ),
		'menu_name'           => __( 'Products', 'hashe' ),
		//'parent_item_colon'   => __( 'Parent Product', 'hashe' ),
		'all_items'           => __( 'All Products', 'hashe' ),
		'view_item'           => __( 'View event', 'hashe' ),
		'add_new_item'        => __( 'Add New event', 'hashe' ),
		'add_new'             => __( 'Add New', 'hashe' ),
		'edit_item'           => __( 'Edit event', 'hashe' ),
		'update_item'         => __( 'Update event', 'hashe' ),
		'search_items'        => __( 'Search event', 'hashe' ),
		'not_found'           => __( 'Not Found', 'hashe' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'hashe' ),
	);

// Set other options for Custom Post Type

	$args = array(
		'label'               => __( 'products', 'hashe' ),
		'description'         => __( 'Products news and reviews', 'hashe' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'thumbnail' ),
		// You can associate this CPT with a taxonomy or custom taxonomy.
		//'taxonomies'          => array( 'category' ),

		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/
		'hierarchical'        => false,
		'public'              => true,
		'query_var'           => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-cart',
		// 'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'rewrite' => array("slug" => "product")
	);

	// Registering your Custom Post Type
	register_post_type( 'cpt_products', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/

add_action( 'init', 'cpt_products', 0 );

/***********************************************************************************************custom category*/
function product_taxonomy() {
    $labels = array(
        'name'              => _x( 'Product Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Product Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Categories' ),
        'all_items'         => __( 'All Categories' ),
        'parent_item'       => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item'         => __( 'Edit Category' ),
        'update_item'       => __( 'Update Category' ),
        'add_new_item'      => __( 'Add New Category' ),
        'new_item_name'     => __( 'New Category Name' ),
        'menu_name'         => __( 'Categories' ),
    );

    $args = array(
        'hierarchical'      => true, // Set this to 'false' for non-hierarchical taxonomy (like tags)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'products-cat' ),
    );

    register_taxonomy( 'product_categories', array( 'cpt_products' ), $args );
}
add_action( 'init', 'product_taxonomy', 0 );

