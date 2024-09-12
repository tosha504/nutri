<?php

/**
 * Theme enqueue scripts and styles.
 *
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
if (!function_exists('start_scripts')) {
	function start_scripts()
	{
		$theme_uri = get_template_directory_uri();
		// Custom JS
		//if slick
		wp_register_script('slick_theme_functions', $theme_uri . '/libery/slick.min.js', [], '1.0', true);
		// Enqueue the script
		wp_enqueue_script('slick_theme_functions', ['jquery'], 1.0, true);
		wp_enqueue_script('start_functions', $theme_uri . '/src/index.js', ['jquery'], 1.0, true);

		wp_localize_script('start_functions', 'localizedObject', [
			'ajaxurl' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('ajax_nonce'),
		]);

		// Custom css
		wp_enqueue_style('external-url-fonts', 'https://use.typekit.net/rzw3kqz.css');
		wp_enqueue_style('google-font-playfair', 'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap', false);
		wp_enqueue_style('start_style', $theme_uri . '/src/index.css', [], 1.0);

		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
	}
}
add_action('wp_enqueue_scripts', 'start_scripts',);

// Add preload links for enqueued styles
add_filter('style_loader_tag', function ($html, $handle, $href, $media) {
	if (in_array($handle, ['external-url-fonts', 'google-font-playfair', 'start_style'])) {
		return '<link rel="preload" href="' . esc_url($href) . '" as="style" onload="this.rel=\'stylesheet\'">' . "\n";
	}
	return $html;
}, 10, 4);

// Add preload attribute to the slick script
add_filter('script_loader_tag', function ($tag, $handle, $src) {
	if ('slick_theme_functions' === $handle) {
		// Add the preload attribute
		return '<link rel="preload" href="' . esc_url($src) . '" as="script">' . "\n" . $tag;
	}
	return $tag;
}, 10, 3);

function custom_block_theme_acf_enqueue_scripts()
{
	$theme_uri = get_template_directory_uri();
	//if slick
	// wp_register_script('slick_theme_functions', $theme_uri . '/libery/slick.min.js', [], '1.0', true);
	if (has_block('acf/health-goal-tnl', get_queried_object_id())) {
		wp_enqueue_script('health-goal-tnl', get_template_directory_uri() . "/blocks/health-goal-tnl/health-goal-tnl.js", array(), '1.0.0', true);
	}

	if (has_block('acf/science-tnl', get_queried_object_id())) {
		wp_enqueue_script('science-tnl', get_template_directory_uri() . "/blocks/science-tnl/science-tnl.js", array(), '1.0.0', true);
	}
}
add_action('wp_enqueue_scripts', 'custom_block_theme_acf_enqueue_scripts');
add_action('admin_enqueue_scripts', 'custom_block_theme_acf_enqueue_scripts');
