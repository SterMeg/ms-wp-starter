<?php get_header(); ?>
<div class="wrapper">
  <div class="content">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

      <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h1 class="entry-title has-heading-2-font-size"><?php the_title(); ?></h1>

        <div class="entry-meta">
          <p>By <?= get_the_author(); ?><br>
            <?= get_the_date(); ?></p>
        </div><!-- .entry-meta -->

        <div class="entry-content">
          <?php the_post_thumbnail('large'); ?>
          <?php the_content(); ?>
          <?php wp_link_pages(array(
            'before' => '<div class="page-link"> Pages: ',
            'after' => '</div>'
          )); ?>
        </div><!-- .entry-content -->

      </div><!-- #post-## -->

    <?php endwhile; // end of the loop. ?>

  </div> <!-- /.content -->

</div>

<?php get_footer(); ?>