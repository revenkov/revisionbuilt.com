<?php
/**
 * Template Name: About
 */
?>


<?php get_header(); ?>


<?php get_template_part('parts/hero'); ?>


<?php
$content_group_1 = get_field('content_group_1');
$image_1 = get_field('image_1');
?>
<div class="section">
    <div class="container">
        <div class="imageTextBlock imageTextBlock--textLeft">
            <div class="imageTextBlock__imageCol" data-aos="fade-up">
                <div class="mediaBlock">
                    <?php echo wp_get_attachment_image( $image_1['ID'], 'full' ); ?>
                </div>
            </div>
            <div class="imageTextBlock__textCol" data-aos="fade-up">
                <div class="imageTextBlock__textContainer">
                    <?php echo $content_group_1['content']; ?>

                    <?php get_template_part('parts/link', false, $content_group_1['button']); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
$content = get_field('content');
$core_strengths = get_field('core_strengths');
?>
<div class="section" data-aos="fade-up">
    <div class="container">
        <?php echo $content; ?>

        <div class="coreStrengths">
            <?php foreach ( $core_strengths as $item ) : ?>
            <div class="coreStrengths__item">
                <h3 class="coreStrengths__itemTitle"><?php echo $item['title']; ?></h3>
                <p class="coreStrengths__itemDescription"><?php echo $item['description']; ?></p>
                <?php
                if ( !empty( $item['logo'] ) ) :
                    echo wp_get_attachment_image( $item['logo']['ID'], 'full', false, ['class'=>'coreStrengths__itemLogo'] );
                endif;
                ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<?php get_template_part('parts/cta'); ?>


<?php get_footer(); ?>
