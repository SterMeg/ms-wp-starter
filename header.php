<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <?php wp_head(); ?>
</head>

<body <?php body_class( ); ?>>
    <a href="#maincontent" class="skiplink">Go to Main Content</a>
    <header class="main-nav wrapper has-box-shadow">
        <nav class="flex space-between">
           <?php if ( function_exists('the_custom_logo')) {
               the_custom_logo();
           } else {
                echo '<h1>'. get_bloginfo( 'name' ) .'</h1>';   
           } ?>
            <button id="menuToggle" class="mobile-menu-button">
                <span></span>
                <span></span>
                <span></span>
                <span class="visuallyhidden">Menu</span>
           </button>
            <?php wp_nav_menu(array(
                'theme_location' => 'primary'
            )); ?>
        </nav>
    </header>
    <main>
</body>
</html>