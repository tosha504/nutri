<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hashimoto
 */

//PREFOOTERCONSULATIONS
$bg_image = !empty(get_field('bg_image', 'options')) ? 'style="background-image:url(' . wp_get_attachment_url(get_field('bg_image', 'options')) . ');"' : "";
$logo_bg_image = !empty(get_field('logo_bg_image', 'options')) ? 'style="background-image:url(' . wp_get_attachment_url(get_field('logo_bg_image', 'options')) . ');"' : "";
$title_bg_iamge = get_field('title_bg_iamge', 'options');
$title_right = get_field('title_right', 'options');
$description_right = get_field('description_right', 'options');
$button = get_field('button', 'options');

//PREFOOTERCONSELFDIAGNOSIS
$bg_image_self = !empty(get_field('bg_image_self', 'options')) ? 'style="background-image:url(' . wp_get_attachment_url(get_field('bg_image_self', 'options')) . ');"' : "";
$title_self = get_field('title_self', 'options');
$description_self = get_field('description_self', 'options');
$button_self = get_field('button_self', 'options');

//FOOTER
$footer_logo = !empty(get_field('footer_logo', 'options')) ? wp_get_attachment_image(get_field('footer_logo', 'options'), 'full') : "";
$footer_column_left = get_field('footer_column_left', 'options');
$footer_column_right = get_field('footer_column_right', 'options');
$footer_bottom_images = get_field('footer_bottom_images', 'options');
$footer_bottom_images_shipping = get_field('footer_bottom_images_shipping', 'options'); ?>

<!-- consultation-tnl start -->
<section class="consultation-tnl">
	<div class="container">
		<div class="consultation-tnl__left" <?php echo $bg_image; ?>>
			<div class="consultation-tnl__left_content" <?php echo $logo_bg_image; ?>>
				<p><?php echo $title_bg_iamge; ?></p>
			</div>
		</div>
		<div class="consultation-tnl__right">
			<p class="consultation-tnl__right_title"><?php echo $title_right; ?></p>
			<p><?php echo $description_right; ?></p>
			<?php
			if ($button) {
				echo create_button($button, 'button button__primary');
			}
			?>
		</div>
	</div>
</section><!-- consultation-tnl end -->

<!-- self-diagnosis-tnl start -->
<section class="self-diagnosis-tnl ">
	<div class="self-diagnosis-tnl__left">
		<p class="self-diagnosis-tnl__left_title"><?php echo $title_self; ?></p>
		<p><?php echo $description_self; ?></p>
		<?php
		if ($button) {
			echo create_button($button, 'button button__primary');
		}
		?>
	</div>
	<div class="self-diagnosis-tnl__right" <?php echo $bg_image_self; ?>>
	</div>
</section><!-- self-diagnosis-tnl  end -->

<footer id="colophon" class="footer">
	<div class="container">
		<div class="footer__logo">
			<?php
			echo $footer_logo; ?>
		</div>
		<div class="footer__columns">
			<?php
			$socials = get_field('socials', 'options');
			$socials_display = '';
			if (!empty($socials) && count($socials) > 0) {
				foreach ($socials as $key => $social) {
					if (!empty($social['link']) && !empty($social['icon'])) {
						$socials_display .= "<a href='" . esc_url($social['link']['url']) . "'>" . wp_get_attachment_image($social['icon'], 'full') . "</a>";
					}
				}
			};

			echo !empty($footer_column_left) && count($footer_column_left) > 0 ? '<div class="footer__columns_left">' . $footer_column_left['text_content'] .  '<div class="socials">' . $socials_display . '</div></div>' : '';
			echo '<div class="footer__columns_center">';
			footer_templates();
			echo '</div>';
			echo '<div class="footer__columns_right">' . $footer_column_right . '</div>'; ?>
		</div>

		<div class="footer__info">
			<p class="footer__info_copyright">Copyright © 2018-2024 Nutri Help</p>
			<p class="footer__info_create">Wykonanie: <a href="https://thenewlook.pl/" target="_blank" rel="noopener noreferrer">THE NEW LOOK</a>
				<?php
				if (!empty($footer_bottom_images_shipping) && count($footer_bottom_images_shipping) > 0) {
				?>
			<p class="footer__info_icons">
				<?php
					foreach ($footer_bottom_images_shipping as $key => $icon) {
						echo wp_get_attachment_image($icon["icon"], 'full');
					}
				?>
			</p>
		<?php } ?>
		</p>
		<?php
		if (!empty($footer_bottom_images) && count($footer_bottom_images) > 0) {
		?>
			<div class="footer__info_icons">
				<?php
				foreach ($footer_bottom_images as $key => $icon) {
					echo wp_get_attachment_image($icon["icon"], 'full');
				}
				?>
			</div>
		<?php }
		?>
		</div>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>