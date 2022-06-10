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
                                echo esc_html( 'GSM ' ) . esc_html( implode( ", ", get_field('network_2g_bands') ) . " " . get_field( 'network_2g_extra' ) );
                                ?></td>
                            </tr>
                        <?php endif;
                        if (get_field('network_3g_bands')) : ?>
                            <tr>
                                <th>3G bands</th>
                                <td><?php 
                                echo esc_html( 'HSDPA ' ) . esc_html( implode( ", ", get_field('network_3g_bands') ) . " " . get_field( 'network_3g_extra' ) );
                                ?></td>
                            </tr>
                        <?php endif;
                        if (get_field('network_4g_bands')) : ?>
                            <tr>
                                <th>4G bands</th>
                                <td><?php echo esc_html( implode( ", ", get_field('network_4g_bands') ) . " " . get_field( 'network_4g_extra' ) ); ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if (get_field('network_5g_bands')) : ?>
                            <tr>
                                <th>5G bands</th>
                                <td><?php echo esc_html( implode( ", ", get_field('network_5g_bands') ) . " " . get_field( 'network_5g_extra' ) ); ?></td>
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
                        <?php if (get_field('general_year')) : ?>
                        <tr>
                            <th>Announced</th>
                            <td><?php echo esc_html( date( "Y, F j", strtotime( get_field('general_year') ) ) ); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ( get_field('general_availability') ) : 
                            $text = get_field('general_availability');
                            if ( $text == 'Available' ) {
                                $text .= '. Released ' . get_field( 'general_release_date' );
                            } elseif ( $text == 'Coming soon') {
                                $text .= '. ' . get_field( 'general_expected_release_date' );
                            }
                            ?>
                        <tr>
                            <th>Status</th>
                            <td><?php echo esc_html( $text ); ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                    <!-- End Launch -->
                    
                    <!-- Start Body -->
                    <h3>Body</h3>
                    <table>
                        <?php if (get_field('body_dimension_height')) : ?>
                        <tr>
                            <th>Dimensions</th>
                            <td><?php echo esc_html( get_field('body_dimension_height') . ' x ' . get_field('body_dimension_width') . ' x ' . get_field('body_dimension_thickness') . ' mm' ); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if (get_field('body_dimension_weight')) : ?>
                        <tr>
                            <th>Weight</th>
                            <td><?php 
                            $oz = floatval( get_field('body_dimension_weight')) / 28.35;
                            echo esc_html( get_field('body_dimension_weight') . ' g (' . number_format($oz, 2) . ' oz)' ); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if (get_field('body_dimension_build')) : ?>
                        <tr>
                            <th>Build</th>
                            <td><?php
                            echo esc_html( get_field('body_dimension_build') ); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ( get_field('body_description_sim') ) : ?>
                        <tr>
                            <th rowspan="10">SIM</th>
                            <td><?php echo esc_html( get_field('body_description_sim') );
                            ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ( get_field('body_description_extra_1') ) : ?>
                        <tr>
                            <td><?php echo esc_html( get_field('body_description_extra_1') );
                            ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ( get_field('body_description_extra_2') ) : ?>
                        <tr>
                            <td><?php echo esc_html( get_field('body_description_extra_2') );
                            ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ( get_field('body_description_extra_3') ) : ?>
                        <tr>
                            <td><?php echo esc_html( get_field('body_description_extra_3') );
                            ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ( get_field('body_description_extra_4') ) : ?>
                        <tr>
                            <td><?php echo esc_html( get_field('body_description_extra_4') );
                            ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ( get_field('body_description_extra_5') ) : ?>
                        <tr>
                            <td><?php echo esc_html( get_field('body_description_extra_5') );
                            ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                    <!-- Start Body -->

                    <!-- Start Display -->
                    <h3>Display</h3>
                    <table>
                        <?php
                        $display = false;
                        $type = [];
                        if (get_field('display_type_technology') || get_field('display_type_refresh_rate') || get_field('display_type_others') || get_field('display_type_brightness') ) : 
                            $display = true;
                            if ( get_field('display_type_technology') ) {
                                $type[] = get_field('display_type_technology');
                            }
                            if ( get_field('display_type_refresh_rate') ) {
                                $type[] = get_field('display_type_refresh_rate') . 'Hz';
                            }
                            if ( get_field( 'display_type_others' ) ) {
                                $type[] = get_field( 'display_type_others' );
                            }
                            if ( get_field( 'display_type_brightness' ) ) {
                                $type[] = get_field( 'display_type_brightness' ) . ' nits';
                            }
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
                            if ( get_field('display_resolution_resolution_front') ) {
                                $comma = get_field('display_resolution_other') ? ',' : '';
                                $resolution[] = get_field('display_resolution_resolution_front') . $comma;
                            }
                            if ( get_field('display_resolution_other') ) {
                                $resolution[] = get_field('display_resolution_other');
                            }
                            if ( get_field('display_resolution_density') ) {
                                $resolution[] = '(~' . get_field('display_resolution_density') . ' ppi density)';
                            }
                        endif; ?>
                        <?php if ( $display ) : ?>
                        <tr>
                            <th>Resolution</th>
                            <td><?php echo implode( " ", $resolution ); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php
                        $display = false;
                        $protections = []; 
                        if (
                            get_field('display_protection_protection_1') ||
                            get_field('display_protection_protection_2') ||
                            get_field('display_protection_protection_3') ||
                            get_field('display_protection_protection_4') ||
                            get_field('display_protection_protection_5')
                        ) {
                            $display = true;
                            if ( get_field('display_protection_protection_1') ) {
                                $protections[] = get_field('display_protection_protection_1');
                            }
                            if ( get_field('display_protection_protection_2') ) {
                                $protections[] = get_field('display_protection_protection_2');
                            }
                            if ( get_field('display_protection_protection_3') ) {
                                $protections[] = get_field('display_protection_protection_3');
                            }
                            if ( get_field('display_protection_protection_4') ) {
                                $protections[] = get_field('display_protection_protection_4');
                            }
                            if ( get_field('display_protection_protection_5') ) {
                                $protections[] = get_field('display_protection_protection_5');
                            }
                        }
                        ?>
                        <?php if ( $display ) :
                            if ( count( $protections ) ) :
                                foreach( $protections as $i => $v ) :
                                    ?>
                                    <tr>
                                        <?php if ( 0 == $i ) : ?>
                                            <th rowspan="10">Protection</th>
                                        <?php endif; ?>
                                        <td><?php echo esc_html( $v ); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php
                        $display = false;
                        $extras = []; 
                        if (
                            get_field('display_others_extra_1') ||
                            get_field('display_others_extra_1') ||
                            get_field('display_others_extra_1') ||
                            get_field('display_others_extra_1')
                        ) {
                            $display = true;
                            if ( get_field('display_others_extra_1') ) {
                                $extras[] = get_field('display_others_extra_1');
                            }
                            if ( get_field('display_others_extra_2') ) {
                                $extras[] = get_field('display_others_extra_2');
                            }
                            if ( get_field('display_others_extra_3') ) {
                                $extras[] = get_field('display_others_extra_3');
                            }
                            if ( get_field('display_others_extra_4') ) {
                                $extras[] = get_field('display_others_extra_4');
                            }
                        }
                        ?>
                        <?php if ( $display ) :
                            if ( count( $extras ) ) :
                                foreach( $extras as $i => $v ) :
                                    ?>
                                    <tr>
                                        <td><?php echo esc_html( $v ); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </table>
                    <!-- End Display -->

                    <!-- Start Platform -->
                    <h3>Platform</h3>
                    <table>
                        <?php
                        $display = false;
                        $os = [];
                        if (
                            get_field('platform_os_os_details_1') ||
                            get_field('platform_os_os_details_2') ||
                            get_field('platform_os_os_details_3')
                        ) : 
                            $display = true;
                            if ( get_field('platform_os_os_details_1') ) {
                                $os[] = get_field('platform_os_os_details_1');
                            }
                            if ( get_field('platform_os_os_details_2') ) {
                                $os[] = get_field('platform_os_os_details_2');
                            }
                            if ( get_field('platform_os_os_details_3') ) {
                                $os[] = get_field('platform_os_os_details_3');
                            }
                        endif; ?>
                        <?php if ( $display ) : 
                            if ( count( $os ) ) :
                                foreach( $os as $i => $v ) :
                                    ?>
                                    <tr>
                                        <?php if ( 0 == $i ) : ?>
                                            <th rowspan="<?php echo esc_attr( count( $os ) )?>">OS</th>
                                        <?php endif; ?>
                                        <td><?php echo esc_html( $v ); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php
                        $display = false;
                        $chipset = [];
                        if (
                            get_field('platform_chipset_chipset_details_1') ||
                            get_field('platform_chipset_chipset_details_2') ||
                            get_field('platform_chipset_chipset_details_3') ||
                            get_field('platform_chipset_chipset_details_4')
                        ) : 
                            $display = true;
                            if ( get_field('platform_chipset_chipset_details_1') ) {
                                $chipset[] = get_field('platform_chipset_chipset_details_1');
                            }
                            if ( get_field('platform_chipset_chipset_details_2') ) {
                                $chipset[] = get_field('platform_chipset_chipset_details_2');
                            }
                            if ( get_field('platform_chipset_chipset_details_3') ) {
                                $chipset[] = get_field('platform_chipset_chipset_details_3');
                            }
                            if ( get_field('platform_chipset_chipset_details_4') ) {
                                $chipset[] = get_field('platform_chipset_chipset_details_4');
                            }
                        endif; ?>
                        <?php if ( $display ) : 
                            if ( count( $chipset ) ) :
                                foreach( $chipset as $i => $v ) :
                                    ?>
                                    <tr>
                                        <?php if ( 0 == $i ) : ?>
                                            <th rowspan="<?php echo esc_attr( count( $chipset ) )?>">Chipset</th>
                                        <?php endif; ?>
                                        <td><?php echo esc_html( $v ); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php
                        $display = false;
                        $cpu = [];
                        if (
                            get_field('platform_cpu_cpu_details_1') ||
                            get_field('platform_cpu_cpu_details_2') ||
                            get_field('platform_cpu_cpu_details_3')
                        ) : 
                            $display = true;
                            if ( get_field('platform_cpu_cpu_details_1') ) {
                                $cpu[] = get_field('platform_cpu_cpu_details_1');
                            }
                            if ( get_field('platform_cpu_cpu_details_2') ) {
                                $cpu[] = get_field('platform_cpu_cpu_details_2');
                            }
                            if ( get_field('platform_cpu_cpu_details_3') ) {
                                $cpu[] = get_field('platform_cpu_cpu_details_3');
                            }
                        endif; ?>
                        <?php if ( $display ) : 
                            if ( count( $cpu ) ) :
                                foreach( $cpu as $i => $v ) :
                                    ?>
                                    <tr>
                                        <?php if ( 0 == $i ) : ?>
                                            <th rowspan="<?php echo esc_attr( count( $cpu ) )?>">CPU</th>
                                        <?php endif; ?>
                                        <td><?php echo esc_html( $v ); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                        
                        <?php
                        $display = false;
                        $gpu = [];
                        if (
                            get_field('platform_gpu_gpu_1') ||
                            get_field('platform_gpu_gpu_2') ||
                            get_field('platform_gpu_gpu_3')
                        ) : 
                            $display = true;
                            if ( get_field('platform_gpu_gpu_1') ) {
                                $gpu[] = get_field('platform_gpu_gpu_1');
                            }
                            if ( get_field('platform_gpu_gpu_2') ) {
                                $gpu[] = get_field('platform_gpu_gpu_2');
                            }
                            if ( get_field('platform_gpu_gpu_3') ) {
                                $gpu[] = get_field('platform_gpu_gpu_3');
                            }
                        endif; ?>
                        <?php if ( $display ) : 
                            if ( count( $gpu ) ) :
                                foreach( $gpu as $i => $v ) :
                                    ?>
                                    <tr>
                                        <?php if ( 0 == $i ) : ?>
                                            <th rowspan="<?php echo esc_attr( count( $gpu ) )?>">GPU</th>
                                        <?php endif; ?>
                                        <td><?php echo esc_html( $v ); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                        
                        
                        
                    </table>
                    <!-- End Platform -->

                    <!-- Start Memory -->
                    <h3>Memory</h3>
                    <table>
                        <?php
                        $display = false;
                        if ( get_field( 'memory_type_card_details' ) ) : 
                            $display = true;
                        endif; ?>
                        <?php if ( $display ) : ?>
                        <tr>
                            <th>Card slot</th>
                            <td><?php echo esc_html( get_field( 'memory_type_card_details' ) ); ?></td>
                        </tr>
                        <?php endif; ?>
                        
                        <?php
                        $display = false;
                        $internal = [];
                        if (
                            get_field( 'memory_variation_1_storage' ) ||
                            get_field( 'memory_variation_2_storage' ) ||
                            get_field( 'memory_variation_3_storage' ) ||
                            get_field( 'memory_variation_4_storage' ) ||
                            get_field( 'memory_variation_5_storage' ) ||
                            get_field( 'memory_variation_1_ram' ) ||
                            get_field( 'memory_variation_2_ram' ) ||
                            get_field( 'memory_variation_3_ram' ) ||
                            get_field( 'memory_variation_4_ram' ) ||
                            get_field( 'memory_variation_5_ram' )
                        ) : 
                            $display = true;
                            if ( get_field( 'memory_variation_1_storage' ) && get_field( 'memory_variation_1_ram' ) ) {
                                $internal[] = get_field( 'memory_variation_1_storage' ) . 'GB ' . get_field( 'memory_variation_1_ram' ) . 'GB RAM';
                            }
                            if ( get_field( 'memory_variation_2_storage' ) && get_field( 'memory_variation_2_ram' ) ) {
                                $internal[] = get_field( 'memory_variation_2_storage' ) . 'GB ' . get_field( 'memory_variation_2_ram' ) . 'GB RAM';
                            }
                            if ( get_field( 'memory_variation_3_storage' ) && get_field( 'memory_variation_3_ram' ) ) {
                                $internal[] = get_field( 'memory_variation_3_storage' ) . 'GB ' . get_field( 'memory_variation_3_ram' ) . 'GB RAM';
                            }
                            if ( get_field( 'memory_variation_4_storage' ) && get_field( 'memory_variation_4_ram' ) ) {
                                $internal[] = get_field( 'memory_variation_4_storage' ) . 'GB ' . get_field( 'memory_variation_4_ram' ) . 'GB RAM';
                            }
                            if ( get_field( 'memory_variation_5_storage' ) && get_field( 'memory_variation_5_ram' ) ) {
                                $internal[] = get_field( 'memory_variation_5_storage' ) . 'GB ' . get_field( 'memory_variation_5_ram' ) . 'GB RAM';
                            }
                        endif; ?>
                        <?php if ( $display ) : ?>
                        <tr>
                            <th>Internal</th>
                            <td><?php echo esc_html( implode( ", ", $internal ) ); ?></td>
                        </tr>
                        <?php endif; ?>

                        <?php
                        $display = false;
                        if ( get_field( 'memory_type_storage' ) && get_field( 'memory_type_storage' ) != 'None' ) : 
                            $display = true;
                        endif; ?>
                        <?php if ( $display ) : ?>
                        <tr>
                            <th></th>
                            <td><?php echo esc_html( get_field( 'memory_type_storage' ) ); ?></td>
                        </tr>
                        <?php endif; ?>

                    </table>
                    <!-- End Memory -->

                    <!-- Start Main Camera -->
                    <h3>Main Camera</h3>
                    <table>
                        <?php
                        $display = false;
                        $number_of_cam = '';
                        if ( get_field( 'main_camera_cameras_cameras' ) ) : 
                            $display = true;
                        endif; ?>
                        <?php if ( $display ) : 
                            
                            if ( get_field( 'main_camera_cameras_cameras' ) && get_field( 'main_camera_cameras_cameras' ) > 0 ) {
                                switch ( get_field( 'main_camera_cameras_cameras' ) ) {
                                    case 1:
                                        $number_of_cam = __( 'Single' );
                                        break;
                                    case 2:
                                        $number_of_cam = __( 'Dual' );
                                        break;
                                    case 3:
                                        $number_of_cam = __( 'Tripple' );
                                        break;
                                    case 4:
                                        $number_of_cam = __( 'Quad' );
                                        break;
                                    default:
                                        $number_of_cam = get_field( 'main_camera_cameras_cameras' ) . __( 'Cameras' );
                                        break;
                                }
                            }

                            $cam_count = intval( get_field( 'main_camera_cameras_cameras' ) );
                            if ( $cam_count > 0 ) {
                                for( $i = 1; $i <= $cam_count; $i++ ) {

                                    $cam = [];
                                    if (
                                        get_field( 'main_camera_camera_info_camera_'. $i .'_resolution' ) ||
                                        get_field( 'main_camera_camera_info_camera_'. $i .'_f-number' )  || 
                                        get_field( 'main_camera_camera_info_camera_'. $i .'_type' )  || 
                                        get_field( 'main_camera_camera_info_camera_'. $i .'_others' )
                                    ) {

                                        if ( get_field( 'main_camera_camera_info_camera_'. $i .'_resolution' ) ) {
                                            $cam[] = get_field( 'main_camera_camera_info_camera_'. $i .'_resolution' ) . ' MP';
                                        }
                                        if ( get_field( 'main_camera_camera_info_camera_'. $i .'_f-number' ) ) {
                                            $cam[] = 'f/' . get_field( 'main_camera_camera_info_camera_'. $i .'_f-number' );
                                        }
                                        if ( get_field( 'main_camera_camera_info_camera_'. $i .'_type' ) && get_field( 'main_camera_camera_info_camera_'. $i .'_type' ) !== 'none' ) {
                                            $angel = get_field( 'main_camera_camera_info_camera_'. $i .'_angel' ) ? get_field( 'main_camera_camera_info_camera_'. $i .'_angel' ) . ' ' : '';
                                            $cam[] = $angel . '(' . get_field( 'main_camera_camera_info_camera_'. $i .'_type' ) . ')';
                                        }
                                        
                                        if ( get_field( 'main_camera_camera_info_camera_'. $i .'_others' ) ) {
                                            $cam[] = get_field( 'main_camera_camera_info_camera_'. $i .'_others' );
                                        }
                                    }

                                    ?>
                                    <tr>
                                        <?php if ( $i == 1 ) : ?>
                                            <th rowspan="<?php echo esc_attr( $cam_count ); ?>"><?php echo $i == 1 ? esc_html( $number_of_cam ) : ''; ?></th>
                                        <?php endif; ?>
                                        <td><?php echo esc_html( implode( ", ", $cam ) ); ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                            
                        <?php endif; ?>

                        <?php
                        $display = false;
                        $features = [];
                        if (
                            get_field( 'main_camera_features_panoroma' ) ||
                            get_field( 'main_camera_features_hdr' ) ||
                            ( get_field( 'main_camera_features_flash' ) &&
                            get_field( 'main_camera_features_flash' ) !== 'none' )
                        ) { 
                            $display = true;
                            if ( get_field( 'main_camera_features_flash' ) ) {
                                $features[] = get_field( 'main_camera_features_flash' ) !== 'none' ? get_field( 'main_camera_features_flash' ) : '';
                            }
                            if ( get_field( 'main_camera_features_panoroma' ) ) {
                                $features[] = 'Panorama';
                            }
                            if ( get_field( 'main_camera_features_hdr' ) ) {
                                $features[] = 'HDR';
                            }
                        } ?>
                        
                        <?php if ( $display ) : ?>
                        <tr>
                            <th>Features</th>
                            <td><?php echo esc_html( implode( ", ", $features ) ); ?></td>
                        </tr>
                        <?php endif; ?>

                        <?php
                        $display = false;
                        if ( get_field( 'main_camera_cameras_video_details' ) ) {
                            $display = true;
                        }
                        ?>

                        <?php if ( $display ) : ?>
                        <tr>
                            <th>Video</th>
                            <td><?php echo esc_html( get_field( 'main_camera_cameras_video_details' ) ); ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                    <!-- End Main Camera -->

                    <!-- Start Selfie Camera -->
                    <h3>Selfie Camera</h3>
                    <table>
                        <?php
                        $display = false;
                        $number_of_cam = '';
                        if ( get_field( 'selfie_camera_cameras_cameras' ) ) : 
                            $display = true;
                        endif; ?>
                        <?php if ( $display ) : 
                            
                            if ( get_field( 'selfie_camera_cameras_cameras' ) && get_field( 'selfie_camera_cameras_cameras' ) > 0 ) {
                                switch ( get_field( 'selfie_camera_cameras_cameras' ) ) {
                                    case 1:
                                        $number_of_cam = __( 'Single' );
                                        break;
                                    case 2:
                                        $number_of_cam = __( 'Dual' );
                                        break;
                                    case 3:
                                        $number_of_cam = __( 'Tripple' );
                                        break;
                                    case 4:
                                        $number_of_cam = __( 'Quad' );
                                        break;
                                    default:
                                        $number_of_cam = get_field( 'selfie_camera_cameras_cameras' ) . __( 'Cameras' );
                                        break;
                                }
                            }

                            $cam_count = intval( get_field( 'selfie_camera_cameras_cameras' ) );
                            if ( $cam_count > 0 ) {
                                for( $i = 1; $i <= $cam_count; $i++ ) {

                                    $cam = [];
                                    if (
                                        get_field( 'selfie_camera_camera_info_camera_'. $i .'_resolution' ) ||
                                        get_field( 'selfie_camera_camera_info_camera_'. $i .'_type' )  || 
                                        get_field( 'selfie_camera_camera_info_camera_'. $i .'_f-number' )  || 
                                        get_field( 'selfie_camera_camera_info_camera_'. $i .'_others' )
                                    ) {

                                        if ( get_field( 'selfie_camera_camera_info_camera_'. $i .'_resolution' ) ) {
                                            $cam[] = get_field( 'selfie_camera_camera_info_camera_'. $i .'_resolution' ) . ' MP';
                                        }

                                        if ( get_field( 'selfie_camera_camera_info_camera_'. $i .'_f-number' ) ) {
                                            $cam[] = 'f/'. get_field( 'selfie_camera_camera_info_camera_'. $i .'_f-number' );
                                        }

                                        if ( get_field( 'selfie_camera_camera_info_camera_'. $i .'_type' ) && get_field( 'selfie_camera_camera_info_camera_'. $i .'_type' ) !== 'none' ) {
                                            $angel = get_field( 'selfie_camera_camera_info_camera_'. $i .'_angel' ) ? get_field( 'selfie_camera_camera_info_camera_'. $i .'_angel' ) . ' ' : '';
                                            $cam[] = $angel . '(' . get_field( 'selfie_camera_camera_info_camera_'. $i .'_type' ) . ')';
                                        }
                                        
                                        if ( get_field( 'selfie_camera_camera_info_camera_'. $i .'_others' ) ) {
                                            $cam[] = get_field( 'selfie_camera_camera_info_camera_'. $i .'_others' );
                                        }
                                    }

                                    ?>
                                    <tr>
                                        <?php if ( $i == 1 ) : ?>
                                            <th rowspan="<?php echo esc_attr( $cam_count ); ?>"><?php echo $i == 1 ? esc_html( $number_of_cam ) : ''; ?></th>
                                        <?php endif; ?>
                                        <td><?php echo esc_html( implode( ", ", $cam ) ); ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                            
                        <?php endif; ?>

                        <?php
                        $display = false;
                        $features = [];
                        if (
                            get_field( 'selfie_camera_features_panoroma' ) ||
                            get_field( 'selfie_camera_features_hdr' ) ||
                            ( get_field( 'selfie_camera_features_flash' ) &&
                            get_field( 'selfie_camera_features_flash' ) !== 'none' )
                        ) { 
                            $display = true;
                            if ( get_field( 'selfie_camera_features_flash' ) ) {
                                $features[] = get_field( 'selfie_camera_features_flash' ) !== 'none' ? get_field( 'selfie_camera_features_flash' ) : '';
                            }
                            if ( get_field( 'selfie_camera_features_panoroma' ) ) {
                                $features[] = 'Panorama';
                            }
                            if ( get_field( 'selfie_camera_features_hdr' ) ) {
                                $features[] = 'HDR';
                            }
                        } ?>
                        
                        <?php if ( $display ) : ?>
                        <tr>
                            <th>Features</th>
                            <td><?php echo esc_html( implode( ", ", $features ) ); ?></td>
                        </tr>
                        <?php endif; ?>

                        <?php
                        $display = false;
                        if ( get_field( 'selfie_camera_cameras_video_details' ) ) {
                            $display = true;
                        }
                        ?>

                        <?php if ( $display ) : ?>
                        <tr>
                            <th>Video</th>
                            <td><?php echo esc_html( get_field( 'selfie_camera_cameras_video_details' ) ); ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                    <!-- End Selfie Camera -->

                    <!-- Start Sound -->
                    <h3>Sound</h3>
                    <table>
                        <?php
                            $display = false;
                            $loudspeaker = '';
                            if ( get_field( 'audio_loudspeaker_extra' ) ) {
                                $display = true;
                                $loudspeaker = get_field( 'audio_loudspeaker_extra' );
                            }
                            ?>
                            <?php if ( $display ) : ?>
                            <tr>
                                <th>Loudspeaker</th>
                                <td><?php echo esc_html( $loudspeaker ); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php
                            $display = false;
                            $jack = [];
                            if (
                                get_field( 'audio_35mm_jack' ) ||
                                get_field( 'audio_extra_extra_info_1' ) ||
                                get_field( 'audio_extra_extra_info_2' ) ||
                                get_field( 'audio_extra_extra_info_3' ) ||
                                get_field( 'audio_extra_extra_info_4' )
                            ) {
                                $display = true;
                                if ( get_field( 'audio_35mm_jack' ) ) {
                                    $jack[] = 'Yes';
                                }
                                if ( get_field( 'audio_extra_extra_info_1' ) ) {
                                    $jack[] = get_field( 'audio_extra_extra_info_1' );
                                }
                                if ( get_field( 'audio_extra_extra_info_2' ) ) {
                                    $jack[] = get_field( 'audio_extra_extra_info_2' );
                                }
                                if ( get_field( 'audio_extra_extra_info_3' ) ) {
                                    $jack[] = get_field( 'audio_extra_extra_info_3' );
                                }
                                if ( get_field( 'audio_extra_extra_info_4' ) ) {
                                    $jack[] = get_field( 'audio_extra_extra_info_4' );
                                }
                            }
                        ?>
                        <?php if ( $display ) : 
                            for( $i = 0; $i < count( $jack ); $i++ ){
                                ?>
                                <tr>
                                    <?php if ( $i == 0 ) : ?>
                                        <th rowspan="10"><?php echo $i == 0 ? esc_html( '3.5mm jack' ) : ''; ?></th>
                                    <?php endif; ?>
                                    <td><?php echo esc_html( $jack[$i] ); ?></td>
                                </tr>
                                <?php
                            }
                            endif; ?>
                    </table>
                    <!-- End Sound -->

                    <!-- Start Commons -->
                    <h3>Commons</h3>
                    <table>
                        <?php
                            $display = false;
                            if ( get_field( 'connectivity_wifi_description' ) ) {
                                $display = true;
                            }
                            ?>
                            <?php if ( $display ) : ?>
                            <tr>
                                <th>WLAN</th>
                                <td><?php echo esc_html( get_field( 'connectivity_wifi_description' ) ); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php
                            $display = false;
                            if ( get_field( 'connectivity_bluetooth_description' ) ) {
                                $display = true;
                            }
                            ?>
                            <?php if ( $display ) : ?>
                            <tr>
                                <th>Bluetooth</th>
                                <td><?php echo esc_html( get_field( 'connectivity_bluetooth_description' ) ); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php
                            $display = false;
                            if ( get_field( 'connectivity_gps_description' ) ) {
                                $display = true;
                            }
                            ?>
                            <?php if ( $display ) : ?>
                            <tr>
                                <th>GPS</th>
                                <td><?php echo esc_html( get_field( 'connectivity_gps_description' ) ); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php
                            $display = false;
                            $nfc = '';
                            if ( get_field( 'connectivity_nfc_nfc' ) ) {
                                $display = true;
                                if ( !empty( get_field( 'connectivity_nfc_description' ) ) ) {
                                    $nfc = get_field( 'connectivity_nfc_description' );
                                } else {
                                    $nfc = "Yes";
                                }
                            }
                            ?>
                            <?php if ( $display ) : ?>
                            <tr>
                                <th>NFC</th>
                                <td><?php echo esc_html( $nfc ); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php
                            $display = false;
                            $infrared = '';
                            if ( get_field( 'connectivity_infrared_infrared' ) ) {
                                $display = true;
                                if ( !empty( get_field( 'connectivity_infrared_description' ) ) ) {
                                    $infrared = get_field( 'connectivity_infrared_description' );
                                } else {
                                    $infrared = "Yes";
                                }
                            }
                            ?>
                            <?php if ( $display ) : ?>
                            <tr>
                                <th>Infrared port</th>
                                <td><?php echo esc_html( $infrared ); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php
                            $display = false;
                            $radio = '';
                            if ( get_field( 'connectivity_fm_radio_fm_radio' ) ) {
                                $display = true;
                                if ( !empty( get_field( 'connectivity_fm_radio_description' ) ) ) {
                                    $radio = get_field( 'connectivity_fm_radio_description' );
                                } else {
                                    $radio = "Yes";
                                }
                            }
                            ?>
                            <?php if ( $display ) : ?>
                            <tr>
                                <th>Radio</th>
                                <td><?php echo esc_html( $radio ); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php
                            $display = false;
                            $usb = '';
                            if ( get_field( 'connectivity_usb_usb_description' ) ) {
                                $display = true;
                                if ( !empty( get_field( 'connectivity_usb_usb_description' ) ) ) {
                                    $usb = get_field( 'connectivity_usb_usb_description' );
                                } else {
                                    $usb = "Yes";
                                }
                            }
                            ?>
                            <?php if ( $display ) : ?>
                            <tr>
                                <th>USB</th>
                                <td><?php echo esc_html( $usb ); ?></td>
                            </tr>
                        <?php endif; ?>
                    </table>
                    <!-- End Commons -->

                    <!-- Start Features -->
                    <h3>Features</h3>
                    <table>
                        <?php
                            $display = false;
                            $features = [];
                            if (
                                get_field( 'sensors_description_1' ) ||
                                get_field( 'sensors_description_2' ) ||
                                get_field( 'sensors_description_3' ) ||
                                get_field( 'sensors_description_4' ) ||
                                get_field( 'sensors_description_5' )
                            ) {
                                $display = true;
                                if ( get_field( 'sensors_description_1' ) ) {
                                    $features[] = get_field( 'sensors_description_1' );
                                }
                                if ( get_field( 'sensors_description_2' ) ) {
                                    $features[] = get_field( 'sensors_description_2' );
                                }
                                if ( get_field( 'sensors_description_3' ) ) {
                                    $features[] = get_field( 'sensors_description_3' );
                                }
                                if ( get_field( 'sensors_description_4' ) ) {
                                    $features[] = get_field( 'sensors_description_4' );
                                }
                                if ( get_field( 'sensors_description_5' ) ) {
                                    $features[] = get_field( 'sensors_description_5' );
                                }
                            }
                        ?>
                        <?php if ( $display ) : 
                            
                            if ( count($features) ) :
                                foreach( $features as $index => $feature ) :
                                    ?>
                                    <tr>
                                        <?php if ( 0 == $index ) : ?>
                                            <th rowspan="10">Features</th>
                                        <?php endif; ?>
                                        <td><?php echo esc_html( $feature ); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endif; ?>

                    </table>
                    <!-- End Features -->

                    <!-- Start Battery -->
                    <h3>Battery</h3>
                    <table>
                        <?php
                            $display = false;
                            if ( get_field( 'battery_description_type' ) ) {
                                $display = true;
                            }
                            ?>
                            <?php if ( $display ) : ?>
                            <tr>
                                <th>Type</th>
                                <td><?php echo esc_html( get_field( 'battery_description_type' ) ); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php
                            $display = false;
                            
                            if (
                                get_field( 'battery_description_charging_data_1' ) ||
                                get_field( 'battery_description_charging_data_2' ) ||
                                get_field( 'battery_description_charging_data_3' ) ||
                                get_field( 'battery_description_charging_data_4' ) ||
                                get_field( 'battery_description_charging_data_5' ) ||
                                get_field( 'battery_description_charging_data_6' ) ||
                                get_field( 'battery_description_charging_data_7' )
                            ) {
                                $display = true;
                            }
                            ?>
                            <?php if ( $display ) : 
                                for( $i = 1; $i <= 7; $i++ ) :
                                    if ( get_field( 'battery_description_charging_data_' . $i ) ) :
                                        ?>
                                        <tr>
                                            <?php if ( $i ==1 ) : ?>
                                                <th rowspan="<?php echo $i == 1 ? esc_attr( 10 ) : ''; ?>"><?php echo $i == 1 ? esc_html( 'Charging' ) : ''; ?></th>
                                            <?php endif; ?>
                                            <td><?php echo esc_html( get_field( 'battery_description_charging_data_' . $i ) ); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            <?php endif; ?>

                        
                    </table>
                    <!-- End Battery -->

                    <!-- Start Miscellaneous -->
                    <h3>Miscellaneous</h3>
                    <table>
                        <?php
                            $display = false;
                            if ( get_field( 'miscellaneous_colors' ) ) {
                                $display = true;
                            }
                            ?>
                            <?php if ( $display ) : ?>
                            <tr>
                                <th>Colors</th>
                                <td><?php echo esc_html( implode( ", ", get_field( 'miscellaneous_colors') ) ); ?></td>
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

                        <?php
                            $display = false;
                            
                            if (
                                get_field( 'miscellaneous_prices_price_1' ) ||
                                get_field( 'miscellaneous_prices_price_2' ) ||
                                get_field( 'miscellaneous_prices_price_3' ) ||
                                get_field( 'miscellaneous_prices_price_4' ) ||
                                get_field( 'miscellaneous_prices_price_5' ) ||
                                get_field( 'miscellaneous_prices_price_6' )
                            ) {
                                $display = true;
                            }
                            ?>
                            <?php if ( $display ) : 
                                $price = [];
                                for( $i = 1; $i <= 6; $i++ ) : 
                                    
                                    if( get_field( 'miscellaneous_prices_price_' . $i ) ) :
                                        $price[] = '$' . get_field( 'miscellaneous_prices_price_' . $i );
                                        ?>
                                    <?php endif; ?>
                                <?php endfor; ?>
                                <tr>
                                    <th>Price</th>
                                    <td><?php echo esc_html( implode( ", ", $price ) ); ?></td>
                                </tr>
                            <?php endif; ?>

                        
                    </table>
                    <!-- End Miscellaneous -->
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
