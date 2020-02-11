<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package H2
 */

?>
<footer class="main-footer">
    <div class="ex-container">
        <div class="footer-top">
            <div class="container position-relative">
                <div class="footer-nav">
                    <ul>
                        <li><a href="">About Tarkhan</a></li>
                        <li><a href="">About Tarkhan</a></li>
                        <li><a href="">About Tarkhan</a></li>
                        <li><a href="">About Tarkhan</a></li>
                        <li><a href="">About Tarkhan</a></li>
                    </ul>
                </div>
                <div class="go-back-top">
                    <a href="#" class="gb-anchor gbAnchor" id="gbAnchor">
                        <span class="fa fa-arrow-up"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="lower-footer">
            <div class="row">
                <div class="col-md-4">
                    <h6 class="lf-title">Contact Us</h6>
                    <div class="lf-contact-details">
                        <ul>
                            <li><span>Address</span>Cavalry ground lahore</li>
                            <li><span>Email</span>info@tarkhan.pk</li>
                            <li><span>Call Us</span>0321-8499287</li>
                            <li><span>WhatsApp</span>0321-8499287</li>
                        </ul>
                    </div>
                    
                </div>
                <div class="col-md-4">
                    <h6 class="lf-title">Social</h6>
                    <div class="lf-contact-details">
                        <ul>
                            <li>Facebook</li>
                            <li>WhatsApp</li>
                            <li>Instagram</li>
                            <li>LinkedIn</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="lf-logo">
                        <?php
                        $custom_logo_id = get_theme_mod( 'custom_logo' );
                        $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                        $meta = wp_get_attachment_metadata($custom_logo_id); ?>
                        <img src="<?php echo $image[0]; ?>" width="<?php echo $meta['width']; ?>" height="<?php echo $meta['height']; ?>" alt="<?php echo $meta['alt']; ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="copyrights">
            <div class="row">
                <div class="col-md-6">
                    <ul>
                        <li><a href="#">Complaint & Repair</a></li>
                        <li><a href="">Shipping & Deliver</a></li>
                        <li><a href="">Privacy Policy</a></li>
                        <li><a href="">Sitemap</a></li>
                    </ul>
                </div>
                <div class="col-md-6 copyright_text">
                    <p>© 2020Tarkhan.pk. All rights reserved</p>
                </div>
            </div>
        </div>
    </div>

<?php wp_footer(); ?>

</body>
</html>
