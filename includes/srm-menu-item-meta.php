<?php 


/* 

Adds a metabox to the Menu Item custom post type

*/

add_action( 'add_meta_boxes_srm_menu_item', 'tasty_srm_menu_item_add_meta_box' );
function tasty_srm_menu_item_add_meta_box( $post ){
	add_meta_box( 
		'srm_menu_item_options', 
		__( 'Menu Item Details', 'srm-domain' ), 
		'tasty_srm_menu_item_meta_box_build', 
		'srm_menu_item', 
		'side'
	);
}




/* 

Build srm_price_meta_box_build()

*/

function tasty_srm_menu_item_meta_box_build( $post ) {

	// Nonce
	wp_nonce_field( basename( __FILE__ ), 'tasty_srm_menu_item_nonce' );

	// Price meta
	$menu_item_pice = get_post_meta( $post->ID, 'srm_menu_item_price_meta', true);

	// Menu ID meta
	$menu_item_id = get_post_meta($post->ID, 'srm_menu_item_id_meta', true );

	// Menu Order meta
	$menu_item_order = get_post_meta($post->ID, 'srm_menu_item_order_meta', true );

	?>
	<div class='inside'>

		<p>
			<label for="srm-menu-item-price"><?php echo __( 'Item price', 'srm-domain' ); ?></label>
		</p>
		<p>
			<input type="text" name="srm_menu_item_price" value="<?php echo $menu_item_pice; ?>" id="srm-menu-item-price" /> 
		</p>


	</div>


	<div class='inside'>

		<p>
			<label for="srm-menu-item-id"><?php echo __( 'Categorize the menu item', 'srm-domain' ); ?></label>
		</p>
		<p>
		<?php

		echo "<select name='srm_menu_item_id' id='srm-menu-item-id'>";
		echo '<option value="">' . __('-- Selet a Menu --', 'srm-domain') . '</option>';

		// Query the menus 
	    $query = new WP_Query( 
	    	array( 'post_type' => 'srm_menu',  'posts_per_page' => -1 )
	    );

	    while ( $query->have_posts() ) {

	        $query->the_post();
	    
	        $id = get_the_ID();

	        $selected = "";
	        if($id == $menu_item_id){
	            $selected = ' selected="selected"';
	        }
	    
	        echo '<option' . $selected . ' value=' . $id . '>' . get_the_title() . '</option>';
	    
	    }

		echo "</select>";

		?>
		</p>


	</div>


	<div class='inside'>

		<p>
			<label for="srm-menu-item-order"><?php echo __( 'Item order', 'srm-domain' ); ?></label>
		</p>
		<p>
			<input type="number" name="srm_menu_item_order" value="<?php echo $menu_item_order; ?>" id="srm-menu-item-order" /> 
		</p>


	</div>



<?php }


/*

Save Custom Post Type (srm_menu_item) Meta

*/

add_action( 'save_post_srm_menu_item', 'tasty_srm_menu_item_save_meta_boxes_data' );
function tasty_srm_menu_item_save_meta_boxes_data( $post_id ){

	// verify nonce 
	if ( !isset( $_POST['tasty_srm_menu_item_nonce'] ) || !wp_verify_nonce( $_POST['tasty_srm_menu_item_nonce'], basename( __FILE__ ) ) ){
		return;
	}

	// return if autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
		return;
	}

	// Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ){
		return;
	}


	// Price meta 
	if( isset( $_POST['srm_menu_item_price'] ) ){

		$price = sanitize_text_field( $_POST['srm_menu_item_price'] );
		update_post_meta( $post_id, 'srm_menu_item_price_meta', $price );

	}else{
		
		delete_post_meta( $post_id, 'srm_menu_item_price_meta' );
	}


	// Menu ID meta
	if ( isset( $_POST['srm_menu_item_id'] ) ) {

		$parent_menu = $_POST['srm_menu_item_id'];
		update_post_meta( $post_id, 'srm_menu_item_id_meta', $parent_menu);

	}else{
		
		delete_post_meta( $post_id, 'srm_menu_item_id_meta' );
	}


	// Order meta
	if ( isset( $_POST['srm_menu_item_order'] ) ) {

		$parent_menu = $_POST['srm_menu_item_order'];
		update_post_meta( $post_id, 'srm_menu_item_order_meta', $parent_menu);
		
	}else{
		
		delete_post_meta( $post_id, 'srm_menu_item_order_meta' );
	}


}
