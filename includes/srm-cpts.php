<?php

/*

Register Custom Post Types:

- Menu (srm_menu)
- Menu Item (srm_menu_item)

*/


add_action( 'init', 'tasty_srm_register_cpts' );
function tasty_srm_register_cpts() {

	$labels = array(
		"name" => __( 'Menus', 'srm-domain' ),
		"singular_name" => __( 'Menu', 'srm-domain' ),
		"menu_name" => __( 'My Menu', 'srm-domain' ),
		"all_items" => __( 'All Menus', 'srm-domain' ),
		"add_new" => __( 'Add New Menu', 'srm-domain' ),
		"add_new_item" => __( 'Add New Menu', 'srm-domain' ),
		"edit_item" => __( 'Edit Menu', 'srm-domain' ),
		"new_item" => __( 'New Menu', 'srm-domain' ),
		"view_item" => __( 'View Menu', 'srm-domain' ),
		"search_items" => __( 'Search Menus', 'srm-domain' ),
	);

	$args = array(
		"label" => __( 'Menus', 'srm-domain' ),
		"labels" => $labels,
		"description" => "",
		"public" => false,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "srm_menu", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-welcome-write-blog",
		"supports" => array( "title", "editor" ),					
	);

	register_post_type( "srm_menu", $args );

	$labels = array(
		"name" => __( 'Menu Items', 'srm-domain' ),
		"singular_name" => __( 'Menu Item', 'srm-domain' ),
		"menu_name" => __( 'Menu Items', 'srm-domain' ),
		"all_items" => __( 'All Menu Items', 'srm-domain' ),
		"add_new" => __( 'Add New Menu Item', 'srm-domain' ),
		"add_new_item" => __( 'Add New Menu Item', 'srm-domain' ),
		"edit_item" => __( 'Edit Menu Item', 'srm-domain' ),
		"new_item" => __( 'New Menu Item', 'srm-domain' ),
		"view_item" => __( 'View Menu Item', 'srm-domain' ),
		"search_items" => __( 'Search Menu Items', 'srm-domain' ),
	);

	$args = array(
		"label" => __( 'Menu Items', 'srm-domain' ),
		"labels" => $labels,
		"description" => "",
		"public" => false,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "srm_menu_item", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-welcome-add-page",
		"supports" => array( "title", "editor", "thumbnail" ),					
	);
	
	register_post_type( "srm_menu_item", $args );


}
