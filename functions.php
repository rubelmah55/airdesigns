<?php
/**
 * Embrace Nature - Custom functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Embrace Nature Custom
 * @since Embrace Nature Custom 1.0
 */

require_once('wp_bootstrap_navwalker.php');
/**
 * Constants
 * Defining default asset paths
 */
define('AIRDESIGNS_DIR_CSS', get_template_directory_uri().'/assets/css');
define('AIRDESIGNS_DIR_JS', get_template_directory_uri().'/assets/js');
define('AIRDESIGNS_DIR_IMG', get_template_directory_uri().'/assets/img');

function airdesigns_theme_support() {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'responsive-embeds' );

	load_theme_textdomain('airdesigns', get_template_directory() . '/languages');

	register_nav_menus( array(
		'header-left' => esc_html__( 'Header Top Left', 'airdesigns' ),
		'header-right' => esc_html__( 'Header Top Right', 'airdesigns' ),
		'primary' => esc_html__( 'Primary Header', 'airdesigns' ),
		'footer-1' => esc_html__( 'Footer One', 'airdesigns' ),
		'footer-2' => esc_html__( 'Footer Two', 'airdesigns' ),
		'footer-3' => esc_html__( 'Footer Three', 'airdesigns' ),
		'footer-4' => esc_html__( 'Footer Four', 'airdesigns' ),
		'footer-5' => esc_html__( 'Footer Five', 'airdesigns' ),
		'header-left' => esc_html__( 'Header Top Left', 'lacesup' ),
		'header-rights' => esc_html__( 'Header Top Right', 'lacesup' ),
		'primary' => esc_html__( 'Primary Header', 'lacesup' ),
		'menu-2' => esc_html__( 'Footer Menu', 'lacesup' ),
	) );
}
add_action( 'after_setup_theme', 'airdesigns_theme_support' );



function airdesigns_register_styles_and_scripts() {
	
    wp_enqueue_style( 'metismenu-css',  AIRDESIGNS_DIR_CSS.'/metismenu.css' );
    wp_enqueue_style( 'magnific-css',  AIRDESIGNS_DIR_CSS.'/magnific-popup.css' );
    wp_enqueue_style( 'airdesigns-style',  AIRDESIGNS_DIR_CSS . '/style.css', array(), filemtime( get_template_directory().'/assets/css/style.css' ) );

    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/libs/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js');
    wp_enqueue_script( 'magnific-popup', AIRDESIGNS_DIR_JS.'/magnific-popup.min.js', array('jquery'), '2.0', true );
    wp_enqueue_script( 'metismenu', AIRDESIGNS_DIR_JS.'/metismenu.js', array('jquery'), '2.0', true );  
    wp_enqueue_script( 'custom-js', AIRDESIGNS_DIR_JS.'/custom.js', array('jquery'), filemtime( get_template_directory().'/assets/js/custom.js' ), true );

}
add_action( 'wp_enqueue_scripts', 'airdesigns_register_styles_and_scripts' );




function airdesigns_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#site-content">' . __( 'Skip to the content', 'airdesigns' ) . '</a>';
}
add_action( 'wp_body_open', 'airdesigns_skip_link', 5 );



function airdesigns_sidebar_registration() {

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
	);

	// Footer #1.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #1', 'airdesigns' ),
				'id'          => 'footer-1',
				'description' => __( 'Widgets in this area will be displayed in the first column in the footer.', 'airdesigns' ),
			)
		)
	);

	// Footer #2.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #2', 'airdesigns' ),
				'id'          => 'footer-2',
				'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'airdesigns' ),
			)
		)
	);

	// Footer #3.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #3', 'airdesigns' ),
				'id'          => 'footer-3',
				'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'airdesigns' ),
			)
		)
	);

}
add_action( 'widgets_init', 'airdesigns_sidebar_registration' );


function add_upload_mimes($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    $mimes['doc'] = 'application/msword';
    $mimes['csv'] = 'text/csv';
    unset( $mimes['exe'] );
    return $mimes;
}
add_filter('upload_mimes', 'add_upload_mimes');


/*** ACF OPTIONS PAGE */
if(function_exists('acf_add_options_page')) {
	acf_add_options_page();
}

/*** Get all page id */ 
function getPageID() {
	global $post;

	if(is_home() && get_option('page_for_posts')) 
	{
		return get_option('page_for_posts');
	} 

	if(get_post_type() == 'page' && $post->post_parent ) {
		$ancestors = get_post_ancestors($post->ID);
		$root = count($ancestors)-1;
		return $ancestors[$root];
	}

	return $post->ID;
}

// Register Custom Post Type Product
function create_product_cpt() {

	$labels = array(
		'name' => _x( 'Products', 'Post Type General Name', 'airdesigns' ),
		'singular_name' => _x( 'Product', 'Post Type Singular Name', 'airdesigns' ),
		'menu_name' => _x( 'Products', 'Admin Menu text', 'airdesigns' ),
		'name_admin_bar' => _x( 'Product', 'Add New on Toolbar', 'airdesigns' ),
		'archives' => __( 'Product Archives', 'airdesigns' ),
		'attributes' => __( 'Product Attributes', 'airdesigns' ),
		'parent_item_colon' => __( 'Parent Product:', 'airdesigns' ),
		'all_items' => __( 'All Products', 'airdesigns' ),
		'add_new_item' => __( 'Add New Product', 'airdesigns' ),
		'add_new' => __( 'Add New', 'airdesigns' ),
		'new_item' => __( 'New Product', 'airdesigns' ),
		'edit_item' => __( 'Edit Product', 'airdesigns' ),
		'update_item' => __( 'Update Product', 'airdesigns' ),
		'view_item' => __( 'View Product', 'airdesigns' ),
		'view_items' => __( 'View Products', 'airdesigns' ),
		'search_items' => __( 'Search Product', 'airdesigns' ),
		'not_found' => __( 'Not found', 'airdesigns' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'airdesigns' ),
		'featured_image' => __( 'Featured Image', 'airdesigns' ),
		'set_featured_image' => __( 'Set featured image', 'airdesigns' ),
		'remove_featured_image' => __( 'Remove featured image', 'airdesigns' ),
		'use_featured_image' => __( 'Use as featured image', 'airdesigns' ),
		'insert_into_item' => __( 'Insert into Product', 'airdesigns' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Product', 'airdesigns' ),
		'items_list' => __( 'Products list', 'airdesigns' ),
		'items_list_navigation' => __( 'Products list navigation', 'airdesigns' ),
		'filter_items_list' => __( 'Filter Products list', 'airdesigns' ),
	);
	$args = array(
		'label' => __( 'Product', 'airdesigns' ),
		'description' => __( '', 'airdesigns' ),
		'labels' => $labels,
		'menu_icon' => 'dashicons-cart',
		'supports' => array('title', 'thumbnail', 'revisions', 'author'),
		'taxonomies' => array(),
		'public' => true,
		'rewrite'=>true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'product' ),
	);
	register_post_type( 'product', $args );

}
add_action( 'init', 'create_product_cpt', 0 );

// Register Taxonomy Category
function create_category_tax() {
	$labels = array(
		'name'              => _x( 'Product categories', 'taxonomy general name', 'airdesigns' ),
		'singular_name'     => _x( 'Product category', 'taxonomy singular name', 'airdesigns' ),
		'search_items'      => __( 'Search Product Categories', 'airdesigns' ),
		'all_items'         => __( 'All Product Categories', 'airdesigns' ),
		'parent_item'       => __( 'Parent Product Category', 'airdesigns' ),
		'parent_item_colon' => __( 'Parent Product Category:', 'airdesigns' ),
		'edit_item'         => __( 'Edit Product Category', 'airdesigns' ),
		'update_item'       => __( 'Update Product Category', 'airdesigns' ),
		'add_new_item'      => __( 'Add New Product Category', 'airdesigns' ),
		'new_item_name'     => __( 'New Product Category Name', 'airdesigns' ),
		'menu_name'         => __( 'Product Category', 'airdesigns' ),
	);
	$args = array(
		'labels' => $labels,
		'description' => __( '', 'airdesigns' ),
		'hierarchical' => true,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
		'rewrite' => array( 'slug' => 'products' ),

	);
	register_taxonomy( 'product_categories', array('product'), $args );
}
add_action( 'init', 'create_category_tax' );

// Register Taxonomy - Filters
function create_filters_tax() {

	//Filter - Gender
	$labels = array(
		'name'              => _x( 'Gender', 'taxonomy general name', 'airdesigns' ),
		'singular_name'     => _x( 'Gender', 'taxonomy singular name', 'airdesigns' ),
		'search_items'      => __( 'Search gender', 'airdesigns' ),
		'all_items'         => __( 'All genders', 'airdesigns' ),
		'parent_item'       => __( 'Parent gender', 'airdesigns' ),
		'parent_item_colon' => __( 'Parent gender:', 'airdesigns' ),
		'edit_item'         => __( 'Edit gender', 'airdesigns' ),
		'update_item'       => __( 'Update gender', 'airdesigns' ),
		'add_new_item'      => __( 'Add New gender', 'airdesigns' ),
		'new_item_name'     => __( 'New Gender Name', 'airdesigns' ),
		'menu_name'         => __( 'Gender', 'airdesigns' ),
	);
	$args = array(
		'labels' => $labels,
		'description' => __( '', 'airdesigns' ),
		'hierarchical' => true,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => false,
		'show_in_rest' => true,
	);
	register_taxonomy( 'product_gender', array('product'), $args );

	//Filter - Age
	$labels = array(
		'name'              => _x( 'Age', 'taxonomy general name', 'airdesigns' ),
		'singular_name'     => _x( 'Age', 'taxonomy singular name', 'airdesigns' ),
		'search_items'      => __( 'Search age', 'airdesigns' ),
		'all_items'         => __( 'All ages', 'airdesigns' ),
		'parent_item'       => __( 'Parent age', 'airdesigns' ),
		'parent_item_colon' => __( 'Parent age:', 'airdesigns' ),
		'edit_item'         => __( 'Edit age', 'airdesigns' ),
		'update_item'       => __( 'Update age', 'airdesigns' ),
		'add_new_item'      => __( 'Add New age', 'airdesigns' ),
		'new_item_name'     => __( 'New Age Name', 'airdesigns' ),
		'menu_name'         => __( 'Age', 'airdesigns' ),
	);
	$args = array(
		'labels' => $labels,
		'description' => __( '', 'airdesigns' ),
		'hierarchical' => true,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => false,
		'show_in_rest' => true,
	);
	register_taxonomy( 'product_age', array('product'), $args );

	//Filter - Product type
	$labels = array(
		'name'              => _x( 'Product type', 'taxonomy general name', 'airdesigns' ),
		'singular_name'     => _x( 'Product type', 'taxonomy singular name', 'airdesigns' ),
		'search_items'      => __( 'Search product type', 'airdesigns' ),
		'all_items'         => __( 'All product types', 'airdesigns' ),
		'parent_item'       => __( 'Parent product type', 'airdesigns' ),
		'parent_item_colon' => __( 'Parent product type:', 'airdesigns' ),
		'edit_item'         => __( 'Edit product type', 'airdesigns' ),
		'update_item'       => __( 'Update product type', 'airdesigns' ),
		'add_new_item'      => __( 'Add New product type', 'airdesigns' ),
		'new_item_name'     => __( 'New Product Type Name', 'airdesigns' ),
		'menu_name'         => __( 'Product type', 'airdesigns' ),
	);
	$args = array(
		'labels' => $labels,
		'description' => __( '', 'airdesigns' ),
		'hierarchical' => true,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => false,
		'show_in_rest' => true,
	);
	register_taxonomy( 'product_type', array('product'), $args );

	//Filter - Color
	$labels = array(
		'name'              => _x( 'Color', 'taxonomy general name', 'airdesigns' ),
		'singular_name'     => _x( 'Color', 'taxonomy singular name', 'airdesigns' ),
		'search_items'      => __( 'Search color', 'airdesigns' ),
		'all_items'         => __( 'All colors', 'airdesigns' ),
		'parent_item'       => __( 'Parent color', 'airdesigns' ),
		'parent_item_colon' => __( 'Parent color:', 'airdesigns' ),
		'edit_item'         => __( 'Edit color', 'airdesigns' ),
		'update_item'       => __( 'Update color', 'airdesigns' ),
		'add_new_item'      => __( 'Add New color', 'airdesigns' ),
		'new_item_name'     => __( 'New Color Name', 'airdesigns' ),
		'menu_name'         => __( 'Color', 'airdesigns' ),
	);
	$args = array(
		'labels' => $labels,
		'description' => __( '', 'airdesigns' ),
		'hierarchical' => true,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => false,
		'show_in_rest' => true,
	);
	register_taxonomy( 'product_color', array('product'), $args );

	//Filter - Brand
	$labels = array(
		'name'              => _x( 'Brand', 'taxonomy general name', 'airdesigns' ),
		'singular_name'     => _x( 'Brand', 'taxonomy singular name', 'airdesigns' ),
		'search_items'      => __( 'Search brand', 'airdesigns' ),
		'all_items'         => __( 'All brands', 'airdesigns' ),
		'parent_item'       => __( 'Parent brand', 'airdesigns' ),
		'parent_item_colon' => __( 'Parent brand:', 'airdesigns' ),
		'edit_item'         => __( 'Edit brand', 'airdesigns' ),
		'update_item'       => __( 'Update brand', 'airdesigns' ),
		'add_new_item'      => __( 'Add New brand', 'airdesigns' ),
		'new_item_name'     => __( 'New Brand Name', 'airdesigns' ),
		'menu_name'         => __( 'Brand', 'airdesigns' ),
	);
	$args = array(
		'labels' => $labels,
		'description' => __( '', 'airdesigns' ),
		'hierarchical' => true,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => false,
		'show_in_rest' => true,
		'rewrite' => array( 'slug' => 'brand' ),
	);
	register_taxonomy( 'product_brand', array('product'), $args );

}
add_action( 'init', 'create_filters_tax' );


function pagination_bar()
{
    global $wp_query;

    $total_pages = $wp_query->max_num_pages;

    if ($total_pages > 1) {
        $current_page = max(1, get_query_var('paged'));

        echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => '/page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
        ));
    }
}

// TODO - check if needed
/*
function sub_category_product_template(){

	$product_cat=get_query_var('product_category');

	if(($product_cat->parent !=0)){

		include(get_template_directory_uri(  ).'/sub_category_template.php');
		exit;

	}
	return;
}
add_action('template_redirect','sub_category_product_template');
*/



//==============================================================
//Shortcode to Support seciton navigations
//[support_menu parent="201" type="link"]
//[support_menu parent="201" type="image"]
//==============================================================
function support_menu_shortcode($attr){

	global $post;

	$parent_id = $attr['parent'];
	$current_level = 1;

	$top_parents    = array();
	$top_parents    = get_post_ancestors($post->ID);
	$top_parents[]  = $post->ID;

	$children = get_posts(
	    array(
	      'post_type'       => 'page'
	    , 'posts_per_page'  => -1
	    , 'post_parent'     => $parent_id
	    , 'order_by'        => 'title'
	    , 'order'           => 'ASC'
	));

	if (empty($children)) return;

	$output = '';

	if($attr['type'] == 'link'){
		//$output .= '<ul class="children level-'.$current_level.'-children">';

		
		$output .= '<div class="support-menu-links">';

		foreach ($children as $child){

			$box_class = '';
		    if (in_array($child->ID, $top_parents)){
		    	$box_class = 'active';
		    }

			$output .= '<a class="btn btn-outline-primary border-1 mb-1 me-1 d-inline-block '.$box_class.'" href="'.get_permalink($child->ID).'">';
			$output .= apply_filters('the_title', $child->post_title);
			$output .= '</a>';

		    // now call the same function for child of this child
		    /*
		    if ($child->ID && (in_array($child->ID, $top_parents))){
		    	show_all_children($child->ID, $post->ID, $current_level+1);
		    }
		    */

			//$output .= '</li>';
		}

		$output .= '</div>';
	}elseif($attr['type'] == 'image'){
		$output .= '<div class="row">';

		foreach ($children as $child){

			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $child->ID ), 'thumbnail' );

			$box_class = '';
		    if (in_array($child->ID, $top_parents)){
		    	$box_class = 'active';
		    }

		    $menu_label = '';
		    $menu_label = get_field('menu_label', $child->ID);
		    if(empty($menu_label)){
		    	$menu_label = get_the_title($child->ID);
		    }

			$output .= '
			<div class="col-12 col-md-3 mb-1">
				<div class="card support-menu-images h-100 rounded-0 '.$box_class.'">
					
					<div class="card-body text-center">
						<a class="d-block" href="'.get_permalink($child->ID).'">
							<img src="'.$image[0].'" alt="'. $menu_label .'" alt="...">
							<span class="d-block mt-1">'. $menu_label .'</span>
						</a>
					</div>
				</div>';
			    // now call the same function for child of this child
				/*
			    if ($child->ID && (in_array($child->ID, $top_parents))){
			    	show_all_children($child->ID, $post->ID, $current_level+1);
			    }
			    */
				$output .= '
			</div>';
		}

		$output .= '</div>';
	}

	return $output;
}
add_shortcode('support_menu', 'support_menu_shortcode');