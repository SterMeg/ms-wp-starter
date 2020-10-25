<?php 
    $cat_args = array(
        'child_of' => 0,
        'parent' => '',
        'type' => 'post',
        'hide_empty' => false,
        'taxonomy' => 'category'
    );

get_header(); ?>

<div class="wrapper content">  
    <div class="grid">
    <?php $categories = get_categories($cat_args);
        foreach($categories as $category) {
        ?>
        <div class="category">
            <h2 class="has-sm-heading-font-size"><?= $category->cat_name; ?></h2>
        <?php 
            $query_args = array(
                'post_type' => 'post',
                'category_name' => $category->slug,
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC'     
            );

            $recent = new WP_Query($query_args);

            if ($recent->have_posts()): 
                while($recent->have_posts()) :
                    $recent->the_post();
                ?>
                    <article class="entry">
                        <h3 class="has-dark-grey-color has-body-font-size has-body-font-style"><?= get_the_title(); ?> - <a href="<?= get_the_permalink(); ?>">Read here</a></h3>
                    </article>
                <?php endwhile; ?>
                <!-- <?php if ($recent->max_num_pages > 1): ?>
                    <a href="/blog/category/<?= $category->slug; ?>">See more articles</a>
                <?php endif; ?> -->
            <?php else: ?>
                <h3 class="has-dark-grey-color has-body-font-size has-body-font-style">Coming soon...</h3>
            <?php endif; ?>
        </div>
    <?php }
        wp_reset_postdata();
    ?>
    </div>
</div>

<?php get_footer(); ?>