jQuery(document).ready(function($){

	if( $('body[class*=" srm_"]').length || $('body[class*=" post-type-srm_"]').length ) {

		$slb_menu_li = $('#toplevel_page_edit-post_type-srm_menu');

		$slb_menu_li_a = $('#toplevel_page_edit-post_type-srm_menu').find('a.wp-has-submenu');

		$slb_menu_li_a.addClass('wp-has-current-submenu');
		
		$slb_menu_li
		.removeClass('wp-not-current-submenu')
		.addClass('wp-has-current-submenu')
		.addClass('wp-menu-open');
		
		$('a:nth-child(2)',$slb_menu_li)
		.removeClass('wp-not-current-submenu')
		.addClass('wp-has-submenu')
		.addClass('wp-has-current-submenu')
		.addClass('wp-menu-open');
		

	}

});


