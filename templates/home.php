<?php
/**
 * Template Name: Home
 */
?>


<?php get_header(); ?>


<?php
$title = get_field('title');
$subtitle = get_field('subtitle');
$slider = get_field('slider');
?>
<div class="heroSlider">
    <div class="heroSlider__slides">
        <?php foreach ( $slider as $slide ) : ?>
            <div class="heroSlider__slide">
                <div class="mediaBlock mediaBlock--formatted heroSlider__mediaBlock">
                    <picture>
                        <?php if ( !empty( $slide['mobile'] ) ) : ?><source media="(max-width: 639px)" srcset="<?php echo wp_get_attachment_image_srcset( $slide['mobile'], 'full' ); ?>" sizes="<?php echo wp_get_attachment_image_sizes( $slide['mobile'], 'full' ); ?>"><?php endif; ?>
                        <?php if ( !empty( $slide['tablet'] ) ) : ?><source media="(max-width: 1119px)" srcset="<?php echo wp_get_attachment_image_srcset( $slide['tablet'], 'full' ); ?>" sizes="<?php echo wp_get_attachment_image_sizes( $slide['tablet'], 'full' ); ?>"><?php endif; ?>
                        <?php echo wp_get_attachment_image( $slide['desktop']['ID'], 'full', false, ['class'=>'heroSlider__slideImage']); ?>
                    </picture>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="heroSlider__overlay">
        <div class="container">
            <div class="heroSlider__inner">
                <div class="heroSlider__content">
                    <h1 class="heroSlider__title" data-aos="fade-up" data-aos-offset="0"><?php echo $title; ?></h1>
                    <hr data-aos="slide-right" data-aos-offset="0">
                    <p class="heroSlider__subtitle text-lg" data-aos="fade-up" data-aos-offset="0"><span style="opacity: .8;"><?php echo $subtitle; ?></span></p>
                </div>
                <div class="heroSlider__controls" data-aos="fade-up">
                    <button class="heroSlider__button heroSlider__button--prev" type="button" title="Previous"></button>
                    <button class="heroSlider__button heroSlider__button--next" type="button" title="Next"></button>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
$card_1 = get_field('card_1');
$card_2 = get_field('card_2');
$card_3 = get_field('card_3');
?>
<div class="section">
    <div class="container">
        <div class="cardsBlock">
            <div class="cardsBlock__items">
                <div class="card" data-aos="fade-up">
                    <div class="mediaBlock mediaBlock--formatted card__mediaBlock"><?php echo wp_get_attachment_image( $card_1['background_image']['ID'], 'full' ); ?></div>
                    <a class="card__overlay" href="<?php echo $card_1['link']; ?>">
                        <h2 class="card__title"><?php echo $card_1['title']; ?></h2>
                        <p class="card__text"><?php echo $card_1['subtitle']; ?></p>
                    </a>
                </div>
                <div class="card" data-aos="fade-up">
                    <div class="mediaBlock mediaBlock--formatted card__mediaBlock"><?php echo wp_get_attachment_image( $card_2['background_image']['ID'], 'full' ); ?></div>
                    <a class="card__overlay" href="<?php echo $card_2['link']; ?>">
                        <h2 class="card__title"><?php echo $card_2['title']; ?></h2>
                        <p class="card__text"><?php echo $card_2['subtitle']; ?></p>
                    </a>
                </div>
                <div class="card" data-aos="fade-up">
                    <div class="mediaBlock mediaBlock--formatted card__mediaBlock"><?php echo wp_get_attachment_image( $card_3['background_image']['ID'], 'full' ); ?></div>
                    <a class="card__overlay" href="<?php echo $card_3['link']; ?>">
                        <h2 class="card__title"><?php echo $card_3['title']; ?></h2>
                        <p class="card__text"><?php echo $card_3['subtitle']; ?></p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
$content_group_1 = get_field('content_group_1');
$value_propositions = get_field('value_propositions');
?>
<div class="section">
    <div class="container">
        <div class="valuePropositions">
            <div class="valuePropositions__header" data-aos="fade-up"><?php echo $content_group_1['content']; ?></div>
            <div class="valuePropositions__items" data-aos="fade-up">
                <?php foreach ( $value_propositions as $item ) : ?>
                    <div class="valuePropositions__item" style="--icon: url('<?php echo $item['icon']['url']; ?>');">
                        <h3 class="valuePropositions__itemTitle"><?php echo $item['title']; ?></h3>
                        <p><?php echo $item['description']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="valuePropositions__nav" data-aos="fade-up">
                <?php get_template_part('parts/link', false, $content_group_1['button']); ?>
            </div>
        </div>
    </div>
</div>


<hr>


<?php get_template_part('parts/featured-projects'); ?>


<?php
$bg = get_field('background_image');
$content_group_2 = get_field('content_group_2');
?>
<div class="section">
    <div class="bgBlock">
        <div class="mediaBlock mediaBlock--formatted bgBlock__mediaBlock">
            <picture>
                <?php if ( !empty( $bg['mobile'] ) ) : ?><source media="(max-width: 639px)" srcset="<?php echo wp_get_attachment_image_srcset( $bg['mobile'], 'full' ); ?>" sizes="<?php echo wp_get_attachment_image_sizes( $bg['mobile'], 'full' ); ?>"><?php endif; ?>
                <?php if ( !empty( $bg['tablet'] ) ) : ?><source media="(max-width: 1119px)" srcset="<?php echo wp_get_attachment_image_srcset( $bg['tablet'], 'full' ); ?>" sizes="<?php echo wp_get_attachment_image_sizes( $bg['tablet'], 'full' ); ?>"><?php endif; ?>
                <?php echo wp_get_attachment_image( $bg['desktop']['ID'], 'full'); ?>
            </picture>
        </div>
        <div class="bgBlock__overlay">
            <div class="container">
                <div class="bgBlock__content" data-aos="fade-up">
                    <?php echo $content_group_2['content']; ?>

                    <?php get_template_part('parts/link', false, $content_group_2['button']); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
$content_group = get_field('content_group_3');
$testimonials = get_field('testimonials');
if ( !empty( $testimonials ) ) :
?>
<div class="section">
    <div class="container">
        <div class="testimonialsBlock">
            <div class="testimonialsBlock__textCol" data-aos="fade-up">
                <?php echo $content_group['content']; ?>

                <?php get_template_part('parts/link', false, $content_group['button']); ?>
            </div>
            <div class="testimonialsBlock__testimonialsCol" data-aos="fade-up">
                <div class="testimonials">
                    <div class="testimonials__items">
                        <?php foreach ( $testimonials as $testimonial ) : ?>
                            <div class="testimonials__item">
                                <div class="testimonial">
                                    <div class="testimonial__text">
                                        <div class="text-lg"><?php echo $testimonial['testimonial']; ?></div>
                                    </div>
                                    <div class="testimonial__author"><strong><?php echo $testimonial['author']; ?></strong></div>
                                    <div class="testimonial__location"><?php echo $testimonial['location']; ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>


<?php get_template_part('parts/cta'); ?>


<?php
$logos = get_field('logos');
if ( !empty( $logos ) ) :
?>
<div class="section">
    <div class="container">
        <div class="logos">
            <?php foreach ( $logos as $logo ) : ?>
                <div class="logos__item" data-aos="fade-up">
                    <a href="<?php echo $logo['external_url']; ?>" target="_blank">
                        <?php echo wp_get_attachment_image( $logo['logo']['ID'], 'full' ); ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>


<?php
$blog = get_field('blog');
$posts = get_posts([
        'post_type' => 'article',
        'posts_per_page' => 4,
        'orderby' => 'meta_value_num',
        'meta_key' => 'date',
        'order' => 'DESC',
        'exclude' => get_the_ID()
]);
if ( !empty( $posts ) ) :
?>
<hr>


<div class="section">
    <div class="container">
        <div class="homeLatestArticles">
            <div class="homeLatestArticles__header" data-aos="fade-up">
                <h2 class="homeLatestArticles__title"><?php echo $blog['title']; ?></h2>
            </div>
            <div class="homeLatestArticles__listing" data-aos="fade-up">
                <div class="latestArticlesListing">
                    <div class="latestArticlesListing__items">
                        <?php
                        foreach ( $posts as $post ) {
                            setup_postdata($post);
                            ?>
                            <div class="latestArticlesListing__item">
                                <?php get_template_part('parts/blog-teaser'); ?>
                            </div>
                            <?php
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
            <nav class="homeLatestArticles__nav" data-aos="fade-up">
                <?php
                get_template_part('parts/link', false, [
                    'title' => __('Visit our blog', 'selectrum'),
                    'url' => selectrum_get_permalink( 2570 ),
                ]);
                ?>
            </nav>
        </div>
    </div>
</div>
<?php endif; ?>


<?php get_footer(); ?>
