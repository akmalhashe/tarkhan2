<?php 

if (is_front_page()){
    echo do_shortcode( '[woo_slider]' );
} else { ?>
    <div class="mb-items inner-banner">
        <div class="mb-item">
            <?php //the_title(); ?>
        </div>
    </div>
<?php } ?>

