<?php
/**
 * Template Name: Services
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
$services = get_field('services');
if ( !empty( $services ) ) :
?>
<div class="section">
    <?php foreach ( $services as $key=>$service ) : ?>
    <div class="serviceBlock">
        <div class="container">
            <div class="serviceBlock__inner">
                <div class="serviceBlock__header">
                    <h2 class="serviceBlock__title"><?php echo $service['title']; ?></h2>
                </div>
                <div class="serviceBlock__cols">
                    <div class="serviceBlock__imageCol">
                        <div class="mediaBlock serviceBlock__mediaBlock">
                            <?php echo wp_get_attachment_image( $service['image']['ID'], 'full'); ?>
                        </div>
                    </div>
                    <div class="serviceBlock__textCol">
                        <div class="serviceBlock__textContainer">
                            <?php echo $service['content']; ?>

                            <?php get_template_part('parts/link', false, $service['button']); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>


<?php
$projects = get_field('projects');
$posts = $projects['projects'];
if ( empty( $posts ) ) :
    $posts = get_posts([
        'post_type' => 'project',
        'posts_per_page' => 4,
    ]);
endif;
if ( !empty( $posts ) ) :
?>
<div class="section">
    <div class="container">
        <div class="featuredProjects">
            <div class="featuredProjects__header">
                <div class="featuredProjects__headerLeft"><?php echo $projects['content']; ?></div>
                <div class="featuredProjects__headerRight">
                    <?php
                    get_template_part('parts/link', false, [
                        'title' => __('Explore our projects', 'selectrum'),
                        'url' => selectrum_get_permalink( 2566 )
                    ]);
                    ?>
                </div>
            </div>
            <div class="featuredProjects__listing">
                <div class="featuredProjects__items">
                    <?php foreach ( $posts as $post ) : setup_postdata($post); ?>
                        <div class="featuredProjects__item">
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
                                    <div class="projectTeaser__categories">
                                        <div class="projectTeaser__category"><?php echo implode('</div><div class="projectTeaser__category">', array_column($categories, 'name')); ?></div>
                                    </div>
                                    <h3 class="projectTeaser__title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="projectTeaser__subtitle"><?php echo $main_content['subtitle']; ?></div>
                                </div>
                                <a class="projectTeaser__overlayLink" href="<?php echo get_the_permalink(); ?>" title="<?php the_title(); ?>"></a>
                            </div>
                        </div>
                    <?php endforeach; wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>


<?php
$content_group_1 = get_field('content_group_1');
if ( !empty( $content_group_1 ) ) :
?>
<div class="section">
    <div class="container">
        <div class="certificationBlock">
            <div class="certificationBlock__header"><?php echo $content_group_1['content_1']; ?></div>
            <div class="certificationBlock__logo"><?php echo wp_get_attachment_image( $content_group_1['logo']['ID'], 'full' ); ?></div>
            <div class="certificationBlock__content"><?php echo $content_group_1['content_2']; ?></div>
        </div>
    </div>
</div>
<?php endif; ?>


<?php get_template_part('parts/cta'); ?>


<?php get_footer(); ?>
