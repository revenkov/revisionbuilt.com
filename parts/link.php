<?php
if ( empty( $args ) ) {
    return;
}
?>
<p>
    <a class="link <?php echo $args['classes'] ?? ''; ?>" href="<?php echo $args['url']; ?>" <?php if ( !empty( $args['target'] ) ) : ?>target="_blank"<?php endif; ?>>
        <span class="link__text"><?php echo $args['title']; ?></span>
    </a>
</p>
