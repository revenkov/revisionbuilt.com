<?php
$categories = get_field('categories');
$main_content = get_field('main_content');
$images = get_field('images');
?>
<div class="projectTeaser">
    <div class="projectTeaser__imageContainer">
        <div class="mediaBlock projectTeaser__mediaBlock"><?php echo wp_get_attachment_image( $images[0]['ID'], 'full' ); ?></div>
    </div>
    <div class="projectTeaser__textContainer">
        <div class="categories projectTeaser__categories">
            <div class="categories__category"><?php echo implode('</div><div class="categories__category">', array_column($categories, 'name')); ?></div>
        </div>
        <h3 class="projectTeaser__title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <div class="projectTeaser__subtitle"><?php echo $main_content['subtitle']; ?></div>
    </div>
    <a class="projectTeaser__overlayLink" href="<?php echo get_the_permalink(); ?>" title="<?php the_title(); ?>"></a>
</div>
