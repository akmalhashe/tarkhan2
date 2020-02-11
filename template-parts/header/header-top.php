<div class="xo-row row">
    <div class="xo-col-md-4 col-md-4">
        <?php
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
        $meta = wp_get_attachment_metadata($custom_logo_id); ?>
        <a class="main-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="">
            <img src="<?php echo $image[0]; ?>" width="<?php echo $meta['width']; ?>" height="<?php echo $meta['height']; ?>" alt="<?php echo $meta['alt']; ?>">
        </a>
    </div>
    <div class="xo-col-md-8 col-md-8">
        <div class="top-widget-bar">
            <a class="widget-item" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account',''); ?>">
                <span class="widget-icon fa fa-user"></span>
                <span class="widget-name"><?php if (is_user_logged_in(  )){
                    _e('My Account','');
                } else {
                    _e('Sign In');
                } ?></span>
            </a>
            <!-- <a href="#" class="widget-item">
                <span class="widget-icon fa fa-user"></span>
                <span class="widget-name">Sign in</span>
            </a> -->
            <a href="#" class="widget-item">
                <span class="widget-icon fa fa-user"></span>
                <span class="widget-name">Wishlist</span>
            </a>
            <?php global $woocommerce;
            $cart_url = wc_get_cart_url(); ?>
            <a href="<?php echo $cart_url; ?>" class="widget-item">
                <span class="widget-icon fa fa-user"></span>
                <span class="widget-name">Basket</span>
            </a>
            <div class="widget-item widget-item-search">
                <span class="widget-icon fa fa-search"></span>
                <div class="search-form-wrapper">
                    <!-- search form -->
                    <form action="<?php echo home_url( '/' ) ?>" method="get" role="search" class="widget">
                        <div class="search-now">
                            <h2>Start Typing</h2>
                            <div class="input-group" id="adv-search">
                                <input type="text" name="s" id="search" class="form-control" placeholder="Search by Keyword or post" value="<?php the_search_query(); ?>" />

                                <div class="input-group-btn">
                                    <div class="btn-group" role="group">
                                        <button type="submit" class="btn btn-xo"><span class="fa fa-search" aria-hidden="true" style="padding-right: 10px;"></span>Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>