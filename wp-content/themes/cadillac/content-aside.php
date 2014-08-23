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
    	
        <div class="loopcontainer">
    		<div class="entry-content">
                <?php 
				if(is_search()){
					the_excerpt();
				}else{
					the_content(); 
				}
				?>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="entry-utility">
        	<div class="entry-icon fa fa-bookmark"></div>
            <span class="meta-date"><?php _e('date', THE_LANG); ?>:&nbsp; <?php the_time('M d, Y') ?></span>
            <span class="meta-comment"><?php _e('comments', THE_LANG); ?>:&nbsp; <?php comments_popup_link(__('0', THE_LANG), __('1', THE_LANG), __('%', THE_LANG)); ?></span><br />
            <span class="meta-author"><?php _e('by', THE_LANG); ?>:&nbsp; <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>"><?php the_author();?></a></span> 
            <span class="meta-cat"><?php _e('category', THE_LANG); ?>:&nbsp; <?php the_category(', '); ?></span>
            <div class="clearfix"></div>
        </div>
		<div class="clearfix"></div>
        
	</article><!-- end post -->