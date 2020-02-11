<?php
/**
 * Template part for displaying a Product
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hasheone
 */

?>
    <div class="proBox">
        <?php the_post_thumbnail('hard-product'); ?>
        <?php if(get_the_title()): ?>
            <figcaption>
                <a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span> </a>
            </figcaption>
        <?php endif; ?>
    </div>