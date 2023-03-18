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
 * @package SacchaOne
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
get_header();
?>
<main id="site-content" class="site-main container mt-5">
		<div class="row">
			<?php
			if ( get_theme_mod( 'sacchaone_sidebar_settings', 'default' ) === 'both-sidebar' || get_theme_mod( 'sacchaone_sidebar_settings', 'default' ) === 'left-sidebar' ) {
				get_sidebar( 'left' );
			}
			?>
			<div id="primary" class="content-area <?php echo esc_attr( sacchaone_class_attr( 'content-area' ) ); ?>">
				<?php
				if ( have_posts() ) :

					if ( is_home() && ! is_front_page() ) :
						?>
						<header>
							<h1 class="page-title screen-reader-text entry-title mb-3"><?php single_post_title(); ?></h1>
						</header>
						<?php
					endif;

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						\MblEssen\Includes\Register_Post_Templates::mbl_essen_get_template_part( 'content', 'phone' );

					endwhile;

					if ( function_exists( 'sacchaone_the_posts_pagination' ) ) :
						sacchaone_the_posts_pagination();
					endif;

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>
			</div><!-- #primary -->
			<?php
			if ( get_theme_mod( 'sacchaone_sidebar_settings', 'default' ) === 'both-sidebar' || get_theme_mod( 'sacchaone_sidebar_settings', 'default' ) === 'right-sidebar' || get_theme_mod( 'sacchaone_sidebar_settings', 'default' ) === 'default' ) {
				get_sidebar();
			}
			?>
		</div><!-- .row -->
	</main><!-- #main -->

<?php
get_footer();