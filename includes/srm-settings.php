<?php


// Register 
add_action( 'admin_menu', 'tasty_srm_admin_menu' );
function tasty_srm_admin_menu() {
	
	add_menu_page( 
		__('Menus','srm-domain'), 
		__('Menus','srm-domain'), 
		'manage_options', 
		'edit.php?post_type=srm_menu', 
		'',
		'dashicons-welcome-write-blog', 
		3  
	);

	add_submenu_page( 
		'edit.php?post_type=srm_menu', 
		__('Menu Items','srm-domain'), 
		__('Menu Items','srm-domain'),
		'manage_options', 
		'edit.php?post_type=srm_menu_item', 
		'' 
	);

	add_submenu_page( 
		'edit.php?post_type=srm_menu', 
		__('Settings','srm-domain'),
		__('Settings','srm-domain'), 
		'manage_options', 
		'srm_setting.php', 
		'tasty_srm_settings_page'
	);

}

// Register Settings
add_action( 'admin_init' , 'tasty_srm_register_settings' );
function tasty_srm_register_settings() {

	register_setting( 'srm_settings_group', 'srm_settings' );

}


function tasty_srm_settings_page()  { 

// declare a global variable to save the settings
global $srm_options;

?>
<div class="wrap">

	<h2><?php echo __('Simple Restaurant Menu Settings', 'srm-domain' ); ?></h2>

	<form method="post" action="options.php">

	<?php settings_fields('srm_settings_group'); ?>

	<table class="form-table">
		<tbody>

			<tr>
				<th><h3><u><?php echo __( 'Currency Options', 'srm-domain'); ?></u></h3></th>
			</tr>

			<tr>
				<th scope="row"><label for="srm_settings[currency]"><?php echo __( 'Currency symbol', 'srm-domain'); ?></label></th>
				<td><input type="text" name="srm_settings[currency]" id="srm_settings[currency]" value="<?php echo $srm_options['currency']; ?>"  />
					<p><i><?php echo __( 'Enter the currency symbol you would like to display in your menu.', 'srm-domain'); ?></i></p>
				</td>
			</tr>

			<tr>
				<th><h3><u><?php echo __( 'Styling Options', 'srm-domain'); ?></u></h3></th>
			</tr>

			<tr>
				<th scope="row"><label for="srm_settings[css]"><?php echo __( 'Disable CSS ?', 'srm-domain'); ?></label></th>
				<td><input type="checkbox" name="srm_settings[css]" id="srm_settings[css]" value="1" <?php checked('1', $srm_options['css']); ?>/>
					<p><i><?php echo __( "Click this option to disable the plugin's CSS.", 'srm-domain'); ?></i></p>
				</td>
			</tr>

			<tr>
				<th scope="row"><label for="srm_settings[custom-css]"><?php echo __( 'Custom CSS', 'srm-domain'); ?></label></th>
				<td><textarea name="srm_settings[custom-css]" id="srm_settings[custom-css]" rows="4" cols="50"><?php echo $srm_options['custom-css']; ?></textarea>
					<p><i><?php echo __( "Enter your custom CSS here <strong>(Optional)</strong>", 'srm-domain'); ?></p>
				</td>
			</tr>

			<tr>
				<th><h3><u><?php echo __( 'Image Options', 'srm-domain'); ?></u></h3></th>
			</tr>

			<tr>
				<th scope="row"><label for="srm_settings[images]"><?php echo __('Disable thumbnail images ?', 'srm-domain'); ?></label></th>
				<td><input type="checkbox" name="srm_settings[images]" id="srm_settings[images]" value="1" <?php checked('1', $srm_options['images']); ?>/>
					<p><i><?php echo __('Click this option to disable thumbnail pictures for your menu items.', 'srm-domain'); ?></i></p>
				</td>
			</tr>

			<tr>
				<th scope="row"><label for="srm_settings[images-pop-ups]"><?php echo __('Disable image pop-ups ?', 'srm-domain'); ?></label></th>
				<td><input type="checkbox" name="srm_settings[images-pop-ups]" id="srm_settings[images-pop-ups]" value="1" <?php checked('1', $srm_options['images-pop-ups']); ?>/>
					<p><i><?php echo __('Click this option to disable image pop-ups for your menu items.', 'srm-domain'); ?></i></p>
				</td>
			</tr>

			<tr>
				<th scope="row"><label for="srm_settings[images-width]"><?php echo __('Menu item image width', 'srm-domain'); ?></label></th>
				<td><input type="number" name="srm_settings[images-width]" id="srm_settings[images-width]" value="<?php echo $srm_options['images-width']; ?>"  />
					<p><i><?php echo __('The width in pixels of menu item thumbnails. Leave this field empty to preserve the default thumbnail size.  Requires width and height to be set.', 'srm-domain'); ?></i></p>

				</td>
			</tr>

			<tr>
				<th scope="row"><label for="srm_settings[images-height]"><?php echo __('Menu item image height', 'srm-domain'); ?></label></th>
				<td><input type="number" name="srm_settings[images-height]" id="srm_settings[images-height]" value="<?php echo $srm_options['images-height']; ?>"  />
					<p><i><?php echo __('The height in pixels of menu item thumbnails. Leave this field empty to preserve the default thumbnail size.  Requires width and height to be set.', 'srm-domain'); ?></i></p>
				</td>
			</tr>


		</tbody>
	</table>

	<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php echo __('Save Changes', 'srm-domain'); ?>" /></p>

	</form>


</div>

<?php  }


	





