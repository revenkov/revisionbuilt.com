<?php
global $post;
$desktop = get_field('desktop', selectrum_get_hero_image_post_id());
$tablet = get_field('tablet', selectrum_get_hero_image_post_id());
$mobile = get_field('mobile', selectrum_get_hero_image_post_id());
?>
<div class="hero">
	<?php if ( !empty( $desktop ) ) : ?>
    <div class="hero__imageContainer">
        <picture>
            <?php if ( !empty( $mobile ) ) : ?><source media="(max-width: 639px)" srcset="<?php echo wp_get_attachment_image_srcset( $mobile['ID'], 'full' ); ?>" sizes="<?php echo wp_get_attachment_image_sizes( $mobile['ID'], 'full' ); ?>"><?php endif; ?>
            <?php if ( !empty( $tablet ) ) : ?><source media="(max-width: 1119px)" srcset="<?php echo wp_get_attachment_image_srcset( $tablet['ID'], 'full' ); ?>" sizes="<?php echo wp_get_attachment_image_sizes( $tablet['ID'], 'full' ); ?>"><?php endif; ?>
            <?php echo wp_get_attachment_image( $desktop['ID'], 'full', false, ['class'=>'hero__image']); ?>
        </picture>
    </div>
    <?php endif; ?>
    <div class="hero__overlay">
        <div class="container hero__container">
            <div class="hero__textContainer"><?php echo selectrum_get_hero_text(); ?></div>
        </div>
    </div>
</div>