<!-- Wordpress Post Loop content Fetch by Category ID -->

<?php
	$args = array( 'numberposts' => 1, 'category' => 3 );
	$recent_posts = get_posts( $args );
	foreach ( $recent_posts as $post ) : setup_postdata( $post ); 
	?>
	<h2><span class="headline-lines"><?php the_title() ?></span></h2>
	<?php the_content(); ?>
	<p class="text-center">
		<?php the_post_thumbnail( $size, $attr ); ?>
	</p>
	<?php endforeach; 
	wp_reset_postdata();
?>

<!-- ================================================= -->

<!-- Wordpress Page content Fetch -->

<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
the_content();
endwhile; else: ?>
<p>Sorry, no posts matched your criteria.</p>
<?php endif; ?>


<!-- ================================================= -->

<!-- Wordpress Load Script and Style through Function file -->

<?php
function wc_scripts_with_jquery()
{
   // Register the script like this for a theme:
   wp_register_script( 'custom-script', get_stylesheet_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array( 'jquery' ) );
   wp_register_style( 'custom-style', get_stylesheet_directory_uri() . '/assets/css/magnific-popup.css', array(), '20120208', 'all' );
}
add_action( 'wp_enqueue_scripts', 'wc_scripts_with_jquery' );
    wp_enqueue_script('custom-script'); 
?>

<!-- ================================================= -->

<!-- Wordpress Short code Create with Loop through Function file -->

<?php
function shortcode_resource_function( $atts ){
ob_start(); extract( shortcode_atts( array('find' => '',), $atts ) );
?>
<?php global $post;
$args = array( 'numberposts' => 1, 'category' => 18 );
$recent_posts = get_posts( $args );
foreach ( $recent_posts as $post ) : setup_postdata( $post ); ?>
	<div id="resources-shortcode">
		    <div class="content-resources">
		      <h1><?php the_title();?></h1>
		      <div class="Expert-contents"><?php the_excerpt();?></div>
		      	<div id="global-btn" class="et_pb_module et_pb_text et_pb_text_2 btn-left btn-blue et_clickable et_pb_bg_layout_light  et_pb_text_align_left"><a href="<?php the_permalink() ?>"><p>READ MORE</p></a>
		      	</div>
		    </div>
	</div>
<?php endforeach; 
wp_reset_postdata();
return ob_get_clean();?>          
<?php

}
add_shortcode( 'shortcode_resource', 'shortcode_resource_function' );
?>

<!-- ================================================= -->

<!-- Wordpress Custom post type and custom taxonomy can generate this url -->

<!-- https://generatewp.com/ -->

<!-- Here also mention the code  for CPT  -->

if ( ! function_exists('resource_center') ) {

// Register Custom Post Type
function resource_center() {

	$labels = array(
		'name'                  => _x( 'Resource Center', 'Post Type General Name', 'resource-center' ),
		'singular_name'         => _x( 'Resource Center', 'Post Type Singular Name', 'resource-center' ),
		'menu_name'             => __( 'Resource Center', 'resource-center' ),
		'name_admin_bar'        => __( 'Resource Center', 'resource-center' ),
		'archives'              => __( 'Resource Archives', 'resource-center' ),
		'attributes'            => __( 'Resource Attributes', 'resource-center' ),
		'parent_item_colon'     => __( 'Parent Resource Item:', 'resource-center' ),
		'all_items'             => __( 'All Resources', 'resource-center' ),
		'add_new_item'          => __( 'Add New Resource', 'resource-center' ),
		'add_new'               => __( 'Add New', 'resource-center' ),
		'new_item'              => __( 'New Resource', 'resource-center' ),
		'edit_item'             => __( 'Edit Resource', 'resource-center' ),
		'update_item'           => __( 'Update Resource', 'resource-center' ),
		'view_item'             => __( 'View Resource', 'resource-center' ),
		'view_items'            => __( 'View Resources', 'resource-center' ),
		'search_items'          => __( 'Search Resource', 'resource-center' ),
		'not_found'             => __( 'Not found', 'resource-center' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'resource-center' ),
		'featured_image'        => __( 'Featured Image', 'resource-center' ),
		'set_featured_image'    => __( 'Set featured image', 'resource-center' ),
		'remove_featured_image' => __( 'Remove featured image', 'resource-center' ),
		'use_featured_image'    => __( 'Use as featured image', 'resource-center' ),
		'insert_into_item'      => __( 'Insert into item', 'resource-center' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'resource-center' ),
		'items_list'            => __( 'Items list', 'resource-center' ),
		'items_list_navigation' => __( 'Items list navigation', 'resource-center' ),
		'filter_items_list'     => __( 'Filter items list', 'resource-center' ),
	);
	$args = array(
		'label'                 => __( 'Resource Center', 'resource-center' ),
		'description'           => __( 'Manage all Resource Here', 'resource-center' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-category',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'rewrite'               => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'resource-center', $args );

}
add_action( 'init', 'resource_center', 0 );

}

function child_theme_import()
{
    wp_register_style( 'custom-grid-style', get_stylesheet_directory_uri() . '/assets/css/custom-grids.css', array(), '20120208', 'all' );
    /*enque Style*/
    wp_enqueue_style('custom-grid-style');
}
add_action( 'wp_enqueue_scripts', 'child_theme_import' );
<!--  -->

<!-- custom category for CPT -->
//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_topics_hierarchical_taxonomy', 0 );
 
//create a custom taxonomy name it topics for your posts
 
function create_topics_hierarchical_taxonomy() {
 
// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI
 
	$labels = array(
		'name'                       => _x( 'Resource Categories', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Resource Category', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Resource Category', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);  
 
// Now register the taxonomy
 
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	    'query_var' => true,
	    'rewrite' => array( 'slug' => 'topic' ),
	);

  register_taxonomy('resource_center',array('resource-center'), $args);
 
}

<!-- custom tag for CPT -->
 
add_action( 'init', 'create_topics_nonhierarchical_taxonomy', 0 );
 
function create_topics_nonhierarchical_taxonomy() {
 
// Labels part for the GUI
 
  $labels = array(
    'name' => _x( 'Resource Type', 'taxonomy general name' ),
    'singular_name' => _x( 'Resource Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Resource Type' ),
    'popular_items' => __( 'Popular Resource Type' ),
    'all_items' => __( 'All Resource Type' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Resource Type' ), 
    'update_item' => __( 'Update Resource Type' ),
    'add_new_item' => __( 'Add New Resource Type' ),
    'new_item_name' => __( 'New Resource Type Name' ),
    'separate_items_with_commas' => __( 'Separate resource type with commas' ),
    'add_or_remove_items' => __( 'Add or remove resource type' ),
    'choose_from_most_used' => __( 'Choose from the most used topics' ),
    'menu_name' => __( 'Resource Type' ),
  ); 
 
// Now register the non-hierarchical taxonomy like tag

	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
	    'query_var' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array( 'slug' => 'resource_tag' ),
	);
 
  register_taxonomy('resource_tag', 'resource-center', $args);
}


<!-- Here End the code  for CPT  -->


<!-- custom post type with forms -->

<!-- http://projects.tareq.co/wp-generator/index.php -->

<!-- ================================================= -->

<!-- Wordpress Custom fields generator this url-->

<!-- https://metabox.io/online-generator/   call custom field-->
<?php get_post_meta(get_the_ID(), 'subtitle', TRUE); ?> 

<!-- ================================================= -->

<!-- Wordpress Custom Template Create-->

<?php 
/* Template Name: PageWithoutSidebar */ 
get_header();
?>

<?php get_footer(); ?>

<!-- ================================================= -->

<!-- Display data from database inside <table> using wordpress $wpdb -->

<table border="1">
    <tr>
     <th>Firstname</th>
     <th>Lastname</th>
     <th>Points</th>
    </tr>
    <tr>
      <?php
        global $wpdb;
        $result = $wpdb->get_results ( "SELECT * FROM myTable" );
        foreach ( $result as $print )   {
            echo '<td>' $print->firstname.'</td>';
            }
      ?>
    </tr>               
</table>

<!-- ================================================= -->


// =========================================================================
// REMOVE WORDPRESS VERSIONING ON URL
// =========================================================================
// 
add_filter( 'style_loader_src',  'sdt_remove_ver_css_js', 9999, 2 );
add_filter( 'script_loader_src', 'sdt_remove_ver_css_js', 9999, 2 );

function sdt_remove_ver_css_js( $src, $handle ) 
{
    $handles_with_version = [ 'style' ]; // <-- Adjust to your needs!

    if ( strpos( $src, 'ver=' ) && ! in_array( $handle, $handles_with_version, true ) )
        $src = remove_query_arg( 'ver', $src );

    return $src;
}

<!-- ================================================= -->
