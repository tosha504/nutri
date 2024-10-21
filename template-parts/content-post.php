<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hashimoto
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- banner-tnl start -->
	<section class="banner-tnl">
		<div class="banner-tnl__left" style="background-color: <?php echo '#FAEFE6'; ?>;">
			<div class="container">
				<?php echo get_the_category()[0]->name; ?>
				<h1><?php echo get_the_title(); ?></h1>
				<div class="post-autor-data">
					<?php
					$id_author = get_the_author_meta('ID');
					$avatar = get_field('avatar', "user_{$id_author}");
					if (!empty($avatar)) {
						echo wp_get_attachment_image($avatar);
					}
					echo  '<p>Napisane przez: <a href="' .  get_author_posts_url(get_the_author_meta('ID')) . '">' .
						get_the_author() .
						'</a><br>' . get_the_date() . '</p>';
					// var_dump( get_the_author(), get_the_author_meta('ID'));
					?>
				</div>
			</div>
		</div>
		<div class="banner-tnl__right" style="<?php echo 'background-image:url(' . get_the_post_thumbnail_url() . ');'; ?>">
		</div>
	</section><!-- banner-tnl end -->
	<div class="container">


		<div class="entry-content">
			<?php the_content(); ?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->