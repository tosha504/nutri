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
if (!empty($content_of)) { ?>
  <div class="content-of-tnl" <?php echo $anchor; ?>>
    <?php echo $content_of; ?>
  </div>
<?php  }
