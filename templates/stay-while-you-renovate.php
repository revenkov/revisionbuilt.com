<?php
/**
 * Template Name: Stay while you renovate
 */
?>


<?php get_header(); ?>


<?php get_template_part('parts/hero'); ?>


<?php
$intro_content = get_field('intro_content');
if ( !empty( $intro_content ) ) :
?>
<div class="section">
    <div class="container">
        <div class="introBlock" data-aos="fade-up"><?php echo $intro_content; ?></div>
    </div>
</div>
<?php endif; ?>


<?php
$sections = get_field('sections');
if ( !empty( $sections ) ) :
    foreach ( $sections as $key=>$section ) :
?>
<div class="section">
    <div class="container">
        <div class="imageTextBlock <?php echo $key % 2 !== 0 ? 'imageTextBlock--textLeft' : false; ?>" data-aos="fade-up">
            <div class="imageTextBlock__imageCol">
                <div class="mediaBlock">
                    <?php echo wp_get_attachment_image( $section['image']['ID'], 'full' ); ?>
                </div>
            </div>
            <div class="imageTextBlock__textCol">
                <div class="imageTextBlock__textContainer">
                    <?php echo $section['content']; ?>

                    <?php get_template_part('parts/link', false, $section['button']); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; endif; ?>


<hr>


<?php
$content_group_1 = get_field('content_group_1');
$testimonials = get_field('testimonials');
if ( !empty( $testimonials ) ) :
?>
<div class="section">
    <div class="container">
        <div class="testimonialsBlock">
            <div class="testimonialsBlock__textCol" data-aos="fade-up">
                <?php echo $content_group_1['content']; ?>

                <?php get_template_part('parts/link', false, $section['button']); ?>
            </div>
            <div class="testimonialsBlock__testimonialsCol" data-aos="fade-up">
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


<?php get_footer(); ?>
