<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package egg
 */

get_header(); ?>

<main class="main-main">
	<?php while ( have_posts() ) {
		the_post(); ?>
		<div class="container">
		
			<section class="featured-categories-wrapper">
				<h2 class="section-title">
					<?php the_field("featured_category_title"); ?>
				</h2>
				<div class="fc-content">
					<?php the_field("featured_category_details"); ?>
				</div>
				<div class="featured-cats">
					<?php $f_cats = get_field("featured_categories");
					function isEven($n) { 
						return ($n & 1); 
					}
					$index = 1;
					foreach ($f_cats as $f_cat) {
						$thumbnail_id = get_term_meta( $f_cat->term_id, 'thumbnail_id', true );
						
						$image_rectangle = wp_get_attachment_image_src( $thumbnail_id, 'product-rectangle' );
						$image_square = wp_get_attachment_image_src( $thumbnail_id, 'product-square-md' );
						
						if (isEven($index) == 0) { ?>
							
								<div class="col-md-4">
									<a href="<?php echo get_term_link( $f_cat->slug, $f_cat->taxonomy ); ?>" class="featured-cat-item">
										<img src="<?php echo $image_square[0]; ?>" alt="" height="" width="">
										<h4 class="fci-title"><?php echo $f_cat->name; ?></h4>
										<span class="fa fa-arrow-right hover-icon"></span>
									</a>
								</div>
							</div>
							<!-- Extra ending div starting on odd below -->

						<?php } else { ?>
							<!-- Extra div starting ends on even -->
							<div class="row <?php echo 'rowed-'.$index; ?>">
								<div class="col-md-8">
									<a href="<?php echo get_term_link( $f_cat->slug, $f_cat->taxonomy ); ?>" class="featured-cat-item">
										<img src="<?php echo $image_rectangle[0]; ?>" alt="" height="" width="">
										<h4 class="fci-title"><?php echo $f_cat->name; ?></h4>
										<span class="fa fa-arrow-right hover-icon"></span>
									</a>
								</div>
						<?php }
						?>
					<?php 
					$index++;
					}
					?>
				</div>
			</section>

			<section class="highest-quality" style="background-image:url(<?php echo get_field('tagline_background')['url']; ?>)">
				<h3 class="hq-tagline"><?php the_field("tagline"); ?></h3>
			</section>

		
			<section class="featured-products-wrapper">
				<h2 class="text-center section-title">
					<small>Made the hard way</small>Featured Products
				</h2>
				<?php echo do_shortcode( '[xo_featured featured="yes" posts_per_page="-1" product_item_wrapper="col-md-3 col-sm-6 col-6" products_wrapper="row" thumbnail_size="product-square-sm" icon="fa fa-arrow-down"]' ); ?>
			</section>
		</div>
		<div class="ex-container">
			<?php $about_img = get_field('about_tarkhan_image'); ?>
			<section class="welcome-tarkhan" style="background-image:url(<?php echo $about_img['url']; ?>)">
				<div class="container">
					<div class="col-md-6">
						<h1 class="main-title section-title">
							<?php the_field("about_tarkhan_title"); ?>
						</h1>
						<?php the_field("about_tarkhan_details"); ?>
					</div>
					
				</div>
			</section>
		</div>

		<div class="container">
			<section class="latest-products-wrapper">
				<h2 class="section-title">
					<?php the_field("latest_products_title"); ?>
				</h2>
				<div class="lat-prods latProds" id="latProds">
				<?php $lat_products = get_field("latest_products");
				foreach ($lat_products as $l_prod) {
					$product = wc_get_product( $l_prod->ID ); ?>
					<div class="xo-product">
						<a href="<?php echo get_permalink($product->get_id());?>" class="">
							<div class="xo-product-image">
								<?php echo $product->get_image('thumbnail', array(), true); ?>
							</div>
							<div class="xo-product-details">
								<p class="xo-product-title"><?php echo $product->get_title(); ?></p>
								<h6 class="xo-product-price"><?php echo get_woocommerce_currency_symbol() . ". " . $product->get_price(); ?></h6>
							</div>
						</a>
					</div>

				<?php } ?>
				</div>
				
			</section>

			<section class="on-sale-wrapper">
				<h2 class="section-title">
					<?php the_field('on_sale_title'); ?>
				</h2>
				<div class="row">
					<?php $query_args = array(
						'posts_per_page'    => 3,
						'no_found_rows'     => 1,
						'post_status'       => 'publish',
						'post_type'         => 'product',
						'meta_query'        => WC()->query->get_meta_query(),
						'post__in'          => array_merge( array( 0 ), wc_get_product_ids_on_sale() )
					);
					$products = new WP_Query( $query_args );
					while ($products->have_posts()) {
						$products->the_post();
						//var_dump('<pre>', $products);
						//echo get_the_ID();
						//die();
						$product = wc_get_product( get_the_ID() ); ?>
						<div class="col-md-4">
							<div class="xo-product">
								<a href="#" class="">
									<div class="xo-product-image">
										<?php echo $product->get_image('product-square-md', array(), true); ?>
									</div>
									<div class="xo-product-details">
										<span class="fa fa-user osi-sale-icon"></span>
										<p class="xo-product-title"><?php echo $product->get_title(); ?></p>
										<h6 class="xo-product-price"><?php echo get_woocommerce_currency_symbol() . ". " . $product->get_regular_price('view'); ?></h6>
										<h6 class="xo-product-sale-price"><?php echo get_woocommerce_currency_symbol() . ". " . $product->get_sale_price('view'); ?></h6>
									</div>
								</a>
							</div>
						</div>
						<?php wp_reset_postdata(); 
					} ?>
				</div>
			</section>
		</div>
	
		<div class="ex-container">
			<?php $qbi = get_field("quote_background_image");
			$qfi = get_field("quote_foreground_image");
			// debug($qfi);
			// debug_die($qbi);
			 ?>
			<div class="quote-images" style="background-image: url(<?php echo $qbi['url']; ?>);">
				<div class="container qi-position">
					<a href="#" class="qi-small-anchor"><img src="<?php echo $qfi['url']; ?>" alt="" height="<?php echo $qfi['height']; ?>" width="<?php echo $qfi['width']; ?>" class="small-image-qutoe"></a>
				</div>
			</div>
		</div>
	<?php } /* global while ends */ ?>
	<div class="container">
		<section class="decor-blog">
			<div class="row">
				<div class="col-md-6">
					<h2 class="h1 section-title">Decore tips & idea's</h2>

					<?php 
					$args = array(
						'post_type' => 'post',
						'post_per_page' => 4
					);
					$decor_qry = new WP_Query($args);
					while ($decor_qry->have_posts()) {
						$decor_qry->the_post(); ?>

						<article class="decor-item">
							<h4 class="di-title"><?php the_title(); ?></h4>
							<p class="di-details"> <span class="inner_skin"><?php echo wp_trim_words( get_the_content(), 20, '...' ); ?> </span>
							<a href="<?php the_permalink( ); ?>" class="readmore di-readmore">readmore <span class="fa fa-arrow-right"></span></a>                                
							</p>
						</article>

						<?php wp_reset_postdata();
					} ?>
					
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-5"><img src="images/decor-tips.jpg" class="decor-image" alt=""></div>
			</div>
		</section>
		

	</div>

</main>


<?php
get_footer();
