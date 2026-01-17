<?php

/**
 * Archive Agenda
 */
get_header();

// Get current filter from URL
$current_month = isset($_GET['bulan']) ? sanitize_text_field($_GET['bulan']) : date('Y-m');
list($year, $month) = explode('-', $current_month . '-' . date('m'));
$year = isset($_GET['bulan']) ? substr($current_month, 0, 4) : date('Y');
$month = isset($_GET['bulan']) ? substr($current_month, 5, 2) : date('m');

// Generate month options for filter
$months = array();
for ($i = 0; $i < 12; $i++) {
    $timestamp = strtotime("-$i months");
    $months[date('Y-m', $timestamp)] = array(
        'label' => date('F Y', $timestamp),
        'value' => date('Y-m', $timestamp)
    );
}
?>

<div class="container">
    <div class="section">
        <div class="page-wrapper">
            <div class="page-content">
                <h1 class="section-title">Agenda</h1>
                <p class="section-subtitle">Agenda kegiatan dan aktivitas sesuai dengan kalender pendidikan</p>

                <!-- Filter Bulan -->
                <div class="agenda-filter">
                    <form method="GET" class="filter-form">
                        <label for="month-filter">Filter Bulan:</label>
                        <select id="month-filter" name="bulan" onchange="this.form.submit()">
                            <option value="">Semua Bulan</option>
                            <?php foreach ($months as $month_data) : ?>
                                <option value="<?php echo esc_attr($month_data['value']); ?>" 
                                    <?php selected($current_month, $month_data['value']); ?>>
                                    <?php echo esc_html($month_data['label']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                </div>

                <!-- Agenda List -->
                <div class="agenda-list">
            <?php
            // Build query args
            $args = array(
                'post_type'      => 'agenda',
                'posts_per_page' => 20,
                'orderby'        => 'meta_value',
                'meta_key'       => '_agenda_tanggal_mulai',
                'order'          => 'ASC',
            );

            // Add date filter if selected
            if (!empty($_GET['bulan'])) {
                $args['meta_query'] = array(
                    array(
                        'key'     => '_agenda_tanggal_mulai',
                        'value'   => array(
                            date('Y-m-01', strtotime($current_month)),
                            date('Y-m-t', strtotime($current_month))
                        ),
                        'compare' => 'BETWEEN',
                        'type'    => 'DATE'
                    )
                );
            }

            $agenda_query = new WP_Query($args);

            if ($agenda_query->have_posts()) :
                $current_date = '';
                while ($agenda_query->have_posts()) : $agenda_query->the_post();
                    $tanggal_mulai = get_post_meta(get_the_ID(), '_agenda_tanggal_mulai', true);
                    $tanggal_berakhir = get_post_meta(get_the_ID(), '_agenda_tanggal_berakhir', true);
                    $jam_mulai = get_post_meta(get_the_ID(), '_agenda_jam_mulai', true);
                    $jam_selesai = get_post_meta(get_the_ID(), '_agenda_jam_selesai', true);
                    $lokasi = get_post_meta(get_the_ID(), '_agenda_lokasi', true);
                    $timezone = get_post_meta(get_the_ID(), '_agenda_timezone', true);
                    if (empty($timezone)) {
                        $timezone = 'WITA';
                    }
                    
                    $formatted_date = !empty($tanggal_mulai) ? date('l, d F Y', strtotime($tanggal_mulai)) : date('l, d F Y');
                    
                    // Show date header if different from previous
                    if ($current_date !== $formatted_date) :
                        if (!empty($current_date)) : ?>
                            </div>
                        <?php endif;
                        $current_date = $formatted_date;
                        ?>
                        <div class="agenda-date-group">
                            <h3 class="agenda-date-header"><?php echo esc_html($formatted_date); ?></h3>
                    <?php endif; ?>
                    
                    <div class="agenda-item">
                        <div class="agenda-time">
                            <?php if (!empty($jam_mulai)) : ?>
                                <div class="agenda-time-start"><?php echo esc_html($jam_mulai); ?> <span class="timezone"><?php echo esc_html($timezone); ?></span></div>
                                <?php if (!empty($jam_selesai)) : ?>
                                    <div class="agenda-time-end">s/d <?php echo esc_html($jam_selesai); ?> <span class="timezone"><?php echo esc_html($timezone); ?></span></div>
                                <?php endif; ?>
                            <?php else : ?>
                                <div class="agenda-time-start">—</div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="agenda-content">
                            <h4 class="agenda-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h4>
                            
                            <div class="agenda-meta">
                                <?php
                                // Display date range
                                $date_display = '';
                                if (!empty($tanggal_mulai)) {
                                    $date_display = date('d M Y', strtotime($tanggal_mulai));
                                    if (!empty($tanggal_berakhir) && $tanggal_berakhir !== $tanggal_mulai) {
                                        $date_display .= ' - ' . date('d M Y', strtotime($tanggal_berakhir));
                                    }
                                }
                                ?>
                                <?php if (!empty($date_display)) : ?>
                                    <span class="agenda-date">
                                        <span class="icon">📅</span> <?php echo esc_html($date_display); ?>
                                    </span>
                                <?php endif; ?>

                                <?php if (!empty($lokasi)) : ?>
                                    <span class="agenda-location">
                                        <span class="icon">📍</span> <?php echo esc_html($lokasi); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <p class="agenda-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                        </div>
                    </div>
                    <?php
                endwhile;
                ?>
                </div>
                <?php
                // Pagination
                if ($agenda_query->max_num_pages > 1) :
                    $base = add_query_arg('paged', '%#%');
                    if (!empty($_GET['bulan'])) {
                        $base = add_query_arg('bulan', $current_month, $base);
                    }
                    ?>
                    <div class="pagination">
                        <?php
                        echo paginate_links(array(
                            'base'      => $base,
                            'format'    => '?paged=%#%',
                            'current'   => max(1, get_query_var('paged')),
                            'total'     => $agenda_query->max_num_pages,
                            'type'      => 'list',
                        ));
                        ?>
                    </div>
                <?php endif;
                wp_reset_postdata();
            else :
                ?>
                <div class="agenda-empty">
                    <p>Tidak ada agenda untuk periode yang dipilih.</p>
                </div>
                <?php
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
