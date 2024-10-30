<?php

/**
 * Two Col Img TNL Block template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or its parent block.
 */

// Load values and assign defaults.

$anchor = '';
if (!empty($block['anchor'])) {
  $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}
$left = get_field('left');
$right = get_field('right');
$image = get_field('image'); ?>
<!-- two-col-img start -->
<section class="two-col-img">
  <div class="container">
    <div class="two-col-img__left">
      <?php echo $left; ?>
    </div>
    <div class="two-col-img__right">
      <?php echo $right; ?>
    </div>
    <div class="two-col-img__image">
      <?php echo wp_get_attachment_image($image, 'full'); ?>
    </div>
  </div>
</section><!-- two-col-img end -->