<?php
/**
 * Template Name: Home
 */
?>


<?php get_header(); ?>


<?php
$title = get_field('title');
$subtitle = get_field('subtitle');
$slider = get_field('slider');
?>
<div class="hero">

</div>


<?php
$card_1 = get_field('card_1');
$card_2 = get_field('card_2');
$card_3 = get_field('card_3');
?>
<div class="section">
    <div class="container"></div>
</div>


<?php
$content_group_1 = get_field('content_group_1');
?>
<div class="section">
    <div class="container"></div>
</div>


<hr>


<?php get_template_part('parts/featured-projects'); ?>


<?php
$background_image = get_field('background_image');
$content_group_2 = get_field('content_group_2');
$content_group_3 = get_field('content_group_3');
?>
<div class="section">
    <div class="container"></div>
</div>


<?php
$content_group_1 = get_field('content_group_1');
$testimonials = get_field('testimonials');
if ( !empty( $testimonials ) ) :
?>
<div class="section">
    <div class="container">
        <div class="testimonialsBlock">
            <div class="testimonialsBlock__textCol">
                <?php echo $content_group_1['content']; ?>

                <?php get_template_part('parts/link', false, $section['button']); ?>
            </div>
            <div class="testimonialsBlock__testimonialsCol">
                <?php foreach ( $testimonials as $testimonial ) : ?>
                    <div class="testimonial">
                        <div class="testimonial__text">
                            <div class="text-lg"><?php echo $testimonial['testimonial']; ?></div>
                        </div>
                        <div class="testimonial__author"><strong><?php echo $testimonial['author']; ?></strong></div>
                        <div class="testimonial__location"><?php echo $testimonial['location']; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>


<?php get_template_part('parts/cta'); ?>


<?php
$logos = get_field('logos');
if ( !empty( $logos ) ) :
?>
<div class="section">
    <div class="container">
        <div class="logos">
            <?php foreach ( $logos as $logo ) : ?>
                <div class="logos__logo">

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>


<?php get_footer(); ?>
