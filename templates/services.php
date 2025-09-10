<?php
/**
 * Template Name: Services
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
$services = get_field('services');
if ( !empty( $services ) ) :
?>
<div class="section">
    <?php foreach ( $services as $key=>$service ) : ?>
    <div class="serviceBlock" data-aos="fade-up">
        <div class="container">
            <div class="serviceBlock__inner">
                <div class="serviceBlock__header">
                    <h2 class="serviceBlock__title"><?php echo $service['title']; ?></h2>
                </div>
                <div class="serviceBlock__cols">
                    <div class="serviceBlock__imageCol">
                        <div class="mediaBlock serviceBlock__mediaBlock">
                            <?php echo wp_get_attachment_image( $service['image']['ID'], 'full'); ?>
                        </div>
                    </div>
                    <div class="serviceBlock__textCol">
                        <div class="serviceBlock__textContainer">
                            <?php echo $service['content']; ?>

                            <?php get_template_part('parts/link', false, $service['button']); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>


<?php get_template_part('parts/featured-projects'); ?>


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
