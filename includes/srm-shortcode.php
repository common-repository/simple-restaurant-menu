<?php 

/* 

Register Shortcode

- Query srm-menu for the post with id equal to $atts['id']
- Get the posts from srm-menu-item with a _srm_menu_item_parent_menu meta value of $atts['id']

*/


add_shortcode('simple-menu', 'tasty_srm_shortcode');
function tasty_srm_shortcode($atts, $content = null){

	global $post;

	global $srm_options;

	// Create attributes and defaults
	$atts = shortcode_atts(array(
		'id' => ''
	), $atts);

	// Query Args
	$args = array(
		'post_type'			=> 'srm_menu',
		'post_status'		=> 'publish',
		'order'				=> 'DSC',
		'page_id' 			=> $atts['id']
	);

	// Fetch Todos
	$menu = new WP_Query($args);

	$output = '';


	// Start the loop
	if($menu->have_posts()){

		$output .= '<div class="srm-menu srm-clearfix" id="srm-menu-' . $atts['id'] . '">';

		while($menu->have_posts()) { 

			$menu->the_post();

			//  srm_menu meta

			$srm_menu_title = get_post_meta( get_the_ID(), 'srm_menu_title_meta', true );
			$srm_menu_layout = get_post_meta( get_the_ID(), 'srm_menu_columns_meta', true );


			if( !$srm_menu_title ) {

		 		$output .= '<div class="srm-menu-title">
		 				<h2>' . get_the_title() . '</h2>
		 				</div>';

		 	}

		 	$output .= '<div class="srm-menu-content">
		 				<p>' . get_the_content() . '</p>
		 				</div>';


			$menu_items = get_posts(array(
				'post_type' 		=> 'srm_menu_item',
				'orderby' 			=> 'meta_value_num',
              	'meta_key'			=> 'srm_menu_item_order_meta',
              	'order' 			=> 'ASC',
              	'posts_per_page'    => -1,
				'meta_query' 		=> array(
					array(
						'key' 		=> 'srm_menu_item_id_meta', 
						'value' 	=>  $atts['id'], 
						'compare' 	=> 'LIKE'
					)
				)
			));
			
			if( $menu_items ):  
			
			$output .= '<ul class="srm-clearfix srm-menu-items menu ' . $srm_menu_layout . '">';

			foreach( $menu_items as $menu_item ):

				$output .= '<li class="srm-clearfix srm-menu-item">';

				if( !$srm_options['images'] ) {

					if ( has_post_thumbnail( $menu_item->ID ) ) {

						$height = !empty($srm_options['images-height']) ? $srm_options['images-height'] : '';
						$width = !empty($srm_options['images-width']) ? $srm_options['images-width'] : '';


						if( !$srm_options['images'] && !$srm_options['images-pop-ups']) {

							$post_thumbnail_id = get_post_thumbnail_id( $menu_item->ID );
							$post_thumbnail_img_full = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );

							$output .= '<div class="srm-menu-item-image">';

							$output .= '<a data-lightbox="srm-gallery-' . $menu_item->srm_menu_item_id_meta . '" data-title="' . $menu_item->post_title . '" href="' . $post_thumbnail_img_full[0] . '">';

							

							if( !empty( $height)  &&  !empty($width) ) {

			        			$output .= get_the_post_thumbnail( $menu_item->ID, array( $height, $width ) );

			        		} else {

			        			$output .= get_the_post_thumbnail( $menu_item->ID, 'thumbnail' );

			        		}

			        		$output .= '</a>';


			        		$output .= '</div>';

							


						} else {

							$output .= '<div class="srm-menu-item-image">';
			        		
			        		if( !empty( $height)  &&  !empty($width) ) {

			        			$output .= get_the_post_thumbnail( $menu_item->ID, array( $height, $width ) );

			        		} else {

			        			$output .= get_the_post_thumbnail( $menu_item->ID, 'thumbnail' );

			        		}
			        		$output .= '</div>';

						}


		    		}

		    	}


				$output .= '<div class="srm-menu-item-text">';
				$output .= '<h4 class="srm-menu-item-title">' . $menu_item->post_title . '</h4>';
				$output .= '<span class="srm-menu-item-price">' .  $srm_options['currency'] . ' ' . $menu_item->srm_menu_item_price_meta . '</span>';
				$output .= '<p class="srm-menu-item-content">' . $menu_item->post_content . '</p>';
				$output .= '</div>';
									
				$output .= '</li>';

			endforeach; 

			$output .= '</ul>';

			endif; 

		 

		} 

		$output .= '</div>';
		 
		wp_reset_query();

	} else {

		return __('<p>Sorry, but the menu was not found.</p>', 'srm-domain' );
	
	}

	return $output;


}



