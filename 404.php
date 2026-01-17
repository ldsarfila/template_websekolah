<?php

/**
 * 404 Template
 */
get_header();
?>

<div class="container">
    <div class="section" style="text-align: center; padding: 100px 20px;">
        <h1 class="section-title" style="font-size: 72px; color: var(--secondary-color);">404</h1>
        <h2 style="font-size: 32px; margin-bottom: 20px;">Halaman Tidak Ditemukan</h2>
        <p style="font-size: 16px; color: var(--text-light); margin-bottom: 30px;">
            Maaf, halaman yang Anda cari tidak ditemukan. Silakan coba kembali ke halaman utama.
        </p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn">Kembali ke Halaman Utama</a>
    </div>
</div>

<?php get_footer(); ?>
