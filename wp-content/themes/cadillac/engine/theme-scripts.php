<?php
function nvr_script() {
	if (!is_admin()) {

		wp_enqueue_script('jquery');
		
		$nvr_shortname = THE_SHORTNAME;
		$nvr_siteurl = THE_SITEURL;
		$nvr_adminurl = THE_ADMINURL;
		$nvr_themeurl = THE_STYLEURI;
		
		wp_register_script('jeasing', THE_JSURI .'jquery.easing.js', array('jquery'), '1.2', true);
		wp_enqueue_script('jeasing');
		
		wp_register_script('jcolor', THE_JSURI .'jquery.color.js', array('jquery'), '2.0', true);
		wp_enqueue_script('jcolor');
		
		wp_register_script('jcookie', THE_JSURI .'jquery.cookie.js', array('jquery'), '1.0', true);
		if(nvr_get_option( THE_SHORTNAME . '_enable_switcher') ){
			wp_enqueue_script('jcookie');
		}
		
		wp_register_script('modernizr', THE_JSURI .'modernizr.js', array('jquery'), '2.5.3');
		wp_enqueue_script('modernizr');
		
		wp_register_script('jappear', THE_JSURI .'appear.js', array('jquery'), '1.0', true);
		wp_enqueue_script('jappear');
		
		wp_register_script('jparallax', THE_JSURI .'jquery.parallax-1.1.3.js', array('jquery'), '1.1.3', true);
		wp_enqueue_script('jparallax');
		
		wp_register_script('jisotope', THE_JSURI .'jquery.isotope.min.js', array('jquery'), '1.0', true);
		wp_enqueue_script('jisotope');
		
		wp_register_script('jCountTo', THE_JSURI .'jquery.countTo.js', array('jquery'), '1.0', true);
		wp_enqueue_script('jCountTo');
		
		wp_register_script('infinite-scroll', THE_JSURI .'jquery.infinitescroll.js', array('jquery'), '2.0b2', true);
		wp_enqueue_script('infinite-scroll');
		
		wp_register_script('jprettyPhoto', THE_JSURI .'jquery.prettyPhoto.js', array('jquery'), '3.0', true);
		wp_enqueue_script('jprettyPhoto');
		
		wp_register_script('jsuperfish', THE_JSURI .'superfish.js', array('jquery'), '1.4.8', true);
		wp_enqueue_script('jsuperfish');
		
		wp_register_script('jsupersubs', THE_JSURI .'supersubs.js', array('jquery'), '0.2', true);
		wp_enqueue_script('jsupersubs');
		
		wp_register_script('jflexslider', THE_JSURI .'jquery.flexslider-min.js', array('jquery'), '1.8', true);
		wp_enqueue_script('jflexslider');
		
		wp_register_script('jgnmenu', THE_JSURI .'gnmenu.js', array('jquery'), '1.0.0', true);
		wp_enqueue_script('jgnmenu');
		
		wp_register_script('jretina', THE_JSURI .'retina.min.js', array('jquery'), '1.1.0', true);
		wp_enqueue_script('jretina');
		
		wp_register_script('jcustom', THE_JSURI .'custom.js', array('jquery'), '1.0', true);
		wp_enqueue_script('jcustom');
		
		$nvr_sliderEffect = nvr_get_option( $nvr_shortname . '_slider_effect' ,'fade'); 
		$nvr_sliderInterval = nvr_get_option( $nvr_shortname . '_slider_interval' ,600);
		$nvr_sliderDisableNav = nvr_get_option( $nvr_shortname . '_slider_disable_nav');
		$nvr_sliderDisablePrevNext = nvr_get_option( $nvr_shortname . '_slider_disable_prevnext');
		
		$nvr_domainFormLink = nvr_get_option( $nvr_shortname . '_domainform_link','');
		if(!$nvr_domainFormLink){
			$nvr_domainFormLink = $nvr_siteurl;
		}
		
		$nvr_interfeisvar = array( 
			'siteurl' 					=> $nvr_siteurl, 
			'adminurl' 					=> $nvr_adminurl,
			'themeurl'					=> $nvr_themeurl,
			'pfloadmore'				=> __('Loading More Portfolio', THE_LANG),
			'postloadmore'				=> __('Loading More Posts', THE_LANG),
			'loadfinish'				=> __('All Items are Loaded', THE_LANG),
			'slidereffect' 				=> $nvr_sliderEffect,
			'slider_interval' 			=> $nvr_sliderInterval,
			'slider_disable_nav' 		=> $nvr_sliderDisableNav,
			'slider_disable_prevnext' 	=> $nvr_sliderDisablePrevNext,
			'domainformlink'			=> $nvr_domainFormLink
		);
		wp_localize_script( 'jcustom', 'interfeis_var', $nvr_interfeisvar );
		
	}
}
add_action('wp_enqueue_scripts', 'nvr_script');
