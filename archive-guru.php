<?php

/**
 * Archive Guru
 */
get_header();
?>

<div class="container">
    <div class="section">
        <div class="page-wrapper">
            <div class="page-content">
                <h1 class="section-title">Daftar GTK</h1>
                <p class="section-subtitle">GTK (Guru dan Tenaga Kependidikan) di <?php echo esc_html(bloginfo('name')); ?></p>

                <div class="staff-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    $posisi = get_post_meta(get_the_ID(), '_guru_posisi', true);
                    $mata_pelajaran = get_post_meta(get_the_ID(), '_guru_mata_pelajaran', true);
                    ?>
                    <article class="staff-card">
                        <div class="staff-card-image">
                            <?php echo sekolah_thumbnail('guru-thumbnail'); ?>
                        </div>
                        <div class="staff-card-content">
                            <h3 class="staff-card-name"><?php the_title(); ?></h3>
                            <?php if (!empty($posisi)) : ?>
                                <p class="staff-card-position"><?php echo esc_html($posisi); ?></p>
                            <?php endif; ?>
                            <?php if (!empty($mata_pelajaran)) : ?>
                                <p class="staff-card-subject"><?php echo esc_html($mata_pelajaran); ?></p>
                            <?php endif; ?>
                            <a href="<?php the_permalink(); ?>" class="btn" style="display: inline-block; margin-top: 10px;">Lihat Detail</a>
                        </div>
                    </article>
                    <?php
                endwhile;
                ?>
                <div style="grid-column: 1/-1; display: flex; justify-content: center;">
                    <div class="pagination">
                        <?php
                        echo paginate_links(array(
                            'type' => 'list',
                        ));
                        ?>
                    </div>
                </div>
                <?php
            else :
                echo '<p>Tidak ada GTK yang ditemukan.</p>';
            endif;
            ?>
                </div>
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
