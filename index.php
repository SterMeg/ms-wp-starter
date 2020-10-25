<?php get_header(); ?>

<div class="wrapper content">  
    <?php //start the loop
    if( have_posts() ) while (have_posts(  )) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; //end the loop ?>
</div>

<?php get_footer(); ?>