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
 *	[URL]/wp-admin/admin-ajax.php?action=b17-force-widgets
 */
function boston_2018_force_widgets() {
	$sidebars = get_option( 'sidebars_widgets' );

	$banner = array(
		'title' => '',
		'text' => '<p class="level-1">WordCamp Boston</p><p class="level-4">taking place at</p><p class="level-2">Boston University</p><p class="level-4">on</p><p class="level-3">July 22 &amp; 23</p><p class="level-5"><a href="#" class="cta-button">Get your ticket</a></p>',
		'filter' => false,
	);
	$twitter = array(
		'title' => 'Join the conversation!',
		'text' => '<a href="https://twitter.com/hashtag/wcbos" class="button">Tweet with #wcbos</a>',
		'filter' => true,
	);
	$sponsors = array(
		'title' => 'Sponsors',
	);
	$subscribe = [];

	$widget_text = array( 1 => $banner, 2 => $twitter, '_multiwidget' => 1 );
	$widget_sponsors = array( 1 => $sponsors, '_multiwidget' => 1 );
	$widget_subscription = array( 1 => $subscribe, '_multiwidget' => 1 );

	update_option( 'widget_text', $widget_text );
	update_option( 'widget_wcb_sponsors', $widget_sponsors );
	update_option( 'widget_mock_subscription_widget', $widget_subscription );

	$sidebars['header-1'] = [ 'text-1', 'mock_subscription_widget-1' ];
	$sidebars['header-2'] = [ 'text-2' ];
	$sidebars['sidebar-1'] = [ 'wcb_sponsors-1' ];

	update_option( 'sidebars_widgets', $sidebars );

	wp_die();
}
add_action( 'wp_ajax_b17-force-widgets', 'boston_2018_force_widgets' );
