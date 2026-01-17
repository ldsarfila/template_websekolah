<?php

/**
 * Index Template
 */
get_header();
?>

<div class="container">
    <div class="section">
        <h1 class="section-title"><?php wp_title(''); ?></h1>

        <div class="posts-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    ?>
                    <article class="post-card">
                        <div class="post-card-image">
                            <?php echo sekolah_thumbnail('medium'); ?>
                        </div>
                        <div class="post-card-content">
                            <h2 class="post-card-title"><?php the_title(); ?></h2>
                            <div class="post-card-meta">
                                <span><?php echo get_the_date(); ?></span>
                            </div>
                            <p class="post-card-excerpt"><?php echo sekolah_excerpt(20); ?></p>
                            <a href="<?php the_permalink(); ?>" class="post-card-link">Baca Selengkapnya →</a>
                        </div>
                    </article>
                    <?php
                endwhile;
                ?>
                <div class="pagination">
                    <?php
                    echo paginate_links(array(
                        'type' => 'list',
                    ));
                    ?>
                </div>
                <?php
            else :
                echo '<p>Tidak ada konten yang ditemukan.</p>';
            endif;
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
