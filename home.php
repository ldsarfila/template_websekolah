<?php
/**
 * Home Template
 */
get_header();
?>

<!-- Smart Slider 3 Slideshow -->
<div class="slider-wrapper">
    <?php echo do_shortcode('[smartslider3 slider="2"]'); ?>
</div>

<!-- Welcome Section & Statistics Combined -->
<section class="section" id="tentang">
    <div class="container">
        <div class="welcome-stats-wrapper">
            <!-- Welcome Section Column -->
            <?php
            $sambutan_page = get_page_by_title('Sambutan Kepala Sekolah', OBJECT, 'page');
            if ($sambutan_page) :
                ?>
                <div class="welcome-stats-column">
                    <h2 class="section-title">Sambutan Kepala Sekolah</h2>
                    <div class="welcome-section">
                        <div class="welcome-content">
                            <h3>Kepala Sekolah</h3>
                            <p><?php echo wp_trim_words($sambutan_page->post_content, 50); ?></p>
                            <a href="<?php echo get_permalink($sambutan_page->ID); ?>" class="btn">Selengkapnya</a>
                        </div>
                        <div class="welcome-image">
                            <?php
                            if (has_post_thumbnail($sambutan_page->ID)) {
                                echo get_the_post_thumbnail($sambutan_page->ID, 'large', array('class' => 'welcome-photo'));
                            } else {
                                echo '<div class="welcome-photo-placeholder">📷</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Statistics Column -->
            <div class="welcome-stats-column">
                <h2 class="section-title">Statistik Data Sekolah</h2>
                <div class="statistics">
                    <div class="stat-card">
                        <div class="number"><?php echo get_option('sekolah_jumlah_guru', '75'); ?></div>
                        <div class="label">Guru & Staf</div>
                    </div>
                    <div class="stat-card">
                        <div class="number"><?php echo get_option('sekolah_jumlah_siswa', '1250'); ?></div>
                        <div class="label">Siswa</div>
                    </div>
                    <div class="stat-card">
                        <div class="number"><?php echo get_option('sekolah_jumlah_rombel', '45'); ?></div>
                        <div class="label">Rombel & Ruang</div>
                    </div>
                </div>

                <!-- Curriculum & Utilities -->
                <div class="curriculum-utilities">
                    <div class="utility-card">
                        <div class="utility-label">Kurikulum</div>
                        <div class="utility-value"><?php echo esc_html(get_option('sekolah_kurikulum', 'Kurikulum Merdeka')); ?></div>
                    </div>
                    <div class="utility-card">
                        <div class="utility-label">Penyelenggaraan</div>
                        <div class="utility-value"><?php echo esc_html(get_option('sekolah_penyelenggaraan', 'Satuan Pendidikan')); ?></div>
                    </div>
                    <div class="utility-card">
                        <div class="utility-label">Luas Tanah</div>
                        <div class="utility-value"><?php echo esc_html(get_option('sekolah_luas_tanah', '2.5 Ha')); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Agenda -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Agenda</h2>
        <p class="section-subtitle">Agenda kegiatan dan aktivitas sesuai dengan kalender pendidikan</p>
        
        <div class="agenda-grid-home">
            <?php
            $agenda_args = array(
                'post_type'      => 'agenda',
                'posts_per_page' => 6,
                'orderby'        => 'meta_value',
                'meta_key'       => '_agenda_tanggal_mulai',
                'order'          => 'ASC'
            );
            $agenda_query = new WP_Query($agenda_args);

            if ($agenda_query->have_posts()) :
                while ($agenda_query->have_posts()) : $agenda_query->the_post();
                    $tanggal_mulai = get_post_meta(get_the_ID(), '_agenda_tanggal_mulai', true);
                    $tanggal_berakhir = get_post_meta(get_the_ID(), '_agenda_tanggal_berakhir', true);
                    ?>
                    <div class="agenda-item-home">
                        <h3 class="agenda-title-home">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                        <div class="agenda-date-home">
                            <?php
                            $date_display = '';
                            if (!empty($tanggal_mulai)) {
                                $date_display = date('d M Y', strtotime($tanggal_mulai));
                                if (!empty($tanggal_berakhir) && $tanggal_berakhir !== $tanggal_mulai) {
                                    $date_display .= ' - ' . date('d M Y', strtotime($tanggal_berakhir));
                                }
                            }
                            echo esc_html($date_display);
                            ?>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>

<!-- News/Posts -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Berita, Artikel & Informasi</h2>
        <p class="section-subtitle">Berita, artikel & informasi sekolah kami</p>
        
        <div class="posts-grid">
            <?php
            $news_args = array(
                'post_type'      => 'post',
                'posts_per_page' => 6
            );
            $news_query = new WP_Query($news_args);

            if ($news_query->have_posts()) :
                while ($news_query->have_posts()) : $news_query->the_post();
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
                            <p class="post-card-excerpt"><?php echo sekolah_excerpt(15); ?></p>
                            <a href="<?php the_permalink(); ?>" class="post-card-link">Baca Selengkapnya →</a>
                        </div>
                    </article>
                    <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>

<!-- GTK -->
<section class="section">
    <div class="container">
        <h2 class="section-title">GTK</h2>
        <p class="section-subtitle">GTK (Guru dan Tenaga Kependidikan) di <?php echo esc_html(bloginfo('name')); ?></p>
        
        <div class="staff-grid-carousel">
            <div class="carousel-container">
                <?php
                $guru_args = array(
                    'post_type'      => 'guru',
                    'posts_per_page' => 4
                );
                $guru_query = new WP_Query($guru_args);

                if ($guru_query->have_posts()) :
                    $guru_count = $guru_query->post_count;
                    $items_per_slide = 4;
                    $total_slides = ceil($guru_count / $items_per_slide);
                    
                    $current_item = 0;
                    while ($guru_query->have_posts()) : $guru_query->the_post();
                        // Open slide div every 4 items
                        if ($current_item % $items_per_slide === 0) {
                            echo '<div class="carousel-slide' . ($current_item === 0 ? ' active' : '') . '">';
                            echo '<div class="staff-grid">';
                        }
                        
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
                            </div>
                        </article>
                    <?php
                        // Close slide div every 4 items
                        if (($current_item + 1) % $items_per_slide === 0 || ($current_item + 1) === $guru_count) {
                            echo '</div>';
                            echo '</div>';
                        }
                        $current_item++;
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
        </div>
    </div>
</section>
<!-- Fasilitas -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Fasilitas Sekolah</h2>
        <p class="section-subtitle">Fasilitas sekolah yang kami miliki</p>
        
        <div class="posts-grid">
            <?php
            $fasilitas_args = array(
                'post_type'      => 'fasilitas',
                'posts_per_page' => 6
            );
            $fasilitas_query = new WP_Query($fasilitas_args);

            if ($fasilitas_query->have_posts()) :
                while ($fasilitas_query->have_posts()) : $fasilitas_query->the_post();
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
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>

<!-- Ekstrakurikuler -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Ekstrakurikuler</h2>
        <p class="section-subtitle">Ekstrakurikuler yang ada di sekolah kami</p>
        
        <div class="posts-grid">
            <?php
            $ekskul_args = array(
                'post_type'      => 'ekskul',
                'posts_per_page' => 6
            );
            $ekskul_query = new WP_Query($ekskul_args);

            if ($ekskul_query->have_posts()) :
                while ($ekskul_query->have_posts()) : $ekskul_query->the_post();
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
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
