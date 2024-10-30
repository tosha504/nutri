<?php

/**
 * Team TNL Block template.
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
$autors_tnl = get_field('autors_tnl');
?>
<!-- title-and-descr start -->
<section class="team-tnl">
  <div class="container">
    <?php echo $content;
    if (!empty($autors_tnl) && count($autors_tnl) > 0) { ?>
      <div class="team-tnl__autors">
        <?php foreach ($autors_tnl as $key => $autor_tnl) {
          $avatar = get_field('avatar', "user_{$autor_tnl}"); ?>
          <div class="team-tnl__autors_item">
            <?php
            if (!empty($avatar)) {
              echo '<a href="' .  get_author_posts_url(get_the_author_meta('id', $autor_tnl)) . '">' . wp_get_attachment_image($avatar) .
                '</a>';
            }
            echo  '<p><a href="' .  get_author_posts_url(get_the_author_meta('id', $autor_tnl)) . '">' .
              get_the_author_meta('display_name', $autor_tnl) .
              '</a></p>'; ?>
          </div>
        <?php  } ?>
      </div>
    <?php } ?>
  </div>
</section>
<!-- title-and-descr end -->