<?php
$image = get_field('image');
$category = get_field('category');
$date = get_field('date');
$excerpt = get_field('excerpt');
?>
<div class="blogTeaser">
    <div class="blogTeaser__imageContainer">
        <div class="mediaBlock mediaBlock--formatted blogTeaser__mediaBlock"><?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?></div>
    </div>
    <div class="blogTeaser__textContainer">
        <div class="blogTeaser__category"><?php echo $category->name; ?></div>
        <h3 class="blogTeaser__title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <span class="blogTeaser__date"><?php echo date_i18n('F j, Y', strtotime( $date )); ?></span> — <span class="blogTeaser__excerpt"><?php echo $excerpt; ?></span>
    </div>
    <a class="blogTeaser__overlayLink" href="<?php echo get_the_permalink(); ?>" title="<?php the_title(); ?>"></a>
</div>