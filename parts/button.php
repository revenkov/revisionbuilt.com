<?php
if ( empty( $args ) ) {
    return;
}
?>
<p>
    <a class="button" href="<?php echo $args['url']; ?>" <?php if ( !empty( $args['target'] ) ) : ?>target="<?php echo $args['target']; ?>"<?php endif; ?>>
        <span class="button__text"><?php echo $args['title']; ?></span>
    </a>
</p>
