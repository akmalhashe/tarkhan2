<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package H2
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php

			while(have_posts()) {
				the_post(); ?>
				<h2><?php the_title(); ?></h2>
				<div class="entry-content">
					<?php 
					the_author_posts_link();
					the_time();
					echo get_the_category_list(", ");
					
					?>
				</div>
			<?php }
			echo paginate_links(  );
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
