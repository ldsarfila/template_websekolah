<?php

/**
 * Single Post Template
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
                            <div class="post-meta">
                                <span><?php echo get_the_date(); ?></span>
                                <span><?php echo get_the_category_list(', '); ?></span>
                            </div>

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

                            <div class="post-tags">
                                <?php
                                $tags = get_the_tags();
                                if ($tags) {
                                    echo '<div style="margin-top: 30px;">';
                                    foreach ($tags as $tag) {
                                        echo '<span class="btn btn-secondary" style="margin-right: 10px; display: inline-block;">#' . esc_html($tag->name) . '</span>';
                                    }
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </article>

                        <!-- Comments -->
                        <div style="margin-top: 50px;">
                            <?php
                            if (comments_open() || get_comments_number()) {
                                comments_template();
                            }
                            ?>
                        </div>

                        <!-- Related Posts -->
                        <div style="margin-top: 50px;">
                            <?php
                            $related_args = array(
                                'post_type'      => 'post',
                                'posts_per_page' => 3,
                                'post__not_in'   => array(get_the_ID()),
                                'category__in'   => wp_get_post_categories(get_the_ID())
                            );
                            $related_query = new WP_Query($related_args);

                            if ($related_query->have_posts()) {
                                echo '<h2 class="section-title">Artikel Terkait</h2>';
                                echo '<div class="posts-grid">';
                                while ($related_query->have_posts()) : $related_query->the_post();
                                    ?>
                                    <article class="post-card">
                                        <div class="post-card-image">
                                            <?php echo sekolah_thumbnail('medium'); ?>
                                        </div>
                                        <div class="post-card-content">
                                            <h3 class="post-card-title"><?php the_title(); ?></h3>
                                            <div class="post-card-meta">
                                                <span><?php echo get_the_date(); ?></span>
                                            </div>
                                            <p class="post-card-excerpt"><?php echo sekolah_excerpt(20); ?></p>
                                            <a href="<?php the_permalink(); ?>" class="post-card-link">Baca Selengkapnya →</a>
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
