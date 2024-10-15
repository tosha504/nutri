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
$iamge = get_sub_field('image_img');
if (!empty($iamge)) { ?>
  <div class="image-img-tnl" <?php echo $anchor; ?>>
    <?php echo my_custom_attachment_image($iamge); ?>
  </div>
<?php  }
