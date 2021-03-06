<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Cadillac
 * @since Cadillac 1.0
 */
 
 global $post, $more;
 $more = 0;
 $nvr_initial = THE_INITIAL;
?>

    <?php /* How to display all posts. */ ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class("content-loop"); ?>>
    	<?php
		if(!is_search()){
			$nvr_custom = get_post_custom($post->ID);
			$nvr_cf_vidurl = (isset($nvr_custom["_".$nvr_initial."_video_url"][0]))? $nvr_custom["_".$nvr_initial."_video_url"][0] : "";
			
			if($nvr_cf_vidurl!=''){
				echo '<div class="mediacontainer">'.apply_filters('the_content', $nvr_cf_vidurl)."</div>";
			}
		}
		?>
        <div class="loopcontainer">
            <h2 class="posttitle"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', THE_LANG ), the_title_attribute( 'echo=0' ) ); ?>" data-rel="bookmark"><?php the_title(); ?></a></h2>
       		<div class="entry-content">
                <?php the_excerpt(); ?>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="entry-utility">
        	<div class="entry-icon fa fa-film"></div>
            <span class="meta-date"><?php _e('date', THE_LANG); ?>:&nbsp; <?php the_time('M d, Y') ?></span>
            <span class="meta-comment"><?php _e('comments', THE_LANG); ?>:&nbsp; <?php comments_popup_link(__('0', THE_LANG), __('1', THE_LANG), __('%', THE_LANG)); ?></span><br />
            <span class="meta-author"><?php _e('by', THE_LANG); ?>:&nbsp; <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>"><?php the_author();?></a></span> 
            <span class="meta-cat"><?php _e('category', THE_LANG); ?>:&nbsp; <?php the_category(', '); ?></span>
            <a href="<?php the_permalink(); ?>" class="more-link btn"><?php _e('Read More', THE_LANG); ?></a>
            <div class="clearfix"></div>
        </div>
		<div class="clearfix"></div>
        
	</article><!-- end post -->