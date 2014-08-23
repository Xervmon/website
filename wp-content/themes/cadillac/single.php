<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Cadillac
 * @since Cadillac 1.0
 */

get_header(); 

$nvr_initial = THE_INITIAL;
?>

        <div id="singlepost">
        
             <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
             <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
             	<?php
                 
				$nvr_custom = get_post_custom($post->ID);
				$nvr_post_format = get_post_format();
				switch ($nvr_post_format) {
					case "video":
						
						$nvr_cf_vidurl = (isset($nvr_custom["_".$nvr_initial."_video_url"][0]))? $nvr_custom["_".$nvr_initial."_video_url"][0] : "";
						if($nvr_cf_vidurl!=''){
							echo '<div class="mediacontainer">'.apply_filters('the_content', $nvr_cf_vidurl)."</div>";
						}
						
					break;
					case "audio":
					
						$nvr_cf_audurl = (isset($nvr_custom["_".$nvr_initial."_audio_url"][0]))? $nvr_custom["_".$nvr_initial."_audio_url"][0] : "";
						if($nvr_cf_audurl!=''){
							echo '<div class="mediacontainer">'.apply_filters('the_content', $nvr_cf_audurl)."</div>";
						}
					
					break;
					case "gallery":
						
						$nvr_post_content = get_the_content();
						preg_match('/\[gallery.*ids=.(.*).\]/', $nvr_post_content, $ids);
						$nvr_array_id = explode(",", $ids[1]);
						
						$nvr_content =  str_replace($ids[0], "", $nvr_post_content);
						$nvr_filtered_content = apply_filters( 'the_content', $nvr_content);
						
						$nvr_sliderli = '';
						foreach($nvr_array_id as $nvr_img_id){
							$nvr_sliderli .= '<li><a href="'. get_permalink() .'">'. wp_get_attachment_image( $nvr_img_id, 'blog-post-image' ) .'</a></li>';
						}
						
						if($nvr_sliderli!=''){
							echo '<div class="gallerycontainer"><div class="flexslider"><ul class="slides">'.$nvr_sliderli."</ul></div></div>";
						}
						
					break;
					case "image":
						
						$nvr_cf_imgurl = (isset($nvr_custom["image_url"][0]))? $nvr_custom["image_url"][0] : "";
						$nvr_imgurl = "";
						/* temporary not used */
						if($nvr_cf_imgurl!=""){
							$nvr_imgurl = '<img src='. $nvr_cf_imgurl .' alt="'. get_the_title( $post->ID ).'" class="scale-with-grid"/>';
						}elseif(has_post_thumbnail($post->ID) ){
							$nvr_imgurl = get_the_post_thumbnail($post->ID, 'blog-post-image', array('class' => 'scale-with-grid'));
						}else{
							$nvr_imgurl ="";
						}
						
						if($nvr_imgurl!=''){
							echo '<div class="imgcontainer">'.$nvr_imgurl."</div>";
						}
						
					break;
					
					default :
					
					break;
				}
				?>
                <h1 class="posttitle"><?php the_title(); ?></h1>
                <div class="entry-utility">
                    <span class="meta-author"><?php _e('posted by:', THE_LANG); ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>"><?php the_author();?></a></span> 
                    <span class="meta-date"><?php _e('date:', THE_LANG); ?> <date><?php the_time('M d, Y') ?></date></span>
                    <span class="meta-cat"><?php _e('category:', THE_LANG); ?> <?php the_category(', '); ?></span>
                    <span class="meta-comment"><?php _e('comments:', THE_LANG); ?> <?php comments_popup_link(__('0', THE_LANG), __('1', THE_LANG), __('%', THE_LANG)); ?></span>
                    <div class="clearfix"></div>
                </div>
                
                 <div class="entry-content">
                    <?php 
					if(isset($nvr_filtered_content)){
						echo do_shortcode($nvr_filtered_content);
					}else{
						the_content();
					}
					?>
                    <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', THE_LANG ) . '</span>', 'after' => '</div>' ) ); ?>
                    <div class="clearfix"></div>
                </div>
                
             </article>
             <div id="prevnext-post-link">
            	<?php
				$nvr_nextpost = get_next_post(true);
				$nvr_prevpost = get_previous_post(true);
                if(!empty($nvr_prevpost)){
					echo '<div class="nav-previous"><a href="'.get_permalink($nvr_prevpost->ID).'"><span class="navarrow fa fa-angle-left"></span><span class="navtext">'. __( 'Previous Article', THE_LANG ) .'</span><br /><span class="prevnexttitle">'.get_the_title($nvr_prevpost->ID).'</span></a></div>';
                }
				if(!empty($nvr_nextpost)){
					echo '<div class="nav-next"><a href="'.get_permalink($nvr_nextpost->ID).'"><span class="navarrow fa fa-angle-right"></span><span class="navtext">'. __( 'Next Article', THE_LANG ) .'</span><br /><span class="prevnexttitle">'.get_the_title($nvr_nextpost->ID).'</span></a></div>';
                }
                ?>
                <div class="clearfix"></div>
            </div>
            <?php
            
            // If a user has filled out their description, show a bio on their entries.
            if ( get_the_author_meta( 'description' ) ) : ?>
            <h2 class="entry-author-title"><?php _e('About Author', THE_LANG); ?></h2>
            <div id="entry-author-info">
                <div id="author-avatar">
                    <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'novaro_author_bio_avatar_size',98 ) ); ?>
                </div><!-- author-avatar -->
                <div id="author-description">
                    <h2><span class="author"><?php the_author(); ?></span></h2>
                    <?php the_author_meta( 'description' ); ?>
                </div><!-- author-description	-->
            </div><!-- entry-author-info -->
            <?php endif; ?>
            <?php comments_template( '', true ); ?>
            
            <?php endwhile; ?>
        
        </div><!-- singlepost --> 
                   
<?php get_footer(); ?>