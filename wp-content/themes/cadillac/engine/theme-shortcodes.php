<?php
$nvr_initial = THE_INITIAL;
$nvr_shortname = THE_SHORTNAME;

/******PORTFOLIO CAROUSEL******/
if(!function_exists('nvr_portfoliocarousel')){
	function nvr_portfoliocarousel($atts, $content = null) {
		extract(shortcode_atts(array(
					"title" => '',
					"cat" => '',
					"showposts" => '-1',
					"full" => 'yes',
					"link" => '',
					"linktext" => __('Show Portfolio', THE_LANG)
		), $atts));
			
			$nvr_pcclass = '';
			if($link!=''){
				$nvr_pcclass .= ' haslink';
			}
			if($linktext==''){
				$linktext = __('Show Portfolio', THE_LANG);
			}
			
			if($full=="yes"){
				$nvr_pcclass .= ' nvr-fullwidthwrap';
			}
			
			$nvr_output  ='<div class="pcarousel '.$nvr_pcclass.'">';
				
			$i=1;
			$nvr_argquery = array(
				'post_type' => 'portofolio',
				'showposts' => $showposts
			);
			if($cat){
				$nvr_argquery['tax_query'] = array(
					array(
						'taxonomy' => 'portfoliocat',
						'field' => 'slug',
						'terms' => $cat
					)
				);
			}
			query_posts($nvr_argquery);
			global $post;
			
			$nvr_output  .='<div class="flexslider-carousel row">';
				$nvr_output  .='<ul class="slides">';
				
				$havepost = false;
				while (have_posts()) : the_post();
					$havepost = true;
					$imgsize	= 'portfolio-image-square';
					$pimgsize 	='square';
					$classpf	= 'imgsize-'.$pimgsize.' ';
					$nvr_output .= nvr_pf_get_box( $imgsize, get_the_ID(), $classpf );
				
				 	$i++; $addclass=""; 
				
				endwhile; wp_reset_query();
				 
				$nvr_output .='</ul>';
			 $nvr_output .='</div>';
			 if($link!=''){
				$nvr_output .= '<a class="button color2 pclink" href="'.$link.'">'.$linktext.'</a>';	
			}
			 $nvr_output .='</div>';
			 if($havepost){
			 	return do_shortcode($nvr_output);
			}else{
				return false;
			}
	}
	
	add_shortcode( 'portfolio_carousel', 'nvr_portfoliocarousel' );
}

if(!function_exists('nvr_portfoliofilter')){
	function nvr_portfoliofilter($atts, $content = null){
		extract(shortcode_atts(array(
					"title" => '',
					"cat" => '',
					'type' => 'grid',
					'nospace' => '',
					"showposts" => '-1'
		), $atts));
		$cats = $cat;
		$showpost = $showposts;
		$orderby = "date";
		$ordersort = "DESC";
		$categories = explode(",",$cats);
	
		if($type!= 'grid' && $type!='classic' && $type!='masonry'){
			$type = 'grid';
		}
		$type.='-4';
		$arrtype = explode("-",$type);
		$ptype = $arrtype[0];
		if($nospace=="yes"){
			$pspace = 'nospace';
		}else{
			$pspace = 'space';
		}
		$column = intval($arrtype[1]);
		$freelayout = false;
		
		$approvedcats = array();
		foreach($categories as $category){
			$catname = get_term_by('slug',$category,"portfoliocat");
			if($catname!=false){
				$approvedcats[] = $catname;
			}
		}
		
		$catslugs = array();
		$nvr_outputfilter = '';
		if(count($approvedcats)>1){
			$nvr_outputfilter .= '<ul id="filters" class="option-set clearfix " data-option-key="filter">';
				$nvr_outputfilter .= '<li class="alpha selected"><a href="#filter" data-option-value="*">'. __('All Categories', THE_LANG ).'</a></li>';
				$filtersli = '';
				$numli = 1;
				foreach($approvedcats as $approvedcat){
					if($numli==1){
						$liclass = 'omega';
					}else{
						$liclass = '';
					}
					$filtersli = '<li class="'.$liclass.'"><a href="#filter" data-option-value=".'.$approvedcat->slug.'">'.$approvedcat->name.'</a></li>'.$filtersli;
					$catslugs[] = $approvedcat->slug;
					$numli++;
				}
				$nvr_outputfilter .= $filtersli;
			$nvr_outputfilter .= '</ul>';
			$hasfilter = true;
		}elseif(count($approvedcats)==1){
			$catslugs[] = $approvedcats[0]->slug;
			$hasfilter = false;
		}else{
			$hasfilter = false;
		}
	
		$idnum = 0;
	
		if($column!= 2 && $column!= 3 && $column!= 4 ){
			$column = 3;
		}
		$pfcontainercls = "nvr-pf-col-".$column;
		$pfcontainercls .= " ".$ptype;
		$pfcontainercls .= " ".$pspace;
		$imgsize = "portfolio-image";
		
		if($showpost==""){$showpost="-1";}
		
		$nvr_argquery = array(
			'post_type' => 'portofolio',
			'orderby' => $orderby,
			'order' => $ordersort
		);
		$nvr_argquery['showposts'] = $showpost;
		
		if(count($catslugs)>0){
			$nvr_argquery['tax_query'] = array(
				array(
					'taxonomy' => 'portfoliocat',
					'field' => 'slug',
					'terms' => $catslugs
				)
			);
		}
	
		query_posts($nvr_argquery); 
		global $post, $wp_query;
		
		$nvr_output = '<div class="portfolio_filter">';
			$nvr_output .= $nvr_outputfilter;
			$nvr_output .= '<div class="nvr-pf-container row">';
				$nvr_output .= '<ul id="nvr-pf-filter" class="'. $pfcontainercls .' isotope">';
			
				while ( have_posts() ) : the_post(); 
						
						$idnum++;
						if(!$freelayout){
							if($column=="2"){
								$classpf = 'six columns ';
							}elseif($column=="4"){
								$classpf = 'three columns ';
							}else{
								$classpf = 'four columns ';
							}
						}else{
							$classpf = 'free columns ';
						}
						
						if(($idnum%$column) == 1){ $classpf .= "first ";}
						if(($idnum%$column) == 0){$classpf .= "last ";}
						
						$custompf = get_post_custom( get_the_ID() );
						
						$pimgsize = '';
						if($ptype=='masonry'){
							$pimgsize = (isset($custompf["_".$nvr_initial."_pimgsize"][0]))? $custompf["_".$nvr_initial."_pimgsize"][0] : "";
							
							if($pimgsize=='square'){
								$imgsize = 'portfolio-image-square';
							}elseif($pimgsize=='portrait'){
								$imgsize = 'portfolio-image-portrait';
							}elseif($pimgsize=='landscape'){
								$imgsize = 'portfolio-image-landscape';
							}
							$classpf .= $pimgsize.' ';
						}elseif($ptype=='grid'){
							$imgsize = 'portfolio-image-square';
							$pimgsize='square';
						}
						$classpf .= 'imgsize-'.$pimgsize.' ';
						
						$thepfterms = get_the_terms( get_the_ID(), 'portfoliocat');
						
						$literms = "";
						if ( $thepfterms && ! is_wp_error( $thepfterms ) ){
			
							$approvedterms = array();
							foreach ( $thepfterms as $term ) {
								$approvedterms[] = $term->slug;
							}			
							$literms = implode( " ", $approvedterms );
						}
						
						$nvr_output .= nvr_pf_get_box( $imgsize, get_the_ID(), $classpf.' element '.$literms );
							
						$classpf=""; 
							
				endwhile; // End the loop. Whew.
	
				$nvr_output .= '<li class="pf-clear"></li>';
				$nvr_output .= '</ul>';
				$nvr_output .= '<div class="clearfix"></div>';
			$nvr_output .= '</div><!-- end #nvr-portfolio -->';
		$nvr_output .= '</div>';
		wp_reset_query();
		return $nvr_output;
	}
	add_shortcode( 'portfolio_filter', 'nvr_portfoliofilter' );
}

/******COUNTERS******/
if(!function_exists('nvr_counters')){
	function nvr_counters($atts, $content = null) {
		extract(shortcode_atts(array(
			'color' => '',
			'align' => '',
			'size' => '',
			'class' => ''
		), $atts));
		
		$style = '';
		if($color!=''){
			$style .= 'color:'.$color.';';
		}
		if($align!=''){
			$style .= 'text-align:'.$align.';';
		}
		if(is_numeric($size)){
			$style .= 'font-size:'.$size.'px;';
			$style .= 'width:'.$size.'px;';
			$style .= 'height:'.$size.'px;';
			$style .= 'line-height:'.$size.'px;';
		}
		$style = 'style="'.$style.'"';
		$nvr_output = '<div class="counters '.$class.'" '.$style.'>'.$content.'</div>';
		return do_shortcode($nvr_output);
	}
	add_shortcode( 'counters', 'nvr_counters' );
}

/******BANNER******/
if(!function_exists('nvr_bannerimg')){
	function nvr_bannerimg($atts, $content = null) {
		extract(shortcode_atts(array(
			'src' => '',
			'link' => '',
			'class' => ''
		), $atts));
		
		$nvr_output = '<div class="bannerimg"><a href="'.$link.'" class="linkrow"><div class="cellcontent">'.$content.'</div><img src="'.$src.'" alt="" /></a></div>';
		return do_shortcode($nvr_output);
	}
	add_shortcode( 'bannerimg', 'nvr_bannerimg' );
}

/******BIGTEXT******/
if(!function_exists('nvr_bigtext')){
	function nvr_bigtext($atts, $content = null) {
		extract(shortcode_atts(array(
		), $atts));
		$nvr_output = '<h2 class="bigtext"><span>'.$content.'</span></h2>';
		return do_shortcode($nvr_output);
	}
	add_shortcode( 'bigtext', 'nvr_bigtext' );
}
/******SECONDARYTEXT******/
if(!function_exists('nvr_secondarytext')){
	function nvr_secondarytext($atts, $content = null) {
		extract(shortcode_atts(array(
		), $atts));
		$nvr_output = '<span class="secondarytext">'.$content.'</span>';
		return do_shortcode($nvr_output);
	}
	add_shortcode( 'secondarytext', 'nvr_secondarytext' );
}

/******HEADING******/
if(!function_exists('nvr_heading')){
	function nvr_heading($atts, $content = null) {
		extract(shortcode_atts(array(
			'level' => '3',
			'align' => 'center',
			'class' => ''
		), $atts));
		
		$arrH = array('1','2','3','4','5','6');
		if(!in_array($level,$arrH)){
			$level = 3;
		}
		if($align!='center' || $align!='left' || $align!='right'){
			$align = 'center';
		}
		$nvr_output = '<div class="nvr-heading '.$class.' '.$align.'"><h'.$level.'><span>'.$content.'</span></h'.$level.'><span class="hborder"></span></div>';
		return do_shortcode($nvr_output);
	}
	add_shortcode( 'heading', 'nvr_heading' );
}

/******METER******/
if(!function_exists('nvr_meter')){
	function nvr_meter($atts, $content = null) {
		extract(shortcode_atts(array(
			'title' => 'Skills',
			'percent' => 100
		), $atts));
		
		if(!is_numeric($percent) || $percent > 100){
			$percent = 100;
		}
		
		$nvr_output = '';
		if($title!=''){
			$nvr_output .= '<h6 class="marginsmall">'.$title.'</h6>';
		}
		$nvr_output .= '<div class="meter"><div style="width:'.$percent.'%;"><span>'.$percent.'%</span></div></div>';
		return $nvr_output;
	}
	add_shortcode( 'meter', 'nvr_meter' );
}

/******SLIDER******/
if(!function_exists('nvr_sliders')){
	function nvr_sliders($atts, $content = null) {
		extract(shortcode_atts(array(
			'id' => '',
			'title' => '',
		), $atts));
		if($id!=""){
			$ids = 'id="'.$id.'" ';
		}else{
			$ids = '';
		}
		$nvr_output  = '<div '.$ids.' class="minisliders flexslider">';
		
		if($title!=""){
			$nvr_output  .='<div class="titlecontainer"><h2 class="contenttitle"><span>'.$title.'</span></h2></div>';
		}
		
		$nvr_output	.= '<ul class="slides">';
		$nvr_output	.= $content;
		$nvr_output	.= '</ul>';
		$nvr_output	.= '<div class="clearfix"></div>';
		$nvr_output .= '</div>';
		return do_shortcode($nvr_output);
	}
	add_shortcode( 'sliders', 'nvr_sliders' );
}
if(!function_exists('nvr_slide')){
	function nvr_slide($atts, $content = null) {
		extract(shortcode_atts(array(
			'id' 	=> '',
			'class'	=> ''
		), $atts));
		if($id!=""){
			$ids = 'id="'.$id.'" ';
		}else{
			$ids = '';
		}
		$classes = 'class="slide '.$class.'" ';
		
		$nvr_output  = '<li '.$ids.$classes.'>';
		$nvr_output	.= $content;
		$nvr_output	.= '</li>';
		return do_shortcode($nvr_output);
	}
	add_shortcode( 'slide', 'nvr_slide' );
}

if(!function_exists('nvr_people')){
	function nvr_people($atts, $content = null) {
		extract(shortcode_atts(array(
			'id' 	=> '',
			'class'	=> '',
			'col' => '3',
			'cat' => '',
			'showposts' => 3,
			'showtitle' => 'yes',
			'showinfo' => 'yes',
			'showthumb' => 'yes'
		), $atts));
		
		$nvr_initial = THE_INITIAL;
		$nvr_shortname = THE_SHORTNAME;
		
		$catname = get_term_by('slug', $cat, 'peoplecat');
		$showtitle = ($showtitle=='yes')? true : false;
		$showinfo = ($showinfo=='yes')? true : false;
		$showthumb = ($showthumb=='yes')? true : false;
		$showposts = (is_numeric($showposts))? $showposts : 5;
		
		if($col!='3' && $col!='4'){
			$col = '3';
		}
		
		if($col=='3'){
			$col = 3;
		}elseif($col=='4'){
			$col = 4;
		}else{
			$col = 3;
		}
		
		$imgsize = 'portfolio-image';
		
		$qryargs = array(
			'post_type' => 'peoplepost',
			'showposts' => $showposts
		);
		if($catname!=false){
			$qryargs['tax_query'] = array(
				array(
					'taxonomy' => 'peoplecat',
					'field' => 'slug',
					'terms' => $catname->slug
				)
			);
		}
		
		query_posts( $qryargs ); 
		global $post;
		
		$nvr_output = "";
		if( have_posts() ){
			$nvr_output .= '<div class="nvr-people '.$class.'">';
			$nvr_output .= '<ul class="row">';
			$i = 1;
			while ( have_posts() ) : the_post(); 
				
				if($col==3){
					$liclass = 'four columns';
				}elseif($col==4){
					$liclass = 'three columns';
				}else{
					$liclass = '';
				}
				
				$custom = get_post_custom($post->ID);
				$peopleinfo 	= (isset($custom['_'.$nvr_initial.'_people_info'][0]))? $custom['_'.$nvr_initial.'_people_info'][0] : "";
				$peoplethumb 	= (isset($custom['_'.$nvr_initial.'_people_thumb'][0]))? $custom['_'.$nvr_initial.'_people_thumb'][0] : "";
				$peoplepinterest= (isset($custom['_'.$nvr_initial.'_people_pinterest'][0]))? $custom['_'.$nvr_initial.'_people_pinterest'][0] : "";
				$peoplefacebook	= (isset($custom['_'.$nvr_initial.'_people_facebook'][0]))? $custom['_'.$nvr_initial.'_people_facebook'][0] : "";
				$peopletwitter 	= (isset($custom['_'.$nvr_initial.'_people_twitter'][0]))? $custom['_'.$nvr_initial.'_people_twitter'][0] : "";
				
				if($i%$col==1){
					$liclass .= ' alpha';
				}elseif($i%$col==0 && $col>1){
					$liclass .= ' last';
				}
				
				$nvr_output .= '<li class="'.$liclass.'">';
					$nvr_output .='<div class="peoplecontainer">';
						if($showthumb){
							$nvr_output .='<div class="imgcontainer">';
								if($peoplethumb){
									$nvr_output .= '<img src="'.$peoplethumb.'" alt="'.get_the_title( $post->ID ).'" title="'. get_the_title( $post->ID ) .'" class="scale-with-grid" />';
								}elseif( has_post_thumbnail( $post->ID ) ){
									$nvr_output .= get_the_post_thumbnail($post->ID, $imgsize, array('class' => 'scale-with-grid'));
								}else{
									$nvr_output .= '<img src="'.get_template_directory_uri().'/images/testi-user.png'.'" alt="'.get_the_title( $post->ID ).'" title="'. get_the_title( $post->ID ) .'" class="scale-with-grid" />';
								}
								$nvr_output .= '<div class="peoplesocial">';
									if($peoplefacebook){
										$nvr_output .= '<a href="'.$peoplefacebook.'" target="_blank" class="fa fa-facebook"></a>';
									}
									if($peopletwitter){
										$nvr_output .= '<a href="'.$peopletwitter.'" target="_blank" class="fa fa-twitter"></a>';
									}
									if($peoplepinterest){
										$nvr_output .= '<a href="'.$peoplepinterest.'" target="_blank" class="fa fa-pinterest"></a>';
									}
									$nvr_output .= '<div class="clearfix"></div>';
								$nvr_output .= '</div>';
								$nvr_output .= '<div class="clearfix"></div>';
							$nvr_output .='</div>';
							
							$bqclass="";
						}else{
							$bqclass="nomargin";
						}
				
						$nvr_output .= '<div class="peopletitle '.$bqclass.'">';
							if($showtitle || $showinfo){
								if($showtitle){
									$nvr_output .= '<h5 class="fontbold marginoff">'.get_the_title( $post->ID ).'</h5>';
								}
								if($peopleinfo){
									$nvr_output .= '<div class="peopleinfo">'.$peopleinfo.'</div>';
								}
							}
							$nvr_output .= '<div class="hborder"></div>';
							$nvr_output .= '<div class="clearfix"></div>';
						$nvr_output .= '</div>';
						$nvr_output .= '<div class="peoplecontent">';
							$nvr_output .= get_the_content();
						$nvr_output .= '</div>';
						$nvr_output .= '<div class="clearfix"></div>';
					$nvr_output .= '</div>';
				$nvr_output .= '</li>';
				
				$i++;
			endwhile;
				$nvr_output .= '<li class="clearfix"></li>';
			$nvr_output .= '</ul>';
			$nvr_output .= '<div class="clearfix"></div>';
			$nvr_output .= "</div>";
		}else{
			$nvr_output .= '<!-- no people post -->';
		}
		wp_reset_query();
		
		return do_shortcode($nvr_output);
	}
	add_shortcode( 'people', 'nvr_people' );
}

/* Recent Posts */
if( !function_exists('nvr_recentposts') ){
	function nvr_recentposts($atts, $content = null) {
		extract(shortcode_atts(array(
					"cat" => '',
					"showposts" => '-1',
					'limitchar' => 100
		), $atts));
			
			if($content){
				$content = nvr_content_formatter($content);
			}
			$nvr_output  ='<div class="nvr-recentposts">';
	
			$i=1;
			$nvr_argquery = array(
				'showposts' => $showposts
			);
			if($cat){
				$nvr_argquery['category_name'] = $cat;
			}
			query_posts($nvr_argquery);
			global $post;
			
			$nvr_output  .='<div class="rp-grid">';
				$nvr_output  .='<ul class="row">';
				
				$havepost = false;
				while (have_posts()) : the_post();
				$havepost = true;
				$excerpt = get_the_excerpt(); 
				$custom = get_post_custom( get_the_ID() );
				$cthumb = (isset($custom["carousel_thumb"][0]))? $custom["carousel_thumb"][0] : "";
				$cimgbig = (isset($custom["lightbox_img"][0]))? $custom["lightbox_img"][0] : "";
				
				$liclass = '';
				if($i%3==1){
					$liclass = ' alpha';
				}elseif($i%3==0){
					$liclass = ' last';
				}
				
				$nvr_output  .='<li class="four columns'.$liclass.'">';
					$nvr_output .= '<div class="rp-item-container">';
						if( has_post_thumbnail( get_the_ID() ) ){
							$nvr_output  .='<div class="nvr-rp-img">';
								$nvr_output  .='<a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_post_thumbnail( get_the_ID(), 'blog-post-image', array('class' => 'scale-with-grid')).'</a>';
							$nvr_output  .='</div>';
						}
						
						$nvr_output  .='<div class="nvr-rp-text">';
							$nvr_output  .='<h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
							$excerpt = nvr_string_limit_char( get_the_excerpt(), $limitchar );
							$nvr_output  .='<div>'.$excerpt.'</div>';
						$nvr_output .= '</div>';
						$nvr_output  .='<div class="entry-utility">';
							$nvr_output .= '<span class="meta-author"><i class="fa fa-user"></i>&nbsp; <a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ) .'">'. get_the_author().'</a></span>'; 
							$nvr_output .= '<span class="meta-date"><i class="fa fa-calendar"></i>&nbsp; '. get_the_time('M d, Y').'</span>';
							$nvr_output .= '<span class="meta-comment"><i class="fa fa-comments"></i>&nbsp; '.get_comments_number( get_the_ID() ). ' '.__('Comments', THE_LANG) .'</span>';
							$nvr_output  .='<div class="clearfix"></div>';
						$nvr_output  .='</div>';
					$nvr_output .= '</div>';
				$nvr_output  .='</li>';
				
				 $i++; $addclass=""; endwhile; wp_reset_query();
				 
				 $nvr_output .='</ul>';
			 $nvr_output .='</div>';
			 $nvr_output .='</div>';
			 if($havepost){
			 	return do_shortcode($nvr_output);
			}else{
				return false;
			}
	} 
	add_shortcode( 'recent_posts', 'nvr_recentposts' );
}

if(!function_exists('nvr_testimonial')){
	function nvr_testimonial($atts, $content = null) {
		
		$nvr_initial = THE_INITIAL;
		
		extract(shortcode_atts(array(
			'id' 	=> '',
			'class'	=> '',
			'col' => '1',
			'cat' => '',
			'showposts' => 5,
			'showtitle' => 'yes',
			'showinfo' => 'yes',
			'showthumb' => 'yes'
		), $atts));
		
		$catname = get_term_by('slug', $cat, 'testimonialcat');
		$showtitle = ($showtitle=='yes')? true : false;
		$showinfo = ($showinfo=='yes')? true : false;
		$showthumb = ($showthumb=='yes')? true : false;
		$showposts = (is_numeric($showposts))? $showposts : 5;
		
		if($col!='1' && $col!='2' && $col!='3'){
			$col = '1';
		}
		
		if($col=='3'){
			$col = 3;
		}elseif($col=='2'){
			$col = 2;
		}else{
			$col = 1;
		}
		
		$qryargs = array(
			'post_type' => 'testimonialpost',
			'showposts' => $showposts
		);
		if($catname!=false){
			$qryargs['tax_query'] = array(
				array(
					'taxonomy' => 'testimonialcat',
					'field' => 'slug',
					'terms' => $catname->slug
				)
			);
		}
		
		query_posts( $qryargs ); 
		global $post;
		
		$nvr_output = "";
		if( have_posts() ){
			$nvr_output .= '<div class="nvr-testimonial '.$class.'">';
			$nvr_output .= '<ul class="row">';
			$i = 1;
			while ( have_posts() ) : the_post(); 
				
				if($col==3){
					$liclass = 'four columns';
				}elseif($col==2){
					$liclass = 'six columns';
				}else{
					$liclass = '';
				}
				
				$custom = get_post_custom($post->ID);
				$testiinfo 	= (isset($custom["_".$nvr_initial."_testi_info"][0]))? $custom["_".$nvr_initial."_testi_info"][0] : "";
				$testithumb = (isset($custom["testi_thumb"][0]))? $custom["testi_thumb"][0] : "";
				
				if(($i%$col) == 1){
					$liclass .= " alpha";
				}elseif($i%$col==0 && $col>1){
					$liclass .= ' last';
				}
				
				$nvr_output .= '<li class="'.$liclass.'">';
				
				$bqclass = ($showthumb)? '' : 'nomargin';
				
				$nvr_output .= '<div class="testiwrapper">';
				
				if($showthumb){
					$nvr_output .='<div class="testiimg">';
					if($testithumb){
						$nvr_output .='<img src="'.$testithumb.'" width="50" height="50" alt="'.get_the_title( $post->ID ).'" title="'. get_the_title( $post->ID ) .'" class="scale-with-grid" />';
					}elseif( has_post_thumbnail( $post->ID ) ){
						$nvr_output .= get_the_post_thumbnail($post->ID, 'testimonial-thumb', array('class' => 'scale-with-grid'));
					}else{
						$nvr_output .='<img src="'.get_template_directory_uri().'/images/testi-user.png" width="50" height="50" alt="'.get_the_title( $post->ID ).'" title="'. get_the_title( $post->ID ) .'" class="scale-with-grid" />';
					}
					$nvr_output .='<span class="insetshadow"></span>';
					$nvr_output .='</div>';
				}
				
				if($showtitle || $showinfo){
					$nvr_output .= '<div class="testiinfo">';
					if($showtitle){
						$nvr_output .= '<h4 class="testititle">'.get_the_title( $post->ID ).'</h4>';
					}
					if($testiinfo){
						$nvr_output .= $testiinfo;
					}
					$nvr_output .= '</div>';
				}
				
				$nvr_output .= '<div class="clearfix"></div>';
				
				$nvr_output .= '<blockquote class="'.$bqclass.'">'.get_the_content().'<span class="arrowbubble"></span></blockquote>';
				
				$nvr_output .= '<div class="clearfix"></div>';
				
				$nvr_output .= '</div>';
				
				$nvr_output .= '</li>';
				
				$i++;
			endwhile;
			$nvr_output .= '<li class="clearfix"></li></ul>';
			$nvr_output .= '<div class="clearfix"></div>';
			$nvr_output .= "</div>";
		}else{
			$nvr_output .= '<!-- no testimonial post -->';
		}
		wp_reset_query();
		
		return do_shortcode($nvr_output);
	}
	add_shortcode( 'testimonial', 'nvr_testimonial' );
}

if(!function_exists('nvr_rotatingtestimonial')){
	function nvr_rotatingtestimonial($atts, $content = null) {
		
		$nvr_initial = THE_INITIAL;
		
		extract(shortcode_atts(array(
			'id' 	=> '',
			'class'	=> '',
			'cat' => '',
			'showposts' => 5,
			'showinfo' => 'yes',
			'showthumb' => 'yes'
		), $atts));
		
		$catname = get_term_by('slug', $cat, 'testimonialcat');
		$showinfo = ($showinfo=='yes')? true : false;
		$showthumb = ($showthumb=='yes')? true : false;
		$showposts = (is_numeric($showposts))? $showposts : 5;
		
		$qryargs = array(
			'post_type' => 'testimonialpost',
			'showposts' => $showposts
		);
		if($catname!=false){
			$qryargs['tax_query'] = array(
				array(
					'taxonomy' => 'testimonialcat',
					'field' => 'slug',
					'terms' => $catname->slug
				)
			);
		}
		
		query_posts( $qryargs ); 
		global $post;
		
		$nvr_output = '';
		if( have_posts() ){
			$nvr_output .= '<div class="nvr-trotating flexslider '.$class.'">';
				$nvr_output .= '<ul class="slides">';
					while ( have_posts() ) : the_post(); 
						$custom = get_post_custom($post->ID);
						$testiinfo 	= (isset($custom["_".$nvr_initial."_testi_info"][0]))? $custom["_".$nvr_initial."_testi_info"][0] : "";
						$testithumb = (isset($custom["testi_thumb"][0]))? $custom["testi_thumb"][0] : "";
						
						$nvr_output .= '<li>';
							$nvr_output .= '<blockquote>'.get_the_content().'<span class="arrowbubble"></span></blockquote>';
							$nvr_output .= '<div class="clearfix"></div>';
							
							$nvr_output .= '<div class="testiinfo">';
								$nvr_output .= '<span class="testititle">'.get_the_title( $post->ID ).'</span>';
								if($testiinfo){
									$nvr_output .= ' - '.$testiinfo;
								}
							$nvr_output .= '</div>';
							
							if($showthumb){
								$nvr_output .='<div class="testiimg">';
								if($testithumb){
									$nvr_output .='<img src="'.$testithumb.'" width="50" height="50" alt="'.get_the_title( $post->ID ).'" title="'. get_the_title( $post->ID ) .'" class="scale-with-grid" />';
								}elseif( has_post_thumbnail( $post->ID ) ){
									$nvr_output .= get_the_post_thumbnail($post->ID, 'testimonial-thumb', array('class' => 'scale-with-grid'));
								}else{
									$nvr_output .='<img src="'.get_template_directory_uri().'/images/testi-user.png" width="50" height="50" alt="'.get_the_title( $post->ID ).'" title="'. get_the_title( $post->ID ) .'" class="scale-with-grid" />';
								}
								$nvr_output .='<span class="insetshadow"></span>';
								$nvr_output .='</div>';
							}
							$nvr_output .= '<div class="clearfix"></div>';
						$nvr_output .= '</li>';
						
					endwhile;
				$nvr_output .= '</ul>';
				$nvr_output .= '<div class="clearfix"></div>';
			$nvr_output .= "</div>";
		}else{
			$nvr_output .= '<!-- no testimonial post -->';
		}
		wp_reset_query();
		
		return do_shortcode($nvr_output);
	}
	add_shortcode( 'testimonial360', 'nvr_rotatingtestimonial' );
}

if(!function_exists('nvr_featuredslider')){
	function nvr_featuredslider($atts, $content = null) {
		extract(shortcode_atts(array(
			'id' => '',
			'class' => 'minisliders',
			'moreproperties' => ''
		), $atts));
		
		global $post;
		
		if($id!=""){
			$ids = 'id="'.$id.'" ';
			$theid = $id;
		}else{
			$ids = 'id="'.$post->ID.'" ';
			$theid = $post->ID;
		}
		
		$qrychildren = array(
			'post_parent' => $theid,
			'post_status' => null,
			'post_type' => 'attachment',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'post_mime_type' => 'image'
		);

		$attachments = get_children( $qrychildren );
		$imgsize = "portfolio-image";
		$cf_thumb2 = array(); $cf_full2 = "";
		
		foreach ( $attachments as $att_id => $attachment ) {
			$getimage = wp_get_attachment_image_src($att_id, $imgsize, true);
			$portfolioimage = $getimage[0];
			$alttext = get_post_meta( $attachment->ID , '_wp_attachment_image_alt', true);
			$image_title = $attachment->post_title;
			$caption = $attachment->post_excerpt;
			$description = $attachment->post_content;
			$cf_thumb2[] ='<img src="'.$portfolioimage.'" alt="'.$alttext.'" title="'. $image_title .'" class="scale-with-grid" />';
			
			$getfullimage = wp_get_attachment_image_src($att_id, 'full', true);
			$fullimage = $getfullimage[0];
			
			$cf_full2 .='<li class="slide" id="'.$att_id.'"><img src="'.$fullimage.'" alt="'.$alttext.'" title="'. $image_title .'" /></li>';
		}
		
		$nvr_output  = '<div '.$ids.' class="'.$class.' flexslider" '.$moreproperties.'>';
		$nvr_output	.= '<ul class="slides">';
		$nvr_output	.= $cf_full2;
		$nvr_output	.= '</ul>';
		$nvr_output	.= '</div>';
		return $nvr_output;
	}
	add_shortcode( 'featuredslider', 'nvr_featuredslider' );
}

if(!function_exists('nvr_featuredgallery')){
	function nvr_featuredgallery($atts, $content = null) {
		extract(shortcode_atts(array(
			'id' => '',
			'class' => '',
			'column' => '4',
			'moreproperties' => ''
		), $atts));
		
		global $post;
		
		if($id!=""){
			$ids = 'id="'.$id.'" ';
			$theid = $id;
		}else{
			$ids = 'id="'.$post->ID.'" ';
			$theid = $post->ID;
		}
		
		$qrychildren = array(
			'post_parent' => $theid,
			'post_status' => null,
			'post_type' => 'attachment',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'post_mime_type' => 'image'
		);
		
		$column = intval($column);
		if($column!= 2 && $column!= 3 && $column!= 4 ){
			$column = 4;
		}

		$attachments = get_children( $qrychildren );
		
		$typecol = "nvr-pf-col-".$column;
		$imgsize = "portfolio-image";
		
		$lipf = "";
		$idnum = 0;
		foreach ( $attachments as $att_id => $attachment ) {
			$getimage = wp_get_attachment_image_src($att_id, $imgsize, true);
			$portfolioimage = $getimage[0];
			$alttext = get_post_meta( $attachment->ID , '_wp_attachment_image_alt', true);
			$image_title = $attachment->post_title;
			$caption = $attachment->post_excerpt;
			$description = $attachment->post_content;
			$cf_thumb ='<img src="'.$portfolioimage.'" alt="'.$alttext.'" title="'. $image_title .'" class="scale-with-grid" />';
			
			$getfullimage = wp_get_attachment_image_src($att_id, 'full', true);
			$fullimage = $getfullimage[0];
			
			if($column==2){
				$classpf = 'six columns ';
			}elseif($column==3){
				$classpf = 'four columns ';
			}else{
				$classpf = 'three columns ';
			}
			
			$rel = " ";

			if((($idnum+1)%$column) == 1){
				$classpf .= "alpha";
			}elseif((($idnum+1)%$column) == 0 && $idnum>0){
				$classpf .= "last";
			}else{
				$classpf .= "";
			}
			
			$lipf .='<li class="'.$classpf.'">';
			$lipf .='<div class="nvr-pf-img">';
				$lipf .='<a href="'.$fullimage.'" data-rel="prettyPhoto['.$theid.']" title="'.$image_title.'">'.$cf_thumb.'</a>';
			$lipf .='</div>';
			$lipf .='</li>';
			
			$idnum++;
		}
		
		$nvr_output  = '<div '.$ids.' class="row '.$class.' nvr-pf-container" '.$moreproperties.'>';
		$nvr_output	.= '<ul class="'.$typecol.'">';
		$nvr_output	.= $lipf;
		$nvr_output	.= '<li class="pf-clear"></li></ul>';
		$nvr_output	.= '</div>';
		return $nvr_output;
	}
	add_shortcode( 'featuredgallery', 'nvr_featuredgallery' );
}

/******BRAND CAROUSEL******/
if(!function_exists('nvr_brandcarousel')){
	function nvr_brandcarousel($atts, $content = null) {
		extract(shortcode_atts(array(
					"class" => '',
					"cat" => '',
					"showposts" => '-1'
		), $atts));
			
			if($content){
				$content = nvr_content_formatter($content);
			}

			$nvr_output  ='<div class="brand '.$class.'">';
			
			$i=1;
			$nvr_argquery = array(
				'post_type' => 'brand',
				'showposts' => $showposts
			);
			if($cat){
				$nvr_argquery['tax_query'] = array(
					array(
						'taxonomy' => 'brandcat',
						'field' => 'slug',
						'terms' => $cat
					)
				);
			}
			query_posts($nvr_argquery);
			global $post;
			
			$nvr_output  .='<div class="flexslider-carousel row">';
				$nvr_output  .='<ul class="slides">';
				
				$havepost = false;
				while (have_posts()) : the_post();
				$havepost = true;
				$excerpt = get_the_excerpt(); 
				$postid = get_the_ID();
				$custom = get_post_custom( $postid );
				$cthumb = (isset($custom["carousel_thumb"][0]))? $custom["carousel_thumb"][0] : "";
				$extlink = (isset($custom["external_link"][0]))? $custom["external_link"][0] : "";
				
				$thumbid = get_post_thumbnail_id( $postid );
				$alttext = get_post_meta($postid, '_wp_attachment_image_alt', true);
				$imagesrc = wp_get_attachment_image_src( $thumbid, 'brand-image' );
				
				if($cthumb!=""){
					$imagethumb = $cthumb;
					$alttext = get_the_title( $postid );
				}else{
					if($imagesrc!=false){
						$imagethumb = $imagesrc[0];
					}else{
						$imagethumb = get_template_directory_uri().'/images/noimage.png';
						$alttext = get_the_title( $postid );
					}
				}
				
				$nvr_output  .='<li>';
					$nvr_output .= '<div class="cr-item-container">';
						if($extlink){
							$nvr_output  .='<a href="'.$extlink.'" target="_blank"><img src="'.$imagethumb.'" alt="'.$alttext.'" /></a>';
						}else{
							$nvr_output  .='<img src="'.$imagethumb.'" alt="'.$alttext.'" />';
						}
					$nvr_output .= '</div>';
				$nvr_output  .='</li>';
				
				$i++; $addclass=""; endwhile; wp_reset_query();
				 
				$nvr_output .='</ul>';
			 $nvr_output .='</div>';
			 $nvr_output .='</div>';
			 if($havepost){
			 	return do_shortcode($nvr_output);
			}else{
				return false;
			}
	}
	
	add_shortcode( 'brand_carousel', 'nvr_brandcarousel' );
}

/******BRAND COLUMNS******/
if(!function_exists('nvr_brandcolumns')){
	function nvr_brandcolumns($atts, $content = null) {
		extract(shortcode_atts(array(
					"class" => '',
					"cat" => '',
					"col" => 4,
					"showposts" => '-1'
		), $atts));
			
			if($content){
				$content = nvr_content_formatter($content);
			}
			
			$i=1;
			$nvr_argquery = array(
				'post_type' => 'brand',
				'showposts' => $showposts
			);
			if($cat){
				$nvr_argquery['tax_query'] = array(
					array(
						'taxonomy' => 'brandcat',
						'field' => 'slug',
						'terms' => $cat
					)
				);
			}
			query_posts($nvr_argquery);
			global $post;
			
			$column = intval($col);
			
			if($column!= 2 && $column!= 3 && $column!= 4 ){
				$column = 3;
			}
			
			$nvr_output  .='<div class="brand-container '.$class.'">';
				$nvr_output  .='<div class="row brand-row">';
				
				$havepost = false;
				while (have_posts()) : the_post();
				$havepost = true;
				$excerpt = get_the_excerpt(); 
				$postid = get_the_ID();
				$custom = get_post_custom( $postid );
				$cthumb = (isset($custom["carousel_thumb"][0]))? $custom["carousel_thumb"][0] : "";
				$extlink = (isset($custom["external_link"][0]))? $custom["external_link"][0] : "";
				
				$thumbid = get_post_thumbnail_id( $postid );
				$alttext = get_post_meta($postid, '_wp_attachment_image_alt', true);
				$imagesrc = wp_get_attachment_image_src( $thumbid, 'brand-image' );
				
				if($cthumb!=""){
					$imagethumb = $cthumb;
					$alttext = get_the_title( $postid );
				}else{
					if($imagesrc!=false){
						$imagethumb = $imagesrc[0];
					}else{
						$imagethumb = get_template_directory_uri().'/images/noimage.png';
						$alttext = get_the_title( $postid );
					}
				}
				
				if($column=="2"){
					$classbr = 'six columns ';
				}elseif($column=="4"){
					$classbr = 'three columns ';
				}else{
					$classbr = 'four columns ';
				}
				
				if(($i%$column) == 1){ $classbr .= "first ";}
				if(($i%$column) == 0){$classbr .= "last ";}
				
				if(($i%$column) == 1 && $i>1){ 
					$nvr_output  .='</div>';
					$nvr_output  .='<div class="row brand-row">';
				}
				
				$nvr_output  .='<div class="'.$classbr.'">';
					$nvr_output .= '<div class="br-item-container">';
						if($extlink){
							$nvr_output  .='<a href="'.$extlink.'" target="_blank"><img src="'.$imagethumb.'" alt="'.$alttext.'" /></a>';
						}else{
							$nvr_output  .='<img src="'.$imagethumb.'" alt="'.$alttext.'" />';
						}
					$nvr_output .= '</div>';
				$nvr_output  .='</div>';
				
				$i++; $addclass=""; endwhile; wp_reset_query();

			 	$nvr_output .='</div>';
			 $nvr_output .='</div>';
			 
			 if($havepost){
			 	return do_shortcode($nvr_output);
			}else{
				return false;
			}
	}
	
	add_shortcode( 'brand', 'nvr_brandcolumns' );
}

/******HOSTING TABLE******/
if(!function_exists('nvr_hostingtable')){
	function nvr_hostingtable($atts, $content) {
		
		extract(shortcode_atts(array(
					"title" => '',
					"price" => '',
					"priceinfo" => __('Permonth', THE_LANG),
					"buttontext" => __('Purchase Now', THE_LANG),
					'buttonlink' => ''
		), $atts));
		
		$return_html = '';
		
		$return_html .= '<div class="hostingtable">';
			$return_html .= '<div class="hostingtitle"><h4>'.$title.'</h4></div>';
			$return_html .= '<div class="hostingprice">';
			$return_html .= $price;
			$return_html .= '<span class="priceinfo">'.$priceinfo.'</span>';
			$return_html .= '</div>';
			$return_html .= '<div class="hostingcontent">';
			$return_html .= $content;
			$return_html .= '</div>';
			if($buttonlink!=''){
				$return_html .= '<div class="hostingbutton"><a href="'.$buttonlink.'" class="button">'.$buttontext.'</a></div>';
			}
		$return_html .= '</div>';
		
		return $return_html;
	}
	add_shortcode( 'hostingtable', 'nvr_hostingtable' );
}

/******ICON CONTAINER******/
if(!function_exists('nvr_iconcontainer')){
	function nvr_iconcontainer($atts, $content) {
		
		extract(shortcode_atts(array(
					"iconclass" => '',
					"align" => '',
					"size" => '',
					"color" => '',
					"padding" => '',
					"radius" => '',
					'type' => '1'
		), $atts));
		
		$class = '';
		if($iconclass!=""){
			$class .=' '.$iconclass;
		}
		if($align=='right'){
			$class .=' alignright';
		}elseif($align=='center'){
			$class .=' aligncenter';
		}else{
			$class .=' alignleft';
		}
		if($type=='2'){
			$class .=' type2';
		}elseif($type=='3'){
			$class .=' type3';
		}
		
		$style = '';
		if(is_numeric($size)){
			$style .= 'font-size:'.$size.'px;';
			$style .= 'width:'.$size.'px;';
			$style .= 'height:'.$size.'px;';
			$style .= 'line-height:'.$size.'px;';
		}
		if($color!=''){
			$style .= 'border-color:'.$color.';';
			if($type=='2'){
				$style .= 'background-color:'.$color.';';
			}else{
				$style .= 'color:'.$color.';';
			}
		}
		if($padding!=''){
			$padding = preg_match('/(px|em|\%|pt|cm)$/', $padding) ? $padding : $padding.'px';
			$style .='padding:'.$padding.';';
		}
		if(is_numeric($radius)){
			$style .='border-radius:'.$radius.'px;';
			$style .='-webkit-border-radius:'.$radius.'px;';
			$style .='-moz-border-radius:'.$radius.'px;';
		}
		if($style!=''){
			$style = ' style="'.$style.'"';
		}
		$return_html = '<div class="icn-container fa'.$class.'"'.$style.'></div>';
		
		return $return_html;
	}
	add_shortcode( 'iconcontainer', 'nvr_iconcontainer' );
}

// Actual processing of the shortcode happens here
function nvr_pre_shortcode( $content ) {
    global $shortcode_tags;
 
    // Backup current registered shortcodes and clear them all out
    $orig_shortcode_tags = $shortcode_tags;
 
    // Do the shortcode (only the one above is registered)
    $content = do_shortcode( $content );
 
    // Put the original shortcodes back
    $shortcode_tags = $orig_shortcode_tags;
 
    return $content;
}
 
add_filter( 'the_content', 'nvr_pre_shortcode', 7 );