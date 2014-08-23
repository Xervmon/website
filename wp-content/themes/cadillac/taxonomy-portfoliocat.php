<?php
/**
 *
 * @package WordPress
 * @subpackage Cadillac
 * @since Cadillac 1.0
 */

get_header(); ?>

		<?php
        
        $nvr_idnum = 0;
        $nvr_column = 3;
        $nvr_typecol = "nvr-pf-col-".$nvr_column;
        $nvr_imgsize = "portfolio-image";
        
        ?>
        
        <div class="nvr-pf-container row">
            <ul class="<?php echo $nvr_typecol; ?>">
        
            <?php
            while ( have_posts() ) : the_post(); 
                    $nvr_idnum++;
                    
                    if($nvr_column=="2"){
                        $nvr_classpf = 'six columns ';
                    }elseif($nvr_column=="4"){
                        $nvr_classpf = 'three columns ';
                    }else{
                        $nvr_classpf = 'four columns ';
                    }

                    if(($nvr_idnum%$nvr_column) == 1){ $nvr_classpf .= "first ";}
                    if(($nvr_idnum%$nvr_column) == 0){$nvr_classpf .= "last ";}
                    
                    echo nvr_pf_get_box( $nvr_imgsize, get_the_ID(), $nvr_classpf );
                        
                    $nvr_classpf=""; 
                        
            endwhile; // End the loop. Whew.
            ?>
            <li class="pf-clear"></li>
            </ul>
            <div class="clearfix"></div>
        </div><!-- end #nvr-portfolio -->
                  
        <?php /* Display navigation to next/previous pages when applicable */ ?>
        <?php if (  $wp_query->max_num_pages > 1 ) : ?>
             <div class="wp-pagenavi">
                <?php
                $nvr_permalinks = get_option('permalink_structure');
                $nvr_format = empty( $nvr_permalinks ) ? '&page=%#%' : 'page/%#%/';
                echo paginate_links( array(
                    'base' => get_term_link($termslug, 'portfoliocat').'%_%',
                    'format' => $nvr_format,
                    'current' => max( 1, $paged ),
                    'total' => $wp_query->max_num_pages,
                    'prev_text'    => __('&laquo; Previous', THE_LANG ),
                    'next_text'    => __('Next &raquo;', THE_LANG),
                ) );
                ?>
             </div>
        <?php endif;  $wp_query = null; $wp_query = $querytemp; wp_reset_query();?>
        <div class="clearfix"></div><!-- clear float --> 
                
<?php get_footer(); ?>