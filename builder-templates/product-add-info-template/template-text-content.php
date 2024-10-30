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

$content_of = get_sub_field('content_of');
$color = !empty(get_sub_field('color')) ? "style='background: " . get_sub_field('color') . "'" : "";
if (!empty($content_of)) { ?>
  <div class="content-of-tnl"
    <?php echo $anchor;
    echo $color; ?>>
    <?php echo $content_of; ?>
  </div>
<?php  }
