    </div>

    <?php
    $address = get_field('address', 'options');
    $phone = get_field('phone', 'options');
    $email = get_field('email', 'options');
    $logos = get_field('logos', 'options');
    $footer_menu = get_field('footer_menu', 'options');
    ?>
    <footer class="siteFooter">
        <div class="container">
            <div class="siteFooter__inner">
                <div class="siteFooter__col1">
                    <a class="siteFooter__logoContainer" href="<?php echo home_url(); ?>" title="<?php bloginfo( 'blog_name' ); ?>">
                        <img class="siteFooter__logoImage" src="<?php echo selectrum_get_image_url('logo.png'); ?>" alt="<?php bloginfo( 'blog_name' ); ?>">
                    </a>
                    <?php if ( !empty( $address ) ) : ?>
                        <div class="siteFooter__address"><a href="//google.com/maps?q=<?php echo strip_tags(urlencode($address)); ?>" target="_blank"><?php echo $address; ?></a></div>
                    <?php endif; ?>
                    <div class="siteFooter__contacts">
                        <?php if ( !empty( $email ) ) : ?><div class="siteFooter__email"><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></div><?php endif; ?>
                        <?php if ( !empty( $phone ) ) : ?><div class="siteFooter__phone"><a href="tel:+1<?php echo preg_replace("/[^0-9]/", "", $phone); ?>"><?php echo $phone; ?></a></div><?php endif; ?>
                    </div>
                    <?php if ( !empty( $logos ) ) : ?>
                        <div class="siteFooter__logos">
                            <?php foreach ( $logos as $logo ) : ?>
                                <a href="<?php echo $logo['url']; ?>" target="_blank">
                                    <?php echo wp_get_attachment_image( $logo['logo_image']['ID'], 'full' ); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="siteFooter__col2">
                    <div class="siteFooter__blocks">
                        <?php
                        if ( !empty( $footer_menu ) ) :
                            foreach ( $footer_menu as $menu ) :
                                ?>
                                <div class="siteFooter__block">
                                    <div class="siteFooter__blockTitle"><?php echo $menu['title']; ?></div>
                                    <div class="siteFooter__blockContent">
                                        <ul>
                                            <?php foreach ( $menu['links'] as $item ) : ?>
                                                <li>
                                                    <a href="<?php echo $item['link']['url']; ?>" target="<?php echo $item['target'] ?? '_self'; ?>"><?php echo $item['link']['title']; ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php
                            endforeach;
                        endif;
                        ?>
                        <div class="siteFooter__block">
                            <div class="siteFooter__blockTitle"><?php echo __('Connect with us', 'selectrum'); ?></div>
                            <div class="siteFooter__blockContent">
                                <div class="siteFooter__socials">
                                    <?php get_template_part('parts/socials'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="siteFooter__copyright">
                        &copy; <?php echo date('Y'); ?> Revision Built. <?php echo __('All Rights Reserved.', 'selectrum'); ?> <span class="siteFooter__divider"></span> <?php echo sprintf( __('Website by %s.', 'selectrum'), '<a href="https://www.selectrum.com/" target="_blank">SELECTRUM COMMUNICATIONS</a>'); ?> <a href="<?php echo get_privacy_policy_url(); ?>"><?php echo __('Privacy Policy', 'selectrum'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>

    </div>

</body>
</html>
