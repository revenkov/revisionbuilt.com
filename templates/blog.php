<?php
/**
 * Template Name: Blog
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
$categories = get_terms([
    'taxonomy' => 'article-category',
    'hide_empty' => true
]);
$posts = get_posts([
    'post_type' => 'article',
    'posts_per_page' => -1,
    'orderby' => 'meta_value_num',
    'meta_key' => 'date',
    'order' => 'DESC'
]);
?>
<div class="section">
    <div class="container">
        <div class="blogListing">
            <div class="blogListing__header">
                <div class="blogListing__categoryFilter">
                    <div class="formField">
                        <label for="categoryField" class="formField__title"><?php _e('Category', 'selectrum'); ?></label>
                        <select id="categoryField" class="formField__input">
                            <option value="*"><?php _e('All', 'selectrum'); ?></option>
                            <?php foreach ( $categories as $category ) : ?>
                                <option value="<?php echo $category->slug; ?>"><?php echo $category->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="blogListing__items">
                <?php
                foreach ( $posts as $post ) :
                    setup_postdata($post);
                    $category = get_field('category');
                ?>
                    <div class="blogListing__item <?php echo $category->slug; ?>">
                        <?php get_template_part('parts/blog-teaser'); ?>
                    </div>
                <?php endforeach; wp_reset_postdata(); ?>
            </div>
            <div class="blogListing__pagination">
                <?php
                get_template_part('parts/link', false, [
                    'classes' => 'link--plus',
                    'url' => 'javascript:',
                    'title' => __('Load more articles', 'selectrum'),
                ]);
                ?>
            </div>
        </div>
    </div>
</div>


<?php get_template_part('parts/cta'); ?>


<?php get_footer(); ?>
