<?php 


/* 

Adds a metabox to the Menu custom post type

*/

add_action( 'add_meta_boxes', 'tasty_srm_menu_meta_box' );
function tasty_srm_menu_meta_box( ){

	add_meta_box( 
		'srm_menu_options', 
		__( 'Menu Options', 'srm-domain' ), 
		'tasty_srm_menu_meta_box_build', 
		'srm_menu', 
		'side'
	);

}

function tasty_srm_menu_meta_box_build( $post ) {

	// Nonce
	wp_nonce_field( basename( __FILE__ ), 'srm_menu_options_nonce' );

	// Do we want to display the menu? 
	$menu_title = get_post_meta( $post->ID, 'srm_menu_title_meta', true);

	// Columns Options
	$menu_columns = get_post_meta($post->ID, 'srm_menu_columns_meta', true );

	?>


	<div class='inside'>

		<p>
			<label for="srm-menu-title"><?php echo __( 'Hide the title ?', 'srm-domain' ); ?></label>
		</p>
		<p>
			<input type="checkbox" name="srm_menu_title" id="srm-menu-title" value="1" <?php checked('1', $menu_title); ?> /> 
		</p>


	</div>


	<div class='inside'>

		<p>
			<label for="srm-menu-columns"><?php echo __( 'Column layout', 'srm-domain' ); ?></label>
		</p>
		<p>
		<?php

		$layout_options = array(
			__('one-column', 'srm-domain'),
			__('two-columns', 'srm-domain')
		);

		echo "<select name='srm_menu_columns' id='srm-menu-columns'>";
		echo '<option value="">' . __('-- Selet a Layout --', 'srm-domain') . '</option>';

		foreach ($layout_options as $layout_option) {

			if($menu_columns == $layout_option){
	            $selected = ' selected="selected"';
	        } else if( $menu_columns !== $layout_option ) {
	        	$selected = '';
	        }

	        echo '<option' . $selected . ' value=' . $layout_option . '>' . $layout_option . '</option>';

		}

		echo "</select>";

		?>
		</p>


	</div>

<?php

}
 
add_action( 'save_post_srm_menu', 'tasty_srm_menu_save_meta_box' );
function tasty_srm_menu_save_meta_box( $post_id ){

	// verify nonce
	if ( !isset( $_POST['srm_menu_options_nonce'] ) || !wp_verify_nonce( $_POST['srm_menu_options_nonce'], basename( __FILE__ ) ) ){
		return;
	}
	
	//* return if autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
		return;
	}

	// Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ){
		return;
	}


	// Title meta 
	if( isset( $_POST['srm_menu_title'] ) ){

		$show_title = $_POST['srm_menu_title'];
		update_post_meta( $post_id, 'srm_menu_title_meta', $show_title );

	}else{

		delete_post_meta( $post_id, 'srm_menu_title_meta' );
	}

	//  Columns meta
	if ( isset( $_POST['srm_menu_columns'] ) ) {

		$menu_columns = $_POST['srm_menu_columns'];
		update_post_meta( $post_id, 'srm_menu_columns_meta', $menu_columns);

	}else{

		delete_post_meta( $post_id, 'srm_menu_columns_meta' );
	}



}

 







 
