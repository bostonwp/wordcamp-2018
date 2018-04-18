<?php
/**
 * Enqueue the parent theme's styles.
 * You can leave this out if you're replacing the parent theme's CSS.
 */
function boston_2018_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', false, time() );
}
add_action( 'wp_enqueue_scripts', 'boston_2018_styles' );

/**
 * Turn on "new" features for this local site. New features are enabled based on time of site
 * creation, approximated based on ID number in the wordcamp.org network. That doesn't map to
 * local sites, so there is difference in markup for some features if we don't whitelist the ID.
 *
 * Change this to the Site ID of your local development site (though it will likely be 47 if
 * this is the first additional site you've created)
 */
function boston_2018_enable_features( $sites ) {
	$sites[] = 47;
	$sites[] = 48;
	return $sites;
}
add_filter( 'wcpt_speaker_post_avatar_enabled_site_ids',       'boston_2018_enable_features' );
add_filter( 'wcpt_session_post_speaker_info_enabled_site_ids', 'boston_2018_enable_features' );
add_filter( 'wcpt_session_post_slides_info_enabled_site_ids',  'boston_2018_enable_features' );
add_filter( 'wcpt_session_post_video_info_enabled_site_ids',   'boston_2018_enable_features' );
add_filter( 'wcpt_speaker_post_session_info_enabled_site_ids', 'boston_2018_enable_features' );

require_once __DIR__ . '/mock-widget-subscriptions.php';

/**
 * Force-set some widgets by visiting
 *	[URL]/wp-admin/admin-ajax.php?action=b18-force-widgets
 */
function boston_2018_force_widgets() {
	$sidebars = []; //get_option( 'sidebars_widgets' );

	$banner = array(
		'title' => '',
		'content' =>
			'<div class="level-1">Two days of WordPress design, development, marketing, content, and business.</div>' .
			'<div class="level-2"><strong>July 21&ndash;22<sup>nd</sup> 2018</strong><br />Boston University</div>',
		'filter' => false,
	);
	$actions = array(
		'title' => '',
		'content' =>
			'<a href="#" class="button">Register</a>' .
			'<a href="#" class="button">Volunteer</a>' .
			'<a href="#" class="button">Speak</a>',
		'filter' => false,
	);
	$sponsors = array(
		'title' => 'Platinum Sponsors',
	);
	$inner_actions = array(
		'title' => '',
		'content' =>
			'<div class="label">Looking for speakers!</div>' .
			'<div class="action"><a href="#" class="button">Apply to speak</a></div>',
		'filter' => false,
	);
	$subscribe = [];

	$widget_text = array( 1 => $banner, 2 => $actions, 3 => $inner_actions, '_multiwidget' => 1 );
	$widget_sponsors = array( 1 => $sponsors, '_multiwidget' => 1 );
	$widget_subscription = array( 1 => $subscribe, '_multiwidget' => 1 );

	update_option( 'widget_custom_html', $widget_text );
	update_option( 'widget_wcb_sponsors', $widget_sponsors );
	update_option( 'widget_mock_subscription_widget', $widget_subscription );

	$sidebars['before-content-homepage-1'] = [ 'custom_html-1', 'custom_html-2' ];
	$sidebars['footer-1'] = [ 'mock_subscription_widget-1' ];
	$sidebars['sidebar-1'] = [ 'custom_html-3', 'wcb_sponsors-1' ];

	update_option( 'sidebars_widgets', $sidebars );

	wp_die();
}
add_action( 'wp_ajax_b18-force-widgets', 'boston_2018_force_widgets' );
