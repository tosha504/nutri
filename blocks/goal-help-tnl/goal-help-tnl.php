<?php

/**
 * Goal Help TNL Block template.
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
$items = get_field('items');  ?>
<!-- goal-help-tnl start -->
<section class="goal-help-tnl" <?php echo $anchor; ?>>
  <div class="container">
    <?php echo $content;
    if (!empty($items) && count($items) > 0) { ?>
      <div class="goal-help-tnl__items">
        <?php foreach ($items as $key => $item) { ?>
          <div class="goal-help-tnl__items_item" style=" background:linear-gradient(0deg, rgba(60, 0, 0, 0), rgba(60, 0, 0, 0)), url(<?php echo wp_get_attachment_url($item['bg_image']); ?>)no-repeat center/cover;">
            <?php echo "<p class='title-help'>{$item['title']}</p>"; ?>
            <?php echo "{$item['descr']}"; ?>
            <div class="goal-help-tnl__items_item-buttons">
              <?php
              foreach ($item['butons'] as $key => $button) {
                if (!empty($button['button'])) {
                  $link_url = $button['button']['url'];
                  $link_title = $button['button']['title'];
                  $link_target = $button['button']['target'] ? $button['button']['target'] : '_self'; ?>
                  <a class="button button__white" href="<?php echo esc_url($link_url); ?>"
                    target="<?php echo esc_attr($link_target); ?>">
                    <?php echo esc_html($link_title); ?>
                  </a>
              <?php }
              } ?>
            </div>
          </div>
        <?php } ?>
      </div>
    <?php } ?>
  </div>
</section><!-- goal-help-tnl end -->