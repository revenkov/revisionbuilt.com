<?php
header("HTTP/1.1 301 Moved Permanently");
header("Location: ".get_bloginfo('url'));
exit();
?>
<?php get_header(); ?>


<?php get_template_part('parts/hero'); ?>


<div class="section">
    <div class="container">
        <?php echo get_field('404_message', 'options'); ?>
    </div>
</div>


<?php get_footer(); ?>