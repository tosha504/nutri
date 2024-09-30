<?php

/**
 * Loop Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

global $product;
$product_claim = !empty(get_field('product_claim')) ? '<p class="product_claim">' . get_field('product_claim') . '</p>' : '';
$descr_after_descr =  !empty(get_field('descr_after_descr')) ? '<p>' . get_field('descr_after_descr') . '</p>' : '';
echo  $descr_after_descr;

?>
<?php if ($price_html = $product->get_price_html()) : ?>
	<div class="product__wrap-body_price">
		<?php echo $product_claim; ?>
		<span class="price"><?php echo $price_html; ?></span>
	</div>
<?php endif; ?>