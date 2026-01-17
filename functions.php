<?php
/**
 * Theme Functions
 */

// Theme Support
add_theme_support('post-thumbnails');
add_theme_support('title-tag');
add_theme_support('custom-logo');
add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

// Register Custom Image Sizes
add_image_size('guru-thumbnail', 113, 151, true);

// Register Menus
register_nav_menus(array(
    'primary' => __('Menu Utama', 'sekolah-indonesia'),
    'footer' => __('Menu Footer', 'sekolah-indonesia')
));

// Enqueue Styles and Scripts
if (!function_exists('sekolah_indonesia_scripts')) {
    function sekolah_indonesia_scripts() {
        wp_enqueue_style('sekolah-style', get_stylesheet_uri());
        wp_enqueue_script('sekolah-script', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true);
    }
    add_action('wp_enqueue_scripts', 'sekolah_indonesia_scripts');
}

// Custom Logo
if (!function_exists('sekolah_indonesia_custom_logo')) {
    function sekolah_indonesia_custom_logo() {
        $custom_logo_id = get_theme_mod('custom_logo');
        return sprintf(
            '<a href="%s" class="custom-logo-link">%s</a>',
            esc_url(home_url('/')),
            wp_get_attachment_image((int) $custom_logo_id, 'full')
        );
    }
}

// Register Widget Areas
if (!function_exists('sekolah_indonesia_widgets_init')) {
    function sekolah_indonesia_widgets_init() {
        register_sidebar(array(
            'name'          => __('Sidebar Utama', 'sekolah-indonesia'),
            'id'            => 'primary-sidebar',
            'description'   => __('Sidebar untuk halaman utama', 'sekolah-indonesia'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>'
        ));

        register_sidebar(array(
            'name'          => __('Footer 1', 'sekolah-indonesia'),
            'id'            => 'footer-1',
            'description'   => __('Footer area 1', 'sekolah-indonesia'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>'
        ));

        register_sidebar(array(
            'name'          => __('Footer 2', 'sekolah-indonesia'),
            'id'            => 'footer-2',
            'description'   => __('Footer area 2', 'sekolah-indonesia'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>'
        ));

        register_sidebar(array(
            'name'          => __('Footer 3', 'sekolah-indonesia'),
            'id'            => 'footer-3',
            'description'   => __('Footer area 3', 'sekolah-indonesia'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>'
        ));
    }
}
add_action('widgets_init', 'sekolah_indonesia_widgets_init');

// Custom Post Types
if (!function_exists('sekolah_indonesia_custom_post_types')) {
    function sekolah_indonesia_custom_post_types() {
        // GTK
        register_post_type('guru', array(
            'labels'       => array(
                'name'          => __('GTK', 'sekolah-indonesia'),
                'singular_name' => __('GTK', 'sekolah-indonesia')
            ),
            'public'       => true,
            'has_archive'  => true,
            'supports'     => array('title', 'editor', 'thumbnail'),
            'menu_icon'    => 'dashicons-groups'
        ));

        // Fasilitas
        register_post_type('fasilitas', array(
            'labels'       => array(
                'name'          => __('Fasilitas', 'sekolah-indonesia'),
                'singular_name' => __('Fasilitas', 'sekolah-indonesia')
            ),
            'public'       => true,
            'has_archive'  => true,
            'supports'     => array('title', 'editor', 'thumbnail'),
            'menu_icon'    => 'dashicons-building'
        ));

        // Ekstrakurikuler
        register_post_type('ekskul', array(
            'labels'       => array(
                'name'          => __('Ekstrakurikuler', 'sekolah-indonesia'),
                'singular_name' => __('Ekstrakurikuler', 'sekolah-indonesia')
            ),
            'public'       => true,
            'has_archive'  => true,
            'supports'     => array('title', 'editor', 'thumbnail'),
            'menu_icon'    => 'dashicons-heart'
        ));

        // Mata Pelajaran Pilihan
        register_post_type('program', array(
            'labels'       => array(
                'name'          => __('Mata Pelajaran Pilihan', 'sekolah-indonesia'),
                'singular_name' => __('Mata Pelajaran Pilihan', 'sekolah-indonesia')
            ),
            'public'       => true,
            'has_archive'  => true,
            'supports'     => array('title', 'editor', 'thumbnail'),
            'menu_icon'    => 'dashicons-book'
        ));

        // Agenda
        register_post_type('agenda', array(
            'labels'       => array(
                'name'          => __('Agenda', 'sekolah-indonesia'),
                'singular_name' => __('Agenda', 'sekolah-indonesia')
            ),
            'public'       => true,
            'has_archive'  => true,
            'supports'     => array('title', 'editor'),
            'menu_icon'    => 'dashicons-calendar'
        ));
    }
}
add_action('init', 'sekolah_indonesia_custom_post_types');

// Custom Taxonomies
if (!function_exists('sekolah_indonesia_custom_taxonomies')) {
    function sekolah_indonesia_custom_taxonomies() {
        // Kategori GTK
        register_taxonomy('kategori_guru', 'guru', array(
            'labels'       => array(
                'name'          => __('Kategori GTK', 'sekolah-indonesia'),
                'singular_name' => __('Kategori GTK', 'sekolah-indonesia')
            ),
            'hierarchical' => true
        ));

        // Kategori Program
        register_taxonomy('kategori_program', 'program', array(
            'labels'       => array(
                'name'          => __('Kategori Program', 'sekolah-indonesia'),
                'singular_name' => __('Kategori Program', 'sekolah-indonesia')
            ),
            'hierarchical' => true
        ));
    }
}
add_action('init', 'sekolah_indonesia_custom_taxonomies');

// Get Theme Option Helper
if (!function_exists('sekolah_option')) {
    function sekolah_option($option_name, $default = '') {
        return get_option('sekolah_' . $option_name, $default);
    }
}

// Excerpt Helper
if (!function_exists('sekolah_excerpt')) {
    function sekolah_excerpt($limit = 55) {
        $excerpt = wp_trim_words(get_the_excerpt(), $limit, '...');
        return $excerpt;
    }
}

// Image Helper
if (!function_exists('sekolah_thumbnail')) {
    function sekolah_thumbnail($size = 'medium') {
        if (has_post_thumbnail()) {
            return get_the_post_thumbnail(get_the_ID(), $size);
        }
        return sprintf(
            '<img src="%s" alt="%s">',
            esc_attr(get_template_directory_uri() . '/images/placeholder.png'),
            esc_attr(get_the_title())
        );
    }
}

// Debug - Enable error logging
if (defined('WP_DEBUG') && WP_DEBUG) {
    error_log('Theme loaded: sekolah-indonesia');
}

// Register Custom Meta Fields for GTK
if (!function_exists('sekolah_register_guru_meta')) {
    function sekolah_register_guru_meta() {
        register_post_meta('guru', '_guru_mata_pelajaran', array(
            'type'          => 'string',
            'single'        => true,
            'show_in_rest'  => true
        ));

        register_post_meta('guru', '_guru_posisi', array(
            'type'          => 'string',
            'single'        => true,
            'show_in_rest'  => true
        ));
    }
}
add_action('init', 'sekolah_register_guru_meta');

// Add Meta Boxes for GTK
if (!function_exists('sekolah_add_guru_meta_box')) {
    function sekolah_add_guru_meta_box() {
        add_meta_box(
            'guru_details',
            'Detail GTK',
            'sekolah_render_guru_meta_box',
            'guru',
            'normal',
            'high'
        );
    }
}
add_action('add_meta_boxes', 'sekolah_add_guru_meta_box');

// Render Meta Box for GTK
if (!function_exists('sekolah_render_guru_meta_box')) {
    function sekolah_render_guru_meta_box($post) {
        $mata_pelajaran = get_post_meta($post->ID, '_guru_mata_pelajaran', true);
        $posisi = get_post_meta($post->ID, '_guru_posisi', true);

        wp_nonce_field('sekolah_guru_nonce', 'sekolah_guru_nonce_field');
        ?>
        <div style="margin-bottom: 15px;">
            <label for="guru_posisi" style="display: block; margin-bottom: 5px; font-weight: bold;">Posisi/Jabatan:</label>
            <input type="text" id="guru_posisi" name="guru_posisi" value="<?php echo esc_attr($posisi); ?>" placeholder="Contoh: Guru Matematika" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="guru_mata_pelajaran" style="display: block; margin-bottom: 5px; font-weight: bold;">Mata Pelajaran:</label>
            <input type="text" id="guru_mata_pelajaran" name="guru_mata_pelajaran" value="<?php echo esc_attr($mata_pelajaran); ?>" placeholder="Contoh: Matematika, Bahasa Inggris" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            <small style="color: #666; display: block; margin-top: 5px;">Tuliskan mata pelajaran yang diampu (pisahkan dengan koma jika lebih dari satu)</small>
        </div>
        <?php
    }
}

// Save Meta Box Data for GTK
if (!function_exists('sekolah_save_guru_meta')) {
    function sekolah_save_guru_meta($post_id) {
        // Verify nonce
        if (!isset($_POST['sekolah_guru_nonce_field']) || !wp_verify_nonce($_POST['sekolah_guru_nonce_field'], 'sekolah_guru_nonce')) {
            return;
        }

        // Save meta fields
        if (isset($_POST['guru_mata_pelajaran'])) {
            update_post_meta($post_id, '_guru_mata_pelajaran', sanitize_text_field($_POST['guru_mata_pelajaran']));
        }

        if (isset($_POST['guru_posisi'])) {
            update_post_meta($post_id, '_guru_posisi', sanitize_text_field($_POST['guru_posisi']));
        }
    }
}
add_action('save_post_guru', 'sekolah_save_guru_meta');

// Register Custom Meta Fields for Agenda
if (!function_exists('sekolah_register_agenda_meta')) {
    function sekolah_register_agenda_meta() {
        register_post_meta('agenda', '_agenda_tanggal_mulai', array(
            'type'          => 'string',
            'single'        => true,
            'show_in_rest'  => true
        ));

        register_post_meta('agenda', '_agenda_tanggal_berakhir', array(
            'type'          => 'string',
            'single'        => true,
            'show_in_rest'  => true
        ));

        register_post_meta('agenda', '_agenda_jam_mulai', array(
            'type'          => 'string',
            'single'        => true,
            'show_in_rest'  => true
        ));

        register_post_meta('agenda', '_agenda_jam_selesai', array(
            'type'          => 'string',
            'single'        => true,
            'show_in_rest'  => true
        ));

        register_post_meta('agenda', '_agenda_lokasi', array(
            'type'          => 'string',
            'single'        => true,
            'show_in_rest'  => true
        ));

        register_post_meta('agenda', '_agenda_timezone', array(
            'type'          => 'string',
            'single'        => true,
            'show_in_rest'  => true
        ));
    }
}
add_action('init', 'sekolah_register_agenda_meta');

// Add Meta Boxes for Agenda
if (!function_exists('sekolah_add_agenda_meta_box')) {
    function sekolah_add_agenda_meta_box() {
        add_meta_box(
            'agenda_details',
            'Detail Agenda',
            'sekolah_render_agenda_meta_box',
            'agenda',
            'normal',
            'high'
        );
    }
}
add_action('add_meta_boxes', 'sekolah_add_agenda_meta_box');

// Render Meta Box for Agenda
if (!function_exists('sekolah_render_agenda_meta_box')) {
    function sekolah_render_agenda_meta_box($post) {
        $tanggal_mulai = get_post_meta($post->ID, '_agenda_tanggal_mulai', true);
        $tanggal_berakhir = get_post_meta($post->ID, '_agenda_tanggal_berakhir', true);
        $jam_mulai = get_post_meta($post->ID, '_agenda_jam_mulai', true);
        $jam_selesai = get_post_meta($post->ID, '_agenda_jam_selesai', true);
        $lokasi = get_post_meta($post->ID, '_agenda_lokasi', true);
        $timezone = get_post_meta($post->ID, '_agenda_timezone', true);
        if (empty($timezone)) {
            $timezone = 'WITA';
        }

        wp_nonce_field('sekolah_agenda_nonce', 'sekolah_agenda_nonce_field');
        ?>
        <div style="margin-bottom: 15px;">
            <label for="agenda_tanggal_mulai" style="display: block; margin-bottom: 5px; font-weight: bold;">Tanggal Mulai:</label>
            <input type="date" id="agenda_tanggal_mulai" name="agenda_tanggal_mulai" value="<?php echo esc_attr($tanggal_mulai); ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="agenda_tanggal_berakhir" style="display: block; margin-bottom: 5px; font-weight: bold;">Tanggal Berakhir:</label>
            <input type="date" id="agenda_tanggal_berakhir" name="agenda_tanggal_berakhir" value="<?php echo esc_attr($tanggal_berakhir); ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="agenda_jam_mulai" style="display: block; margin-bottom: 5px; font-weight: bold;">Jam Mulai:</label>
            <input type="time" id="agenda_jam_mulai" name="agenda_jam_mulai" value="<?php echo esc_attr($jam_mulai); ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="agenda_jam_selesai" style="display: block; margin-bottom: 5px; font-weight: bold;">Jam Selesai:</label>
            <input type="time" id="agenda_jam_selesai" name="agenda_jam_selesai" value="<?php echo esc_attr($jam_selesai); ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="agenda_lokasi" style="display: block; margin-bottom: 5px; font-weight: bold;">Lokasi:</label>
            <input type="text" id="agenda_lokasi" name="agenda_lokasi" value="<?php echo esc_attr($lokasi); ?>" placeholder="Contoh: Aula Sekolah" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="agenda_timezone" style="display: block; margin-bottom: 5px; font-weight: bold;">Zona Waktu:</label>
            <select id="agenda_timezone" name="agenda_timezone" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                <option value="WIB" <?php selected($timezone, 'WIB'); ?>>WIB (Waktu Indonesia Barat)</option>
                <option value="WITA" <?php selected($timezone, 'WITA'); ?>>WITA (Waktu Indonesia Tengah)</option>
                <option value="WIT" <?php selected($timezone, 'WIT'); ?>>WIT (Waktu Indonesia Timur)</option>
            </select>
        </div>
        <?php
    }
}

// Save Meta Box Data for Agenda
if (!function_exists('sekolah_save_agenda_meta')) {
    function sekolah_save_agenda_meta($post_id) {
        // Verify nonce
        if (!isset($_POST['sekolah_agenda_nonce_field']) || !wp_verify_nonce($_POST['sekolah_agenda_nonce_field'], 'sekolah_agenda_nonce')) {
            return;
        }

        // Save meta fields
        if (isset($_POST['agenda_tanggal_mulai'])) {
            update_post_meta($post_id, '_agenda_tanggal_mulai', sanitize_text_field($_POST['agenda_tanggal_mulai']));
        }

        if (isset($_POST['agenda_tanggal_berakhir'])) {
            update_post_meta($post_id, '_agenda_tanggal_berakhir', sanitize_text_field($_POST['agenda_tanggal_berakhir']));
        }

        if (isset($_POST['agenda_jam_mulai'])) {
            update_post_meta($post_id, '_agenda_jam_mulai', sanitize_text_field($_POST['agenda_jam_mulai']));
        }

        if (isset($_POST['agenda_jam_selesai'])) {
            update_post_meta($post_id, '_agenda_jam_selesai', sanitize_text_field($_POST['agenda_jam_selesai']));
        }

        if (isset($_POST['agenda_lokasi'])) {
            update_post_meta($post_id, '_agenda_lokasi', sanitize_text_field($_POST['agenda_lokasi']));
        }

        if (isset($_POST['agenda_timezone'])) {
            update_post_meta($post_id, '_agenda_timezone', sanitize_text_field($_POST['agenda_timezone']));
        }
    }
}
add_action('save_post_agenda', 'sekolah_save_agenda_meta');
// Theme Settings Page for School Statistics
if (!function_exists('sekolah_add_admin_menu')) {
    function sekolah_add_admin_menu() {
        add_menu_page(
            'Pengaturan Sekolah',
            'Pengaturan Sekolah',
            'manage_options',
            'sekolah-settings',
            'sekolah_render_settings_page',
            'dashicons-admin-generic',
            60
        );
    }
}
add_action('admin_menu', 'sekolah_add_admin_menu');

// Render Settings Page
if (!function_exists('sekolah_render_settings_page')) {
    function sekolah_render_settings_page() {
        // Check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }

        // Save settings
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sekolah_settings_nonce'])) {
            if (wp_verify_nonce($_POST['sekolah_settings_nonce'], 'sekolah_settings_save')) {
                update_option('sekolah_jumlah_guru', sanitize_text_field($_POST['sekolah_jumlah_guru'] ?? ''));
                update_option('sekolah_jumlah_siswa', sanitize_text_field($_POST['sekolah_jumlah_siswa'] ?? ''));
                update_option('sekolah_jumlah_rombel', sanitize_text_field($_POST['sekolah_jumlah_rombel'] ?? ''));
                update_option('sekolah_kurikulum', sanitize_text_field($_POST['sekolah_kurikulum'] ?? ''));
                update_option('sekolah_penyelenggaraan', sanitize_text_field($_POST['sekolah_penyelenggaraan'] ?? ''));
                update_option('sekolah_luas_tanah', sanitize_text_field($_POST['sekolah_luas_tanah'] ?? ''));
                echo '<div class="notice notice-success is-dismissible"><p>Pengaturan berhasil disimpan!</p></div>';
            }
        }

        $jumlah_guru = get_option('sekolah_jumlah_guru', '75');
        $jumlah_siswa = get_option('sekolah_jumlah_siswa', '1250');
        $jumlah_rombel = get_option('sekolah_jumlah_rombel', '45');
        $kurikulum = get_option('sekolah_kurikulum', 'Kurikulum Merdeka');
        $penyelenggaraan = get_option('sekolah_penyelenggaraan', 'Satuan Pendidikan');
        $luas_tanah = get_option('sekolah_luas_tanah', '2.5 Ha');
        ?>
        <div class="wrap">
            <h1>Pengaturan Sekolah</h1>
            <p style="color: #666;">Kelola data statistik dan informasi sekolah</p>

            <form method="POST" action="" style="margin-top: 30px; max-width: 600px;">
                <?php wp_nonce_field('sekolah_settings_save', 'sekolah_settings_nonce'); ?>

                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="sekolah_jumlah_guru">Jumlah Guru & Staf</label>
                        </th>
                        <td>
                            <input type="number" id="sekolah_jumlah_guru" name="sekolah_jumlah_guru" value="<?php echo esc_attr($jumlah_guru); ?>" class="regular-text" min="0">
                            <p class="description">Masukkan total jumlah guru dan staf sekolah</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="sekolah_jumlah_siswa">Jumlah Siswa</label>
                        </th>
                        <td>
                            <input type="number" id="sekolah_jumlah_siswa" name="sekolah_jumlah_siswa" value="<?php echo esc_attr($jumlah_siswa); ?>" class="regular-text" min="0">
                            <p class="description">Masukkan total jumlah siswa aktif</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="sekolah_jumlah_rombel">Jumlah Rombel & Ruang</label>
                        </th>
                        <td>
                            <input type="number" id="sekolah_jumlah_rombel" name="sekolah_jumlah_rombel" value="<?php echo esc_attr($jumlah_rombel); ?>" class="regular-text" min="0">
                            <p class="description">Masukkan total jumlah rombel (kelas) dan Ruang</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="sekolah_kurikulum">Kurikulum</label>
                        </th>
                        <td>
                            <input type="text" id="sekolah_kurikulum" name="sekolah_kurikulum" value="<?php echo esc_attr($kurikulum); ?>" class="regular-text" placeholder="Contoh: Kurikulum Merdeka">
                            <p class="description">Masukkan jenis kurikulum yang digunakan</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="sekolah_penyelenggaraan">Penyelenggaraan</label>
                        </th>
                        <td>
                            <input type="text" id="sekolah_penyelenggaraan" name="sekolah_penyelenggaraan" value="<?php echo esc_attr($penyelenggaraan); ?>" class="regular-text" placeholder="Contoh: Satuan Pendidikan">
                            <p class="description">Masukkan bentuk penyelenggaraan pendidikan</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="sekolah_luas_tanah">Luas Tanah</label>
                        </th>
                        <td>
                            <input type="text" id="sekolah_luas_tanah" name="sekolah_luas_tanah" value="<?php echo esc_attr($luas_tanah); ?>" class="regular-text" placeholder="Contoh: 2.5 Ha">
                            <p class="description">Masukkan luas tanah sekolah (misal: 2.5 Ha atau 25000 m²)</p>
                        </td>
                    </tr>
                </table>

                <?php submit_button('Simpan Pengaturan', 'primary', 'submit', true); ?>
            </form>
        </div>
        <?php
    }
}