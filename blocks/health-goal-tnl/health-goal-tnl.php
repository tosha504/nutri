<?php

/**
 * Health Goal TNL Block template.
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
$items = get_field('items');
$buttons = get_field('buttons');
?>

<!-- health-goal-tnl start -->
<section class="health-goal-tnl" <?php echo $anchor; ?>>
  <div class="container">
    <div class="health-goal-tnl__content">
      <?php echo $content; ?>
    </div>
    <?php if (!empty($buttons) && count($buttons) > 0) { ?>
      <div class="health-goal-tnl__buttons">
        <?php foreach ($buttons as $key => $button) {
          $link = $button['button'];
          if ($link) {
            echo create_button($link, 'button button__primary');
          }
        } ?>
      </div>
    <?php } ?>
    <?php if (!empty($items) && count($items) > 0) { ?>
      <div class="health-goal-tnl__items-wrap">
        <button id="prev" aria-label="Go to prev slide"></button>
        <button id="next" aria-label="Go to next slide"></button>
        <div class="health-goal-tnl__items-slider">
          <?php foreach ($items as $key => $item) {
            $id_goal = $item->ID;
            $icon = get_field('icon', $id_goal);
            $goal = get_field('goal',  $id_goal); ?>
            <a href="<?php echo get_permalink($id_goal); ?>" class="health-goal-tnl__items-slider_item" style="background-image:url(<?php echo wp_get_attachment_url($icon); ?>);">
              <?php echo '<p>' .  $goal . '</p>'; ?>
            </a>
          <?php } ?>
        </div>
      </div>
    <?php } ?>
  </div>
</section><!-- health-goal-tnl end -->