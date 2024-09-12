<?php

/**
 * About Block template.
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
$image = get_field('image');


// $class_name = 'banner';
// if (!empty($block['className'])) {
//   $class_name .= ' ' . $block['className'];
// }
// if (!empty($block['align'])) {
//   $class_name .= ' align' . $block['align'];
// }<?php echo get_block_wrapper_attributes();
// style="background-color: <?php echo $bg_color  . '; background-image:url(' . wp_get_attachment_url($image)
?>

<section class="banner-tnl">
  <div class="banner-tnl__contant">
    <div class="container">
      <?php echo $content; ?>
    </div>
  </div>
  <div class="image">
    <?php echo wp_get_attachment_image($image, 'full'); ?>
  </div>
</section>