<?php
/*
 * Template Name: Marketing
 * description: >-
  Page with no header or footer
 */ 
?>

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
<main>
<div class="wrapper content">  
    <?php //start the loop
    if( have_posts() ) while (have_posts(  )) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; //end the loop ?>
</div>

<?php wp_footer(); ?>
</body>
</html>
