<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package dumplinghub_site_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<section class="error-404">
				<div class="page-content">
					<h1 class="page-title"><?php echo esc_html( '404' ); ?></h1>
					<div class="error-image">
						<img src="<?php echo get_template_directory_uri() ?>/assets/images/bomb.png" alt= "avatar">
				  </div>
					<h2>Sorry</h2>
					<p>The page you are looking for is not found</p>
					<p class="home-link"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Home</a></p>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_footer(); ?>

