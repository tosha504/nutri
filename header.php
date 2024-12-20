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
				$socials_count = get_field('socials_count', 'options');
				if (!empty($socials_count) && count($socials_count) > 0) { ?>
					<ul class="header__top_socials">
						<?php foreach ($socials_count as $key => $social) {
							$icon = !empty($social['icon']) ?  wp_get_attachment_image($social['icon'], 'full') : ''; ?>
							<li>
								<a href="<?php echo esc_url($social['link']) ?>" target="_blank"><?php echo $icon; ?></a>
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
								'walker' => new AWP_Menu_Walker()
							),
						);
						wp_nav_menu(
							array(
								'theme_location' => 'mobile-header',
								'container' => false,
								'menu_id' => 'mobile-header',
								'menu_class' => 'header__nav',
							),
						);


						?>
						<div id="mobile-extra-element" class="mobile-only">
							<?php
							$socials = get_field('socials_count', 'options');
							$socials_display = '';
							if (!empty($socials) && count($socials) > 0) {

								foreach ($socials as $key => $social) {
									if (!empty($social['link']) && !empty($social['icon'])) {
										$socials_display .= "<a href='" . esc_url($social['link']) . "'>" . wp_get_attachment_image($social['icon'], 'full') . "</a>";
									}
								}
							};
							echo '<div class="socials">' . $socials_display . '</div>';
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
			<div class="search-form-tnl">
				<div class="container">
					<form role="search" method="get" class="search-form" action="/">
						<label>
							<span class="screen-reader-text">Search for:</span>
							<input type="search" class="search-field" placeholder="Co chcesz znaleźć?" name="s"
								data-rlvlive="true" data-rlvparentel="#rlvlive" data-rlvconfig="default">
						</label>
						<button class="button button__black" type="submit">Szukaj</button>
						<div id="rlvlive"></div>
					</form>
				</div>
			</div>
		</header><!-- #masthead -->