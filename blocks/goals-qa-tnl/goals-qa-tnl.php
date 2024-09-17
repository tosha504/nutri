<?php

/**
 * Goals QA TNL Block template.
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
$left_links = get_field('left_links'); ?>
<!-- goals-qa-tnl start -->
<section class="goals-qa-tnl" <?php echo $anchor; ?>>
  <div class="container">
    <div class="goals-qa-tnl__left">
      <div class="sticky">

        <img id="mainImage" src="http://nutri.local/wp-content/uploads/2024/09/Rectangle-29.jpg" alt="Image" />
        <?php
        if (!empty($left_links) && count($left_links) > 0) { ?>
          <div class="goals-qa-tnl__left_wrap">
            <img src="<?php echo get_template_directory_uri() . '/assets/icons/goal-nutri-logo.svg' ?>" alt="goal-nutri-logo" loading="lazy">
            <div class="goals-qa-tnl__left_wrap-links">
              <?php foreach ($left_links as $key => $left_link) {
                $link = $left_link["link"];
                if ($link) {
                  $link_url = $link['url'];
                  $link_title = $link['title'];
                  $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                  <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                    <?php echo $link_title; ?>
                  </a>
              <?php }
              } ?>

            </div>
          </div>
        <?php } ?>
      </div>
    </div>
    <div class="goals-qa-tnl__right">
      <?php
      if (have_rows('right')) {
        while (have_rows('right')) {
          the_row();
          if (get_row_layout() == 'template_content') {
            get_template_part('builder-templates/goals-qa-tnl/template-content');
          }
        }
      }
      ?>
    </div>
  </div>
</section><!-- goals-qa-tnl end -->