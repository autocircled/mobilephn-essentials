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
    <div class="feature-section">
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
        <?php do_action( 'mbl_essen_after_featured_section' ); ?>
    </div>

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
                <style>
                    .specs-list th {
                        width: 130px;
                        vertical-align: top;
                    }
                </style>
                <div class="specs-list">
                    <!-- Start Network -->
                    <h3>Network</h3>
                    <table>
                        <?php if (get_field('network_technology')) : ?>
                            <tr>
                                <th>Technology</th>
                                <td><?php echo esc_html( get_field('network_technology') );
                                ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if (get_field('network_2g_bands')) : ?>
                            <tr>
                                <th>2G bands</th>
                                <td><?php 
                                echo esc_html( 'GSM ' ) . esc_html( get_field('network_2g_bands') );
                                ?></td>
                            </tr>
                        <?php endif;
                        if (get_field('network_3g_bands')) : ?>
                            <tr>
                                <th>3G bands</th>
                                <td><?php 
                                echo esc_html( 'HSDPA ' ) . esc_html( get_field('network_3g_bands') );
                                ?></td>
                            </tr>
                        <?php endif;
                        //var_dump(get_field('network_4g_bands'));
                        if (get_field('network_4g_bands')) : ?>
                            <tr>
                                <th>4G bands</th>
                                <td><?php echo esc_html( get_field('network_4g_bands') ); ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if (get_field('network_5g_bands')) : ?>
                            <tr>
                                <th>5G bands</th>
                                <td><?php echo esc_html( get_field('network_5g_bands') ); ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if (get_field('network_speed')) : ?>
                            <tr>
                                <th>Speed</th>
                                <td><?php echo esc_html( get_field('network_speed') ); ?></td>
                            </tr>
                        <?php endif; ?>
                    </table>
                    <!-- End Network -->

                    <!-- Start Launch -->
                    <h3>Launch</h3>
                    <table>
                        <?php if (get_field('launch_announced')) : ?>
                        <tr>
                            <th>Announced</th>
                            <td><?php echo esc_html( get_field('launch_announced') ); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ( get_field('launch_status') ) : ?>
                        <tr>
                            <th>Status</th>
                            <td><?php echo esc_html( get_field('launch_status') ); ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                    <!-- End Launch -->
                    
                    <!-- Start Body -->
                    <h3>Body</h3>
                    <table>
                        <?php if (get_field('body_dimensions')) : ?>
                        <tr>
                            <th>Dimensions</th>
                            <td><?php echo esc_html( get_field('body_dimensions') ); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if (get_field('body_weight')) : ?>
                        <tr>
                            <th>Weight</th>
                            <td><?php echo esc_html( get_field('body_weight') ); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if (get_field('body_build')) : ?>
                        <tr>
                            <th>Build</th>
                            <td><?php
                            echo esc_html( get_field('body_build') ); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ( get_field('body_sim') ) : ?>
                        <tr>
                            <th>SIM</th>
                            <td><?php echo esc_html( get_field('body_sim') ); ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                    <!-- Start Body -->

                    <!-- Start Display -->
                    <h3>Display</h3>
                    <table>
                        <?php
                        if ( get_field('display_type') ) : ?>
                        <tr>
                            <th>Type</th>
                            <td><?php echo esc_html( get_field('display_type') ); ?></td>
                        </tr>
                        <?php endif; ?>

                        <?php if ( get_field('display_size') ) : ?>
                        <tr>
                            <th>Size</th>
                            <td><?php echo esc_html( get_field('display_size') ); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ( get_field('display_resolution') ) : ?>
                        <tr>
                            <th>Resolution</th>
                            <td><?php echo esc_html( get_field('display_resolution') ); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ( get_field('display_protection') ) : ?>
                        <tr>
                            <th>Protection</th>
                            <td><?php echo esc_html( get_field('display_protection') ); ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                    <!-- End Display -->

                    <!-- Start Platform -->
                    <h3>Platform</h3>
                    <table>
                        <?php if ( get_field('platform_os') ) : ?>
                        <tr>
                            <th>OS</th>
                            <td><?php echo esc_html( get_field('platform_os') ); ?></td>
                        </tr>
                        <?php endif; ?>

                        <?php if ( get_field('platform_chipset') ) : ?>
                        <tr>
                            <th>Chipset</th>
                            <td><?php echo esc_html( get_field('platform_chipset') ); ?></td>
                        </tr>
                        <?php endif; ?>

                        <?php if ( get_field('platform_cpu') ) : ?>
                        <tr>
                            <th>CPU</th>
                            <td><?php echo esc_html( get_field('platform_cpu') ); ?></td>
                        </tr>
                        <?php endif; ?>
                        
                        <?php if ( get_field('platform_gpu') ) : ?>
                        <tr>
                            <th>GPU</th>
                            <td><?php echo esc_html( get_field('platform_gpu') ); ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                    <!-- End Platform -->

                    <!-- Start Memory -->
                    <h3>Memory</h3>
                    <table>
                        <?php if ( get_field( 'memory_card_slot' ) ) : ?>
                        <tr>
                            <th>Card slot</th>
                            <td><?php echo esc_html( get_field( 'memory_card_slot' ) ); ?></td>
                        </tr>
                        <?php endif; ?>
                        
                        <?php if ( get_field( 'memory_internal' ) ) : ?>
                        <tr>
                            <th>Internal</th>
                            <td><?php echo esc_html( get_field( 'memory_internal' ) ); ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                    <!-- End Memory -->

                    <!-- Start Main Camera -->
                    <h3>Main Camera</h3>
                    <table>
                        <?php if ( get_field( 'main_camera_type' ) && get_field( 'main_camera_info' ) ) : ?>
                        <tr>
                            <th><?php echo esc_html( ucfirst( get_field( 'main_camera_type' ) ) ); ?></th>
                            <td><?php echo esc_html( get_field( 'main_camera_info' ) ); ?></td>
                        </tr>
                        <?php endif; ?>

                        <?php if ( get_field( 'main_camera_features' ) ) : ?>
                        <tr>
                            <th>Features</th>
                            <td><?php echo esc_html( get_field( 'main_camera_features' ) ); ?></td>
                        </tr>
                        <?php endif; ?>

                        <?php if ( get_field( 'main_camera_video' ) ) : ?>
                        <tr>
                            <th>Video</th>
                            <td><?php echo esc_html( get_field( 'main_camera_video' ) ); ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                    <!-- End Main Camera -->

                    <!-- Start Selfie Camera -->
                    <h3>Selfie Camera</h3>
                    <table>
                        <?php if ( get_field( 'selfie_camera_type' ) && get_field( 'selfie_camera_info' ) ) : ?>
                        <tr>
                            <th><?php echo esc_html( ucfirst( get_field( 'selfie_camera_type' ) ) ); ?></th>
                            <td><?php echo esc_html( get_field( 'selfie_camera_info' ) ); ?></td>
                        </tr>                            
                        <?php endif; ?>

                        <?php if ( get_field( 'selfie_camera_features' ) ) : ?>
                        <tr>
                            <th>Features</th>
                            <td><?php echo esc_html( get_field( 'selfie_camera_features' ) ); ?></td>
                        </tr>
                        <?php endif; ?>

                        <?php if ( get_field( 'selfie_camera_video' ) ) : ?>
                        <tr>
                            <th>Video</th>
                            <td><?php echo esc_html( get_field( 'selfie_camera_video' ) ); ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                    <!-- End Selfie Camera -->

                    <!-- Start Sound -->
                    <h3>Sound</h3>
                    <table>
                        <?php if ( get_field( 'sound_loudspeaker' ) ) : ?>
                        <tr>
                            <th>Loudspeaker</th>
                            <td><?php echo esc_html( get_field( 'sound_loudspeaker' ) ); ?></td>
                        </tr>
                        <?php endif; ?>

                        <?php if ( get_field( 'sound_35mm_jack' ) ) : ?>
                        
                        <tr>
                            <th><?php echo esc_html( '3.5mm jack' ); ?></th>
                            <td><?php echo esc_html( ucfirst( get_field( 'sound_35mm_jack' ) ) ); ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                    <!-- End Sound -->

                    <!-- Start Commons -->
                    <h3>Commons</h3>
                    <table>
                        <?php if ( get_field( 'comms_wlan' ) ) : ?>
                        <tr>
                            <th>WLAN</th>
                            <td><?php echo esc_html( get_field( 'comms_wlan' ) ); ?></td>
                        </tr>
                        <?php endif; ?>
                        
                        <?php if ( get_field( 'comms_bluetooth' ) ) : ?>
                        <tr>
                            <th>Bluetooth</th>
                            <td><?php echo esc_html( get_field( 'comms_bluetooth' ) ); ?></td>
                        </tr>
                        <?php endif; ?>
                        
                        <?php if ( get_field( 'comms_positioning' ) ) : ?>
                        <tr>
                            <th>GPS</th>
                            <td><?php echo esc_html( get_field( 'comms_positioning' ) ); ?></td>
                        </tr>
                        <?php endif; ?>
                        
                        <?php if ( get_field( 'comms_nfc' ) ) : ?>
                        <tr>
                            <th>NFC</th>
                            <td><?php echo esc_html( get_field( 'comms_nfc' ) ); ?></td>
                        </tr>
                        <?php endif; ?>
                        
                        <?php if ( get_field( 'comms_infrared_port' ) ) : ?>
                        <tr>
                            <th>Infrared port</th>
                            <td><?php echo esc_html( get_field( 'comms_infrared_port' ) ); ?></td>
                        </tr>
                        <?php endif; ?>
                        
                        <?php if ( get_field( 'comms_radio' ) ) : ?>
                        <tr>
                            <th>Radio</th>
                            <td><?php echo esc_html( get_field( 'comms_radio' ) ); ?></td>
                        </tr>
                        <?php endif; ?>
                        
                        <?php if ( get_field( 'comms_usb' ) ) : ?>
                        <tr>
                            <th>USB</th>
                            <td><?php echo esc_html( get_field( 'comms_usb' ) ); ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                    <!-- End Commons -->
                    
                    <!-- Start Features -->
                    <h3>Features</h3>
                    <table>
                        <?php if ( get_field( 'features_sensors' ) ) : ?>
                        <tr>
                            <th>Features</th>
                            <td><?php echo esc_html( get_field( 'features_sensors' ) ); ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                    <!-- End Features -->
                    
                    <!-- Start Battery -->
                    <h3>Battery</h3>
                    <table>
                        <?php if ( get_field( 'battery_type' ) ) : ?>
                        <tr>
                            <th>Type</th>
                            <td><?php echo esc_html( get_field( 'battery_type' ) ); ?></td>
                        </tr>
                        <?php endif; ?>
                        
                        <?php if ( get_field( 'battery_charging' ) ) : ?>
                        <tr>
                            <th>Charging</th>
                            <td><?php echo esc_html( get_field( 'battery_charging' ) ); ?></td>
                        </tr>
                        <?php endif; ?>                        
                    </table>
                    <!-- End Battery -->
                    
                    <!-- Start Miscellaneous -->
                    <h3>Miscellaneous</h3>
                    <table>
                        <?php if ( get_field( 'misc_colors' ) ) : ?>
                        <tr>
                            <th>Colors</th>
                            <td><?php echo esc_html( get_field( 'misc_colors' ) ); ?></td>
                        </tr>
                        <?php endif; ?>
                        
                        <?php if ( get_field( 'misc_price' ) ) : ?>
                        <tr>
                            <th>Price</th>
                            <td><?php echo esc_html( get_field( 'misc_price' ) ); ?></td>
                        </tr>
                        <?php endif; ?>

                        <?php
                            $display = false;
                            if ( get_field( 'miscellaneous_models' ) ) {
                                $display = true;
                            }
                            ?>
                            <?php if ( $display ) : ?>
                            <tr>
                                <th>Models</th>
                                <td><?php echo esc_html( get_field( 'miscellaneous_models' ) ); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php
                            $display = false;
                            if ( get_field( 'miscellaneous_sar' ) ) {
                                $display = true;
                            }
                            ?>
                            <?php if ( $display ) : ?>
                            <tr>
                                <th>SAR</th>
                                <td><?php echo esc_html( get_field( 'miscellaneous_sar' ) ); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php
                            $display = false;
                            if ( get_field( 'miscellaneous_sar_eu' ) ) {
                                $display = true;
                            }
                            ?>
                            <?php if ( $display ) : ?>
                            <tr>
                                <th>SAR EU</th>
                                <td><?php echo esc_html( get_field( 'miscellaneous_sar_eu' ) ); ?></td>
                            </tr>
                        <?php endif; ?>

                        
                        
                    </table>
                    <!-- End Miscellaneous -->
                    
                    <!-- Start Test -->
                    <h3>Test</h3>
                    <table>
                        <?php if ( get_field( 'tests_performance' ) ) : ?>
                        <tr>
                            <th>Price</th>
                            <td><?php echo esc_html( get_field( 'tests_performance' ) ); ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                    <!-- End Test -->

                    <div class="disclaimer-notice">
                        <p><strong>Disclaimer</strong>: We can not guarantee that the information on this page is 100% correct. <a href="https://mobilephn.com/data-disclaimer/">Read more</a></p>
                    </div>
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
