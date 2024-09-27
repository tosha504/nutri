<?php
defined('ABSPATH') || exit;

add_action('after_setup_theme', 'bht_tnl_add_woocommerce_support', 99);
if (!function_exists('bht_tnl_add_woocommerce_support')) {
  /**
   * Declares WooCommerce theme support.
   */

  function bht_tnl_add_woocommerce_support()
  {
    add_theme_support('woocommerce');
    // add_theme_support('woocommerce');
    // array(
    //   'thumbnail_image_width' => 250,
    //   'single_image_width'    => 170,
    // );
    // Add Product Gallery support.

    // add_theme_support('wc-product-gallery-lightbox');
    // remove_theme_support('wc-product-gallery-zoom');
    // add_theme_support('wc-product-gallery-slider');
  }
}
remove_theme_support('wc-product-gallery-zoom');
remove_theme_support('wc-product-gallery-lightbox');
remove_theme_support('wc-product-gallery-slider');
//Remove actions bht
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
add_filter('woocommerce_enqueue_styles', '__return_false');



add_filter('woocommerce_sale_flash', '__return_null');
add_action('customize_register', 'remove_woocommerce_catalog_columns', 20);

function remove_woocommerce_catalog_columns($wp_customize)
{
  // Remove the control for catalog columns
  $wp_customize->remove_control('woocommerce_catalog_columns');
}
add_action('woocommerce_before_shop_loop',  function () {
  if (is_active_sidebar('left-sidebar')) {
    echo '<div class="products-wrap-tnl">';
  };
}, 40);
add_action('woocommerce_after_shop_loop',  function () {
  if (is_active_sidebar('left-sidebar')) {
    echo '</div>';
  };
}, 5);


add_action('woocommerce_before_shop_loop', function () { ?>
  <aside class="custom-sidebar-shop">
    <p><?php _e('FILTRY', 'hashimoto'); ?></p>
    <ul>
      <?php dynamic_sidebar('left-sidebar'); ?>
    </ul>
  </aside>
<?php
}, 40);

// Function to display product tags on the shop page
function display_product_tags_on_shop_page()
{
  global $product;

  // Get product tags
  $product_tags = get_the_term_list($product->get_id(), 'product_tag', '', ', ');

  if ($product_tags) {
    echo '<div class="product-tags">' . $product_tags . '</div>';
  }
}

// Hook into WooCommerce loop to display tags after product title
add_action('woocommerce_after_shop_loop_item_title', 'display_product_tags_on_shop_page', 15);
