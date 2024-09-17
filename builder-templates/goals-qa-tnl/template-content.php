<?php

/**
 * Template Content
 *
 * @package  hashimoto
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$anchor = '';
if (!empty(get_sub_field('anchor'))) {
  $anchor = 'id="' . esc_attr(get_sub_field('anchor')) . '" ';
}
$title = !empty(get_sub_field('title')) ? "<p class='goal-subfield-title'>" . get_sub_field('title') . "</p>" : "";
$content = get_sub_field('content');
$image = get_sub_field('image');
$buttons = get_sub_field('buttons'); ?>
<div class="content-goal" <?php echo $anchor; ?> data-src="<?php echo wp_get_attachment_url($image); ?>">
  <?php echo $title; ?>
  <?php echo $content;
  if (!empty($buttons) && count($buttons) > 0) { ?>
    <div class="content-goal__buttons">
      <?php foreach ($buttons as $key => $button) {
        $link = $button['button'];
        $link_url = $link['url'];
        $link_title = $link['title'];
        $link_target = $link['target'] ? $link['target'] : '_self'; ?>
        <a class="button <?php echo $button['class_button'] ?>" href="<?php echo esc_url($link_url); ?>"
          target="<?php echo esc_attr($link_target); ?>">
          <?php echo esc_html($link_title); ?>
        </a>
      <?php } ?>
    </div>
  <?php } ?>
  <?php echo my_custom_attachment_image($image); ?>
</div>