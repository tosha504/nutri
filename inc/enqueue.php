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

		if (!wp_script_is("wc-cart-fragments", "enqueued") && wp_script_is("wc-cart-fragments", "registered")) {
			// Enqueue the wc-cart-fragments script
			wp_enqueue_script("wc-cart-fragments");
		}

		if (is_checkout() || is_checkout()) {
			wp_enqueue_script('checkout_script', get_template_directory_uri() . ('/src/add_quantity.js'), array(), false, true);
			$localize_script = array(
				'ajax_url' => admin_url('admin-ajax.php')
			);
			wp_localize_script('checkout_script', 'add_quantity', $localize_script);
		}

		wp_localize_script('start_functions', 'localizedObject', [
			'ajaxurl' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('ajax_nonce'),
		]);

		// Custom css


		wp_enqueue_style('external-url-fonts', 'https://use.typekit.net/rzw3kqz.css');
		wp_enqueue_style('slick-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css', false);
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
	if (in_array($handle, ['external-url-fonts', 'google-font-playfair'])) {
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

add_action('wp_ajax_update_order_review', 'update_order_review');
add_action('wp_ajax_nopriv_update_order_review', 'update_order_review');
function update_order_review()
{
	WC()->cart->cart_contents[$_POST['key']]['quantity'] = $_POST['qty'];
	WC()->cart->calculate_totals();
	var_dump('sdfsf');
	$cart_fragments = apply_filters('woocommerce_add_to_cart_fragments', false);
	echo json_encode($cart_fragments);
	// woocommerce_cart_totals();

	wp_die();
}

function implement_ajax_apply_coupon()
{
	global $woocommerce;
	$code = filter_input(INPUT_POST, 'coupon_code', FILTER_DEFAULT);

	if (empty($code) || !isset($code)) {
		$response = array(
			'result'    => 'error',
			'message'   => 'Code text field can not be empty.'
		);

		header('Content-Type: application/json');
		echo json_encode($response);
		exit();
	}

	$coupon = new WC_Coupon($code);

	if (!$coupon->id && !isset($coupon->id)) {
		$response = array(
			'result'    => 'error',
			'message'   => 'Invalid code entered. Please try again.'
		);

		header('Content-Type: application/json');
		echo json_encode($response);
		exit();
	} else {
		if (!empty($code) && !WC()->cart->has_discount($code)) {
			WC()->cart->add_discount($code);
			$response = array(
				'result'    => 'success',
				'message'   => 'successfully added coupon code'
			);

			header('Content-Type: application/json');
			echo json_encode($response);
			exit();
		}
	}
}

add_action('wp_ajax_ajaxapplucoupon', 'implement_ajax_apply_coupon');
add_action('wp_ajax_nopriv_ajaxapplucoupon', 'implement_ajax_apply_coupon');
