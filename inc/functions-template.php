<?php

/**
 * Custom functions
 *
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
function footer_templates()
{
  if (have_rows('footer_column_center', 'options')) {
    while (have_rows('footer_column_center', 'options')) {
      the_row();
      if (get_row_layout() == 'footer_links_menu') {
        get_template_part('builder-templates/footer-links-menu');
      } elseif (get_row_layout() == 'footer_content_menu') {
        get_template_part('builder-templates/footer-content-menu');
      }
    }
  }
}


function my_custom_attachment_image($attachment_id)
{
  echo wp_get_attachment_image($attachment_id, 'full', false, ['alt' => get_post_meta($attachment_id, '_wp_attachment_image_alt', true), 'loading' => 'lazy', 'title' => get_the_title($attachment_id)]);
}

function create_button($link, $class_btn)
{
  $link_url = $link['url'];
  $link_title = $link['title'];
  $link_target = $link['target'] ? $link['target'] : '_self'; ?>
  <a class="<?php echo $class_btn ?>" href="<?php echo esc_url($link_url); ?>"
    target="<?php echo esc_attr($link_target); ?>">
    <?php echo esc_html($link_title); ?>
  </a>
<?php
}
