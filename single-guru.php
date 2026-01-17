<?php

/**
 * Template Name: GTK
 * Post Type: guru
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
                    <div style="display: grid; grid-template-columns: 113px 1fr; gap: 40px; align-items: start;">
                        <div class="guru-image-container">
                            <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('guru-thumbnail');
                            } else {
                                echo '<img src="' . get_template_directory_uri() . '/images/placeholder.png" alt="' . get_the_title() . '" class="guru-image">';
                            }
                            ?>
                        </div>
                        <div>
                            <h1 class="post-title"><?php the_title(); ?></h1>
                            <p style="font-size: 18px; color: var(--secondary-color); font-weight: 600; margin-bottom: 20px;">
                                <?php
                                $posisi = get_post_meta(get_the_ID(), '_guru_posisi', true);
                                if ($posisi) {
                                    echo esc_html($posisi);
                                } else {
                                    the_excerpt();
                                }
                                ?>
                            </p>

                            <?php
                            $mata_pelajaran = get_post_meta(get_the_ID(), '_guru_mata_pelajaran', true);
                            if (!empty($mata_pelajaran)) :
                                ?>
                                <div style="margin-bottom: 20px; padding: 15px; background-color: #f0f7ff; border-left: 4px solid var(--primary-color); border-radius: 4px;">
                                    <p style="margin: 0; font-size: 14px; color: var(--text-dark);">
                                        <strong>📚 Mata Pelajaran:</strong> <?php echo esc_html($mata_pelajaran); ?>
                                    </p>
                                </div>
                            <?php endif; ?>

                            <div class="post-body">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Related Guru -->
                <div style="margin-top: 50px;">
                    <?php
                    $related_args = array(
                        'post_type'      => 'guru',
                        'posts_per_page' => 4,
                        'post__not_in'   => array(get_the_ID())
                    );
                    $related_query = new WP_Query($related_args);

                    if ($related_query->have_posts()) {
                        echo '<h2 class="section-title">Guru Lainnya</h2>';
                        echo '<div class="staff-grid">';
                        while ($related_query->have_posts()) : $related_query->the_post();
                            ?>
                            <article class="staff-card">
                                <div class="staff-card-image">
                                    <?php echo sekolah_thumbnail('guru-thumbnail'); ?>
                                </div>
                                <div class="staff-card-content">
                                    <h3 class="staff-card-name"><?php the_title(); ?></h3>
                                    <p class="staff-card-position"><?php the_excerpt(); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="btn" style="display: inline-block; margin-top: 10px;">Lihat Detail</a>
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
