<?php

/**
 * Banner Smpl CalcTNL Block template.
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
$choose_tag = get_field('choose_tag');
$title = !empty(get_field('title')) ? "<{$choose_tag}>" . get_field('title') . "</{$choose_tag}>" : "";
$image = get_field('image'); ?>
<!-- banner-calc-smpl-tnl start -->
<section class="banner-calc-smpl-tnl" style="background-image: url(<?php echo wp_get_attachment_url($image) ?>);">
  <div class="container">
    <div class="banner-calc-smpl-tnl__wrap">
      <?php echo $title; ?>
    </div>
    <a href="#" class="arrow-down"></a>
  </div>
</section><!-- banner-calc-smpl-tnl end -->