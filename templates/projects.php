<?php
/**
 * Template Name: Projects
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
        <div class="introBlock" data-aos="fade-up"><?php echo $intro_content; ?></div>
    </div>
</div>
<?php endif; ?>


<?php
$posts = get_posts([
    'post_type' => 'project',
    'posts_per_page' => -1,
]);
?>
<div class="section">
    <div class="container">
        <div class="projectsListing projectsListing--isotope">
            <div class="projectsListing__items" data-aos="fade-up">
                <?php foreach ( $posts as $post ) : setup_postdata($post); ?>
                    <div class="projectsListing__item">
                        <?php get_template_part('parts/project-teaser'); ?>
                    </div>
                <?php endforeach; wp_reset_postdata(); ?>
            </div>
            <div class="projectsListing__pagination" data-aos="fade-up">
                <?php
                get_template_part('parts/link', false, [
                    'classes' => 'link--plus',
                    'url' => 'javascript:',
                    'title' => __('Load more projects', 'selectrum'),
                ]);
                ?>
            </div>
        </div>
    </div>
</div>


<?php get_template_part('parts/cta'); ?>


<?php get_footer(); ?>
