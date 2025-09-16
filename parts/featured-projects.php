<?php
$projects = get_field('projects');
$posts = $projects['projects'];
if ( empty( $posts ) ) :
    $posts = get_posts([
        'post_type' => 'project',
        'posts_per_page' => 4,
    ]);
endif;
if ( empty( $posts ) ) :
    return;
endif;
?>
<div class="section">
    <div class="container">
        <div class="featuredProjects">
            <div class="featuredProjects__header" data-aos="fade-up">
                <?php echo $projects['content']; ?>
            </div>
            <div class="featuredProjects__listing">
                <div class="projectsListing">
                    <div class="projectsListing__items">
                        <?php foreach ( $posts as $post ) : setup_postdata($post); ?>
                            <div class="projectsListing__item" data-aos="fade-up">
                                <?php get_template_part('parts/project-teaser'); ?>
                            </div>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
            <nav class="featuredProjects__nav" data-aos="fade-up">
                <?php
                get_template_part('parts/link', false, [
                        'title' => __('Explore our projects', 'selectrum'),
                        'url' => selectrum_get_permalink( 2566 )
                ]);
                ?>
            </nav>
        </div>
    </div>
</div>