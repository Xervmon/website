jQuery(document).ready(function(){
	
	/*Add Class Js to html*/
	jQuery('html').addClass('js');	
	
	show_tab();
	
	show_toggle();
	
	toggle_menu();
	
	topcart_effects();
	
	topsearch_effects();
	
	show_socialicon();
	
	show_lightbox();
	
	show_carousel();
	
	form_styling();
	
	slider_init();
	
	fullwidthwrap();
	
	appear_effect();
	
	counter_effect();
	
	change_uberOrientation();
	
	new gnMenu( document.getElementById( 'gn-menu' ) );
});

jQuery(window).load(function(){
	header_effect();
	show_menu();
	isotopeinit();
	parallax_effect();
});

jQuery(window).resize(function(){
	isotopeinit();
	fullwidthwrap();
	change_uberOrientation();
	jQuery('ul.topnav').css('top','');
});

function isMobile(){
	"use strict";
	var onMobile = false;
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) { onMobile = true; }
	return onMobile;
}

function header_effect(){
	"use strict";
	/*=================================== TOPSEARCH ==============================*/
	var headertext = jQuery('#headertext');
	var outerheader = jQuery('#outerheader');
	var outerheaderw = jQuery('#outerheaderwrapper');
	var outerslider = jQuery('#outerslider');
	var wpadminbar = jQuery('#wpadminbar');
	
	var headertextheight = headertext.height();
	var headertextinnerh = headertext.innerHeight();
	var adminbarinnerh = wpadminbar.innerHeight();
	var outerheaderinnerh = outerheader.innerHeight();
	var outerheadertop = outerheader.css("top");
	var windowheight = jQuery(window).height();
	var headertextoffset = headertext.offset().top;
	var outerheaderoffset = outerheader.offset().top;
	
	/* Deprecated in 1.1.5
	if(jQuery('body').hasClass('nvrlayout3')){
		var outersliderv3 = jQuery('.nvrlayout3 #outerslider');
		var outersliderinnerh = outersliderv3.innerHeight();
		var outersliderheight = outersliderinnerh+adminbarinnerh;
		
		if(outersliderheight>windowheight){
			outersliderheight = windowheight-adminbarinnerh;
		}
		outersliderv3.css({
			'height' : outersliderheight
		});
	}
	*/
	
	if(jQuery('body').hasClass('nvrlayout4')!=true){
		outerheaderw.css('height',outerheaderinnerh);
	}
	
	headertext.css('height', headertextheight);
	jQuery(window).scroll(function(evt){
		var scrolltop = jQuery(document).scrollTop();
		
		if(jQuery('body').hasClass('nvrlayout4')){
			if(scrolltop>headertextinnerh){
				headertext.addClass("sticky");
				outerheader.addClass("sticky");
				outerslider.addClass("sticky");
			}else{
				headertext.removeClass("sticky");
				outerheader.removeClass("sticky");
				outerslider.removeClass("sticky");
			}
		}else{
			
			if(scrolltop>(outerheaderoffset)){
				outerheader.addClass("sticky");
			}else{
				outerheader.removeClass("sticky");
			}
		}
	});
}

function parallax_effect(){
	if(!isMobile()){
		jQuery('.parallax, .parallax-container').each(function(){
			jQuery(this).parallax("30%", 0.1);
		});
	}
}

function appear_effect(){
	"use strict";
	//Elements Fading
	jQuery('.element_from_top').each(function () {
		jQuery(this).appear(function() {
		  jQuery(this).delay(150).animate({opacity:1,top:"0px"},1000);
		});	
	});
	
	jQuery('.element_from_bottom').each(function () {
		jQuery(this).appear(function() {
		  jQuery(this).delay(150).animate({opacity:1,bottom:"0px"},1000);
		});	
	});
	
	
	jQuery('.element_from_left').each(function () {
		jQuery(this).appear(function() {
		  jQuery(this).delay(150).animate({opacity:1,left:"0px"},1000);
		});	
	});
	
	
	jQuery('.element_from_right').each(function () {
		jQuery(this).appear(function() {
		  jQuery(this).delay(150).animate({opacity:1,right:"0px"},1000);
		});	
	});
		
	jQuery('.element_fade_in').each(function () {
		jQuery(this).appear(function() {
		  jQuery(this).delay(150).animate({opacity:1,right:"0px"},1000);
		});	
	});
}

function show_menu(){
	"use strict";
	/*=================================== MENU ===================================*/
    jQuery("ul.sf-menu").supersubs({ 
    minWidth		: 12,		/* requires em unit. */
    maxWidth		: 15,		/* requires em unit. */
    extraWidth		: 0	/* extra width can ensure lines don't sometimes turn over due to slight browser differences in how they round-off values */
                           /* due to slight rounding differences and font-family */
    }).superfish();  /* 
						call supersubs first, then superfish, so that subs are 
                        not display:none when measuring. Call before initialising 
                        containing tabs for same reason. 
					 */
}

function change_uberOrientation(){
	"use strict";
	var winwidth = jQuery(window).width();
	if(jQuery('body').hasClass('nvrlayout4')){
		if(winwidth>1023){
			jQuery('#megaMenu').addClass('megaMenuVertical').removeClass('megaMenuHorizontal');
		}else{
			jQuery('#megaMenu').addClass('megaMenuHorizontal').removeClass('megaMenuVertical');
		}
	}
}

/* !Fullwidth wrap for shortcodes & templates */
function fullwidthwrap(){
	"use strict";
	if( jQuery(".nvr-fullwidthwrap").length && jQuery(".nosidebar").length ){
		jQuery(".nvr-fullwidthwrap").each(function(){
			var $_this = jQuery(this),
				offset_wrap = $_this.position().left;

				var $offset_fs;
				var $scrollBar = 0;
				var $paddingvc = 0;
				if($_this.parents('.wpb_row').length>0){
					$paddingvc = 30;
				}
			 	var containerwidth = jQuery('#outermain .container').width();
				var outerwidth = (jQuery('#outercontainer').width() - (jQuery('#outercontainer').width()%2));

				var paddingcol = parseInt(jQuery('.columns').css('padding-left'));

				if( jQuery('body').hasClass('boxed') ){
					$offset_fs = ((parseInt(outerwidth) - parseInt(containerwidth)) / 2);
				} else {
						var $windowWidth = (jQuery(window).width() <= parseInt(containerwidth)) ? parseInt(containerwidth) : jQuery(window).width();
						$offset_fs = Math.ceil( ((outerwidth + $scrollBar + $paddingvc - parseInt(containerwidth)) / 2) );
				};
				$_this.css({
					width: outerwidth,
					"margin-left": -$offset_fs
				});
		});
	};
};

function show_tab(){
	"use strict";
	/*jQuery tab */
	var pathurl = window.location.href.split("#tab");
	var deftab = "";
	
	jQuery(".tab-content").hide(); /* Hide all content */
	if(pathurl.length>1){ 
		deftab = "#"+pathurl[1];
		var pdeftab = jQuery("ul.tabs li a[href="+deftab+"]").parent().addClass("active").show();
		var tabcondeftab = ".tabcontainer "+deftab;
		jQuery(tabcondeftab).show();
	}else{
		jQuery("ul.tabs li:first").addClass("active").show(); /* Activate first tab */
		jQuery(".tab-content:first").show(); /* Show first tab content */
	}
	/* On Click Event */
	jQuery("ul.tabs li").click(function() {
		jQuery("ul.tabs li").removeClass("active"); /* Remove any "active" class */
		jQuery(this).addClass("active"); /* Add "active" class to selected tab */
		jQuery(".tab-content").hide(); /* Hide all tab content */
		var activeTab = jQuery(this).find("a").attr("href"); /* Find the rel attribute value to identify the active tab + content */
		jQuery(activeTab).fadeIn(200); /* Fade in the active content */
		return false;
	});
}

function toggle_menu(){
	"use strict";
	jQuery('a.nav-toggle').click(function(evt){
		var outerheader = jQuery('#outerheader');
		var outerheaderinnerh = outerheader.innerHeight();
		var topnavpos = outerheaderinnerh ;
		
		jQuery('.topnav').css('top', topnavpos);
		jQuery('.topnav').slideToggle('slow',function(){
			if(isMobile()){
				if(jQuery('.topnav').css('display')=='block'){
					jQuery('video.video').addClass('hidden');
				}else{
					jQuery('video.video').removeClass('hidden');
				}
			}
		});
		
		jQuery('.topnav li a').click(function(){
			jQuery('.topnav').slideUp('slow');
			jQuery('video.video').removeClass('hidden');
		});
	});
}

function show_toggle(){
	"use strict";
	/*jQuery toggle*/
	jQuery(".toggle_container").hide();
	var isiPhone = /iphone/i.test(navigator.userAgent.toLowerCase());
	if (isiPhone){
		jQuery("h2.trigger").click(function(){
			if( jQuery(this).hasClass("active")){
				jQuery(this).removeClass("active");
				jQuery(this).next().css('display','none');
			}else{
				jQuery(this).addClass("active");
				jQuery(this).next().css('display','block');
			}
		});
	}else{
		jQuery("h2.trigger").click(function(){
			jQuery(this).toggleClass("active").next().slideToggle("slow");
		});
	}
}

function counter_effect(){
	"use strict";
	//Animated Counters
	jQuery(".counters").appear(function() {
		var counter = jQuery(this).html();
		jQuery(this).countTo({
			from: 0,
			to: counter,
			speed: 2000,
			refreshInterval: 60,
		});
	});
}

function show_socialicon(){
	"use strict";
	/*=================================== SOCIAL ICON ===================================*/
	var socialicons = jQuery('ul.sn li a');
	socialicons.hover(
		function() {
			var iconimg = jQuery(this).children();
			iconimg.stop(true,true);
			iconimg.fadeOut(500);
		},
		function() {
			var iconimg = jQuery(this).children();
			iconimg.stop(true,true);
			iconimg.fadeIn(500);
		}
	);
	
	if (window.devicePixelRatio > 1) {

		socialicons.each(function(i) {
			var lowres = jQuery(this).css('background-image');
			var highres = lowres.replace(".png", "@2x.png");
			jQuery(this).css('background-image', highres);
		});
	}
}

function show_lightbox(){
	"use strict";
	/*=================================== PRETTYPHOTO ===================================*/
	jQuery('a[data-rel]').each(function() {jQuery(this).attr('rel', jQuery(this).data('rel'));});
	jQuery("a[rel^='prettyPhoto']").prettyPhoto({animationSpeed:'slow',gallery_markup:'',slideshow:2000});
}

function show_carousel(){
	"use strict";
	var ctype = {
		"pcarousel" : {
			"index" : '.pcarousel .flexslider-carousel, .postcarousel .flexslider-carousel',
			"minItems" : 2,
			"maxItems" : 5,
			"itemWidth" : 197
		},
		"bcarousel" : {
			"index" : '.brand .flexslider-carousel',
			"minItems" : 2,
			"maxItems" : 5,
			"itemWidth" : 197
		}
	}
	
	for(var key in ctype){
		var carousel = ctype[key];
		jQuery(carousel.index).flexslider({
			animation: "slide",
			animationLoop: true,
			directionNav: true,
			controlNav: false,
			prevText : '',
			nextText : '',
			itemWidth: carousel.itemWidth,
			itemMargin: 0,
			minItems: carousel.minItems,
			maxItems: carousel.maxItems
		 });
	}
}

function slider_init(){
	"use strict";
	var slidereffect 			= interfeis_var.slidereffect;
    var slider_interval 		= interfeis_var.slider_interval;
    var slider_disable_nav 		= interfeis_var.slider_disable_nav;
    var slider_disable_prevnext	= interfeis_var.slider_disable_prevnext;
    
    if(slider_disable_prevnext=="0"){
        var direction_nav = true;
    }else{
        var direction_nav = false;
    }
    
    if(slider_disable_nav=="0"){
        var control_nav = true;
    }else{
        var control_nav = false;
    }

    jQuery('.flexslider').flexslider({
        animation: slidereffect,
        slideshowSpeed: slider_interval,
        directionNav: direction_nav,
        controlNav: control_nav,
        smoothHeight: true,
		pauseOnHover: true,
		prevText : '',
		nextText : '',
		start : function(){
			jQuery('#slideritems').removeClass('preloader');
		}
    });
}

function isotopeinit(){
	"use strict";
	
	var pffilter = jQuery('#nvr-pf-filter');
    pffilter.isotope({
        itemSelector : '.element'
    });
	
	pffilter.infinitescroll({
		loading: {
			finishedMsg: interfeis_var.loadfinish,
			msg: null,
			msgText: interfeis_var.pfloadmore,
			img: interfeis_var.themeurl + 'images/pf-loader.gif'
		  },
			navSelector  : '#loadmore-paging',    // selector for the paged navigation 
			nextSelector : '#loadmore-paging .loadmorebutton a:first',  // selector for the NEXT link (to page 2)
			itemSelector : '.element',     // selector for all items you'll retrieve
			bufferPx: 40
		},
       	// call Isotope as a callback
		function ( newElements ) {

			var $newElems = jQuery( newElements ).css({ opacity: 0 });
			$newElems.imagesLoaded(function(){
				$newElems.animate({ opacity: 1 });
				pffilter.isotope( 'appended', $newElems, true );
				pffilter.isotope('reLayout');
				show_lightbox();
				jQuery('#loadmore-paging').css('display','block');
			});
		}
	);
	
	jQuery('#filters li').click(function(){
        jQuery('#filters li').removeClass('selected');
        jQuery(this).addClass('selected');
        var selector = jQuery(this).find('a').attr('data-option-value');
        pffilter.isotope({ filter: selector });
        return false;
    });
	
	var postisotope = jQuery('.postscontainer.mason').isotope({
		itemSelector : '.articlewrapper'
	});
	
	postisotope.infinitescroll({
		loading: {
			finishedMsg: interfeis_var.loadfinish,
			msg: null,
			msgText: interfeis_var.postloadmore,
			img: interfeis_var.themeurl + 'images/pf-loader.gif'
		  },
			navSelector  : '#loadmore-paging',    // selector for the paged navigation 
			nextSelector : '#loadmore-paging .loadmorebutton a:first',  // selector for the NEXT link (to page 2)
			itemSelector : '.articlewrapper',     // selector for all items you'll retrieve
			bufferPx: 40
		},
       	// call Isotope as a callback
		function ( newElements ) {
			
			slider_init();

			var $newElems = jQuery( newElements ).css({ opacity: 0 });
			$newElems.imagesLoaded(function(){
				$newElems.animate({ opacity: 1 });
				postisotope.isotope( 'appended', $newElems, true );
				postisotope.isotope('reLayout');
				jQuery('#loadmore-paging').css('display','block');
			});
		}
	);
	
	
	jQuery(window).unbind('.infscr');
	
	jQuery('#loadmore-paging .loadmorebutton a:first').click(function(evt){
		pffilter.infinitescroll('retrieve');
		postisotope.infinitescroll('retrieve');
		return false;
	});
	jQuery(document).ajaxError(function(e,xhr,opt){
		if(xhr.status==404){jQuery('#loadmore-paging a').remove();}
	});
}

function form_styling(){
	"use strict";
	/* Select */
	var selects = jQuery('select#cmbpostdomain');
	selects.wrap('<div class="nvr_selector" />');
	var selector = jQuery('.nvr_selector');
	selector.prepend('<span />');
	selector.each(function(){
		var selval = jQuery(this).find('select option:selected').text();
		var sel = jQuery(this).children('select');
		var selclass = sel.attr('class');
		jQuery(this).children('span').text(selval);
		jQuery(this).addClass(selclass);
		sel.css('width','100%');
		sel.change(function(){
			var selvals = jQuery(this).children('option:selected').text();
			jQuery(this).parent().children('span').text(selvals);
		});
	});
}

/*=================================== CUSTOM CART ===================================*/
function update_custom_cart(){
	"use strict";
	
	var the_cart = jQuery("#topminicart"),
		dropdown_cart = the_cart.find(".cartlistwrapper:eq(0)"),
		subtotal = the_cart.find('.cart_subtotal'),
		cart_widget = jQuery('.widget_shopping_cart');
		
		var new_subtotal = dropdown_cart.find('.total');
		new_subtotal.find('strong').remove();
		subtotal.html( new_subtotal.html() );
}

/*=================================== TOPCART ==============================*/
function topcart_effects(){
	"use strict";
	
	jQuery('body').bind('added_to_cart', update_custom_cart);
	
	var btncart = jQuery("#topminicart");
	var catcont = jQuery("#topminicart .cartlistwrapper");
	
	btncart.mouseenter(function(){
		catcont.stop().fadeIn(100,'easeOutCubic');
	});
	btncart.mouseleave(function(){
		catcont.stop().fadeOut(100,'easeOutCubic');
	});
}

function topsearch_effects(){
	"use strict";
	
	var btnsearch = jQuery('.searchbox .submit');
	var searcharea = jQuery('.searchbox .searcharea');
	var textsearch = jQuery('.searchbox .txtsearch');
	
	btnsearch.on('click', function(evt){
		if(textsearch.val()==''){
			evt.preventDefault();
			if(searcharea.hasClass('shown')){
				searcharea.removeClass('shown');
				searcharea.fadeOut();
			}else{
				searcharea.addClass('shown');
				searcharea.fadeIn();
			}
		}
	});
}