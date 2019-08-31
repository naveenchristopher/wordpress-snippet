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
