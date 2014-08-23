<?php
	/* Shortcode */
	add_shortcode('separator', 'nvr_separator');
	add_shortcode('spacer', 'if_spacer');
	add_shortcode('clearfix', 'nvr_clearfixfloat');
	
	/* -----------------------------------------------------------------
		Separator
	----------------------------------------------------------------- */
	function nvr_separator($atts, $content = null) {
		extract(shortcode_atts(array(
					"line" => '',
					'margin' => '30'
		), $atts));
		
		if($margin=="") $margin = '30';

		if($line==""){
		$nvr_output = '<div class="separator" style="padding:'.$margin.'px 0px"><div></div></div>';
		}else{
		$nvr_output = '<div class="clearfix"></div><div class="separator line" style="padding:'.$margin.'px 0px"><div></div></div>';
		}
		
		return do_shortcode($nvr_output);
		
	}
	
	/* -----------------------------------------------------------------
		Spacer
	----------------------------------------------------------------- */
	function if_spacer($atts, $content = null) {
		extract(shortcode_atts(array(
					"height" => '20px'
		), $atts));
		
		if($height=="") $height = '20px';
		
		$nvr_output = '<div class="spacer" style="height:'.$height.';"></div>';

		return do_shortcode($nvr_output);
		
	}
	
	/* -----------------------------------------------------------------
		Clearfix
	----------------------------------------------------------------- */
	function nvr_clearfixfloat($atts, $content = null) {
		$nvr_output = '<div class="clearfix"></div>';
		return do_shortcode($nvr_output);
		
	}
?>