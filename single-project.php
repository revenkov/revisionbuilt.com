<?php get_header(); ?>


<?php get_template_part('parts/hero'); ?>


<?php
$next_post = get_next_post();
$prev_post = get_previous_post();
?>
<div class="section">
    <div class="container">
        <nav class="postNav">
            <?php
            if ( $prev_post ) :
                get_template_part('parts/link', false, [
                    'classes' => 'link--prev postNav__prev',
                    'title' => __('Previous project', 'selectrum'),
                    'url' => get_permalink( $prev_post )
                ]);
            endif;
            if ( $next_post ) :
                get_template_part('parts/link', false, [
                    'classes' => 'postNav__next',
                    'title' => __('Previous project', 'selectrum'),
                    'url' => get_permalink( $next_post )
                ]);
            endif;
            get_template_part('parts/link', false, [
                'classes' => 'link--back postNav__back',
                'title' => __('Back to projects', 'selectrum'),
                'url' => selectrum_get_permalink(2566)
            ]);
            ?>
        </nav>
    </div>
</div>


<?php get_footer(); ?>
