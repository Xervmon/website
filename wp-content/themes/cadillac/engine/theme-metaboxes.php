<?php 

$nvr_shortname = THE_SHORTNAME;
$nvr_initial = THE_INITIAL;

global $wpdb;

$nvr_optsidebar = array(
	$nvr_shortname . "-sidebar" => "Sidebar", 
);
$nvr_optionsidebarval = get_option( $nvr_shortname . '_sidebar');
	if(is_array($nvr_optionsidebarval)){
		
		foreach($nvr_optionsidebarval as $ids => $val){
			$nvr_optsidebar[$ids] = $val;
		}
		
	}


/* Option */
$nvr_optonoff = array(
	'true' => 'On',
	'false' => 'Off'
);

$nvr_optslidertype = array(
	'flexslider' => 'Flexslider',
	'layerslider' => 'LayerSlider'
);

$nvr_optlayout = array(
	'' => 'Default',
	'left' => 'Left',
	'right' => 'Right'
);

$nvr_optbloglayout = array(
	'' => 'Default',
	'3col-masonry' => 'Masonry 3 Columns',
	'2col-masonry' => 'Masonry 2 Columns'
);

$nvr_opttextalign = array(
	'left' => 'Left',
	'right' => 'Right'
);

$nvr_optslidertextalign = array(
	'top' => 'Top',
	'left' => 'Left',
	'right' => 'Right'
);

$nvr_optpcolumns = array(
	'' => 'Default',
	'classic-2-space' => 'Classic Two Columns',
	'classic-3-space' => 'Classic Three Columns',
	'classic-4-space' => 'Classic Four Columns',
	'masonry-3-space' => 'Masonry Three Columns with space',
	'masonry-4-space' => 'Masonry Four Columns with space',
	'masonry-5-space' => 'Masonry Five Columns with space',
	'masonry-3-nospace' => 'Masonry Three Columns with no space',
	'masonry-4-nospace' => 'Masonry Four Columns with no space',
	'masonry-5-nospace' => 'Masonry Five Columns with no space',
	'grid-3-space'	=> 'Grid Three Columns with space',
	'grid-4-space'	=> 'Grid Four Columns with space',
	'grid-5-space'	=> 'Grid Five Columns with space',
	'grid-3-nospace'	=> 'Grid Three Columns with no space',
	'grid-4-nospace'	=> 'Grid Four Columns with no space',
	'grid-5-nospace'	=> 'Grid Five Columns with no space'
);

$nvr_optpcontainer = array(
	'' => 'Default',
	'nvr-fullwidthwrap' => '100% Full-Width'
);

$nvr_optpitemtype = array(
	'' => 'Default',
	'square' => 'Square',
	'portrait' => 'Portrait',
	'landscape' => 'Landscape'
);

$nvr_optarrange = array(
	'ASC' => 'Ascending',
	'DESC' => 'Descending'
);

$nvr_optbgrepeat = array(
	'' => 'Default',
	'repeat' => 'repeat',
	'no-repeat' => 'no-repeat',
	'repeat-x' => 'repeat-x',
	'repeat-y' => 'repeat-y'
);

$nvr_optbgattch = array(
	'' => 'Default',
	'scroll' => 'scroll',
	'fixed' => 'fixed'
);

$nvr_imagepath =  get_template_directory_uri() . '/images/backendimage/';
$nvr_optlayoutimg = array(
	'default' => $nvr_imagepath.'mb-default.png',
	'one-col' => $nvr_imagepath.'mb-1c.png',
	'two-col-left' => $nvr_imagepath.'mb-2cl.png',
	'two-col-right' => $nvr_imagepath.'mb-2cr.png'
);
// Create meta box slider
global $nvr_meta_boxes;
$nvr_meta_boxes = array();

$nvr_meta_boxes[] = array(
	'id' => 'post-option-meta-box',
	'title' => __('Post Options',THE_LANG),
	'page' => 'post',
	'showbox' => 'meta_option_show_box',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Layout',THE_LANG),
			'desc' => '<em>'.__('Select the layout you want on this specific post/page. Overrides default site layout.',THE_LANG).'</em>',
			'options' => $nvr_optlayoutimg,
			'id' => '_'.$nvr_initial.'_layout',
			'type' => 'selectimage',
			'std' => ''
		),
		array(
			'name' => __('External URL',THE_LANG),
			'desc' => '<em>'.__('Input your external link in here. if you use "Link" format.',THE_LANG).'</em>',
			'id' => '_'.$nvr_initial.'_external_url',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => __('Audio File URL',THE_LANG),
			'desc' => '<em>'.__('Input your audio file URL in here. ',THE_LANG).'</em>',
			'id' => '_'.$nvr_initial.'_audio_url',
			'type' => 'textarea',
			'std' => ''
		),
		array(
			'name' => __('Video File URL / Video Link',THE_LANG),
			'desc' => '<em>'.__('Input your video file URL or video link like youtube or vimeo in here. ',THE_LANG).'</em>',
			'id' => '_'.$nvr_initial.'_video_url',
			'type' => 'textarea',
			'std' => ''
		)
	)
);


$nvr_meta_boxes[] = array(
	'id' => 'page-option-meta-box',
	'title' => __('Page Options',THE_LANG),
	'page' => 'page',
	'showbox' => 'meta_option_show_box',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Layout',THE_LANG),
			'desc' => '<em>'.__('Select the layout you want on this specific post/page. Overrides default site layout.',THE_LANG).'</em>',
			'options' => $nvr_optlayoutimg,
			'id' => '_'.$nvr_initial.'_layout',
			'type' => 'selectimage',
			'std' => ''
		),
		array(
			'name' => __('Background Color Maincontent',THE_LANG),
			'desc' => '<em>'.__('Input the hexcolor in this textbox if you want to change the background color of your content.',THE_LANG).'</em>',
			'id' => 'bg_color_maincontent',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => __('Page Description',THE_LANG),
			'desc' => '<em>'.__('Input your own page description here.',THE_LANG).'</em>',
			'id' => '_'.$nvr_initial.'_pagedesc',
			'type' => 'text',
			'std' => ''
		)
	)
);

$nvr_meta_boxes[] = array(
	'id' => 'page-sidebar-meta-box',
	'title' => __('Sidebar Option',THE_LANG),
	'page' => 'page',
	'showbox' => 'meta_option_show_box',
	'context' => 'side',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Registered Sidebar',THE_LANG),
			'desc' => '<em>'.__('Please choose the sidebar for this page',THE_LANG).'</em>',
			'options' => $nvr_optsidebar,
			'id' => '_'.$nvr_initial.'_sidebar',
			'type' => 'select',
			'std' => ''
		)
	)
);

$nvr_meta_boxes[] = array(
	'id' => 'page-slider-option-meta-box',
	'title' => __('Page Slider Options',THE_LANG),
	'page' => 'page',
	'showbox' => 'meta_option_show_box',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Enable Slider',THE_LANG),
			'desc' => '<em>'.__('Choose \'On\' if you want to show the slider.',THE_LANG).'</em>',
			'id' => 'enable_slider',
			'type' => 'select',
			'options' => $nvr_optonoff,
			'std' => 'false'
		),
		array(
			'name' => __('Slider Category',THE_LANG),
			'desc' => '<em>'.__('You need to select the slider category to make the slider works.',THE_LANG).'</em>',
			'id' => 'slider_category',
			'type' => 'select-slider-category',
			'std' => ''
		),
		array(
			'name' => __('External Slider Shortcode',THE_LANG),
			'desc' => '<em>'.__('You can put the layerslider or revolution slider shortcode in here. It will overwrite the slider category.',THE_LANG).'</em>',
			'id' => 'slider_layerslider',
			'type' => 'text',
			'std' => ''
		)
	)
);

$nvr_meta_boxes[] = array(
	'id' => 'page-blog-option-meta-box',
	'title' => __('Page Blog Options',THE_LANG),
	'page' => 'page',
	'showbox' => 'meta_option_show_box',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Blog Categories',THE_LANG),
			'desc' => '<em>'.__('You need to tick the blog categories to make the template blog works.',THE_LANG).'</em>',
			'id' => 'blog_category',
			'type' => 'checkbox-blog-categories',
			'std' => ''
		),
		array(
			'name' => __('Blog Type',THE_LANG),
			'desc' => '<em>'.__('Choose the type of the blog that you want to show.',THE_LANG).'</em>',
			'id' => 'blog_layout',
			'type' => 'select',
			'options' => $nvr_optbloglayout,
			'std' => ''
		),
		array(
			'name' => __('Use Infinite Scrolls?',THE_LANG),
			'desc' => '<em>'.__('Choose \'On\' if you want to use infinite scrolls.',THE_LANG).'</em>',
			'id' => 'blog_infscrolls',
			'type' => 'select',
			'options' => $nvr_optonoff,
			'std' => 'false'
		)
	)
);

$nvr_meta_boxes[] = array(
	'id' => 'page-portfolio-option-meta-box',
	'title' => __('Page Portfolio Options',THE_LANG),
	'page' => 'page',
	'showbox' => 'meta_option_show_box',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Portfolio Type',THE_LANG),
			'desc' => '<em>'.__('Select the type of your portfolio.',THE_LANG).'</em>',
			'id' => 'p_type',
			'type' => 'select',
			'options' => $nvr_optpcolumns,
			'std' => '3'
		),
		array(
			'name' => __('Portfolio Container',THE_LANG),
			'desc' => '<em>'.__('Select the type of container for your portfolio.',THE_LANG).'</em>',
			'id' => 'p_container',
			'type' => 'select',
			'options' => $nvr_optpcontainer,
			'std' => ''
		),
		array(
			'name' => __('Portfolio Categories',THE_LANG),
			'desc' => '<em>'.__('Select more than one portfolio category to make the portfolio filter works.',THE_LANG).'</em>',
			'id' => 'p_categories',
			'type' => 'checkbox-portfolio-categories',
			'std' => ''
		),
		array(
			'name' => __('Use Auto Load More?',THE_LANG),
			'desc' => '<em>'.__('Tick this checkbox if you want to use a Load More functionality.',THE_LANG).'</em>',
			'id' => 'p_loadmore',
			'type' => 'checkbox',
			'std' => ''
		),
		array(
			'name' => __('Portfolio Showposts',THE_LANG),
			'desc' => '<em>'.__('Input the number of portfolio items that you want to show per page.',THE_LANG).'</em>',
			'id' => 'p_showpost',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => __('Portfolio Order By',THE_LANG),
			'desc' => '<em>'.__('(optional). Sort retrieved portfolio items by parameter. Defaults to \'date\'',THE_LANG).'</em>',
			'id' => 'p_orderby',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => __('Portfolio Order',THE_LANG),
			'desc' => '<em>'.__('(optional). Designates the ascending or descending order of the \'Portfolio Order By\' parameter. Defaults to \'DESC\'.',THE_LANG).'</em>',
			'id' => 'p_sort',
			'type' => 'text',
			'std' => ''
		)
	)
);

$nvr_meta_boxes[] = array(
	'id' => 'portfolio-option-meta-box',
	'title' => __('Portfolio Options',THE_LANG),
	'page' => 'portofolio',
	'showbox' => 'meta_option_show_box',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Layout',THE_LANG),
			'desc' => '<em>'.__('Select the layout you want on this specific post/page. Overrides default site layout.',THE_LANG).'</em>',
			'options' => $nvr_optlayoutimg,
			'id' => '_'.$nvr_initial.'_layout',
			'type' => 'selectimage',
			'std' => ''
		),
		array(
			'name' => __('Image Size',THE_LANG),
			'desc' => '<em>'.__('Select the image size for your portfolio item.',THE_LANG).'</em>',
			'options' => $nvr_optpitemtype,
			'id' => '_'.$nvr_initial.'_pimgsize',
			'type' => 'select',
			'std' => ''
		),
		array(
			'name' => __('Custom Thumbnail',THE_LANG),
			'desc' => '<em>'.__('(optional). You can input the custom image URL to override the \'Set Featured Image\'',THE_LANG).'</em>',
			'id' => 'custom_thumb',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => __('External Link',THE_LANG),
			'desc' => '<em>'.__('(optional). You can input the URL if you want to link the portfolio item to another website.',THE_LANG).'</em>',
			'id' => 'external_link',
			'type' => 'text',
			'std' => ''
		)
	)
);

$nvr_meta_boxes[] = array(
	'id' => 'people-option-meta-box',
	'title' => __('People Options',THE_LANG),
	'page' => 'peoplepost',
	'showbox' => 'meta_option_show_box',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('People Information',THE_LANG),
			'desc' => '<em>'.__('Input your own people post information here.',THE_LANG).'</em>',
			'id' => '_'.$nvr_initial.'_people_info',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => __('Pinterest Link',THE_LANG),
			'desc' => '<em>'.__('Input your own people post information here.',THE_LANG).'</em>',
			'id' => '_'.$nvr_initial.'_people_pinterest',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => __('Facebook Link',THE_LANG),
			'desc' => '<em>'.__('Input the people facebook link in here.',THE_LANG).'</em>',
			'id' => '_'.$nvr_initial.'_people_facebook',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => __('Twitter Link',THE_LANG),
			'desc' => '<em>'.__('Input the people facebook link in here.',THE_LANG).'</em>',
			'id' => '_'.$nvr_initial.'_people_twitter',
			'type' => 'text',
			'std' => ''
		)
	)
);

$nvr_meta_boxes[] = array(
	'id' => 'testimonial-option-meta-box',
	'title' => __('Testimonial Options',THE_LANG),
	'page' => 'testimonialpost',
	'showbox' => 'meta_option_show_box',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Testimonial Information',THE_LANG),
			'desc' => '<em>'.__('Input your own testimonial post information here.',THE_LANG).'</em>',
			'id' => '_'.$nvr_initial.'_testi_info',
			'type' => 'text',
			'std' => ''
		)
	)
);

$nvr_meta_boxes[] = array(
	'id' => 'brand-option-meta-box',
	'title' => __('Brand Options',THE_LANG),
	'page' => 'brand',
	'showbox' => 'meta_option_show_box',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('External Link',THE_LANG),
			'desc' => '<em>'.__('Input the external link for your brand post in here. (optional)',THE_LANG).'</em>',
			'id' => 'external_link',
			'type' => 'text',
			'std' => ''
		)
	)
);

$nvr_meta_boxes[] = array(
	'id' => 'slider-option-meta-box',
	'title' => __('Slider Options',THE_LANG),
	'page' => 'slider-view',
	'showbox' => 'meta_option_show_box',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('External Link',THE_LANG),
			'desc' => '<em>'.__('(optional). You can input the URL if you want to link the slider image to another website.',THE_LANG).'</em>',
			'id' => 'external_link',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => __('Custom Image URL',THE_LANG),
			'desc' => '<em>'.__('(optional). You can input the custom image URL to override the \'Set Featured Image\'',THE_LANG).'</em>',
			'id' => 'image_url',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => __('Text Align',THE_LANG),
			'desc' => '<em>'.__('Select the text align for your text slider.',THE_LANG).'</em>',
			'id' => 'text_align',
			'type' => 'select',
			'options' => $nvr_optslidertextalign,
			'std' => 'top'
		)
	)
);

$nvr_meta_boxes[] = array(
	'id' => 'product-option-meta-box',
	'title' => __('Product Options',THE_LANG),
	'page' => 'product',
	'showbox' => 'meta_option_show_box',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Layout',THE_LANG),
			'desc' => '<em>'.__('Select the layout you want on this specific post/page. Overrides default site layout.',THE_LANG).'</em>',
			'options' => $nvr_optlayoutimg,
			'id' => '_'.$nvr_initial.'_layout',
			'type' => 'selectimage',
			'std' => ''
		)
	)
);
?>