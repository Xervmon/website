<?php
function nvr_get_sidebar_position($nvr_postid = ''){
	$nvr_shortname = THE_SHORTNAME;
	$nvr_initial = THE_INITIAL;
	
	$nvr_pid = nvr_get_postid();
	$nvr_custom = nvr_get_customdata($nvr_pid);
	
	if($nvr_postid){
		$nvr_custom = nvr_get_customdata($nvr_postid);
	}
	
	$nvr_pagelayoutall = array('one-col','two-col-left','two-col-right');
	
	$nvr_sidebarposition = nvr_get_option( $nvr_shortname . '_sidebar_position' ,'two-col-left'); 
	$nvr_pagelayout = ($nvr_sidebarposition!="")? $nvr_sidebarposition : 'two-col-left';
	if(isset( $nvr_custom['_'.$nvr_initial.'_layout'][0] ) && $nvr_custom['_'.$nvr_initial.'_layout'][0]!='default'){
		$nvr_pagelayout = $nvr_custom['_'.$nvr_initial.'_layout'][0];
	}
	
	if(isset($_GET['sidebar_layout']) && in_array($_GET['sidebar_layout'],$nvr_pagelayoutall)){
		$nvr_pagelayout = esc_html($_GET['sidebar_layout']);
	}
	return $nvr_pagelayout;
}
function nvr_pf_get_image($nvr_imgsize, $nvr_postid=""){

	global $post;
	if($nvr_postid==""){
		$nvr_postid = get_the_ID();
	}

	$nvr_custom = get_post_custom( $nvr_postid );
	$nvr_cf_thumb = (isset($nvr_custom["custom_thumb"][0]))? $nvr_custom["custom_thumb"][0] : "";
	$nvr_cf_externallink = (isset($nvr_custom["external_link"][0]))? $nvr_custom["external_link"][0] : "";
	if(isset($nvr_custom["lightbox_img"])){
		$nvr_checklightbox = $nvr_custom["lightbox_img"] ; 
		$nvr_cf_lightbox = array();
		for($i=0;$i<count($nvr_checklightbox);$i++){
			if($nvr_checklightbox[$i]){
				$nvr_cf_lightbox[] = $nvr_checklightbox[$i];
			}
		}
		if(!count($nvr_cf_lightbox)){
			$nvr_cf_lightbox = "";
		}
	}else{
		$nvr_cf_lightbox = "";
	}
	
	
	/*get recent-portfolio-post-thumbnail*/
	$nvr_qrychildren = array(
		'post_parent' => $nvr_postid ,
		'post_status' => null,
		'post_type' => 'attachment',
		'order_by' => 'menu_order',
		'order' => 'ASC',
		'post_mime_type' => 'image'
	);

	$nvr_attachments = get_children( $nvr_qrychildren );
	
	$nvr_cf_thumb2 = array();
	$nvr_cf_full2 = "";
	$z = 1;
	foreach ( $nvr_attachments as $nvr_att_id => $nvr_attachment ) {
		$nvr_getimage = wp_get_attachment_image_src($nvr_att_id, $nvr_imgsize, true);
		$nvr_portfolioimage = $nvr_getimage[0];
		$nvr_alttext = get_post_meta( $nvr_attachment->ID , '_wp_attachment_image_alt', true);
		$nvr_image_title = $nvr_attachment->post_title;
		$nvr_caption = $nvr_attachment->post_excerpt;
		$nvr_description = $nvr_attachment->post_content;
		$nvr_cf_thumb2[] ='<img src="'.$nvr_portfolioimage.'" alt="'.$nvr_alttext.'" title="'. $nvr_image_title .'" class="scale-with-grid" />';
		
		$nvr_getfullimage = wp_get_attachment_image_src($nvr_att_id, 'full', true);
		$nvr_fullimage = $nvr_getfullimage[0];
		
		if($z==1){
			$nvr_fullimageurl = $nvr_fullimage;
			$nvr_fullimagetitle = $nvr_image_title;
			$nvr_fullimagealt = $nvr_alttext;
		}elseif($nvr_att_id == get_post_thumbnail_id( $nvr_postid ) ){
			$nvr_cf_full2 ='<a data-rel="prettyPhoto['.$post->post_name.']" href="'.$nvr_fullimageurl.'" title="'. $nvr_fullimagetitle .'" class="hidden"></a>'.$nvr_cf_full2;
			$nvr_fullimageurl = $nvr_fullimage;
			$nvr_fullimagetitle = $nvr_image_title;
			$nvr_fullimagealt = $nvr_alttext;
		}else{
			$nvr_cf_full2 .='<a data-rel="prettyPhoto['.$post->post_name.']" href="'.$nvr_fullimage.'" title="'. $nvr_image_title .'" class="hidden"></a>';
		}
		$z++;
	}
	
	if($nvr_cf_thumb!=""){
		$nvr_cf_thumb = '<img src="' . $nvr_cf_thumb . '" alt="'. get_the_title($nvr_postid) .'"  class="scale-with-grid" />';
	}elseif( has_post_thumbnail( $nvr_postid ) ){
		$nvr_cf_thumb = get_the_post_thumbnail($nvr_postid, $nvr_imgsize, array('class' => 'scale-with-grid'));
	}elseif( isset( $nvr_cf_thumb2[0] ) ){
		$nvr_cf_thumb = $nvr_cf_thumb2[0];
	}else{
		$nvr_cf_thumb = '<span class="nvr-noimage"></span>';
	}
	
	
	if($nvr_cf_externallink!=""){
		$nvr_golink = $nvr_cf_externallink;
		$nvr_rollover = "gotolink";
		$nvr_atext = __('More',THE_LANG);
		$nvr_cf_full2 = '';
	}else{
		$nvr_golink = get_permalink();
		$nvr_rollover = "gotopost";
		$nvr_atext = __('More',THE_LANG);
	}
	
	$nvr_bigimageurl = $nvr_bigimagetitle = $nvr_rel = '';
	if( is_array($nvr_cf_lightbox) ){
		$nvr_bigimageurl = $nvr_cf_lightbox[0];
		$nvr_bigimagetitle = get_the_title();
		$nvr_rel = ' data-rel="prettyPhoto['.$post->post_name.']"';
		$nvr_cf_lightboxoutput = '';
		for($i=1;$i<count($nvr_cf_lightbox);$i++){
			$nvr_cf_lightboxoutput .='<a data-rel="prettyPhoto['.$post->post_name.']" href="'.$nvr_cf_lightbox[$i].'" title="'. get_the_title($nvr_postid) .'" class="hidden"></a>';
		}
		$nvr_cf_full2 = $nvr_cf_lightboxoutput;
	}else{
		if( isset($nvr_fullimageurl)){
			$nvr_bigimageurl = $nvr_fullimageurl; 
			$nvr_bigimagetitle = $nvr_fullimagetitle;
			$nvr_rel = ' data-rel="prettyPhoto['.$post->post_name.']"';
		}
	}
	
	$nvr_return = array(
		'nvr_bigimageurl' 	=> $nvr_bigimageurl,
		'nvr_bigimagetitle'	=> $nvr_bigimagetitle,
		'nvr_rel'			=> $nvr_rel,
		'nvr_cf_full2'		=> $nvr_cf_full2,
		'nvr_golink'		=> $nvr_golink,
		'nvr_rollover'		=> $nvr_rollover,
		'nvr_atext'			=> $nvr_atext,
		'nvr_cf_thumb'		=> $nvr_cf_thumb
	);
	return $nvr_return;
}

function nvr_pf_get_box( $nvr_imgsize, $nvr_postid="",$nvr_class="", $nvr_limitchar = 250 ){

	$nvr_output = "";
	global $post;
	
	if($nvr_postid==""){
		$nvr_postid = get_the_ID();
	}
	$nvr_taxonomy_slug = 'portfoliocat';
	
	$nvr_get_image = nvr_pf_get_image($nvr_imgsize, $nvr_postid );
	extract($nvr_get_image);
	
	$nvr_output  .='<li class="'.$nvr_class.'">';
		$nvr_output  .='<div class="nvr-pf-box">';
			$nvr_output  .='<div class="nvr-pf-img">';
				$nvr_output .='<div class="rollover"></div>';
				
				$nvr_output .='<a class="image '.$nvr_rollover.'" href="'.$nvr_golink.'" title="'.get_the_title($nvr_postid).'">&nbsp; '.$nvr_atext.'</a>';
				if($nvr_bigimageurl!=''){
					$nvr_output .='<a class="image zoom" href="'.$nvr_bigimageurl.'" '.$nvr_rel.' title="'.$nvr_bigimagetitle.'">&nbsp; '.__('Zoom',THE_LANG).'</a>';
				}
				
				$nvr_output  .=$nvr_cf_thumb;
				$nvr_output  .=$nvr_cf_full2;
			$nvr_output  .='</div>';
	
			$nvr_excerpt = nvr_string_limit_char( get_the_excerpt(), $nvr_limitchar );
			$nvr_output  .='<div class="nvr-pf-text">';
			
				$nvr_output  .='<h2 class="nvr-pf-title"><a href="'.get_permalink($nvr_postid).'" title="'.get_the_title($nvr_postid).'">'.get_the_title($nvr_postid).'</a></h2>';
				 // get the terms related to post
				$nvr_terms = get_the_terms( $nvr_postid, $nvr_taxonomy_slug );
				$nvr_termarr = array();
				if ( !empty( $nvr_terms ) ) {
				  foreach ( $nvr_terms as $nvr_term ) {
					$nvr_termarr[] = '<a href="'. get_term_link( $nvr_term->slug, $nvr_taxonomy_slug ) .'">'. $nvr_term->name ."</a>";
				  }
				  
				  $nvr_output .= '<div class="nvr-pf-cat">'.implode(", ", $nvr_termarr).'</div>';
				}
				$nvr_output .= '<div class="nvr-pf-separator"></div>';
				$nvr_output .= '<div class="nvr-pf-content">'.$nvr_excerpt.'</div>';
				
			$nvr_output  .='</div>';
			$nvr_output  .='<div class="nvr-pf-clear"></div>';
		$nvr_output  .='</div>';
	$nvr_output  .='</li>';
	
	return $nvr_output; 
}

if( !function_exists('nvr_section_builder') ){
	function nvr_section_builder($nvr_sectionbuilders){

		if(isset($nvr_sectionbuilders) && is_array($nvr_sectionbuilders) && count($nvr_sectionbuilders)>0){ 
			$i = 1;
			foreach($nvr_sectionbuilders as $nvr_sectionbuilder){ 
				
				$nvr_sectionbgcolor = (isset($nvr_sectionbuilder['backgroundcolor']))? $nvr_sectionbuilder['backgroundcolor'] : '';
				$nvr_sectionbgimage = (isset($nvr_sectionbuilder['backgroundimage']))? $nvr_sectionbuilder['backgroundimage'] : '';
				$nvr_sectionclass   = (isset($nvr_sectionbuilder['customclass']))? $nvr_sectionbuilder['customclass'] : '';
				$nvr_sectioncontent = (isset($nvr_sectionbuilder['content']))? $nvr_sectionbuilder['content'] : '';
				
				if($nvr_sectioncontent==''){ continue; }
				
				$nvr_sectionstyle = '';
				if($nvr_sectionbgcolor!='' || $nvr_sectionbgimage!=''){
					$nvr_sectionstyle  = 'style="';
						if($nvr_sectionbgcolor!=''){
							$nvr_sectionstyle .= 'background-color:'.$nvr_sectionbgcolor.'; ';
						}
						if($nvr_sectionbgimage!=''){
							$nvr_sectionstyle .= 'background-image:url('.$nvr_sectionbgimage.'); ';
						}
						$nvr_sectionstyle .= 'background-repeat:no-repeat';
						$nvr_sectionstyle .= 'background-position:center';
					$nvr_sectionstyle .= '"';
				}
			?>
				<section id="outersection_<?php echo $i; ?>" class="outersection <?php echo $nvr_sectionclass; ?>" <?php echo $nvr_sectionstyle; ?>>
					<div class="container">
						<section id="innersection_<?php echo $i; ?>" class="row innersection">
							<div class="sectioncontent twelve columns">
								<?php echo do_shortcode($nvr_sectioncontent); ?>
								<div class="clearfix"></div>
							</div>
							<div class="clearfix"></div>
						</section>
					</div>
				</section>
			<?php 
				$i++;
			}//end foreach 
		}
	}
}

/*Template for comments and pingbacks. */
if ( ! function_exists( 'nvr_comment' ) ) :
function nvr_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="con-comment">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 65 ); ?>
		</div><!-- .comment-author .vcard -->


		<div class="comment-body">
			<?php  printf( __( '<cite class="fn">%s</cite>', THE_LANG ), sprintf( '%s Says:', get_comment_author_link() ) ); ?>
            <span class="time">
            <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
            <?php
                /* translators: 1: date, 2: time */
                printf( __( '%1$s %2$s', THE_LANG ), get_comment_date(),  get_comment_time() ); ?></a>
                <?php edit_comment_link( __( '(Edit)', THE_LANG ), ' ' );?>
            </span>
            
            <div class="clear"></div>
			<div class="commenttext">
			<?php comment_text(); ?>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', THE_LANG ); ?></em>
			<?php endif; ?>
			</div>
            <span class="reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ,'reply_text' => 'Reply') ) ); ?></span>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
			echo '<li class="post pingback">';
				echo '<p>'. __( 'Pingback:', THE_LANG ).' ';
					comment_author_link();
					edit_comment_link( __('(Edit)', THE_LANG), ' ' );
				echo '</p>';
				
			break;
	endswitch;
}
endif;

/*********QUICK VIEW PRODUCT**********/
add_action("wp_ajax_nvr_quickviewproduct", "nvr_quickviewproduct");
add_action("wp_ajax_nopriv_nvr_quickviewproduct", "nvr_quickviewproduct");
function nvr_quickviewproduct(){
	
	if( !wp_verify_nonce( $_REQUEST['nonce'], "nvr_quickviewproduct_nonce")) {
    	exit("No naughty business please");
	}
	
	$nvr_productid = (isset($_REQUEST["post_id"]) && $_REQUEST["post_id"]>0)? $_REQUEST["post_id"] : 0;
	
	$nvr_query_args = array(
		'post_type'	=> 'product',
		'p'			=> $nvr_productid
	);
	$nvr_outputraw = $nvr_output = '';
	$nvr_productquery = new WP_Query($nvr_query_args);
	if($nvr_productquery->have_posts()){ 

		while ($nvr_productquery->have_posts()){ $nvr_productquery->the_post(); setup_postdata($nvr_productquery->post);
			global $product;
			ob_start();
			woocommerce_get_template_part( 'content', 'quickview-product' );
			$nvr_outputraw = ob_get_contents();
			ob_end_clean();
		}
	}// end if ($nvr_productquery->have_posts())
	$nvr_output = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $nvr_outputraw);
	echo $nvr_output;
}