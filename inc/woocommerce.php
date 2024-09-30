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
    <p class="custom-sidebar-shop__title"><?php _e('FILTRY', 'hashimoto'); ?></p>
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
  $product_id = $product->get_id();
  // Get all product tags (terms)
  $tags = wp_get_post_terms($product_id, 'product_tag');

  // Loop through each tag
  if (! empty($tags) && ! is_wp_error($tags)) {
    echo '<ul class="product__wrap-body_tags">';
    foreach ($tags as $tag) {
      echo '<li><a href="' . get_term_link($tag->term_id) . '">' . esc_html($tag->name) . '</a></li>'; // Output the tag name
    }
    echo '</ul>';
  }
}

// Hook into WooCommerce loop to display tags after product title
add_action('woocommerce_shop_loop_item_title', function () {
  echo '<div class="product__wrap-body_title">';
}, 9);
add_action('woocommerce_after_shop_loop_item_title', function () {
  echo '</div>';
}, 6);


add_action('woocommerce_after_shop_loop_item_title', 'display_product_tags_on_shop_page', 15);


// remove
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

//content-product
function custom_display_star_rating($product_id)
{
  // Get the product
  $product = wc_get_product($product_id);
  // Check if the product has a rating
  if (! $product || ! $product->get_average_rating()) {
    return;
  }
  // Get the average rating and round it to the nearest half star
  $average = round($product->get_average_rating() * 2) / 2;
  // Custom HTML for star rating
  echo '<div class="custom-star-rating">';
  // Loop to display full stars, half stars, and empty stars
  for ($i = 1; $i <= 5; $i++) {
    if ($i <= $average) {
      echo '<span class="star full-star">&#9733;</span>'; // Full star
    } elseif ($i - 0.5 == $average) {
      echo '<span class="star half-star">&#9733;</span>'; // Half star
    } else {
      echo '<span class="star empty-star">&#9734;</span>'; // Empty star
    }
  }

  echo '</div>';
}
