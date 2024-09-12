<?php

/**
 * Difference TNL Block template.
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
$difference_items = get_field('difference_items'); ?>
<!-- difference-tnl start -->
<section class="difference-tnl" <?php echo $anchor; ?>>
  <div class="container">
    <div class="difference-tnl__content">
      <?php echo $content; ?>
    </div>
    <?php if (!empty($difference_items) && count($difference_items) > 0) {
    ?>
      <div class="difference-tnl__items">
        <?php foreach ($difference_items as $key => $item) {
        ?>
          <div class="difference-tnl__items_item">
            <?php
            echo wp_get_attachment_image($item['icon'], 'full');
            echo '<p>' . $item['text'] . '</p>'; ?>
          </div>

        <?php } ?>
      </div>
    <?php } ?>
  </div>
</section><!-- difference-tnl end -->