<?php

/**
 * Consultation TNL Block template.
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
<!-- consultation-tnl1 start -->
<section class="consultation-tnl1" <?php echo $anchor; ?>>
  consultation-tnl1
</section><!-- consultation-tnl1 end -->