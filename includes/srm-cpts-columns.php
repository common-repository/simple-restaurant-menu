<?php 

/*

Column Titles

Custom Post Type:  srm_menu

*/

add_filter('manage_edit-srm_menu_columns', 'tasty_srm_menu_columns');
function tasty_srm_menu_columns($defaults) {

	unset($defaults['date']);
    $defaults['shortcode'] = __('Shortcode','srm-domain');
    return $defaults;

}

/* 

Column Titles

Custom Post Type:  srm_menu_item 

*/

add_filter( 'manage_edit-srm_menu_item_columns', 'tasty_srm_menu_item_columns' );
function tasty_srm_menu_item_columns( $defaults ) {

    unset($defaults['title']);
    unset($defaults['date']);

    $defaults['title'] = __('Title','srm-domain');
    $defaults['picture'] = __('Featured Image','srm-domain');
    $defaults['menu'] = __('Menu','srm-domain');
    $defaults['order'] = __('Iten Order','srm-domain');
    $defaults['date'] = __('Upload Date','srm-domain');

    return $defaults;

}


 
/* 

Custom Post Type:   srm_menu

Create the shortcode for the srm-menu 

*/

add_action('manage_srm_menu_posts_custom_column', 'tasty_srm_menu_column', 10, 2);
function tasty_srm_menu_column($column_name, $post_ID ) {
    if ($column_name == 'shortcode') {
        $shortcode_id = tasty_srm_get_shortcode_id( $post_ID );
        if ($shortcode_id) {
            echo '<input type="text" onfocus="this.select();" readonly="readonly" value="[simple-menu id=' . $shortcode_id . ']" class="code">';
        }
    }
}



/* 

Return the post id 

*/

function tasty_srm_get_shortcode_id( $post_ID ) {

    $the_post = get_post();
    $shortcode_id = $the_post->ID;
    return $shortcode_id;

}


/* 

Custom Post Type:   srm_menu_item

- Get the categorized menu
- Get the featured image
- Get the order

*/

add_image_size( 'tasty-column-picture', 80, 80, true );
add_action('manage_srm_menu_item_posts_custom_column', 'tasty_srm_menu_item_column', 10, 2);
function tasty_srm_menu_item_column($column_name, $post_ID ) {

    switch ($column_name) {
        
        case 'menu':
        
            $menu = tasty_srm_get_the_menu( $post_ID );
            if( $menu ) { 
                echo $menu; 
            }
        
        break;

        case 'picture':
            # code...

            $post_featured_image = tasty_srm_get_the_featured_image($post_ID);
            if ($post_featured_image) {
                echo '<img src="' . $post_featured_image . '" alt="Featured Image" width="80" height="80" />';
            }

        break;

        case 'order':

            $order = tasty_srm_get_the_order( $post_ID );
            if( $order ) {

                echo $order;
            }

        break;
        
    }

}


/* 

Get the featured image 

*/

function tasty_srm_get_the_featured_image( $post_ID ) {

    $post_thumbnail_id = get_post_thumbnail_id($post_ID);

    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'tasty-column-picture');
        return $post_thumbnail_img[0];
    }

}



/* 

Return the selected menu 

*/

function tasty_srm_get_the_menu( $post_ID ) {

    $menu_id = get_post_meta( get_the_ID(), 'srm_menu_item_id_meta', true );

    if ( $menu_id ) {

        $the_post = get_post( $menu_id );
        $menu_name = $the_post->post_title;
        return $menu_name;

    } else {

        $menu_name = __('<strong>No menu was selected</strong>','srm-domain');
        return $menu_name;

    }

}


/* 

Return the order

*/

function tasty_srm_get_the_order( $post_ID ) {

    $meta = get_post_meta( get_the_ID(), 'srm_menu_item_order_meta', true );

    if ( $meta ) {

        $menu_order = $meta;
        return $menu_order;

    } else {

        $menu_order = '';
        return $menu_order;

    }

}


/* 

Make the Menu Column Sortable 

*/


add_filter('manage_edit-srm_menu_item_sortable_columns', 'tasty_srm_sort_srm_menu_item');
function tasty_srm_sort_srm_menu_item($columns) {

    $columns['menu'] = __('Menu','srm-domain');
    return $columns;
}


