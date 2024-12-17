<?php

/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package start
 */

if (get_post_type() === 'product') {
	wc_get_template_part('content', 'product');
} else {
	$trim_words = 20;
	$excerpt = wp_trim_words(get_the_excerpt(), $trim_words); ?>
	<li class="item">
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
}
