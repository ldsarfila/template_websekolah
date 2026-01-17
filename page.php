<?php

/**
 * Page Template
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

                        <?php
                        if (comments_open() || get_comments_number()) {
                            comments_template();
                        }
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
