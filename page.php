<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package H2
 */

get_header();
?>
<main class="main-main">
    <div class="container">
        <?php while ( have_posts() ) : the_post(); ?>
            
            <div class="col-lg-12">
                <h1 class="page-title"><?php the_title(); ?></h1>
                <?php the_content( sprintf(
                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ),
                    get_the_title()
                ) );
                ?>
            </div>
            
        <?php endwhile; ?>
    </div>
</main>
<?php
get_footer();
