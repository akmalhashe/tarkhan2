<?php
//---------------------------------------------------------------------------------------- Custom Post Type for Testimonials
/*
* Creating a function to create our CPT
*/

function cpt_testimonials() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Testimonials', 'Post Type General Name', 'hashe' ),
		'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name', 'hashe' ),
		'menu_name'           => __( 'Testimonials', 'hashe' ),
		//'parent_item_colon'   => __( 'Parent Testimonial', 'hashe' ),
		'all_items'           => __( 'All Testimonials', 'hashe' ),
		'view_item'           => __( 'View Testimonial', 'hashe' ),
		'add_new_item'        => __( 'Add New Testimonial', 'hashe' ),
		'add_new'             => __( 'Add New', 'hashe' ),
		'edit_item'           => __( 'Edit Testimonial', 'hashe' ),
		'update_item'         => __( 'Update Testimonial', 'hashe' ),
		'search_items'        => __( 'Search Testimonial', 'hashe' ),
		'not_found'           => __( 'Not Found', 'hashe' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'hashe' ),
	);

// Set other options for Custom Post Type

	$args = array(
		'label'               => __( 'testimonials', 'hashe' ),
		'description'         => __( 'Testimonial news and reviews', 'hashe' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions' ),
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
		'menu_icon'           => 'dashicons-format-chat',
		// 'can_export'          => true,
		// 'has_archive'         => true,
		// 'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'rewrite' => array("slug" => "testimonials"),
		'register_meta_box_cb'=> 'add_designation_metaboxes'
	);

	// Registering your Custom Post Type Testimonials
	register_post_type( 'testimonials', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/

add_action( 'init', 'cpt_testimonials', 0 );

/***********************************************************************************************custom category*/
/*
function create_custom_taxonomies() {
    $labels = array(
        'name'              => _x( 'Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
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
        'hierarchical'      => false, // Set this to 'false' for non-hierarchical taxonomy (like tags)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'testimonials-category' ),
    );

    register_taxonomy( 'projects_categories', array( 'testimonials' ), $args );
}
add_action( 'init', 'create_custom_taxonomies', 0 );*/

/*********************************************************************************************** Custom metabox for designation */
add_action( 'add_meta_boxes', 'add_designation_metaboxes' );
// Add the Events Meta Boxes
function add_designation_metaboxes() {
    add_meta_box('testimonial_designation_mb', 'Designation', 'show_testimonial_designation_mb', 'testimonials', 'side', 'default');
}

// The Event Location Metabox
function show_testimonial_designation_mb() {
    global $post;

    // Noncename needed to verify where the data originated
    echo '<input type="hidden" name="designationmeta_noncename" id="designationmeta_noncename" value="' .
    wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

    // Get the designation data if its already been entered
    $designation = get_post_meta($post->ID, '_designation', true);

    // Echo out the field
        /* echo '<p>Page Title</p>';*/
    echo '<input type="text" name="_designation" value="' . $designation  . '" class="widefat" />';
}

// Save the Metabox Data
function save_designation_meta($post_id, $post) {

    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if ( !wp_verify_nonce( $_POST['designationmeta_noncename'], plugin_basename(__FILE__) )) {
    return $post->ID;
    }

    // Is the user allowed to edit the post or page?
    if ( !current_user_can( 'edit_post', $post->ID ))
        return $post->ID;

    // OK, we're authenticated: we need to find and save the data
    // We'll put it into an array to make it easier to loop though.

    $designation_meta['_designation'] = $_POST['_designation'];

    // Add values of $designation_meta as custom fields

    foreach ($designation_meta as $key => $value) { // Cycle through the $designation_meta array!
        if( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
        if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
            update_post_meta($post->ID, $key, $value);
        } else { // If the custom field doesn't have a value
            add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
    }

}

add_action('save_post', 'save_designation_meta', 1, 2); // save the custom fields