<?php
/**
 * Header Template
 */

// Debug - check if header is being loaded
if (defined('WP_DEBUG') && WP_DEBUG) {
    error_log('Header.php loaded');
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header class="site-header">
        <div class="header-container">
            <div class="site-logo">
                <?php if (has_custom_logo()) : ?>
                    <div class="custom-logo">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php endif; ?>
                <div class="site-branding">
                    <h1><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
                    <p><?php bloginfo('description'); ?></p>
                </div>
            </div>

            <button class="menu-toggle" id="menu-toggle" aria-label="Toggle Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <nav class="main-navigation" id="main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'fallback_cb'    => 'wp_page_menu',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'depth'          => 2
                ));
                ?>
            </nav>
        </div>
    </header>

    <main id="main" class="site-main">
