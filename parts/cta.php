<?php
$cta = get_field('call-to-action');
if ( empty( $cta['content'] ) ) {
    $cta = get_field('default_content_group', 'options');
}
if ( empty( $cta['content'] ) ) {
    return;
}
?>
<div class="section">
    <div class="container">
        <div class="ctaBlock">
            <div class="ctaBlock__inner">
                <?php echo $cta['content']; ?>

                <?php get_template_part('parts/button', false, $cta['button']); ?>
            </div>
        </div>
    </div>
</div>