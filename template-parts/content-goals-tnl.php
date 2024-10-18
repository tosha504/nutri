<?php

/**
 * Template part for displaying posts-goals-tnl
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hashimoto
 */

$goal = get_field('goal');
$descr = !empty(get_field('descr')) ? "<p>" . get_field('descr') . "</p>" : "";
$iamge  = get_field('iamge');
$symptoms  = get_field('symptoms');
$Understand_your_symptoms  = get_field('Understand_your_symptoms'); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- goal-post-banner start -->
	<section class="goal-post-banner" style="background-image: url(<?php echo get_the_post_thumbnail_url() ?>);">
		<div class="goal-post-banner__wrap">
			<h1>Twój cel to <br><span><?php echo $goal; ?></span></h1>
			<?php echo $descr; ?>
		</div>
		<a href="#" class="arrow-down"></a>
	</section><!-- goal-post-banner end -->
	<!-- current-symptoms start -->
	<?php if (!empty($symptoms) && count($symptoms) > 0) { ?>
		<section class="current-symptoms">
			<div class="current-symptoms__left"><?php echo my_custom_attachment_image($iamge); ?></div>
			<div class="current-symptoms__right">
				<h2 class="title-tnl">Twoje <span>obecne objawy</span></h2>
				<div class="current-symptoms__right_symptoms">

					<?php foreach ($symptoms as $key => $symptom) { ?>
						<p><?php echo $symptom; ?></p>
					<?php } ?>
				</div>
			</div>
		</section><!-- current-symptoms start -->
	<?php } ?>
	<!-- Understand_your_symptoms start -->
	<div class="container your-symptoms">
		<?php echo $Understand_your_symptoms; ?>
	</div><!-- Understand_your_symptoms start -->

	<?php the_content(); ?>

</article><!-- #post-<?php the_ID(); ?> -->