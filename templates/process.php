<?php
/**
 * Template Name: Our process
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


<hr>


<?php
$steps = get_field('steps');
if ( !empty( $steps ) ) :
?>
<div class="section">
    <div class="container">
        <div class="steps">
            <?php foreach ( $steps as $key=>$step ) : ?>
            <div class="step" style="--icon: url('<?php echo $step['icon']['url']; ?>');" data-aos="fade-up">
                <div class="step__indexCol">
                    <div class="step__number"><?php echo sprintf('%02d', $key+1); ?></div>
                </div>
                <div class="step__textCol">
                    <?php echo $step['content']; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>


<hr>


<?php
$content_group_1 = get_field('content_group_1');
if ( !empty( $content_group_1 ) ) :
?>
<div class="section">
    <div class="container">
        <div class="certificationBlock" data-aos="fade-up">
            <div class="certificationBlock__header"><?php echo $content_group_1['content_1']; ?></div>
            <div class="certificationBlock__logo"><?php echo wp_get_attachment_image( $content_group_1['logo']['ID'], 'full' ); ?></div>
            <div class="certificationBlock__content"><?php echo $content_group_1['content_2']; ?></div>
        </div>
    </div>
</div>
<?php endif; ?>


<?php get_template_part('parts/cta'); ?>


<?php get_footer(); ?>
