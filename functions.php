<?php
/**
 * H2 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package H2
 */

if ( ! function_exists( 'h2_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function h2_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on H2, use a find and replace
		 * to change 'h2' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'h2', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'h2' ),
			'footer-one' => esc_html__( 'footer Menu one', 'hasheone' )
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'h2_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'h2_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function h2_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'h2_content_width', 640 );
}
add_action( 'after_setup_theme', 'h2_content_width', 0 );

/**
 * Add theme support for Front Page without separate page template
 *
 * @return void
 */
function h2_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'h2_front_page_template' );

/**
 * Custom Image sizes
 *
 * @return void
 */
function h2_img_sizes() {
    add_image_size( 'product-square-sm', 270, 270, true, array( 'center', 'center' ) );
    add_image_size( 'product-square-md', 370, 370, true, array( 'center', 'center' )  );
    add_image_size( 'product-rectangle', 770, 370, true, array( 'center', 'center' )  );
    add_image_size( 'banner-ex', 1570, 640, true, array( 'center', 'center' ) );
}
add_action( 'after_setup_theme', 'h2_img_sizes' );

/**
 * Updating theme thumbnails
 * 
 * @return void
 */
update_option( 'thumbnail_size_w', 170 );
update_option( 'thumbnail_size_h', 170 );

update_option( 'medium_size_w', 550 );
update_option( 'medium_size_h', 9999 );

update_option( 'large_size_w', 1920 );
update_option( 'large_size_h', 900 );

/**
 * Displaying Menu
 *
 * @return void
 */
function h2_menu($menu, $menuclass) {
	if ( has_nav_menu( $menu ) ) {
		wp_nav_menu( array(
			'theme_location' => $menu,
			'menu_class' => $menuclass,
			 'container'=>false
		));
	}
}
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function h2_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'h2' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'h2' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
        'name'          => __( 'Header address', 'hasheone' ),
        'id'            => 'headeraddress',
        'description'   => __( 'Address on top.', 'hasheone' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<p class="displaynone">',
        'after_title'   => '</p>',
	) );
	register_sidebar( array(
        'name'          => __( 'Header phone', 'hasheone' ),
        'id'            => 'headerphone',
        'description'   => __( 'Phone on top.', 'hasheone' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<p class="displaynone">',
        'after_title'   => '</p>',
	) );
	register_sidebar( array(
        'name'          => __( 'Banner Tagline', 'hasheone' ),
        'id'            => 'bannertagline',
        'description'   => __( 'Widgets on banner area.', 'hasheone' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<p class="displaynone">',
        'after_title'   => '</p>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Contact bottom widgets', 'h2' ),
		'id'            => 'contactbottom',
		'description'   => esc_html__( 'widgets below map.', 'h2' ),
		'before_widget' => '<div class="col-sm-4 text-center "><div id="%1$s" class="mbw-item  %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<strong class="widget-title">',
		'after_title'   => '</strong>',
	) );
	register_sidebar( array(
        'name'          => __( 'Bottom logo', 'hasheone' ),
        'id'            => 'logobottom',
        'description'   => __( 'Just add image.', 'hasheone' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<p class="displaynone">',
        'after_title'   => '</p>',
	) );
	register_sidebar( array(
        'name'          => __( 'Copyrights', 'hasheone' ),
        'id'            => 'copyright',
        'description'   => __( 'Text of copyrights.', 'hasheone' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<p class="displaynone">',
        'after_title'   => '</p>',
	) );
}
add_action( 'widgets_init', 'h2_widgets_init' );

/**
 * Emptying text widgets from unneccessary divs
 *
 * @return void
 */
add_action( 'widgets_init', 'register_my_widgets' );
function register_my_widgets() {
    register_widget( 'My_Text_Widget' );
}
class My_Text_Widget extends WP_Widget_Text {
    function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
        echo $before_widget;
        if ( !empty( $title ) ) {
        	echo $before_title . $title . $after_title;
        } ?>
            <?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?>
        <?php
        echo $after_widget;
    }
}
/**
 * Empty custom html widget
 *
 * @return void
 */
add_action( 'widgets_init', 'register_my_widgetss' );
function register_my_widgetss() {
    register_widget( 'My_custom_html_widget' );
}
class My_custom_html_widget extends WP_Widget_Custom_HTML {
    function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $content = apply_filters( 'widget_text', empty( $instance['content'] ) ? '' : $instance['content'], $instance );
        echo $before_widget;
        if ( !empty( $title ) ) {
            echo $before_title . $title . $after_title;
        } ?>
            <?php echo !empty( $instance['filter'] ) ? wpautop( $content ) : $content; ?>
        <?php
        echo $after_widget;
    }
}
/**
 * Making it possible to add [span] or [sup] in widget titles
 * 
 * @param str $title
 */
function html_widget_title( $title ) {
	/*HTML tag opening/closing brackets*/
$title = str_replace( '[', '<', $title );
$title = str_replace( '[/', '</', $title );
// span
$title = str_replace( 'span]', 'span>', $title );
// sup
$title = str_replace( 'small]', 'small>', $title );

return $title;
}
add_filter( 'widget_title', 'html_widget_title' );



/**
 * Enqueue scripts and styles.
 */
function h2_scripts() {

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'h2_scripts' );

add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );
function wps_deregister_styles() {
    wp_deregister_style( 'contact-form-7' );
}

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

/**
 * Changing excerpt more
 *
 * @param [type] $more
 * @return void
 */
function new_excerpt_more($more) {
	global $post;
	/*return '<a class="archive-readmore" href="'. get_permalink($post->ID) . '">' . 'Read More' . '</a>';*/
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

/**
 * Customize comment form default fields.
 * 
 * Move the comment_field below the author, email, and url fields.
 * @param mixed $name
 */
function wpse250243_comment_form_default_fields( $fields ) {
    $commenter     = wp_get_current_commenter();
    $user          = wp_get_current_user();
    $user_identity = $user->exists() ? $user->display_name : '';
    $req           = get_option( 'require_name_email' );
    $aria_req      = ( $req ? " aria-required='true'" : '' );

    $fields = [
        'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'textdomain'  ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' /></p>',
        'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'textdomain'  ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p>',
        'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'textdomain'  ) . '</label> ' .
                    '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" /></p>',
        'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment *', 'noun', 'textdomain' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true"></textarea></p>',
    ];

    return $fields;
}
add_filter( 'comment_form_default_fields', 'wpse250243_comment_form_default_fields' );

/**
 * Remove the original comment field because we've added it to the default fields
 * using wpse250243_comment_form_default_fields(). If we don't do this, the comment
 * field will appear twice.
 * 
 * @param mixed $name
 */
function wpse250243_comment_form_defaults( $defaults ) {
    if ( isset( $defaults[ 'comment_field' ] ) ) {
        $defaults[ 'comment_field' ] = '';
    }
    $defaults = array(
        'title_reply_before'   => '<strong id="reply-title" class="comment-reply-title">',
        'title_reply_after'    => '</strong>',
        'comment_field'        => '',
    );

    return $defaults;
}
add_filter( 'comment_form_defaults', 'wpse250243_comment_form_defaults', 10, 1 );

/**
 * Navigation Markup for posts
 * desine the navigation_markup_template callback
 * 
 * @param mixed $name
 */
function filter_navigation_markup_template( $template, $class ) {
    // make filter magic happen here...
    $template = '
        <nav class="navigation %1$s">
            <h2 class="screen-reader-text">%2$s</h2>
            <div class="nav-links">%3$s</div>
        </nav>';
    return $template;
};

// add the filter
add_filter( 'navigation_markup_template', 'filter_navigation_markup_template', 10, 2 );

/**
 * Required Plugins
 */
require_once dirname( __FILE__ ) . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'h2_required_plugins' );

function h2_required_plugins() {
    $plugins = array(
	    // array(
	    //     'name' => 'Customize Image Gallery Control',
	    //     'slug' => 'wp-customize-image-gallery-control',
	    //     'source' => 'https://github.com/xwp/wp-customize-image-gallery-control/archive/master.zip',
	    //     'required' => true,
	    //     'force_activation' => false,
	    // ),
	    // array(
		// 	'name' => 'MailPoet Newsletters',
		// 	'slug' => 'wysija-newsletters',
		// 	'required'  => true,
		// ),
		array(
			'name' => 'Contact Form 7',
			'slug' => 'contact-form-7',
			'required'  => true,
		),
		array(
			'name' => 'All-in-One WP Migration',
			'slug' => 'all-in-one-wp-migration',
			'required'  => true,
		),
		array(
			'name' => 'Advanced Custom Fields PRO',
			'slug' => 'acf',
			'source' => get_template_directory() . '/inc/advanced-custom-fields-pro.zip',
			'required'  => true,
			'force_activation' => false,
		),
	);
 
    tgmpa( $plugins );
}
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load Metabox.
 */
//require get_template_directory() . '/template-parts/meta-box/register-metabox.php';

/**
 * Load Custom Post Type.
 */
//require get_template_directory() . '/template-parts/post-type/register-testimonials.php';
/*require get_template_directory() . '/template-parts/post-type/register-products.php';
require get_template_directory() . '/template-parts/post-type/register-team.php';*/

/**
 * Load Custom pagination.
 */
require get_template_directory() . '/template-parts/pagination/pagination.php';

/**
 * Load Custom widget.
 */
require get_template_directory() . '/template-parts/widget/custom-widget.php';

/**
 * Load Custom breadcrumbs.
 */
require get_template_directory() . '/template-parts/breadcrumbs/breadcrumbs.php';

/**
 * Products / Woocommerce
 */
require get_template_directory() . '/products/slider-products.php';
require get_template_directory() . '/products/featured-products.php';


/**
 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 */
// Remove each style one by one

/*

add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}

// Or just remove them all in one line
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
remove_action( 'enqueue_block_assets', 'wp_enqueue_registered_block_scripts_and_styles' );

// Disable Gutenberg editor.
add_filter('use_block_editor_for_post_type', '__return_false', 10);

add_action( 'wp_enqueue_scripts', 'remove_block_css', 100 );
function remove_block_css() {

    wp_enqueue_style( 'atf-style', get_stylesheet_directory_uri() . '/css/atf.css' );


    wp_dequeue_style( 'wp-block-library' ); // WordPress core
    wp_dequeue_style( 'wp-block-library-theme' ); // WordPress core
}

*/

add_action( 'wp_enqueue_scripts', 'include_styles' );
function include_styles() {

    wp_enqueue_style( 'atf-style', get_stylesheet_directory_uri() . '/css/atf.css' );


    // wp_dequeue_style( 'wp-block-library' ); // WordPress core
    // wp_dequeue_style( 'wp-block-library-theme' ); // WordPress core
}

/**
 * Load styles in footer
 */
function prefix_add_footer_styles() {
    wp_enqueue_style( 'bootstrap-grid', get_stylesheet_directory_uri() . '/css/bootstrap.grid.css' );
    wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.min.css' );
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap' );
    wp_enqueue_style( 'slick-style', get_stylesheet_directory_uri() . '/slick/slick.css' );
    wp_enqueue_style( 'hashe-style', get_stylesheet_directory_uri() . '/style.css' );

    
    wp_enqueue_script( 'slick-script', get_stylesheet_directory_uri() . '/slick/slick.min.js' );
    wp_enqueue_script( 'hashe-script', get_stylesheet_directory_uri() . '/js/hashe.js' );
}
add_action( 'get_footer', 'prefix_add_footer_styles' );

/**
 * Adding new jquery
 */
if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   //wp_register_script('jquery', "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js", false, null);
   wp_register_script('jquery', get_stylesheet_directory_uri() . '/js/jquery.min.js', false, null);
   wp_enqueue_script('jquery');
}


/**
 * Theme options page
 */
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
}

/**
 * Debug
 */
function debug ($param) {
	echo "<pre>";
	var_dump($param);
	echo "</pre>";
}
function debug_die ($param) {
	echo "<pre>";
	var_dump($param);
	echo "</pre>";
	die();
}