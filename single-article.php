<?php get_header(); ?>


<?php get_template_part('parts/hero'); ?>


<?php
$image = get_field('image');
$category = get_field('category');
$date = get_field('date');
$content = get_field('content');
$button = get_field('button');
?>
<div class="section">
    <div class="container">
        <div class="blogDetails">
            <h1 class="blogDetails__title" data-aos="fade-up"><?php echo get_the_title(); ?></h1>
            <div class="blogDetails__cols">
                <div class="blogDetails__col1" data-aos="fade-up">
                    <div class="mediaBlock blogDetails__mediaBlock"><?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?></div>
                </div>
                <div class="blogDetails__col2" data-aos="fade-up">
                    <div class="blogDetails__meta">
                        <?php if ( !empty( $date ) ) : ?>
                            <div class="blogDetails__date"><?php echo date_i18n('F j, Y', strtotime($date)); ?></div>
                        <?php endif; ?>
                        <?php if ( !empty( $category ) ) : ?>
                            <div class="blogDetails__category"><?php echo $category->name; ?></div>
                        <?php endif; ?>
                    </div>
                    <?php echo $content; ?>
                    <?php get_template_part('parts/button', false, $button); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
$posts = get_posts([
    'post_type' => 'article',
    'posts_per_page' => 3,
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
        <div class="latestArticles">
            <div class="latestArticles__header" data-aos="fade-up">
                <h2 class="latestArticles__title"><?php _e('Latest articles', 'selectrum'); ?></h2>
            </div>
            <div class="latestArticles__listing" data-aos="fade-up">
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
            <nav class="latestArticles__nav" data-aos="fade-up">
                <?php
                get_template_part('parts/link', false, [
                    'title' => __('Back to blog', 'selectrum'),
                    'url' => selectrum_get_permalink( 2570 ),
                    'classes' => 'link--prev'
                ])
                ?>
            </nav>
        </div>
    </div>
</div>
<?php endif; ?>


<?php get_footer(); ?>
