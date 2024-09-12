<?php

/**
 * Banner TNL Block template.
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
$content = get_field('content');
$bg_color = get_field('bg_color');
$image = get_field('image'); ?>
<!-- banner-tnl start -->
<section class="banner-tnl" <?php echo $anchor; ?>>
  <div class="banner-tnl__left" style="background-color: <?php echo $bg_color; ?>;">
    <div class="container">
      <?php echo $content; ?>
    </div>
  </div>
  <div class="banner-tnl__right" style="<?php echo 'background-image:url(' . wp_get_attachment_url($image) . ');'; ?>">
  </div>
</section><!-- banner-tnl end -->