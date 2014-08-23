<?php
/**
 * Template Name: Roi Calculator
 *
 * A custom page template for portfolio page.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Cadillac
 * @since Cadillac 1.0
 */

get_header(); ?>
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/noUiSlider/6.2.0/jquery.nouislider.min.css">
        <style>
            .noUi-horizontal .noUi-handle {
                width: 30px;
                height: 30px;
                left: -17px;
                top: -7px;
                border-radius: 50%;
                background: #fff;
                border: 7px solid #0088cc;
            }
            .noUi-handle:before, .noUi-handle:after {
                content: "";
                display: block;
                position: absolute;
                height: 14px;
                width: 1px;
                background: transparent;
                left: 14px;
                top: 7px;
            }
            input {
                color: #0088cc;
                font-weight: 700;
            }           
        </style>
	<?php
    $nvr_shortname = THE_SHORTNAME;
	$nvr_initial = THE_INITIAL;
	
	
   	$nvr_pid = nvr_get_postid();
	$nvr_custom = nvr_get_customdata($nvr_pid);
    $nvr_type = (isset($nvr_custom["p_type"][0]))? $nvr_custom["p_type"][0] : "";
	$nvr_contlayout = (isset($nvr_custom["p_container"][0]))? $nvr_custom["p_container"][0] : "";
    $nvr_cats = (isset($nvr_custom["p_categories"][0]))? $nvr_custom["p_categories"][0] : "";
    $nvr_showpost = (isset($nvr_custom["p_showpost"][0]))? $nvr_custom["p_showpost"][0] : "";
    $nvr_orderby = (isset($nvr_custom["p_orderby"][0]))? $nvr_custom["p_orderby"][0] : "date";
    $nvr_ordersort = (isset($nvr_custom["p_sort"][0]))? $nvr_custom["p_sort"][0] : "DESC";
	$nvr_loadmore = (isset($nvr_custom["p_loadmore"][0]))? $nvr_custom["p_loadmore"][0] : "";
    $nvr_categories = explode(",",$nvr_cats);

	if($nvr_type==""){
		$nvr_type = 'classic-3-space';
	}
	$nvr_arrtype = explode("-",$nvr_type);
	
	$nvr_ptype = $nvr_arrtype[0];
	$nvr_column = intval($nvr_arrtype[1]);
	$nvr_pspace = $nvr_arrtype[2];
	if($nvr_column==0){
		$nvr_freelayout = true;
	}else{
		$nvr_freelayout = false;
	}
    
    $nvr_approvedcats = array();
    foreach($nvr_categories as $nvr_category){
        $nvr_catname = get_term_by('slug',$nvr_category,"portfoliocat");
        if($nvr_catname!=false){
            $nvr_approvedcats[] = $nvr_catname;
        }
    }
    
    $nvr_catslugs = array();
    if(count($nvr_approvedcats)>1){
        echo '<ul id="filters" class="option-set clearfix " data-option-key="filter">';
            echo '<li class="alpha selected"><a href="#filter" data-option-value="*">'. __('All Categories', THE_LANG ).'</a></li>';
            $nvr_filtersli = '';
            $nvr_numli = 1;
            foreach($nvr_approvedcats as $nvr_approvedcat){
                if($nvr_numli==1){
                    $nvr_liclass = 'omega';
                }else{
                    $nvr_liclass = '';
                }
                $nvr_filtersli = '<li class="'.$nvr_liclass.'"><a href="#filter" data-option-value=".'.$nvr_approvedcat->slug.'">'.$nvr_approvedcat->name.'</a></li>'.$nvr_filtersli;
                $nvr_catslugs[] = $nvr_approvedcat->slug;
                $nvr_numli++;
            }
            echo $nvr_filtersli;
        echo '</ul>';
		$nvr_hasfilter = true;
    }elseif(count($nvr_approvedcats)==1){
		$nvr_catslugs[] = $nvr_approvedcats[0]->slug;
		$nvr_hasfilter = false;
	}else{
		$nvr_hasfilter = false;
	}

    $nvr_idnum = 0;

    if($nvr_column!= 2 && $nvr_column!= 3 && $nvr_column!= 4 && $nvr_column!= 5 ){
        $nvr_column = 3;
    }
    $nvr_pfcontainercls = "nvr-pf-col-".$nvr_column;
	$nvr_pfcontainercls .= " ".$nvr_ptype;
	$nvr_pfcontainercls .= " ".$nvr_pspace;
	$nvr_pfcontainercls .= " ".$nvr_contlayout;
    $nvr_imgsize = "portfolio-image";
    
    if($nvr_showpost==""){$nvr_showpost="-1";}
    
    $nvr_argquery = array(
        'post_type' => 'portofolio',
        'orderby' => $nvr_orderby,
        'order' => $nvr_ordersort,
        'paged' => $paged
    );
	$nvr_argquery['showposts'] = $nvr_showpost;
    
    if(count($nvr_catslugs)>0){
        $nvr_argquery['tax_query'] = array(
            array(
                'taxonomy' => 'portfoliocat',
                'field' => 'slug',
                'terms' => $nvr_catslugs
            )
        );
    }

    query_posts($nvr_argquery); 
    global $post, $wp_query;
    ?>
    <div class="nvr-pf-container row">
        
<div class="">
			<div class="container">
				<p style="color:#333;font-size: 18px;text-align: justify;line-height: 30px;"> Xervmon delivers more value, saves time, delivers better return on investment and your risks mitigated. Calculate ROI delivered by Xervmon Managed Services delivered by Xervmon Unified Platform.</p>
				<div class="row" style="border-bottom: 2px solid #EEE;">
					<div class="col-md-6">
						<h3 style="color: #0088cc;border-right: 1px solid #EEE"><b>Your Cost</b></h3>
					</div>
					<div class="col-md-6">
						<h3 style="color: #0088cc;"><b>Xervmon Cost</b></h3>
					</div>
				</div>
				<div class="row" style="border-bottom: 2px solid #EEE;">
					<div class="col-md-6">
						<div style="border-right: 1px solid #EEE;">
							<div>
								<h5 style="padding: 10px 0;text-transform: none;"><b>Number of Servers</b></h5>
								<div class="row" style="padding-bottom: 10px;">
									<div class="col-md-9">
										<div class="servers"></div>
									</div>
									<div class="col-md-3">
										<input name="input_servers" class="input_servers" style="width: 65px;height: 36px;margin-top: -10px;padding: 5px;" value="10">
									</div>
								</div>
							</div>
							<div>
								<h5 style="padding: 10px 0;text-transform: none;"><b>Number of Employees</b></h5>
								<div class="row">
									<div class="col-md-9">
										<div class="employees"></div>
									</div>
									<div class="col-md-3">
										<input name="input_employees" class="input_employees" style="width: 65px;height: 36px;margin-top: -10px;padding: 5px;" value="2">
									</div>
								</div>
							</div>
							<div>
								<h5 style="padding: 10px 0;text-transform: none;"><b>Average Salary per Employee</b></h5>
								<div class="row">
									<div class="col-md-9">
										<div class="salaryperemployee"></div>
									</div>
									<div class="col-md-3">
										<input name="input_salary_employee" class="input_salary_employee" style="width: 65px;height: 36px;margin-top: -10px;padding: 5px;" value="80000">
									</div>
								</div>
							</div>
							<br />
							<div style="padding-bottom: 10px;" class="row">
								<div class="col-md-6">
									<b> Monitoring System </b>
								</div>
								<div class="col-md-6">
									$20,000 per year
								</div>
							</div>
							<div style="padding-bottom: 10px;" class="row">
								<div class="col-md-6">
									<b> Help Desk </b>
								</div>
								<div class="col-md-6">
									$15,000 per year
								</div>
							</div>
							<div style="padding-bottom: 10px;" class="row">
								<div class="col-md-6">
									<b> 24/7 NOC </b>
								</div>
								<div class="col-md-6">
									$20,000 per year
								</div>
							</div>
						</div>
						<hr>
					</div>
					<div class="col-md-6">
						<div>
							<h5 style="padding: 10px 0;text-transform: none;"><b>Number of Servers</b></h5>
							<div class="row">
								<div class="col-md-9">
									<div class="xervmon_servers"></div>
								</div>
								<div class="col-md-3">
									<input name="input_servers" class="input_xervmon_servers" style="width: 65px;height: 36px;margin-top: -10px;padding: 5px;" value="10">
								</div>
							</div>
						</div>
						<div>
							<h5 style="padding: 10px 0;text-transform: none;"><b>Number of Service moniters</b></h5>
							<div class="row">
								<div class="col-md-9">
									<div class="serveice_moniters"></div>
								</div>
								<div class="col-md-3">
									<input name="input_service_moniter" class="input_service_moniter" style="width: 65px;height: 36px;margin-top: -10px;padding: 5px;" value="0">
								</div>
							</div>
						</div>
						<div>
							<h5 style="padding: 10px 0;text-transform: none;"><b>Select your Product</b></h5>
							<div class="radio" style="padding-bottom: 10px;">
								<label>
									<input type="radio" name="radio2" value="1" checked>
									Monitoring + Remediation </label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="radio2" value="2">
									Monitoring + Remediation + Management </label>
							</div>
						</div>
					</div>
				</div>
				<br />
				<div class="row" style="border-bottom: 2px solid #EEE">
					<div class="col-md-6">
						<div>
							<h4>Total Cost : <b style="color: #0088cc;font-size: 24px;"><span id="your_cost"></span></b>/mo</h4>
						</div>
					</div>
					<div class="col-md-6">
						<div>
							<h4>Xervmon Cost : <b style="color: #0088cc;font-size: 24px;"><span id="xervmon_cost"></span></b>/mo</h4>
						</div>
					</div>
				</div>
				<div>
					<h2>You Save : <b style="color: #0088cc;font-size: 36px;"><span id="you_save"> </span>/yr</b>&nbsp; that is <b style="color: #0088cc;font-size: 36px;"> <span id="you_save_percent"> </span>%</b></h2>
				</div>
			</div>

        <div class="clearfix"></div>
    </div><!-- end #nvr-portfolio -->
    
    <?php
	$nvr_infscrolls = ( $nvr_loadmore )? true : false;
	if( $nvr_infscrolls ){
	?>
	<div id="loadmore-paging">
	<div class="loadmorebutton"><?php next_posts_link( '<i class="fa fa-camera"></i>&nbsp; '.__( 'Load More', THE_LANG ) ); ?></div>
	</div>
	<?php
	}
	?>
              
    <?php /* Display navigation to next/previous pages when applicable */ ?>
    <?php if (  $wp_query->max_num_pages > 1 && !$nvr_infscrolls ) : ?>
     <?php if(function_exists('wp_pagenavi')) { ?>
         <?php wp_pagenavi(); ?>
     <?php }else{ ?>
        <div id="nav-below" class="navigation">
                <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Previous', THE_LANG ) ); ?></div>
                <div class="nav-next"><?php previous_posts_link( __( 'Next <span class="meta-nav">&rarr;</span>', THE_LANG ) ); ?></div>
        </div><!-- #nav-below -->
    <?php }?>
    <?php endif; wp_reset_query();?>
            
    <div class="clearfix"></div><!-- clear float -->
            <script src="<?php bloginfo('template_url'); ?>/js/Link.js"></script>
            <script src="http://cdnjs.cloudflare.com/ajax/libs/noUiSlider/6.2.0/jquery.nouislider.js"></script>
            <script src="<?php bloginfo('template_url'); ?>/js/script_roi.js"></script>
                      
<?php get_footer(); ?>
