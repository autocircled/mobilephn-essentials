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

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sone-article-single' ); ?>>
	<?php
	if ( 'post' === get_post_type() ) :
		if ( has_post_thumbnail() ) :
			?>
			<div class="caption">
				<?php sacchaone_post_thumbnail( 'sacchaone-blog-thumbnail' ); ?>
			</div>
			<?php
		endif;
	endif;
	?>

	<div class="content-wrapper">
		<header class="entry-header">

			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
				?>
				<div class="blog_post_meta">
					<?php
					sacchaone_posted_on();
					sacchaone_posted_by();
					?>
				</div>
				<?php
			else :
				?>

				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>" rel="bookmark">
						<?php
						the_title();
						?>
					</a>
				</h2>
				<?php
			endif;
			?>
			<div class="taxonomy-meta">
				<?php sacchaone_entry_footer(); ?>
			</div>
		</header><!-- .entry-header -->

		<div class="entry-content clearfix">
		<?php
		if ( is_singular() ) :
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'sacchaone' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);

            if ( function_exists('acf_add_local_field_group') ){
                ?>
                <div class="specs-list">
                    <h3>Network</h3>
                    <table>
                    <?php if (get_field('network_2g_bands')) : ?>
                        <tr>
                            <th>2G bands</th>
                            <td><?php 
                            echo esc_html( 'GSM ' );
                            esc_html( the_field('network_2g_bands') );
                            // $_4g_obj = get_field_object('network_4g_bands');
                            // $text = '';
                            // $c = count( get_field('network_4g_bands') );
                            // foreach( get_field('network_4g_bands') as $bands ){
                            //     $punc = $c > 1 ? ', ' : '';
                            //     $text .= $_4g_obj['choices'][$bands] . $punc; 
                            //     $c--;
                            // }
                            // echo esc_html( $text );
                            ?></td>
                        </tr>
                        <?php endif;
                        if (get_field('network_3g_bands')) : ?>
                        <tr>
                            <th>3G bands</th>
                            <td><?php 
                            echo esc_html( 'HSDPA ' );
                            esc_html( the_field('network_3g_bands') );
                            ?></td>
                        </tr>
                        <?php endif;
                        if (get_field('network_4g_bands')) : ?>
                        <tr>
                            <th>4G bands</th>
                            <td><?php esc_html( the_field('network_4g_bands') ); ?></td>
                        </tr>
                        <?php endif;
                        if (get_field('network_5g_bands')) : ?>
                        <tr>
                            <th>5G bands</th>
                            <td><?php esc_html( the_field('network_5g_bands') ); ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>

                    <h3>Launch</h3>
                    <table>
                        <?php if (get_field('general_year')) : ?>
                        <tr>
                            <th>Announced</th>
                            <td><?php echo esc_html( date( "Y, F j", strtotime( get_field('general_year') ) ) ); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ( get_field('general_availability') || get_field('general_expected_release_date') ) : ?>
                        <tr>
                            <th>Status</th>
                            <td><?php echo esc_html( get_field('general_availability') . '. ' . get_field('general_expected_release_date') ); ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                    
                    <h3>Body</h3>
                    <table>
                        <?php if (get_field('body_height')) : ?>
                        <tr>
                            <th>Dimensions</th>
                            <td><?php echo esc_html( get_field('body_height') . ' x ' . get_field('body_width') . ' x ' . get_field('body_thickness') . ' mm' ); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if (get_field('body_weight')) : ?>
                        <tr>
                            <th>Weight</th>
                            <td><?php 
                            $oz = floatval( get_field('body_weight')) / 28.35;
                            echo esc_html( get_field('body_weight') . ' g (' . number_format($oz, 2) . ' oz)' ); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ( get_field('sim_sim_chamber') ) : ?>
                        <tr>
                            <th>SIM</th>
                            <td><?php
                            switch( get_field('sim_sim_chamber') ) {
                                case 1:
                                    $text = 'Single SIM';
                                    break;
                                case 2:
                                    $text = 'Dual SIM';
                                    break;
                                case 3:
                                    $text = 'Tripple SIM';
                                    break;
                                case 4:
                                    $text = 'Quad SIM';
                                    break;
                                default:
                                    $text = get_field('sim_sim_chamber') . ' SIM Slots';
                            }
                            $sim_type = get_field('sim_sim_size') ? get_field('sim_sim_size') : '';
                            echo $text . " (" . implode( ", ", $sim_type ) . ")";
                            ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>

                    <h3>Display</h3>
                    <table>
                        <?php
                        $display = false;
                        $type = [];
                        if (get_field('display_type_technology') || get_field('display_type_refresh_rate') || get_field('display_type_others') || get_field('display_type_brightness') ) : 
                            $display = true;
                            $type[] = get_field('display_type_technology');
                            $type[] = get_field('display_type_refresh_rate') . 'Hz';
                            $type[] = get_field( 'display_type_others' );
                            $type[] = get_field( 'display_type_brightness' ) . ' nits';
                        endif; ?>
                        <?php if ( $display ) : ?>
                        <tr>
                            <th>Type</th>
                            <td><?php echo esc_html( implode( ", ", $type ) ); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php
                        $display = false;
                        $size = [];
                        if (get_field('display_size_size_inches') || get_field('display_size_size_centimeters') ) : 
                            $display = true;
                            $size[] = get_field('display_size_size_inches') . ' inches';
                            $size[] = get_field('display_size_size_centimeters') . ' cm<sup>2</sup>';
                        endif; ?>
                        <?php if ( $display ) : ?>
                        <tr>
                            <th>Size</th>
                            <td><?php echo implode( ", ", $size ); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php
                        $display = false;
                        $resolution = [];
                        if (get_field('display_resolution_resolution_front') || get_field('display_resolution_density') ) : 
                            $display = true;
                            $resolution[] = get_field('display_resolution_resolution_front');
                            $resolution[] = '(~' . get_field('display_resolution_density') . ' ppi density)';
                        endif; ?>
                        <?php if ( $display ) : ?>
                        <tr>
                            <th>Resolution</th>
                            <td><?php echo implode( " ", $resolution ); ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                </div>
                <?php

            }else{

            }

			wp_link_pages(
				array(
					'before' => '<div class="sone-page-links">' . esc_html__( 'Pages:', 'sacchaone' ),
					'after'  => '</div>',
				)
			);

            
		else :
			sacchaone_excerpt();
		endif;

		?>
		</div><!-- .entry-content -->
	</div><!-- .content-wrapper -->
</article><!-- #post-<?php the_ID(); ?> -->
