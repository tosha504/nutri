<?php

/**
 * The template for displaying home(archive)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bht-tnl
 */
get_header(); ?>
<main id="primary" class="site-main">
  <?php
  $cusstom_title = get_field('cusstom_title',  'options');
  $descr_posts = get_field('descr_posts', 'options');
  $image_banner = get_field('image_banner', 'options');

  if (!empty($cusstom_title) || !empty($descr_posts)) { ?>
    <!-- blog-banner start -->
    <section class="blog-banner" style="background-image: url(<?php echo wp_get_attachment_image_url($image_banner, 'full') ?>);">
      <div class="blog-banner__wrap">
        <h1><?php echo $cusstom_title; ?></h1>
        <?php echo $descr_posts; ?>

      </div>
      <?php get_category_display(); ?>
      <a href="#" class="arrow-down"></a>
    </section><!-- blog-banner end -->
  <?php } ?>
  <div class="container">
    <!-- current-symptoms start -->
    <?php
    if (have_posts()) : ?>
      <ul class="blog-posts__items">
        <?php
        while (have_posts()) :
          the_post();
          $trim_words = 20;
          $excerpt = wp_trim_words(get_the_excerpt(), $trim_words); ?>
          <li class="blog-posts__items_item item">
            <div class="item__image">
              <a href="<?php echo get_permalink(); ?>">
                <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'homepage-thumb');                ?>
              </a>
            </div>
            <div class="item__metadata">
              <a href="<?php echo get_category_link(get_the_category()[0]->term_id); ?>" class="art-cat <?php echo get_the_category()[0]->slug; ?>"> <?php echo get_the_category()[0]->name; ?></a>
              <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                <?php echo get_the_author(); ?>
              </a>
            </div>
            <div class="item__wrap">
              <a href="<?php echo get_permalink(); ?>">
                <h5><?php echo  get_the_title(); ?></h5>
              </a>
              <p class="descr"><?php echo $excerpt; ?></p>
            </div>
          </li>
      <?php
        endwhile;
      else :
        get_template_part('template-parts/content', 'none');
      endif; ?>
      </ul>
      <!-- Pagination Start -->
      <?php
      echo '<nav class="pagination" role="navigation" aria-label="Pagination Navigation">';
      // Display pagination links
      the_posts_pagination(array(
        'mid_size'  => 2, // Number of pages to show on either side of the current page
        'prev_text' => '«',
        'next_text' => '»',
        'screen_reader_text' => __('Posts navigation'),
      ));

      echo '</nav>';

      ?>
      <!-- Pagination End -->
  </div>

</main><!-- #main -->

<?php
get_footer();
