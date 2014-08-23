<?php
/**
 * Loads up all the widgets defined by this theme. Note that this function will not work for versions of WordPress 2.7 or lower
 *
 */

/******************from framework******************/
include_once (THE_WIDGETPATH . 'nvr-recent-comment.php');
include_once (THE_WIDGETPATH . 'nvr-recent-posts.php');

add_action("widgets_init", "load_framework_widgets");

function load_framework_widgets() {
	register_widget("NVR_RecentCommentWidget");
	register_widget("NVR_RecentPostWidget");
}
