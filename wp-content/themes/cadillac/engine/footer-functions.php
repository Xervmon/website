<?php 
/* get website title */
if(!function_exists("nvr_footer_text")){
	function nvr_footer_text(){
		
		$nvr_shortname = THE_SHORTNAME;
		
		$nvr_foot= stripslashes(nvr_get_option( $nvr_shortname . '_footer'));
		if($nvr_foot==""){
		
			_e('Copyright', THE_LANG ); echo ' &copy;';
			global $wpdb;
			$nvr_post_datetimes = $wpdb->get_results("SELECT YEAR(min(post_date_gmt)) AS firstyear, YEAR(max(post_date_gmt)) AS lastyear FROM $wpdb->posts WHERE post_date_gmt > 1970");
			if ($nvr_post_datetimes) {
				$nvr_firstpost_year = $nvr_post_datetimes[0]->firstyear;
				$nvr_lastpost_year = $nvr_post_datetimes[0]->lastyear;
	
				$nvr_copyright = $nvr_firstpost_year;
				if($nvr_firstpost_year != $nvr_lastpost_year) {
					$nvr_copyright .= '-'. $nvr_lastpost_year;
				}
				$nvr_copyright .= ' ';
	
				echo $nvr_copyright;
				echo '<a href="'.home_url( '/').'">'.get_bloginfo('name') .'.</a>';
			}
			?> 
        <?php 
		}else{
        	echo $nvr_foot;
        }
		
	}/* end nvr_footer_text() */
}

if(!function_exists('nvr_output_footertext')){
	function nvr_output_footertext(){
		echo '<div class="copyright">';
			nvr_footer_text();
		echo '</div>';
	}
	add_action('nvr_output_footerarea','nvr_output_footertext',5);
	
}

if (!function_exists('nvr_socialicon')){
	function nvr_socialicon(){
		
		$nvr_shortname = THE_SHORTNAME;
		$nvr_optSocialIcons = nvr_fontsocialicon();
		
		$nvr_outputli = "";
		foreach($nvr_optSocialIcons as $nvr_optSocialIcon => $nvr_optSocialText){
			$nvr_sociallink = nvr_get_option( $nvr_shortname . '_socialicon_'.$nvr_optSocialIcon, "" );
			if(isset($nvr_sociallink) && $nvr_sociallink!=''){
				$nvr_outputli .= '<li><a href="'.$nvr_sociallink.'" class="fa '.$nvr_optSocialIcon.'"></a></li>'."\n";
			}
		}
		$nvr_output = "";
		if($nvr_outputli!=""){
			$nvr_output .= '<ul class="sn">';
			$nvr_output .= $nvr_outputli;
			$nvr_output .= '</ul>';
		}
		return $nvr_output;
	}
}//end if(!function_exists('nvr_get_socialicon'))

if(!function_exists('nvr_output_socialicon')){
	function nvr_output_socialicon(){
		/*=====SOCIALICON======*/
		$nvr_socialiconoutput = nvr_socialicon();
		if($nvr_socialiconoutput!=''){				
			// get the social network icon
			echo '<div class="footericon">'. $nvr_socialiconoutput .'</div>';
		}
	}
	add_action('nvr_output_footerarea','nvr_output_socialicon',8);
	
}

if(!function_exists('nvr_tracking_code')){
	function nvr_tracking_code(){
		$nvr_shortname = THE_SHORTNAME;
		$nvr_trackingcode = stripslashes(nvr_get_option( $nvr_shortname . '_trackingcode'));
		if($nvr_trackingcode!=""){
			echo '<script type="text/javascript">';
			echo $nvr_trackingcode;
			echo '</script>';
		}
	}
	add_action('nvr_wp_footer','nvr_tracking_code',8);
	
}

if(!function_exists("nvr_wp_footer")){
	function nvr_wp_footer(){
		do_action("nvr_wp_footer");
	}
	add_action('wp_head', 'nvr_wp_footer', 100);
}

function redirect_to_function($redirect_to, $request, $user)
{
return 'http://www.xervmon.com/thank-you-for-registration/';

}
add_filter( 'login_redirect', 'redirect_to_function', 10, 3 );
