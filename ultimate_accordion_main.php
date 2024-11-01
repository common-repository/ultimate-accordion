<?php
/*
Plugin Name: Ultimate Accordion 
Plugin URI: http://ibnbd.net/accordion-demo/
Description: This plugin will enable an awesome ultimate accordion use anywhere your wordpress theme page. Fully customization & responsive layout.. Just use Shortcode. 
Author: Md. Shiddikur Rahman
Author URI: http://phpdev.us/siddik
Version: 1.0
*/
/*Some Set-up*/
define('ULTIMATE_ACCORDION', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
/* Including all files */
function ultimate_accordion_plugins() {	
wp_enqueue_style('ultimate-accordion-css', ULTIMATE_ACCORDION.'css/style.css',array(), 1.0 );
wp_enqueue_script( 'ultimate-accordion-js',ULTIMATE_ACCORDION.'js/plugins.js', array('jquery'), 1.0, true);
}
add_action( 'wp_enqueue_scripts', 'ultimate_accordion_plugins' );

/*---------------------------------------------------
 *This custom post for  Accordion Plugin
 ----------------------------------------------------*/
add_action( 'init', 'accordion_custom_post' );
function accordion_custom_post() {
	$labels = array(
		'name'               => _x( 'Accordion Items', 'ultimate-accordion' ),
		'singular_name'      => _x( 'Accordion Item',  'ultimate-accordion' ),
		'menu_name'          => _x( 'Accordion Items', 'ultimate-accordion' ),
		'name_admin_bar'     => _x( 'Accordion Item',  'ultimate-accordion' ),
		'add_new'            => _x( 'Add New Accordion Item', 'ultimate-accordion' ),
		'add_new_item'       => __( 'Add New Accordion Items', 'ultimate-accordion' ),
		'new_item'           => __( 'New Accordion Items', 'ultimate-accordion' ),
		'edit_item'          => __( 'Edit Accordion Items', 'ultimate-accordion' ),
		'view_item'          => __( 'View Accordion Items', 'ultimate-accordion' ),
		'all_items'          => __( 'All Accordion Items', 'ultimate-accordion' ),
		'search_items'       => __( 'Search Accordion Items', 'ultimate-accordion' ),
		'parent_item_colon'  => __( 'Parent Accordion Items:', 'ultimate-accordion' ),
		'not_found'          => __( 'No Accordion Items found.', 'ultimate-accordion' ),
		'not_found_in_trash' => __( 'No Accordion Items found in Trash.', 'ultimate-accordion' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'accordion-items' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail')
	);

	register_post_type( 'accordion-item', $args );
}
/*---------------------------------------------------
 *This code for  Accordion Cat taxonomy 
 ----------------------------------------------------*/
	function cat_accordion_taxonomy() {
		register_taxonomy(
			'accordion_cat',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
			'accordion-item',                  //post type name
			array(
				'hierarchical'          => true,
				'label'                 => 'Accordion Item Category',  //Display name
				'query_var'             => true,
				'show_admin_column' => true,
				'rewrite'               => array(
					'slug'              => 'accordion-item-category', // This controls the base slug that will display before each term
					'with_front'    	=> false // Don't display the category base before
					)
				)
		);
	}
	add_action( 'init', 'cat_accordion_taxonomy');

/*--------------------------------------------------------
 *Shortcode for ultimate accordion Style One
 ---------------------------------------------------------*/
 function ultimate_accordion_one($atts){
	extract( shortcode_atts( array(
		'bootstrap_columns' => '6',
		'shownumberpost' => '3',
		'category' => '',
	), $atts, 'ultimate_accordion_style_1' ) );
	
    $q = new WP_Query(
        array( 'accordion_cat' => $category, 'posts_per_page' => $shownumberpost, 'post_type' => 'accordion-item')
        );
$list = '<div class="col-lg-'.$bootstrap_columns.' col-md-'.$bootstrap_columns.' col-sm-'.$bootstrap_columns.' col-xs-12"><div class="accordionStyle-one"><div id="accordion" class="panel-group">';
while($q->have_posts()) : $q->the_post();
    //get the ID of your post in the loop
    $id = get_the_ID(); 
	$list .= '
			<!-- Accordion One Start -->
			<div class="panel panel-default">
				<div class="panel-heading">
				  <h4 class="panel-title">
					<a aria-controls="'.get_the_ID().'" aria-expanded="true" href="#'.get_the_ID().'" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle">
					 '.get_the_title().'
					</a>
				  </h4>
				</div>
				<div class="panel-collapse collapse " id="'.get_the_ID().'" style="height: auto;">
				  <div class="panel-body">
				   <p>'.get_the_content().'</p>
				  </div>
				</div>
			</div>
			<!-- Accordion One End -->
			';        
endwhile;
$list.= '</div></div></div>';
wp_reset_query();
return $list;
}
add_shortcode('ultimate_accordion_style_1', 'ultimate_accordion_one');	

/*--------------------------------------------------------
 *Shortcode for ultimate accordion Style Two
 ---------------------------------------------------------*/
 function ultimate_accordion_two($atts){
	extract( shortcode_atts( array(
		'bootstrap_columns' => '6',
		'shownumberpost' => '3',
		'category' => '',
	), $atts, 'ultimate_accordion_style_2' ) );
	
    $q = new WP_Query(
        array( 'accordion_cat' => $category, 'posts_per_page' => $shownumberpost, 'post_type' => 'accordion-item')
        );
$list = '<div class="col-lg-'.$bootstrap_columns.' col-md-'.$bootstrap_columns.' col-sm-'.$bootstrap_columns.' col-xs-12"><div class="accordionStyle-two"><div id="accordiontwo" class="panel-group">';
while($q->have_posts()) : $q->the_post();
    //get the ID of your post in the loop
    $id = get_the_ID(); 
	$list .= '
			<!-- Accordion One Start -->
			<div class="panel panel-default">
				<div class="panel-heading">
				  <h4 class="panel-title">
					<a aria-controls="'.get_the_ID().'" aria-expanded="true" href="#'.get_the_ID().'" data-parent="#accordiontwo" data-toggle="collapse" class="accordion-toggle">
					 '.get_the_title().'
					</a>
				  </h4>
				</div>
				<div class="panel-collapse collapse " id="'.get_the_ID().'" style="height: auto;">
				  <div class="panel-body">
				   <p>'.get_the_content().'</p>
				  </div>
				</div>
			</div>
			<!-- Accordion One End -->
			';        
endwhile;
$list.= '</div></div></div>';
wp_reset_query();
return $list;
}
add_shortcode('ultimate_accordion_style_2', 'ultimate_accordion_two');	

/*--------------------------------------------------------
 *Shortcode for ultimate accordion Style Three
 ---------------------------------------------------------*/
 function ultimate_accordion_three($atts){
	extract( shortcode_atts( array(
		'bootstrap_columns' => '6',
		'shownumberpost' => '3',
		'category' => '',
	), $atts, 'ultimate_accordion_style_3' ) );
	
    $q = new WP_Query(
        array( 'accordion_cat' => $category, 'posts_per_page' => $shownumberpost, 'post_type' => 'accordion-item')
        );
$list = '<div class="col-lg-'.$bootstrap_columns.' col-md-'.$bootstrap_columns.' col-sm-'.$bootstrap_columns.' col-xs-12"><div class="accordionStyle-three"><div id="accordion" class="panel-group">';
while($q->have_posts()) : $q->the_post();
    //get the ID of your post in the loop
    $id = get_the_ID(); 
	$list .= '
			<!-- Accordion One Start -->
			<div class="panel panel-default">
				<div class="panel-heading">
				  <h4 class="panel-title">
					<a aria-controls="'.get_the_ID().'" aria-expanded="true" href="#'.get_the_ID().'" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle">
					 '.get_the_title().'
					</a>
				  </h4>
				</div>
				<div class="panel-collapse collapse " id="'.get_the_ID().'" style="height: auto;">
				  <div class="panel-body">
				   <p>'.get_the_content().'</p>
				  </div>
				</div>
			</div>
			<!-- Accordion One End -->
			';        
endwhile;
$list.= '</div></div></div>';
wp_reset_query();
return $list;
}
add_shortcode('ultimate_accordion_style_3', 'ultimate_accordion_three');	

/*--------------------------------------------------------
 *Shortcode for ultimate accordion Style Four
 ---------------------------------------------------------*/
 function ultimate_accordion_four($atts){
	extract( shortcode_atts( array(
		'bootstrap_columns' => '6',
		'shownumberpost' => '3',
		'category' => '',
	), $atts, 'ultimate_accordion_style_4' ) );
	
    $q = new WP_Query(
        array( 'accordion_cat' => $category, 'posts_per_page' => $shownumberpost, 'post_type' => 'accordion-item')
        );
$list = '<div class="col-lg-'.$bootstrap_columns.' col-md-'.$bootstrap_columns.' col-sm-'.$bootstrap_columns.' col-xs-12"><div class="accordionStyle-four"><div id="accordion" class="panel-group">';
while($q->have_posts()) : $q->the_post();
    //get the ID of your post in the loop
    $id = get_the_ID(); 
	$list .= '
			<!-- Accordion One Start -->
			<div class="panel panel-default">
				<div class="panel-heading">
				  <h4 class="panel-title">
					<a aria-controls="'.get_the_ID().'" aria-expanded="true" href="#'.get_the_ID().'" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle">
					 '.get_the_title().'
					</a>
				  </h4>
				</div>
				<div class="panel-collapse collapse " id="'.get_the_ID().'" style="height: auto;">
				  <div class="panel-body">
				   <p>'.get_the_content().'</p>
				  </div>
				</div>
			</div>
			<!-- Accordion One End -->
			';        
endwhile;
$list.= '</div></div></div>';
wp_reset_query();
return $list;
}
add_shortcode('ultimate_accordion_style_4', 'ultimate_accordion_four');

/*--------------------------------------------------------
 *Shortcode for ultimate accordion Style Five
 ---------------------------------------------------------*/
 function ultimate_accordion_five($atts){
	extract( shortcode_atts( array(
		'bootstrap_columns' => '6',
		'shownumberpost' => '3',
		'category' => '',
	), $atts, 'ultimate_accordion_style_5' ) );
	
    $q = new WP_Query(
        array( 'accordion_cat' => $category, 'posts_per_page' => $shownumberpost, 'post_type' => 'accordion-item')
        );
$list = '<div class="col-lg-'.$bootstrap_columns.' col-md-'.$bootstrap_columns.' col-sm-'.$bootstrap_columns.' col-xs-12"><div class="accordionStyle-five"><div id="accordionfive" class="panel-group">';
while($q->have_posts()) : $q->the_post();
    //get the ID of your post in the loop
    $id = get_the_ID(); 
	$list .= '
			<!-- Accordion One Start -->
			<div class="panel panel-default">
				<div class="panel-heading">
				  <h4 class="panel-title">
					<a aria-controls="'.get_the_ID().'" aria-expanded="true" href="#'.get_the_ID().'" data-parent="#accordionfive" data-toggle="collapse" class="accordion-toggle">
					<span><i class="fa fa-dot-circle-o"></i></span>
					 '.get_the_title().'
					</a>
				  </h4>
				</div>
				<div class="panel-collapse collapse " id="'.get_the_ID().'" style="height: auto;">
				  <div class="panel-body">
				   <p>'.get_the_content().'</p>
				  </div>
				</div>
			</div>
			<!-- Accordion One End -->
			';        
endwhile;
$list.= '</div></div></div>';
wp_reset_query();
return $list;
}
add_shortcode('ultimate_accordion_style_5', 'ultimate_accordion_five');	

/*--------------------------------------------------------
 *Shortcode for ultimate accordion Style Six
 ---------------------------------------------------------*/
 function ultimate_accordion_six($atts){
	extract( shortcode_atts( array(
		'bootstrap_columns' => '6',
		'shownumberpost' => '3',
		'category' => '',
	), $atts, 'ultimate_accordion_style_6' ) );
	
    $q = new WP_Query(
        array( 'accordion_cat' => $category, 'posts_per_page' => $shownumberpost, 'post_type' => 'accordion-item')
        );
$list = '<div class="col-lg-'.$bootstrap_columns.' col-md-'.$bootstrap_columns.' col-sm-'.$bootstrap_columns.' col-xs-12"><div class="accordionStyle-six"><div id="accordionsix" class="panel-group">';
while($q->have_posts()) : $q->the_post();
    //get the ID of your post in the loop
    $id = get_the_ID(); 
	$list .= '
			<!-- Accordion One Start -->
			<div class="panel panel-default">
				<div class="panel-heading">
				  <h4 class="panel-title">
					<a aria-controls="'.get_the_ID().'" aria-expanded="true" href="#'.get_the_ID().'" data-parent="#accordionsix" data-toggle="collapse" class="accordion-toggle">
					 '.get_the_title().'
					</a>
				  </h4>
				</div>
				<div class="panel-collapse collapse " id="'.get_the_ID().'" style="height: auto;">
				  <div class="panel-body">
				   <p>'.get_the_content().'</p>
				  </div>
				</div>
			</div>
			<!-- Accordion One End -->
			';        
endwhile;
$list.= '</div></div></div>';
wp_reset_query();
return $list;
}
add_shortcode('ultimate_accordion_style_6', 'ultimate_accordion_six');	
/*--------------------------------------------------------
 *Shortcode for ultimate accordion Style Seven
 ---------------------------------------------------------*/
 function ultimate_accordion_seven($atts){
	extract( shortcode_atts( array(
		'bootstrap_columns' => '6',
		'shownumberpost' => '3',
		'category' => '',
	), $atts, 'ultimate_accordion_style_7' ) );
	
    $q = new WP_Query(
        array( 'accordion_cat' => $category, 'posts_per_page' => $shownumberpost, 'post_type' => 'accordion-item')
        );
$list = '<div class="col-lg-'.$bootstrap_columns.' col-md-'.$bootstrap_columns.' col-sm-'.$bootstrap_columns.' col-xs-12"><div class="accordionStyle-seven"><div id="accordionseven" class="panel-group">';
while($q->have_posts()) : $q->the_post();
    //get the ID of your post in the loop
    $id = get_the_ID(); 
	$list .= '
			<!-- Accordion One Start -->
			<div class="panel panel-default">
				<div class="panel-heading">
				  <h4 class="panel-title">
					<a aria-controls="'.get_the_ID().'" aria-expanded="true" href="#'.get_the_ID().'" data-parent="#accordionseven" data-toggle="collapse" class="accordion-toggle">
					<span><i class="fa fa-check-circle"></i></span>
					 '.get_the_title().'
					</a>
				  </h4>
				</div>
				<div class="panel-collapse collapse " id="'.get_the_ID().'" style="height: auto;">
				  <div class="panel-body">
				   <p>'.get_the_content().'</p>
				  </div>
				</div>
			</div>
			<!-- Accordion One End -->
			';        
endwhile;
$list.= '</div></div></div>';
wp_reset_query();
return $list;
}
add_shortcode('ultimate_accordion_style_7', 'ultimate_accordion_seven');	



?>