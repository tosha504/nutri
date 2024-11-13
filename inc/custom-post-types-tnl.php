<?php

/**
 * Custom post types for theme.
 *
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
function register_post_types()
{
  register_post_type('goals-tnl', array(
    'label' => 'Cele',
    'public' => true,
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
    'rewrite' => array('slug' => 'cele'),
    'show_in_rest' => true,
    'menu_icon' => 'dashicons-universal-access',
  ));

  register_post_type('megamenu-tnl', array(
    'label' => 'Mega menu',
    'public' => true,
    'supports' => array('title', 'custom-fields'),
    'show_in_rest' => false,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_icon'           => 'dashicons-editor-ol',
    'can_export'          => true,
    'has_archive'         => false,
    'exclude_from_search' => true,
    'publicly_queryable'  => false,
    'capability_type'     => 'post',
  ));
}
add_action('init', 'register_post_types');

// display shortcode
add_filter('walker_nav_menu_start_el', function ($item_output, $item) {

  if (!is_object($item) || !isset($item->object)) {
    return $item_output;
  }

  $shortcode = get_field('shortcode_menu', $item->ID);
  if ($shortcode) {
    $item_output = $item_output . do_shortcode($shortcode);
  }
  return $item_output;
}, 20, 2);


//add class to item menu
function my_wp_nav_menu_objects($items, $args)
{

  foreach ($items as &$item) {
    $shortcode = get_field('shortcode_menu', $item);
    if ($shortcode) {
      $item->classes[] = 'is-megamenu';
    }
  }
  return $items;
}
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

//add column with shorcode
function add_mege_menu_columns($columns)
{
  $column_meta = array('megamenu_tnl' => 'shortcode');
  $columns = array_slice($columns, 0, 6, true) + $column_meta + array_slice($columns, 6, NULL, true);
  return $columns;
}

function mega_menu_columns($column)
{
  global $post;
  switch ($column) {

    case 'megamenu_tnl':
      $hits = '[megamenu_tnl id="';
      $hits .= $post->ID;
      $hits .= '"]';
      echo $hits;
      break;
  }
}

add_filter('manage_megamenu-tnl_posts_columns',  'add_mege_menu_columns');
add_action('manage_posts_custom_column', 'mega_menu_columns');

//mega-menu construct
function megamenu_tnl($atts, $content = null)
{
  $atts = shortcode_atts(
    array(
      'id'  => '',
    ),
    $atts
  );
  if ($atts['id']) {
    $html = mega_menu_display($atts['id']);
  }
  return $html;
}
add_shortcode('megamenu_tnl', 'megamenu_tnl');


//mega-menu-shortcode
function mega_menu_display($id)
{
  ob_start();
?>
  <div class="mega_menu">
    <div class="container">
      <?php
      if (have_rows('menu_mm', $id)) {
      ?>
        <div class="megaMenu" style="display: flex;">
          <div class="megaMenu__menu-mg">
            <?php
            $key_link = 0;
            while (have_rows('menu_mg', $id)) {
              the_row();
              $key_link++;
              $primary_link_g = get_sub_field('primary_link_mg');
              if ($primary_link_g) {
                $primary_link_url = $primary_link_g['url'];
                $primary_link_title = $primary_link_g['title'];
                $primary_link_target = $primary_link_g['target'] ? $primary_link_g['target'] : '_self';  ?>

                <a class="megaMenu__menu-mg_link <?php echo $key_link == 1 ? ' active' : ''; ?>" data-key-link="<?php echo $key_link; ?>" href="<?php echo esc_url($primary_link_url); ?>" target="<?php echo esc_attr($primary_link_target); ?>">
                  <?php echo esc_html($primary_link_title); ?>
                </a>
            <?php }
            } ?>
          </div>
          <div class="megaMenu__menu-mm">
            <?php
            $key = 0;
            while (have_rows('menu_mm', $id)) {
              the_row();
              $key++;
              repeat_megamenu($key);
            }
            mega_menu_adds($id);
            $addsp = get_field('products_to_show', $id);
            if (!empty($addsp) &&  get_field('display_adddp', $id) == true) {
              echo '<div class="megaMenu__menu-mm_wrap">
              <p class="weight-title">NAJPOPULARNIEJSZE</p>';
              echo '<ul class="megaMenu__menu-mm_products products">';
              foreach ($addsp as $key => $pr) {
                echo "<li><a href='" . get_permalink($pr->ID) . "'>" . get_the_post_thumbnail($pr->ID, 'thumbnail') . "
                <p>{$pr->post_title}</p>
                </a></li>";
              }
              echo '</ul></div>';
            }
            ?>
          </div>
        </div>
      <?php
      }  ?>
    </div>
  </div>
  <?php

  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}


function mega_menu_adds($id)
{
  $adds = get_field('adds_mm', $id);
  if ($adds && get_field('display_addds', $id) == true) {
    $image_ads_mm = $adds['image_ads_mm']; ?>
    <div class="megaMenu__adds">
      <?php
      if ($image_ads_mm) echo wp_get_attachment_image($image_ads_mm, 'full');
      ?>
    </div>
  <?php
  }
}

function repeat_megamenu($key)
{
  $description = get_sub_field('description'); ?>
  <div class="megaMenu__item <?php echo $key == 1 ? ' active' : ''; ?>" data-key="<?php echo $key ?>">
    <div class="megaMenu__item_submenu" style="position :relative">
      <?php
      if ($description) echo '<p class="megaMenu__item_submenu-description weight-title" >' . $description . '</p>';

      if (have_rows('submenu_mm')) {
        echo '<ul class="megaMenu__item_submenu-list">';
        while (have_rows('submenu_mm')) {
          the_row();
          $sublink = get_sub_field('link_submenu_mm');
          if ($sublink) {
            $sublink_url = $sublink['url'];
            $sublink_title = $sublink['title'];
            $sublink_target = $sublink['target'] ? $sublink['target'] : '_self';
            $sublink_style = get_sub_field('style_as_a_button') ? 'btn btn-primary' : ''; ?>
            <li>
              <a class="megaMenu__item--submenu__list--item <?php echo $sublink_style ?>" href="<?php echo esc_url($sublink_url); ?>" target="<?php echo esc_attr($sublink_target); ?>">
                <?php echo esc_html($sublink_title); ?>
              </a>
            </li>
      <?php
          }
        }
        echo '</ul>';
      }
      ?>
    </div>
  </div>
<?php
}
