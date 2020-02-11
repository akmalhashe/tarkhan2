<?php
/**
 * [xo_featured 
 * featured="yes"
 * posts_per_page="-1" 
 * product_item_wrapper="col-md-3 col-sm-6 col-6" 
 * products_wrapper="row" 
 * thumbnail_size="product-square-sm" 
 * icon="fa fa-arrow-down"]
 */
add_shortcode( 'xo_featured', 'xo_woo_featured' );
/*
 *
 * Featured Product Loop
 */
function xo_woo_featured($atts) {
    $atts = shortcode_atts(
        array(
            'posts_per_page' => -1,
            'product_item_wrapper' => 'col-md-3 col-sm-6 col-6',
            'products_wrapper' => 'row',
            'thumbnail_size' => 'product-square-sm',
            'icon' => 'fa fa-arrow-down',
            'featured' => ''
        ), $atts );

    if ($atts['featured'] == 'yes') {
        $atts['featured'] = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
                'operator' => 'IN'
            );
    } else {

    }
    $args = array(  
        'post_type'      => 'product',  
        'posts_per_page' => $atts['posts_per_page'],
        'post_status'    => 'publish',
        'tax_query'      => array($atts['featured'])
        
    );  
    $featured_product = new WP_Query( $args );  

    if ( $featured_product->have_posts() ) :  

        ob_start();

        echo '<div class="'.$atts['products_wrapper'].'">';
        while ( $featured_product->have_posts() ) : $featured_product->the_post();

            $product               = wc_get_product( $featured_product->post->ID );  
            $post_thumbnail_id     = get_post_thumbnail_id();
            $product_thumbnail     = wp_get_attachment_image_src($post_thumbnail_id, $size = $atts['thumbnail_size']);
            $product_thumbnail_alt = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );

            // Featured Post Loop Output 
            //	wc_get_template_part( 'content', 'product' ); 
            //$product = wc_get_product( $post_id );
        ?>
            <div class="<?php echo $atts['product_item_wrapper'] ?>">
                <div class="xo-product">
                    <a href="<?php the_permalink();?>" class="">
                        <div class="xo-product-image">
                        <img src="<?php echo $product_thumbnail[0];?>" height="" width="" alt="<?php echo $product_thumbnail_alt;?>">
                        </div>
                        <div class="xo-product-details">
                            <p class="xo-product-title"><?php the_title();?></p>
                            <h6 class="xo-product-price"><?php echo get_woocommerce_currency_symbol() . ". " . $product->get_price(); ?></h6>
                            <span class="<?php $atts['icon'] ?>"></span>
                        </div>
                    </a>
                </div>
            </div>

        <?php

        endwhile;  
        echo '</div>';
    endif;  
    wp_reset_query();

    return ob_get_clean();
}