<?php

/**
 * Science TNL Block template.
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
$items = get_field('items'); ?>

<!-- science-tnl start -->
<section class="science-tnl" <?php echo $anchor; ?>>
  <div class="container">
    <div class="science-tnl__content">
      <?php echo $content; ?>
    </div>
    <?php if (!empty($items) && count($items) > 0) { ?>
      <div class="science-tnl__items-wrap">
        <button id="prevScience" aria-label="Go to prev science slide"></button>
        <button id="nextScience" aria-label="Go to next science slide"></button>
        <div class="science-tnl__items-slider">
          <?php foreach ($items as $key => $item) {
            if (!empty($item['iamge'])) {
              $bg_color = !empty($item['bg_color']) ? "style='background-color: {$item['bg_color']}'" : "";
              $title = !empty($item['title']) ? "<p class='right__title'>{$item['title']}</p>" : ""; ?>
              <div class="science-tnl__items-slider_item">
                <div class="left">
                  <?php echo my_custom_attachment_image($item['iamge']) ?>
                </div>
                <div class="right" <?php echo $bg_color; ?>>
                  <?php echo $title;
                  echo $item['content']; ?>
                </div>
              </div>
          <?php }
          } ?>
        </div>
      </div>
    <?php } ?>
</section><!-- science-tnl end -->