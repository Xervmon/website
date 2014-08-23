<?php
$nvr_sliderarrange = nvr_get_option( THE_SHORTNAME . '_slider_arrange');
$nvr_sliderDisableText = nvr_get_option( THE_SHORTNAME . '_slider_disable_text');

$nvr_prefix = 'nvr_';
$nvr_pid = nvr_get_postid();
$nvr_custom = nvr_get_customdata($nvr_pid);
$nvr_cf_sliderCategory 	= (isset($nvr_custom["slider_category"][0]))? $nvr_custom["slider_category"][0] : "";
$nvr_cf_sliderLayer		= (isset($nvr_custom["slider_layerslider"][0]))? $nvr_custom["slider_layerslider"][0] : "";
?>
<!-- SLIDER -->
<div id="outerslider">
	<?php if($nvr_cf_sliderLayer==''){ ?>
    <div id="slidercontainer" class="container">
        <section id="slider" class="row">
            <div id="slideritems" class="flexslider preloader twelve columns">
                <ul class="slides">
                    <?php
                    $nvr_catSlider = get_term_by('slug', $nvr_cf_sliderCategory, "slidercat");
                    if($nvr_cf_sliderCategory!=""){
                        $nvr_catSliderInclude = '&slidercat='. $nvr_catSlider->slug ;
                    }
                    
                    query_posts('post_type=slider-view'.$nvr_catSliderInclude.'&post_status=publish&showposts=-1&order=' . $nvr_sliderarrange);
                    while ( have_posts() ) : the_post();
                    
                    $nvr_prefix = 'if_';
                    $nvr_custom = get_post_custom( get_the_ID() );
                    $nvr_thumbid = get_post_thumbnail_id( get_the_ID() );
                    $nvr_slidersrc = wp_get_attachment_image_src( $nvr_thumbid, 'full' );

                    $nvr_cf_slideurl = (isset($nvr_custom["external_link"][0]))?$nvr_custom["external_link"][0] : "";
                    $nvr_cf_thumb = (isset($nvr_custom["image_url"][0]))? $nvr_custom["image_url"][0] : "";
					$nvr_cf_talign = (isset($nvr_custom["text_align"][0]))? $nvr_custom["text_align"][0] : "";
                    
                    $nvr_output = $nvr_style ="";
                    $nvr_output .='<li style="'.$nvr_style.'">';
                        if($nvr_cf_slideurl!=""){
                            $nvr_output .= '<a href="'.$nvr_cf_slideurl.'">';
                        }
                       
                        //slider images
                        if(has_post_thumbnail( get_the_ID()) || $nvr_cf_thumb!=""){
                            if($nvr_cf_thumb!=""){
                                $nvr_output .= '<img src="'.$nvr_cf_thumb.'" alt="" />';
                            }else{
                                $nvr_output .= get_the_post_thumbnail(get_the_ID(),'full');
                            }
                        }
                            
                        if($nvr_cf_slideurl!=""){
                            $nvr_output .= '</a>';
                        }
                        
                       //slider text
                       if($nvr_sliderDisableText!=true){
					   		if($nvr_cf_talign=="left"){
								$nvr_talign = "left";
							}elseif($nvr_cf_talign=="right"){
								$nvr_talign = "right";
							}else{
								$nvr_talign = "top";
							}
                           $nvr_output .='<div class="flex-caption">';
						   	$nvr_output .='<div class="text-caption '.$nvr_talign.'">';
						   		$nvr_output .='<div class="caption-content">';
						   if($nvr_cf_slideurl!=""){
                               $nvr_output .='<h2><a href="'.$nvr_cf_slideurl.'">'.get_the_title().'</a></h2>';
                           }else{
                               $nvr_output .='<h2>'.get_the_title().'</h2>';
                           }
						   
                           if($nvr_cf_slideurl!=""){
                               $nvr_output .='<div><a href="'.$nvr_cf_slideurl.'">'.get_the_excerpt().'</a></div>';
							   $nvr_output .='<a class="sliderbutton" href="'.$nvr_cf_slideurl.'"><span>'.__( 'Order Now', THE_LANG ).'</span></a>';
                           }else{
                               $nvr_output .='<div>'.get_the_excerpt().'</div>';
                           }
						   
						   		$nvr_output .='</div>';
								$nvr_output .='<div class="clearfix"></div>';
							$nvr_output .='</div>';
                           $nvr_output .='</div>';
                       }
                        
                    $nvr_output .='</li>';
                    
                    echo $nvr_output;
                    
                    endwhile;
                    wp_reset_query();
                    ?>
                </ul>
            </div>
            <div class="clearfix"></div>
        </section>
        <div class="clearfix"></div>
    </div>
    <?php }else{ ?>
		<?php 
        if($nvr_cf_sliderLayer!=""){
            echo do_shortcode($nvr_cf_sliderLayer);
        }
        ?>
    <?php } ?>
</div>
<!-- END SLIDER -->