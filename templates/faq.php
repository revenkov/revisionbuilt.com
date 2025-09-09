<?php
/**
 * Template Name: FAQ
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
        <div class="introBlock"><?php echo $intro_content; ?></div>
    </div>
</div>
<?php endif; ?>


<?php
$questions = get_field('questions');
if ( !empty( $questions ) ) :
?>
<div class="section">
    <div class="container">
        <div class="faqBlock">
            <div class="faqBlock__col1">
                <?php echo $questions['content']; ?>

                <?php empty($questions['button']) ?? get_template_part('parts/link', false, $questions['button']); ?>
            </div>
            <div class="faqBlock__col2">
                <div class="accordion">
                    <?php foreach ( $questions['questions'] as $item ) : ?>
                        <div class="accordion__item">
                            <div class="accordion__header">
                                <h3><?php echo $item['question']; ?></h3>
                            </div>
                            <div class="accordion__content">
                                <div class="accordion__contentInner"><?php echo $item['answer']; ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>


<?php get_template_part('parts/cta'); ?>


<?php get_footer(); ?>
