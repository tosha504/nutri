<?php

/**
 * Custom post types for theme.
 *
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
function register_post_types()
{
  register_post_type('goals-tnl', array(
    'label' => 'Cele',
    'public' => true,
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
    'rewrite' => array('slug' => 'cele'),
    'show_in_rest' => true,
    'menu_icon' => 'dashicons-universal-access',
  ));
}
add_action('init', 'register_post_types');
