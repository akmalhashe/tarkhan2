<?php
$args = array('post_type' => 'members', 'posts_per_page' => 2, 'orderby' => 'date', 'order' => 'ASC' );
$the_query = new WP_Query($args);
?>
<!--Just displaying on home page for now-->
<?php if ($the_query->have_posts()) { ?>
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <div class="col-sm-6">
            <div class="board-member aniview normal" av-animation="fadeInUp">
                <div class="img-box">
                    <?php the_post_thumbnail() ?>
                </div>
                <div class="board-member-details">
                    <h3><?php the_title(); ?></h3>

                    <?php echo wp_trim_words( get_the_content(), 30, '...' ); ?>
                    <a class="readmore" href="<?php the_permalink() ?>">Read More</a>
                    <div class="social-links">
                        <p class="no-margin">
                        	<?php
					            //global $wp_query;
					            $postid = $the_query->post->ID;
					        ?>
					        <?php if (get_post_meta($postid, 'Email', true)): ?>
							<a class="flat-icon tw" href="mailto:<?php echo get_post_meta($postid, 'Email', true); ?>"><span class="fa fa-envelope"></span></a>
							<?php endif; ?>
							<?php if (get_post_meta($postid, 'Website', true)): ?>
							<a target="_blank" class="flat-icon tw" href="<?php echo get_post_meta($postid, 'Website', true); ?>"><span class="fa fa-external-link"></span></a>
							<?php endif; ?>

					        <?php if (get_post_meta($postid, 'Twitter', true)): ?>
							<a target="_blank" class="flat-icon tw" href="<?php echo get_post_meta($postid, 'Twitter', true); ?>"><span class="fa fa-twitter"></span></a>
							<?php endif; ?>
							<?php if (get_post_meta($postid, 'Facebook', true)): ?>
							<a target="_blank" class="flat-icon fb" href="<?php echo get_post_meta($postid, 'Facebook', true); ?>"><span class="fa fa-facebook"></span></a>
							<?php endif; ?>
							<?php if (get_post_meta($postid, 'GooglePlus', true)): ?>
							<a target="_blank" class="flat-icon gplus" href="<?php echo get_post_meta($postid, 'GooglePlus', true); ?>"><span class="fa fa-google-plus"></span></a>
							<?php endif; ?>
							<?php if (get_post_meta($postid, 'LinkedIn', true)): ?>
							<a target="_blank" class="flat-icon likdin" href="<?php echo get_post_meta($postid, 'LinkedIn', true); ?>"><span class="fa fa-linkedin"></span></a>
							<?php endif; ?>
                            <?php // wp_reset_query(); ?>
                        </p>

                    </div>
                </div>
            </div>
        </div>
	<?php endwhile; /*End post loop 1*/ ?>
	<?php wp_reset_postdata(); ?>
<?php } /*end have_posts if*/ ?>