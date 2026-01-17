<?php
/**
 * Footer Template
 */

// Debug
if (defined('WP_DEBUG') && WP_DEBUG) {
    error_log('Footer.php loaded');
}
?>
    </main>

    <footer class="site-footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
