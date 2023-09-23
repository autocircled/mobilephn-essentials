<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SacchaOne
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'col-xs-6 col-sm-4 col-md-3 sone-recent-phone' ); ?>>
	<?php
	if ( 'phone' === get_post_type() ) :
		if ( has_post_thumbnail() ) :
			?>
			<div class="caption">
				<?php sacchaone_post_thumbnail( 'sacchaone-blog-thumbnail' ); ?>
			</div>
			<?php
		endif;
	endif;
	?>
	<div class="phone-title">
		<?php the_title( '<h6 class="card-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h6>' ); ?>
	</div><!-- .entry-content-wrapper -->
</div>


