<?php

/**
 * Symptoms TNL Block template.
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
$symptoms_items = get_field('symptoms_items'); ?>
<!-- symptoms-tnl start -->
<section class="symptoms-tnl" <?php echo $anchor; ?>>
  <div class="container">
    <div class="symptoms-tnl__content">
      <?php echo $content;
      if (!empty($symptoms_items) && count($symptoms_items) > 0) { ?>
        <div class="symptoms-tnl__items">
          <?php foreach ($symptoms_items as $key => $item) {
            $link = $item["link"];
            if ($link) {
              $link_url = $link['url'];
              $link_title = $link['title'];
              $link_target = $link['target'] ? $link['target'] : '_self';
              $background = !empty($item['image']) ? 'style="background: url(' . wp_get_attachment_url($item['image'], 'full') . ') no-repeat top/cover"' : ''; ?>
              <div class="symptoms-tnl__items_item" <?php echo $background; ?>>
                <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                  <?php echo '<p class="sub-title">' . $item['title'] . '</p>'; ?>
                </a>
              </div>
          <?php }
          }  ?>
        </div>
      <?php } ?>
    </div>
  </div>
</section><!-- symptoms-tnl end -->