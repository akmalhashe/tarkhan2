<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package H2
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"></meta>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="ex-container">
        <header class="main-header">

			<?php get_template_part( 'template-parts/header/header', 'top' ); ?>
			<?php get_template_part( 'template-parts/header/header', 'bottom' ); ?>

		</header>
		
        <aside class="main-banner">
			<?php get_template_part( 'template-parts/header/banner', 'content' ); ?>
        </aside>
    </div>
