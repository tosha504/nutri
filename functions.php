<?php

/**
 * start functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package hashimoto
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function start_setup()
{
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on start, use a find and replace
	 * to change 'start' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('hashimoto', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-header' => esc_html__('Header menu', 'hashimoto'),
			'menu-right-header' => esc_html__('Header right menu', 'hashimoto'),
			'menu-top-header' => esc_html__('Header top menu', 'hashimoto'),
			'mobile-header' => esc_html__('Mobile menu', 'hashimoto'),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'start_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height' => 250,
			'width' => 250,
			'flex-width' => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'start_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function start_content_width()
{
	$GLOBALS['content_width'] = apply_filters('start_content_width', 640);
}
add_action('after_setup_theme', 'start_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function start_widgets_init()
{
	register_sidebar(
		array(
			'name' => esc_html__('Sidebar', 'hashimoto'),
			'id' => 'sidebar-1',
			'description' => esc_html__('Add widgets here.', 'hashimoto'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action('widgets_init', 'start_widgets_init');

/**
 * Disable Gutenberg
 */
// add_filter('use_block_editor_for_post', '__return_false');

// Theme includes directory.
$realestate_inc_dir = 'inc';

// Array of files to include.
$realestate_includes = array(
	'/functions-template.php',  // 	Theme custom functions
	'/enqueue.php',				//	Enqueue scripts and styles.
	'/custom-header.php',		//	Implement the Custom Header feature.
	'/customizer.php',			//	Customizer additions.
	'/template-tags.php',		// 	Custom template tags for this theme.
	'/template-functions.php',	//	Functions which enhance the theme by hooking into WordPress.
	'/acf-block-register.php',
	'/install-plugin-formthis-theme.php',
	'/custom-post-types-tnl.php',
);

// Load WooCommerce functions if WooCommerce is activated.
if (class_exists('WooCommerce')) {
	$realestate_includes[] = '/woocommerce.php';
}

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Include files.
foreach ($realestate_includes as $file) {
	require_once get_theme_file_path($realestate_inc_dir . $file);
}

require_once dirname(__FILE__) . '/inc/class-tgm-plugin-activation.php';

/**
 * Make ACF Options
 */
function my_register_acf_options_pages()
{
	// Check function exists to safely use ACF functions
	if (function_exists('acf_add_options_page')) {
		// Register the options page
		$option_page = acf_add_options_page(array(
			'page_title'    => 'General settings',
			'menu_title'    => 'General settings',
			'menu_slug'     => 'theme-general-settings',
			'capability'    => 'edit_posts',
			'redirect'      => false
		));

		$option_page_header = acf_add_options_page([
			'page_title' => 'Header settings',
			'menu_title' => 'Header settings',
			'menu_slug' => 'theme-header-settings',
			'capability' => 'edit_posts',
			'icon_url' => 'dashicons-admin-settings',
			'redirect' => false
		]);

		$option_page_footer = acf_add_options_page([
			'page_title' => 'Footer settings',
			'menu_title' => 'Footer settings',
			'menu_slug' => 'theme-footer-settings',
			'capability' => 'edit_posts',
			'icon_url' => 'dashicons-admin-settings',
			'redirect' => false
		]);

		// Optionally check if the options page was added successfully

	}
}

// Hook into 'init'
add_action('acf/init', 'my_register_acf_options_pages');

function acf_json_save_point()
{
	return get_template_directory() . '/acf-json';
}

function acf_json_load_point($paths)
{
	unset($paths[0]);
	$paths[] = get_template_directory() . '/acf-json';
	return $paths;
}
function acf_json_change_field_group($group)
{
	$groups = array(
		'group_64dcb34c9db9a',
		'group_64dcb34c9db9a__trashed',
		'group_64dc8b9fc1e74',
		'group_64dc8b9fc1e74__trashed',
		'group_64e30cbb90836',
		'group_64e30cbb90836__trashed',

	);
	if (in_array($group['key'], $groups)) {
		add_filter('acf/settings/save_json', array('acf_json_save_point'));
	}
	return $group;
}

add_action('acf/update_field_group', 'acf_json_change_field_group');
add_action('acf/trash_field_group', 'acf_json_change_field_group');
add_action('acf/untrash_field_group', 'acf_json_change_field_group');
add_filter('acf/settings/load_json', 'acf_json_load_point');
//svg
function cc_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

define('ALLOW_UNFILTERED_UPLOADS', true);

function fix_svg_thumb_display()
{
	echo
	'<style>
		td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail {
			width: 100% !important;
			height: auto !important;
		}
	</style>';
}
add_action('widgets_init', 'register_my_widgets');
function register_my_widgets()
{

	register_sidebar([
		'name' => 'The left sidebar of the shop',
		'id' => 'left-sidebar',
		'description' => 'These widgets will be shown in the left column of the site',
		'before_title' => '<h2>',
		'after_title' => '</h2>'
	]);
}


add_image_size('homepage-thumb', 640, 400, true);


function customize_homepage_main_query($query)
{
	// Ensure we're modifying the main query on the home page in the frontend
	if ($query->is_home() && $query->is_main_query() && ! is_admin()) {
		$query->set('category__not_in', [91]);
	}
}
add_action('pre_get_posts', 'customize_homepage_main_query');

// functions.php or include a separate file for the walker class

class WP_Bootstrap_Mega_Menu_Walker extends Walker_Nav_Menu
{

	// Start Level
	function start_lvl(&$output, $depth = 0, $args = array())
	{

		$indent = str_repeat("\t", $depth);
		$submenu = ($depth > 0) ? ' sub-menu' : ' mega-menu-dropdown';
		$output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
	}

	// Start Element
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
	{
		$indent = ($depth) ? str_repeat("\t", $depth) : '';
		$li_attributes = '';
		$classes = empty($item->classes) ? array() : (array) $item->classes;
		// echo "<pre>";
		// var_dump($item);
		// echo "</pre>";
		// Check if the item has children
		$has_children = in_array('menu-item-has-children', $classes);

		$classes[] = 'menu-item-' . $item->ID;
		if ($has_children) {
			$classes[] = 'dropdown';
		}

		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
		$class_names = ' class="' . esc_attr($class_names) . '"';

		$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
		$id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names . $li_attributes . '>';

		$atts = array();
		$atts['title']  = ! empty($item->attr_title) ? $item->attr_title : '';
		$atts['target'] = ! empty($item->target)     ? $item->target     : '';
		$atts['rel']    = ! empty($item->xfn)        ? $item->xfn        : '';
		$atts['href']   = ! empty($item->url)        ? $item->url        : '';

		if ($has_children && $depth === 0) {
			$atts['class']       = 'dropdown-toggle';
			$atts['data-toggle'] = 'dropdown';
			$atts['aria-haspopup'] = 'true';
			$atts['aria-expanded'] = 'false';
		}

		$atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);

		$attributes = '';
		foreach ($atts as $attr => $value) {
			if (! empty($value)) {
				$value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$title = apply_filters('the_title', $item->title, $item->ID);
		$title = apply_filters('nav_menu_item_title', $title, $item, $args);

		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . $title . $args->link_after;
		if ($has_children && $depth === 0) {
			$item_output .= ' <span class="caret"></span>';
		}
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}

	// End Element
	function end_el(&$output, $item, $depth = 0, $args = array())
	{
		$output .= "</li>\n";
	}
}
