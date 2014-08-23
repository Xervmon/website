<?php
/**
 * The Header for our theme.
 *
 *
 * @package WordPress
 * @subpackage Cadillac
 * @since Cadillac 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?> class="no-js">
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?> class="no-js">
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?> class="no-js">
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php nvr_document_title(); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php 
/* We add some JavaScript to pages with the comment form
 * to support sites with threaded comments (when in use).
 */
if ( is_singular() && get_option( 'thread_comments' ) )
	wp_enqueue_script( 'comment-reply' );

/* Always have wp_head() just before the closing </head>
 * tag of your theme, or you will break many plugins, which
 * generally use this hook to add elements to <head> such
 * as styles, scripts, and meta tags.
 */

$nvr_shortname = THE_SHORTNAME;
$nvr_initial = THE_INITIAL;

wp_head(); /* the novaro' custom content for wp_head is in includes/header-functions.php */ ?>
</head><?php 

$nvr_pid = nvr_get_postid();
$nvr_custom = nvr_get_customdata($nvr_pid);
if(isset($nvr_custom["show_breadcrumb"][0])){
	if($nvr_custom["show_breadcrumb"][0]=="true"){
		$nvr_showbc = true;
	}else{
		$nvr_showbc = false;
	}
}
$nvr_showbc = true;
$nvr_cf_enableSlider 	= (isset($nvr_custom["enable_slider"][0]))? $nvr_custom["enable_slider"][0] : "";

if($nvr_cf_enableSlider=="true" && !is_search()){
	$nvr_issliderdisplayed = true;
}else{
	$nvr_issliderdisplayed = false;
}

$nvr_allsitelayout		= array('nvrlayout1','nvrlayout2','nvrlayout3','nvrlayout4','nvrlayout5','nvrlayout6');
$nvr_sitelayout			= nvr_get_option( $nvr_shortname . '_web_layout');
if(function_exists('simpleSessionGet') && nvr_get_option( $nvr_shortname . '_demo_mode' )=="1"){
	$nvr_sitelayout = simpleSessionGet('site_layout', 'nvrlayout1');
}
$nvr_cf_siteLayout	 	= (isset($nvr_custom["site_layout"][0]))? $nvr_custom["site_layout"][0] : $nvr_sitelayout;

if(!in_array($nvr_cf_siteLayout,$nvr_allsitelayout)){
	$nvr_cf_siteLayout = 'nvrlayout1';
}
if(function_exists('simpleSessionSet') && nvr_get_option( $nvr_shortname . '_demo_mode' )=="1"){
	simpleSessionSet('site_layout', $nvr_cf_siteLayout);
}
$nvr_txtContainerWidth = nvr_get_bodycontainer();

$nvr_bodyclass = array($nvr_shortname);  
$nvr_bodyclass[] = $nvr_cf_siteLayout;
if($nvr_issliderdisplayed){
	$nvr_bodyclass[] = 'nvrslideron';
}

if($nvr_txtContainerWidth>1100){
	$nvr_bodyclass[] = 'nvr1100more';
}
?>
<body <?php body_class($nvr_bodyclass); ?>>


<div id="subbody">
	<div id="outercontainer">
    
        <!-- HEADER -->
        <div id="headertext">
        	<div class="container">
                <div class="row">
                	<?php 
					/***** file : engine/header-functions.php
					- nvr_output_headertext - 5
					- nvr_output_headertext2 - 8
					- nvr_output_wpmlselector - 20
					*****/
					do_action('nvr_output_toparea');
					?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <header id="outertop">
        	<?php
			if($nvr_issliderdisplayed && $nvr_cf_siteLayout=='nvrlayout3'){
            	get_template_part( 'slider');
            }
			?>
            <div id="outerheaderwrapper">
            <div id="outerheader">
                <div class="topcontainer container">
                    <div class="row">
                    	<ul id="gn-menu" class="gn-menu-main">
                            <li class="gn-trigger">
                                <a class="gn-icon fa fa-bars gn-trigger-button"><span><?php _e('Menu', THE_LANG); ?></span></a>
                                <nav class="gn-menu-wrapper">
                                    <div class="gn-scroller">
                                    	<?php
										nvr_secondary_menu(); /* file: engine/header-functions.php */
										?>
                                    </div><!-- /gn-scroller -->
                                </nav>
                            </li>
                        </ul>
                        <div class="logo columns"><?php nvr_logo(); // print the logo html ?></div>
                        <?php
							
							if($nvr_cf_siteLayout=='nvrlayout4'){
								nvr_primary_menu(); /* file: engine/header-functions.php */
								nvr_output_searchform(); /* file: engine/header-functions.php */
								nvr_output_minicart(); /* file: engine/header-functions.php */
							}else{
								if($nvr_cf_siteLayout!='nvrlayout5' && $nvr_cf_siteLayout!='nvrlayout6'){
									nvr_output_minicart(); /* file: engine/header-functions.php */
									nvr_output_searchform(); /* file: engine/header-functions.php */
								}
								nvr_primary_menu(); /* file: engine/header-functions.php */
							}
						?>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            </div>

			<?php 
            if($nvr_issliderdisplayed && $nvr_cf_siteLayout!='nvrlayout3'){
            	get_template_part( 'slider');
            }
			
			if(!$nvr_issliderdisplayed) {
            ?>
            <!-- AFTER HEADER -->
            <div id="outerafterheader">
                <div class="container">
                    <div id="afterheader" class="row">
                        <section id="pagetitlecontainer" class="columns">
                            <?php
                            get_template_part( 'title');
                            
							$nvr_pagedesc = (isset($nvr_custom['_'.$nvr_initial.'_pagedesc'][0]) && $nvr_custom['_'.$nvr_initial.'_pagedesc'][0]!="")? $nvr_custom['_'.$nvr_initial.'_pagedesc'][0] : "";
							if($nvr_pagedesc){
								echo '<span class="pagedesc">'.$nvr_pagedesc.'</span>';
							}
                            ?>
                        </section>
                        <?php if($nvr_showbc){ ?>
                        <div id="breadcrumbcontainer" class="columns"><?php nvr_breadcrumb(); ?></div>
                        <?php } ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- END AFTER HEADER -->
            <?php 
            }/* end if( !$nvr_issliderdisplayed ) */ 
            ?>
		</header>
        <!-- END HEADER -->
        
        <!-- MIDDLE -->
        <div id="outermiddle">
        <!-- SECTION BUILDER BEFORE CONTENT -->
		<?php 
		$nvr_sectionbuilderb = array();
		if(isset( $nvr_custom['_'.$nvr_initial.'_sectionbuilder_before'][0] )){
			$nvr_sectionbuilderb = unserialize($nvr_custom['_'.$nvr_initial.'_sectionbuilder_before'][0]);
		}
		
        nvr_section_builder($nvr_sectionbuilderb);
        ?>
        <!-- END SECTION BUILDER BEFORE CONTENT -->
        
        <?php
		$nvr_pagelayout = nvr_get_sidebar_position($nvr_pid);
		
		if($nvr_pagelayout!='one-col'){
			$nvr_mcontentclass = "hassidebar";
			if($nvr_pagelayout=="two-col-left"){
				$nvr_mcontentclass .= " mborderright";
			}else{
				$nvr_mcontentclass .= " mborderleft";
			}
		}else{
			$nvr_mcontentclass = "twelve columns nosidebar";
		}
		?>
        <!-- MAIN CONTENT -->
        <div id="outermain">
        	<div id="main-gradienttop">
        	<div class="container">
            	<div class="row">
                
                <section id="maincontent" class="<?php echo $nvr_mcontentclass; ?>">
                
                <?php if($nvr_pagelayout!='one-col'){ ?>
                        
                    <section id="content" class="eight columns <?php if($nvr_pagelayout=="two-col-left"){echo "positionleft";}else{echo "positionright";}?>">
                        <div class="main">
                
                <?php } ?>
                	