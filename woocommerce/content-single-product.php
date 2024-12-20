<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
  echo get_the_password_form(); // WPCS: XSS ok.
  return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
  <div class="container">
    <div class="product-top-data">
      <?php
      /**
       * Hook: woocommerce_before_single_product_summary.
       *
       * @hooked woocommerce_show_product_sale_flash - 10
       * @hooked woocommerce_show_product_images - 20
       */
      do_action('woocommerce_before_single_product_summary');
      $tabs_items = [];
      $product_composition = !empty(get_field('product_composition')) ? ['question_title' => 'Skład produktu', 'answer' => get_field('product_composition')] : null;
      $usage = !empty(get_field('usage')) ? ['question_title' => 'Sposób użycia', 'answer' => get_field('usage')] : null;
      $information_leaflet = !empty(get_field('information_leaflet')) ? ['question_title' => 'Ulotka informacyjna', 'answer' => get_field('information_leaflet')] : null;

      if ($product_composition) {
        $tabs_items[] = $product_composition;
      }
      if ($usage) {
        $tabs_items[] = $usage;
      }
      if ($information_leaflet) {
        $tabs_items[] = $information_leaflet;
      } ?>
      <script>
        jQuery(document).on('click', '.question', function(e) {
          if (jQuery(this).parent().siblings().children('div.answer').is(':visible')) {
            jQuery(this).parent().siblings().children('.question').children('button').removeClass('active')
            jQuery(this).parent().siblings().children('div.answer').slideUp(200);
          }
          jQuery(this).children('button').toggleClass('active')
          jQuery(this).siblings('div.answer').slideToggle(200)

        })
      </script>
      <div class="summary entry-summary">

        <?php
        /**
         * Hook: woocommerce_single_product_summary.
         *
         * @hooked woocommerce_template_single_title - 5
         * @hooked woocommerce_template_single_rating - 10
         * @hooked woocommerce_template_single_price - 10
         * @hooked woocommerce_template_single_excerpt - 20
         * @hooked woocommerce_template_single_add_to_cart - 30
         * @hooked woocommerce_template_single_meta - 40
         * @hooked woocommerce_template_single_sharing - 50
         * @hooked WC_Structured_Data::generate_product_data() - 60
         */
        do_action('woocommerce_single_product_summary');
        ?>
      </div>
    </div>


    <ul class="product-tabs-tnl">
      <li>
        <div class="question">
          <p><?php echo 'Opis produktu'; ?></p>
          <button aria-label="Toggle Accordion Content">
            <div></div>
          </button>
        </div>
        <div class="answer">
          <?php echo apply_filters('the_content', get_the_content()); ?>
        </div>
      </li>
      <?php if (!empty($tabs_items)) {
        foreach ($tabs_items as $key => $val) { ?>
          <li>
            <div class="question">
              <p><?php echo $val['question_title']; ?></p>
              <button aria-label="Toggle Accordion Content">
                <div></div>
              </button>
            </div>
            <div class="answer">
              <?php echo $val['answer']; ?>
            </div>
          </li>
      <?php }
      } ?>
    </ul>
    <?php if (have_rows('additional_info')) { ?>
      <div class="product-add-info">
        <?php while (have_rows('additional_info')) {
          the_row();
          if (get_row_layout() == 'image') {
            get_template_part('builder-templates/product-add-info-template/template-iamge');
          } elseif (get_row_layout() == 'text_content') {
            get_template_part('builder-templates/product-add-info-template/template-text-content');
          }
        } ?>
      </div>
    <?php }
    $benefits_of_use_title = !empty(get_field('benefits_of_use_title')) ? '<h3 class="title-tnl">' . get_field('benefits_of_use_title') . '</h3>' : "";
    $benefits_of_use_items = get_field('benefits_of_use_items');
    if (!empty($benefits_of_use_title) || !empty($benefits_of_use_items) && count($benefits_of_use_items) > 0) { ?>
      <div class="benefits_of_use">
        <?php echo $benefits_of_use_title;
        if (!empty($benefits_of_use_items) && count($benefits_of_use_items)) { ?>
          <div class="benefits_of_use__items">
            <?php foreach ($benefits_of_use_items as $key => $item) { ?>
              <div class="benefits_of_use__items_item item">
                <div class="item__img">
                  <?php echo my_custom_attachment_image($item['icon']); ?>
                </div>
                <div class="item__content">
                  <p class="item__content_title"><?php echo $item['title']; ?></p>
                  <?php echo $item['descr']; ?>
                </div>
              </div>
            <?php } ?>
          </div>
        <?php }
        ?>
      </div>
    <?php } ?>
  </div>

  <?php
  $content = get_field('difference_tnl_content', 'options');
  $difference_items = get_field('difference_items', 'options'); ?>
  <!-- difference-tnl start -->
  <section class="difference-tnl">
    <div class="container">
      <div class="difference-tnl__content">
        <?php echo $content; ?>
      </div>
      <?php if (!empty($difference_items) && count($difference_items) > 0) {
      ?>
        <div class="difference-tnl__items">
          <?php foreach ($difference_items as $key => $item) {
          ?>
            <div class="difference-tnl__items_item">
              <?php
              echo wp_get_attachment_image($item['icon'], 'full');
              echo '<p>' . $item['text'] . '</p>'; ?>
            </div>

          <?php } ?>
        </div>
      <?php } ?>
    </div>
  </section><!-- difference-tnl end -->
  <div class="container">
    <div class="opinion-block-tnl">
      <!-- Begin eTrusted widget tag -->
      <etrusted-widget data-etrusted-widget-id="wdg-aa2167f2-9c39-4fc0-bc04-4cffe2a3540a" data-sku="<?php echo $product->get_sku(); ?>"></etrusted-widget>
      <!-- End eTrusted widget tag -->
    </div>
  </div>
  <?php
  $faq = get_field('faq');
  // Check if $tabs_items is not empty
  if (!empty($faq) && count($faq) > 0) { ?>
    <div class="container">
      <h3 class="title-tnl" style="text-align: center;padding: 50px 0;">Najczęściej zadawane pytania</h3>
      <ul class="faq">
        <?php foreach ($faq as $key => $faq_item) { ?>
          <li>
            <div class="faq__question">
              <p><?php echo $faq_item['question']; ?></p>
              <button aria-label="Toggle Accordion Content">
                <div></div>
              </button>
            </div>
            <div class="faq__answer">
              <?php echo $faq_item['answer']; ?>
            </div>
          </li>
        <?php } ?>
      </ul>
    </div>
  <?php } ?>

  <script>
    jQuery(document).on('click', '.faq__question', function(e) {
      if (jQuery(this).parent().siblings().children('div.faq__answer').is(':visible')) {
        jQuery(this).parent().siblings().children('.faq__question').children('button').removeClass('active')
        jQuery(this).parent().siblings().children('div.faq__answer').slideUp(200);
      }

      jQuery(this).children('button').toggleClass('active')
      jQuery(this).siblings('div.faq__answer').slideToggle(200)

    })
  </script>

  <div class="container">
    <?php
    /**
     * Hook: woocommerce_after_single_product_summary.
     *
     * @hooked woocommerce_output_product_data_tabs - 10
     * @hooked woocommerce_upsell_display - 15
     * @hooked woocommerce_output_related_products - 20
     */
    do_action('woocommerce_after_single_product_summary');
    ?>
  </div>

</div>

<?php do_action('woocommerce_after_single_product'); ?>