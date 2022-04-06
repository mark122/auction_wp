<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package ibid
 */
?>
<?php
global $ibid_redux;
?>

<div class="footer footer-copyright">
    <div class="container">
        <div class="row">
            <?php if ( class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
                <div class="col-md-6">
                    <p class="copyright"><?php echo wp_kses($ibid_redux['ibid_footer_text_left'], 'link'); ?></p>
                </div>
                <div class="col-md-6 payment-methods">
                    <p class="copyright"><?php echo wp_kses($ibid_redux['ibid_footer_text_right'], 'link'); ?></p>
                </div>
            <?php }else { ?>
                <div class="col-md-6">
                    <p class="copyright"><?php esc_html_e( 'Copyright by ModelTheme. All Rights Reserved.', 'ibid' ); ?></p>
                </div>
                <div class="col-md-6 payment-methods">
                    <p class="copyright"><?php esc_html_e( 'Elite Author on ThemeForest', 'ibid' ); ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>