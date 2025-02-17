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

add_action('woocommerce_after_shop_loop_item', 'display_product_tags_on_shop_page', 11);

add_action('woocommerce_before_cart', function () {
  echo '<div class="container">';
}, 9);
add_action('woocommerce_before_cart', function () {
  echo '</div >';
}, 11);

add_action('woocommerce_cart_is_empty', function () {
  echo '<div class="container">';
}, 1);
add_action('woocommerce_cart_is_empty', function () {
  echo '</div >';
}, 11);

//SINGLE-PAGE
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);


add_action('woocommerce_single_product_summary', 'display_product_tags_on_shop_page', 5);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 15);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 25);
add_action('woocommerce_single_product_summary', 'product_feature', 28);
add_action('woocommerce_single_product_summary', 'delivery_tnl_single_product', 32);
add_action('woocommerce_single_product_summary', 'package_tnl', 29);
function package_tnl()
{
  $packages = get_field('packages');
  if (!empty($packages) && count($packages) > 0) {
  ?>
    <div class="packegaes">
      <?php foreach ($packages as $key => $package) {
        // var_dump($package['text'], $package['choose_product'][0]);
        $prod_id = $package['choose_product'][0]->ID;
        $product = wc_get_product($prod_id); ?>
        <a href="<?php echo get_permalink($prod_id); ?>">
          <?php echo $package['text'];
          ?> <p class="price"><span class="woocommerce-Price-amount amount"><bdi><?php echo $product->get_price(); ?>&nbsp;<span class="woocommerce-Price-currencySymbol">&#122;&#322;</span></bdi></span></p></a>
      <?php } ?>
    </div>
  <?php }
}
function product_feature()
{
  $product_feature = get_field('product_feature', get_the_ID());
  if (!empty($product_feature) && count($product_feature) > 0) { ?>
    <div class="product-feature">
      <?php foreach ($product_feature as $key => $feature) { ?>
        <div class="product-feature__item">
          <?php echo wp_get_attachment_image($feature['icon'], 'full'); ?>
          <p><?php echo $feature['name']; ?></p>
        </div>
      <?php } ?>
    </div>
  <?php }
}

function delivery_tnl_single_product()
{
  $delivery = get_field('delivery', get_the_ID());
  if (!empty($delivery) && count($delivery) > 0) { ?>
    <div class="product-delivery">
      <?php foreach ($delivery as $key => $delivery_item) { ?>
        <div class="product-delivery__item">
          <?php echo wp_get_attachment_image($delivery_item['icon'], 'full'); ?>
          <p><?php echo $delivery_item['descr']; ?></p>
        </div>
      <?php } ?>
    </div>
  <?php }
}

//archive-page
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
add_action('woocommerce_shop_loop_header', function () {
  $banner_image = !empty(get_field('banner_image', 'options')) ? 'background-image:url(' . wp_get_attachment_url(get_field('banner_image', 'options')) . ')' : 'background:red;';
  $descr = !empty(get_field('descr', 'options')) ? '<p class="shop-banner-tnl__descr">' . get_field('descr', 'options') . '</p>' : ''; ?>
  <div class="shop-banner-tnl">
    <div class="container" style="<?php echo $banner_image; ?>">
      <?php echo '<h1>' . get_the_archive_title() . '</h1>';
      echo $descr ?>
    </div>

  </div>
<?php
}, 11);

add_action('woocommerce_shop_loop_header', function () {
?>
  <div class="container">
    <h2>Wszystkie produkty</h2>
  </div>
<?php
}, 15);


//quantity field
add_action('woocommerce_before_quantity_input_field', function () {
  echo '<button class="cart-qty minus">-</button>';
});

add_action('woocommerce_after_quantity_input_field', function () {
  echo '<button class="cart-qty plus">+</button>';
});

//CART
// remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
// add_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 15);
remove_action('woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10);
add_action('woocommerce_before_cart_collaterals', 'woocommerce_cart_totals');


// CHECKOUT
// Display cross-sell products on checkout page
add_action('woocommerce_review_order_after_submit', 'add_cross_sells_to_checkout', 99);

function add_cross_sells_to_checkout()
{
  $cross_sells = WC()->cart->get_cross_sells();
  if (empty($cross_sells)) {
    return;
  }
  $args = array(
    'post_type' => 'product',
    'posts_per_page' => 31,
    'post__in' => $cross_sells,
    'orderby' => 'rand'
  );
  $products = new WP_Query($args);
  if ($products->have_posts()) {
    echo '<div class="cross-sell-products">';
    echo '<h3>' . __('You may also like...', 'hashimoto') . '</h3>';
    echo '<ul class="products shop-tnl">';
    while ($products->have_posts()) {
      $products->the_post();
      wc_get_template_part('content', 'product');
    }
    echo '</ul>';
    echo '</div>';
  }

  // Reset post data
  wp_reset_postdata();
}

remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);
add_action('custom_payment_position', 'woocommerce_checkout_payment', 20);

add_action('woocommerce_before_checkout_form', function () {
  echo '<div class="container">';
}, 1);

add_action('woocommerce_after_checkout_form', function () {
  echo '</div>';
}, 1);

add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment($fragments)
{
  global $woocommerce;

  ob_start(); ?>
  <a href="<?php echo wc_get_cart_url(); ?>">
    <span class="count">
      <?php echo sprintf($woocommerce->cart->cart_contents_count); ?>
    </span></a>
  <?php
  $fragments['li.cart-header a'] = ob_get_clean();
  ob_start();



  return $fragments;
}

add_filter('woocommerce_update_order_review_fragments', 'filter_update_order_review_fragments');
function filter_update_order_review_fragments($fradments)
{
  ob_start();
  if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) :
  ?>
    <div class="ajax-shipp-method">
      <?php do_action('woocommerce_review_order_before_shipping'); ?>

      <?php wc_cart_totals_shipping_html(); ?>

      <?php do_action('woocommerce_review_order_after_shipping'); ?>
    </div>
  <?php
  endif;

  $fradments['.ajax-shipp-method'] = ob_get_clean();

  return $fradments;
}

add_filter('woocommerce_cross_sells_total', 'bbloomer_change_cross_sells_product_no');
function bbloomer_change_cross_sells_product_no($columns)
{
  return 3;
}

add_action('wp_footer', 'cart_update_qty_script');
function cart_update_qty_script()
{
  if (is_checkout()) :
  ?>
    <script>
      let timeout;
      jQuery('.checkout.woocommerce-checkout').on('change', 'input.qty', function() {
        if (timeout !== undefined) {
          clearTimeout(timeout);
        }
        timeout = setTimeout(function() {
          jQuery('.cart-qty.plus, .minus').attr('disabled', true) // trigger cart update
        }, 100); // 1 second delay, half a second (500) seems comfortable too
        // jQuery(document.body).trigger('wc_fragment_refresh');
        setTimeout(function() {
          jQuery(document.body).trigger('wc_fragment_refresh'); // Refresh the cart fragments
        }, 1000);
      });
    </script>
<?php
  endif;
}
