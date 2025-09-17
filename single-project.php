<?php get_header(); ?>


<?php get_template_part('parts/hero'); ?>


<?php
$categories = get_field('categories');
$main_content = get_field('main_content');
$images = get_field('images');
?>
<div class="section">
    <div class="container">
        <div class="projectDetails">
            <?php if ( !empty( $categories ) ) : ?>
                <div class="categories projectDetails__categories" data-aos="fade-up">
                    <div class="categories__category"><?php echo implode('</div><div class="categories__category">', array_column($categories, 'name')); ?></div>
                </div>
            <?php endif; ?>
            <div class="projectDetails__cols">
                <div class="projectDetails__col1">
                    <h1 class="h2 projectDetails__title" data-aos="fade-up"><?php echo get_the_title(); ?></h1>
                    <div class="projectDetails__subtitle text-lg" data-aos="fade-up"><?php echo $main_content['subtitle']; ?></div>
                    <?php if ( !empty( $main_content['details'] ) ) : ?>
                        <div class="projectDetails__items" data-aos="fade-up">
                            <?php foreach ( $main_content['details'] as $item ) : ?>
                                <div class="projectDetails__item">
                                    <div class="projectDetails__itemTitle"><strong><?php echo $item['title']; ?></strong></div>
                                    <div class="projectDetails__itemDescription"><?php echo $item['description']; ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( !empty( $main_content['content'] ) ) : ?>
                        <div class="projectDetails__description" data-aos="fade-up"><?php echo $main_content['content']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="projectDetails__col2">
                    <div class="projectGallery" data-aos="fade-up">
                        <div class="projectGallery__slides">
                            <?php foreach ( $images as $key=>$image ) : ?>
                                <div class="projectGallery__slide">
                                    <div class="mediaBlock mediaBlock--formatted projectGallery__mediaBlock">
                                        <a href="javascript:" data-fancybox-trigger="gallery" data-fancybox-index="<?php echo $key; ?>">
                                            <?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div style="display: none;">
                            <?php foreach ( $images as $key=>$image ) : ?>
                                <a href="javascript:" data-fancybox="gallery" data-src="<?php echo wp_get_attachment_image_url( $image['ID'], 'full' ); ?>">
                                    <?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
$sections = get_field('sections');
if ( !empty( $sections ) ) :
    foreach ( $sections as $section ) :
        ?>
        <div class="section">
            <div class="container">
                <?php
                switch ( $section['acf_fc_layout'] ) {
                    case 'image_image':
                        echo $section['content'] ?? false;
                        ?>
                        <div class="imageImageBlock">
                            <div class="imageImageBlock__col1" data-aos="fade-up">
                                <div class="mediaBlock mediaBlock--formatted imageImageBlock__mediaBlock">
                                    <?php echo wp_get_attachment_image( $section['image_left']['ID'], 'full' ); ?>
                                    <div class="imageImageBlock__label"><?php echo $section['tag_image_left']; ?></div>
                                </div>
                            </div>
                            <div class="imageImageBlock__col2" data-aos="fade-up">
                                <div class="mediaBlock mediaBlock--formatted imageImageBlock__mediaBlock">
                                    <?php echo wp_get_attachment_image( $section['image_right']['ID'], 'full' ); ?>
                                    <div class="imageImageBlock__label"><?php echo $section['tag_image_right']; ?></div>
                                </div>
                            </div>
                        </div>
                        <?php
                        break;
                    case 'testimonial_section':
                        ?>
                        <div class="testimonialsBlock">
                            <div class="testimonialsBlock__textCol" data-aos="fade-up">
                                <?php echo $section['content'] ?? false; ?>
                            </div>
                            <div class="testimonialsBlock__testimonialsCol" data-aos="fade-up">
                                <?php foreach ( $section['testimonials'] as $testimonial ) : ?>
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
                        <?php
                        break;
                    case 'image_full_width':
                        ?>
                        <div class="mediaBlock fullWidthMediaBlock" data-aos="fade-up"><?php echo wp_get_attachment_image( $section['image']['ID'], 'full' ); ?></div>
                        <?php
                        break;
                    case 'text_image':
                        ?>
                        <div class="imageTextBlock <?php echo (int)$section['image_position'] === 2 ? 'imageTextBlock--textLeft' : false; ?>">
                            <div class="imageTextBlock__imageCol" data-aos="fade-up">
                                <div class="mediaBlock">
                                    <?php echo wp_get_attachment_image( $section['image']['ID'], 'full' ); ?>
                                </div>
                            </div>
                            <div class="imageTextBlock__textCol" data-aos="fade-up">
                                <div class="imageTextBlock__textContainer">
                                    <?php echo $section['content']; ?>

                                    <?php get_template_part('parts/link', false, $section['button']); ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        break;
                }
                ?>
            </div>
        </div>
        <?php
    endforeach;
endif;
?>


<?php
$next_post = get_previous_post();
$prev_post = get_next_post();
?>
<div class="section">
    <div class="container">
        <nav class="postNav" data-aos="fade-up">
            <?php if ( $prev_post ) : ?>
            <a class="link link--prev postNav__prev" href="<?php echo get_permalink( $prev_post ); ?>" title="<?php echo __('Previous project', 'selectrum'); ?>">
                <span class="link__text" data-text-mobile="<?php echo __('Prev. project', 'selectrum'); ?>" data-text-default="<?php echo __('Previous project', 'selectrum'); ?>"></span>
            </a>
            <?php endif; ?>
            <?php if ( $next_post ) : ?>
                <a class="link link--next postNav__next" href="<?php echo get_permalink( $next_post ); ?>">
                    <span class="link__text"><?php echo __('Next project', 'selectrum'); ?></span>
                </a>
            <?php endif; ?>
            <a class="link link--back postNav__back" href="<?php echo selectrum_get_permalink(2566); ?>">
                <span class="link__text"><?php echo __('Back to projects', 'selectrum'); ?></span>
            </a>
        </nav>
    </div>
</div>


<?php get_footer(); ?>
