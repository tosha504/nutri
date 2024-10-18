<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hashimoto
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="wrapper">

		<header id="masthead" class="header">

			<div id="header-top-navigation" class="header__top">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-top-header',
						'container' => false,
						'menu_id' => 'menu-top-header',
						'menu_class' => 'header__top_nav',
					),
				);
				$socials = get_field('socials', 'options');
				if (!empty($socials) && count($socials) > 0) { ?>
					<ul class="header__top_socials">
						<?php foreach ($socials as $key => $social) {
							$icon = !empty($social['icon']) ?  wp_get_attachment_image($social['icon'], 'full') : ''; ?>
							<li>
								<a href="<?php esc_url($social['link']) ?>" target="_blank"><?php echo $icon; ?></a>
								<p><?php echo $social['quantity']; ?></p>
							</li>
						<?php } ?>
					</ul>
				<?php } ?>
			</div>

			<div class="header__bottom">
				<div class="container">
					<?php
					$logo = get_field('logo', 'options');
					if (!empty($logo)) { ?>
						<div class="header__logo">
							<a href="<?php echo esc_url(home_url('/')) ?>">
								<?php
								echo wp_get_attachment_image($logo, 'full');
								?>
							</a>
						</div>
					<?php } ?>


					<nav id="site-navigation" class="main-navigation">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-header',
								'container' => false,
								'menu_id' => 'primary-menu1',
								'menu_class' => 'header__nav',
							),
						);
						?>
					</nav><!-- #site-navigation -->



					<nav id="menu-right-header" class="right-navigation">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-right-header',
								'container' => false,
								'menu_class' => 'header__nav_right',
							),
						);
						?>
					</nav><!-- #site-navigation -->

					<button class="burger" aria-label="Open the menu"><span></span><span></span><span></span></button><!-- burger -->
				</div>
			</div>
		</header><!-- #masthead -->