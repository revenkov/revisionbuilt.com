<?php
use Selectrum\WalkerNavMenu;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php echo wp_title( '|', true, 'right' ); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<meta name="format-detection" content="telephone=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
    <?php /*
    <link rel="icon" type="image/x-icon" href="<?php echo selectrum_get_image_url('favicon/favicon.ico'); ?>">
    <link rel="icon" type="image/png" href="<?php echo selectrum_get_image_url('favicon/favicon-32x32.png'); ?>" sizes="32x32" />
    <link rel="icon" type="image/png" href="<?php echo selectrum_get_image_url('favicon/favicon-16x16.png'); ?>" sizes="16x16" />
    */ ?>
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div class="site" id="site">

    <header id="siteHeader" class="siteHeader">
        <div class="container siteHeader__container">
            <div class="siteHeader__inner">
                <a class="siteHeader__logoContainer" href="<?php echo home_url(); ?>" title="<?php bloginfo( 'blog_name' ); ?>">
                    <img class="siteHeader__logoImage" src="<?php echo selectrum_get_image_url('logo.png'); ?>" alt="<?php bloginfo( 'blog_name' ); ?>">
                </a>
            </div>
        </div>
    </header>


    <button class="btnMenu" id="btnMenu">
        <span class="btnMenu__text"><?php echo __('Menu', 'selectrum'); ?></span>
    </button>


    <nav id="siteNav" class="siteNav">
        <a class="siteNav__logoContainer" href="<?php echo home_url(); ?>" title="<?php bloginfo( 'blog_name' ); ?>">
            <img class="siteNav__logoImage" src="<?php echo selectrum_get_image_url('logo.png'); ?>" alt="<?php bloginfo( 'blog_name' ); ?>">
        </a>
        <button class="siteNav__closeButton" id="btnMenuClose" title="Close"><span></span><span></span></button>
        <div class="container siteNav__container">
            <div class="siteNav__inner">
                <div class="siteNav__inner2">
	                <?php
	                wp_nav_menu( array(
		                'theme_location' => 'primary_menu',
		                'menu_class'     => 'primaryMenu',
		                'menu_id'        => 'primaryMenu',
		                'container'      => false,
		                'walker'         => new WalkerNavMenu()
	                ) );
	                ?>

                    <?php
                    get_template_part('parts/button', false, [
                        'title' => __('Book a consultation', 'selectrum'),
                        'target' => '_blank',
                        'url' => '#'
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </nav>


    <div id="siteContent" class="siteContent">