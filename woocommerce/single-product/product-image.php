<?php

/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.0.0
 */

defined('ABSPATH') || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if (!function_exists('wc_get_gallery_image_html')) {
  return;
}

global $product;

$columns = apply_filters('woocommerce_product_thumbnails_columns', 4);
$post_thumbnail_id = $product->get_image_id();
$attachment_ids = $product->get_gallery_image_ids();

$wrapper_classes = apply_filters(
  'woocommerce_single_product_image_gallery_classes',
  array(
    'woocommerce-product-gallery',
    'woocommerce-product-gallery--' . ($post_thumbnail_id ? 'with-images' : 'without-images'),
    'woocommerce-product-gallery--columns-' . absint($columns),
    'images',
  )
); ?>
<div class="slider-product-wrap">
  <div class="slider-product-wrap__show">
    <?php
    if ($post_thumbnail_id) {
      echo '<div>';
      echo wp_get_attachment_image($post_thumbnail_id, 'full');
      echo '</div>';
    }
    foreach ($attachment_ids as $attachment_id) {
      echo '<div>';
      echo wp_get_attachment_image($attachment_id, 'full');
      echo '</div>';
    }
    ?>
  </div>

  <?php if ($attachment_ids && $product->get_image_id()) { ?>
    <div class="slider-product-wrap__slider">
      <?php
      if ($post_thumbnail_id) {
        echo '<div>';
        echo wp_get_attachment_image($post_thumbnail_id, 'full');
        echo '</div>';
      }
      foreach ($attachment_ids as $attachment_id) {
        echo '<div>';
        echo wp_get_attachment_image($attachment_id, 'full');
        echo '</div>';
      }
      ?>
    </div>
  <?php } ?>


</div>