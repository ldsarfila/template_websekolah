<?php

/**
 * Template Name: Fasilitas
 * Post Type: fasilitas
 */
get_header();
?>

<div class="container">
    <div class="section">
        <div class="page-wrapper">
            <div class="page-content">
                <?php
                if (have_posts()) :
                    while (have_posts()) : the_post();
                ?>
                <article class="post-content">
                    <h1 class="post-title"><?php the_title(); ?></h1>

                    <?php
                    if (has_post_thumbnail()) {
                        echo '<div class="post-featured-image">';
                        the_post_thumbnail('large');
                        echo '</div>';
                    }
                    ?>

                    <div class="post-body">
                        <?php the_content(); ?>
                    </div>
                </article>

                <!-- Related Fasilitas -->
                <div style="margin-top: 50px;">
                    <?php
                    $related_args = array(
                        'post_type'      => 'fasilitas',
                        'posts_per_page' => 6,
                        'post__not_in'   => array(get_the_ID())
                    );
                    $related_query = new WP_Query($related_args);

                    if ($related_query->have_posts()) {
                        echo '<h2 class="section-title">Fasilitas Lainnya</h2>';
                        echo '<div class="posts-grid">';
                        while ($related_query->have_posts()) : $related_query->the_post();
                            ?>
                            <article class="post-card">
                                <div class="post-card-image">
                                    <?php echo sekolah_thumbnail('medium'); ?>
                                </div>
                                <div class="post-card-content">
                                    <h3 class="post-card-title"><?php the_title(); ?></h3>
                                    <p class="post-card-excerpt"><?php echo sekolah_excerpt(15); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="post-card-link">Lihat →</a>
                                </div>
                            </article>
                            <?php
                        endwhile;
                        echo '</div>';
                        wp_reset_postdata();
                    }
                    ?>
                        </div>
                        <?php
                    endwhile;
                endif;
                ?>
            </div>

            <aside class="sidebar">
                <?php
                if (is_active_sidebar('primary-sidebar')) {
                    dynamic_sidebar('primary-sidebar');
                }
                ?>
            </aside>
        </div>
    </div>
</div>

<?php get_footer(); ?>
