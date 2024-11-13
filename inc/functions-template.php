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

add_filter('get_the_archive_title', function ($title) {
  if (is_category()) {
    $title = single_cat_title('', false);
  } elseif (is_tag()) {
    $title = single_tag_title('', false);
  } elseif (is_author()) {
    $title = '<span class="vcard">' . get_the_author() . '</span>';
  } elseif (is_post_type_archive()) {
    $title = post_type_archive_title('', false);
  } elseif (is_tax()) {
    $title = single_term_title('', false);
  }

  return $title;
});


//show category on archive page POST
function get_category_display()
{
  $args = array(
    'orderby'    => 'name',
    'order'      => 'ASC',
    'hide_empty' => false, // Set to true to hide categories without posts
  );

  // Retrieve categories
  $categories = get_categories($args);

  // Get the current category if on a category archive page
  $current_category = is_category() ? get_queried_object() : null;

  // Check if categories exist
  if (! empty($categories)) {
    echo '<ul class="custom-category-list">';
    foreach ($categories as $category) {
      if ($category->slug !== 'przepisy') {
        // Get the category link
        $category_link = get_category_link($category->term_id);

        // Determine if this category is the current category
        $active_class = '';
        if ($current_category && $category->term_id === $current_category->term_id) {
          $active_class = ' current-category';
        }

        // Output each category as a list item, adding the active class if applicable
        echo '<li class="' . esc_attr(trim($active_class)) . '">';
        echo '<a href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a>';
        echo '</li>';
      }
    }
    echo '</ul>';
  }
}
class AWP_Menu_Walker extends Walker_Nav_Menu {}
