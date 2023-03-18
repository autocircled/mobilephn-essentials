<?php
/**
 * The template for displaying archive pages
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

				/**
				 * Hook sacchaone_archive_title
				 *
				 * @hooked sacchaone_archive_title 10
				 */
				do_action( 'sacchaone_archive_title' );

                do_action( 'sacchaone_before_archive_content' );
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
                    \MblEssen\Includes\Register_Post_Templates::mbl_essen_get_template_part( 'content', 'archive' );
					// get_template_part( 'template-parts/content', 'archive' );

				endwhile;

                do_action( 'sacchaone_after_archive_content' );

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
