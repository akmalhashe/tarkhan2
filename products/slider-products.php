<?php
/**
 * [woo_slider]
 */
add_shortcode( 'woo_slider', 'wb_woo_featured' );
/*
 *
 * Featured Product Loop
 */
function wb_woo_featured() {

    
    //echo "<pre>";
    //print_r($banner_items);
    //die();

    // $args = array(  
    //     'post_type'      => 'product',  
    //     'posts_per_page' => 3,
    //     'post_status'    => 'publish',
    //     'tax_query'      => array(
    //         array(
    //             'taxonomy' => 'product_visibility',
    //             'field'    => 'name',
    //             'terms'    => 'featured',
    //             'operator' => 'IN'
    //         ),  
    //     ),
    // );  
    //$featured_product = new WP_Query( $args );  

    //if ( $featured_product->have_posts() ) :  
        // function GetImageUrlsByProductId( $productId){
                    
        //     $product = new WC_product($productId);
        //     $attachmentIds = $product->get_image();
        //     return $$attachmentIds;
        // }
        ob_start();

        echo '<div class="mb-items mbItems" id="mbItems">';
            $banner_products = get_field("banner_products", "option");
            foreach ($banner_products as $banner_product) {
                $product = wc_get_product($banner_product->ID);
        ?>

                

                <div class="mb-item">
                    <?php echo $product->get_image('banner-ex', array(), true); ?>
                    <div class="mb-details-wrapper">
                        <div class="md-item-details">
                            <h3 class="mi-title"><?php echo $product->get_title(); ?></h3>
                            <h4 class="mi-price"><?php echo get_woocommerce_currency_symbol() . ". " . $product->get_price(); ?></h4>
                        </div>
                        <a href="<?php echo get_permalink($product->get_id());?>" class="mi-order">Order Now</a>
                    </div>
                </div>
        <?php
            } 
        echo '</div>';
    //endif;  
    wp_reset_query();

    return ob_get_clean();
}