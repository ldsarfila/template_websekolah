<?php

/**
 * Single Agenda Template
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
                        $tanggal_mulai = get_post_meta(get_the_ID(), '_agenda_tanggal_mulai', true);
                        $tanggal_berakhir = get_post_meta(get_the_ID(), '_agenda_tanggal_berakhir', true);
                        $jam_mulai = get_post_meta(get_the_ID(), '_agenda_jam_mulai', true);
                        $jam_selesai = get_post_meta(get_the_ID(), '_agenda_jam_selesai', true);
                        $lokasi = get_post_meta(get_the_ID(), '_agenda_lokasi', true);
                        $timezone = get_post_meta(get_the_ID(), '_agenda_timezone', true);
                        if (empty($timezone)) {
                            $timezone = 'WITA';
                        }
                        ?>
                        <article class="post-content">
                            <h1 class="post-title"><?php the_title(); ?></h1>

                            <!-- Agenda Details -->
                            <div class="agenda-detail-box">
                                <div class="agenda-detail-item">
                                    <span class="agenda-detail-label">📅 Tanggal Mulai</span>
                                    <span class="agenda-detail-value">
                                        <?php 
                                        if (!empty($tanggal_mulai)) {
                                            echo esc_html(date('l, d F Y', strtotime($tanggal_mulai)));
                                        } else {
                                            echo '—';
                                        }
                                        ?>
                                    </span>
                                </div>

                                <div class="agenda-detail-item">
                                    <span class="agenda-detail-label">📅 Tanggal Berakhir</span>
                                    <span class="agenda-detail-value">
                                        <?php 
                                        if (!empty($tanggal_berakhir)) {
                                            echo esc_html(date('l, d F Y', strtotime($tanggal_berakhir)));
                                        } else {
                                            echo '—';
                                        }
                                        ?>
                                    </span>
                                </div>

                                <?php if (!empty($jam_mulai)) : ?>
                                <div class="agenda-detail-item">
                                    <span class="agenda-detail-label">⏰ Jam Mulai</span>
                                    <span class="agenda-detail-value"><?php echo esc_html($jam_mulai); ?> <?php echo esc_html($timezone); ?></span>
                                </div>
                                <?php endif; ?>

                                <?php if (!empty($jam_selesai)) : ?>
                                <div class="agenda-detail-item">
                                    <span class="agenda-detail-label">⏰ Jam Selesai</span>
                                    <span class="agenda-detail-value"><?php echo esc_html($jam_selesai); ?> <?php echo esc_html($timezone); ?></span>
                                </div>
                                <?php endif; ?>

                                <?php if (!empty($lokasi)) : ?>
                                <div class="agenda-detail-item">
                                    <span class="agenda-detail-label">📍 Lokasi</span>
                                    <span class="agenda-detail-value"><?php echo esc_html($lokasi); ?></span>
                                </div>
                                <?php endif; ?>
                            </div>

                            <div class="post-body">
                                <?php the_content(); ?>
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

                        <!-- Related Agenda -->
                        <div style="margin-top: 50px;">
                            <?php
                            $related_args = array(
                                'post_type'      => 'agenda',
                                'posts_per_page' => 3,
                                'post__not_in'   => array(get_the_ID()),
                                'orderby'        => 'meta_value',
                                'meta_key'       => '_agenda_tanggal_mulai',
                                'order'          => 'ASC'
                            );
                            $related_query = new WP_Query($related_args);

                            if ($related_query->have_posts()) {
                                echo '<h2 class="section-title">Agenda Lainnya</h2>';
                                echo '<div class="related-agenda-list">';
                                while ($related_query->have_posts()) : $related_query->the_post();
                                    $agenda_tanggal_mulai = get_post_meta(get_the_ID(), '_agenda_tanggal_mulai', true);
                                    $agenda_jam = get_post_meta(get_the_ID(), '_agenda_jam_mulai', true);
                                    ?>
                                    <div class="related-agenda-item">
                                        <div class="related-agenda-date">
                                            <span class="date-value">
                                                <?php 
                                                if (!empty($agenda_tanggal_mulai)) {
                                                    echo esc_html(date('d', strtotime($agenda_tanggal_mulai)));
                                                }
                                                ?>
                                            </span>
                                            <span class="date-month">
                                                <?php 
                                                if (!empty($agenda_tanggal_mulai)) {
                                                    echo esc_html(date('M', strtotime($agenda_tanggal_mulai)));
                                                }
                                                ?>
                                            </span>
                                        </div>
                                        <div class="related-agenda-info">
                                            <h4 class="related-agenda-title">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h4>
                                            <?php if (!empty($agenda_jam)) : ?>
                                            <p class="related-agenda-time">
                                                <span class="icon">⏰</span> <?php echo esc_html($agenda_jam); ?>
                                            </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
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
