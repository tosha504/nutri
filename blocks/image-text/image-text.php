<?php

/**
 * Image Text TNL Block template.
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
} ?>
<section class="image-text-section">
  <div class="container">
    <?php if (have_rows('additional_info')) { ?>
      <div class="image-text">
        <?php while (have_rows('additional_info')) {
          the_row();
          if (get_row_layout() == 'image') {
            get_template_part('builder-templates/product-add-info-template/template-iamge');
          } elseif (get_row_layout() == 'text_content') {
            get_template_part('builder-templates/product-add-info-template/template-text-content');
          }
        } ?>
      </div>
    <?php } ?>
  </div>
</section>