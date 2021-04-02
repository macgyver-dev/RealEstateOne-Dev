<?php
/**
 * Contains Basic Functions for Easy Real Estate plugin.
 */

/**
 * Get template part for ERE plugin.
 *
 * @access public
 *
 * @param mixed  $slug Template slug.
 * @param string $name Template name (default: '').
 */
function ere_get_template_part( $slug, $name = '' ) {
	$template = '';

	// Get slug-name.php.
	if ( ! $template && $name && file_exists( ERE_PLUGIN_DIR . "/{$slug}-{$name}.php" ) ) {
		$template = ERE_PLUGIN_DIR . "/{$slug}-{$name}.php";
	}

	// Get slug.php.
	if ( ! $template && file_exists( ERE_PLUGIN_DIR . "/{$slug}.php" ) ) {
		$template = ERE_PLUGIN_DIR . "/{$slug}.php";
	}

	// Allow 3rd party plugins to filter template file from their plugin.
	$template = apply_filters( 'ere_get_template_part', $template, $slug, $name );

	if ( $template ) {
		load_template( $template, false );
	}
}

if ( ! function_exists( 'inspiry_is_realhomes_registered' ) ) {
	/**
	 * Check Realhomes theme registration status
	 *
	 * @return bool
	 */
	function inspiry_is_realhomes_registered() {

		return ( 'yes' == get_option( 'inspiry_realhomes_registered', 'no' ) );
	}
}

if ( ! function_exists( 'ere_exclude_CPT_meta_keys_from_rest_api' ) ) {

	add_filter( 'ere_property_rest_api_meta', 'ere_exclude_CPT_meta_keys_from_rest_api' );
	add_filter( 'ere_agency_rest_api_meta', 'ere_exclude_CPT_meta_keys_from_rest_api' );
	add_filter( 'ere_agent_rest_api_meta', 'ere_exclude_CPT_meta_keys_from_rest_api' );

	function ere_exclude_CPT_meta_keys_from_rest_api( $post_meta ) {

		$exclude_keys = array(
			// '_thumbnail_id',
			'_vc_post_settings',
			'_dp_original',
			'_edit_lock',
			'_wp_old_slug',
			'slide_template',
			'REAL_HOMES_banner_sub_title',
		);

		// excluding keys
		foreach ( $exclude_keys as $key ) {
			if ( key_exists( $key, $post_meta ) ) {
				unset( $post_meta[ $key ] );
			}
		}

		// return the post meta
		return $post_meta;
	}
}

if ( ! function_exists( 'ere_get_current_user_ip' ) ) {
	/**
	 * Return current user IP
	 *
	 * @return string|string[]|null
	 */
	function ere_get_current_user_ip() {
		return preg_replace( '/[^0-9a-fA-F:., ]/', '', $_SERVER['REMOTE_ADDR'] );
	}
}

if ( ! function_exists( 'ere_generate_posts_list' ) ) {
	/**
	 * Generates options list for given post arguments
	 *
	 * @param $post_args
	 * @param int       $selected
	 */
	function ere_generate_posts_list( $post_args, $selected = 0 ) {

		$defaults = array(
			'posts_per_page'   => -1,
			'suppress_filters' => true,
		);

		if ( is_array( $post_args ) ) {
			$post_args = wp_parse_args( $post_args, $defaults );
		} else {
			$post_args = wp_parse_args( array( 'post_type' => $post_args ), $defaults );
		}

		$posts = get_posts( $post_args );

		if ( isset( $selected ) && is_array( $selected ) ) {
			foreach ( $posts as $post ) :
				?><option value="<?php echo esc_attr( $post->ID ); ?>" 
				<?php
				if ( in_array( $post->ID, $selected ) ) {
					echo 'selected'; }
				?>
><?php echo esc_html( $post->post_title ); ?></option>
				<?php
			endforeach;
		} else {
			foreach ( $posts as $post ) :
				?>
				<option value="<?php echo esc_attr( $post->ID ); ?>" 
										  <?php
											if ( isset( $selected ) && ( $selected == $post->ID ) ) {
												echo 'selected'; }
											?>
				><?php echo esc_html( $post->post_title ); ?></option>
				<?php
			endforeach;
		}
	}
}

if ( ! function_exists( 'ere_display_property_label' ) ) {
	/**
	 * Display property label
	 *
	 * @param $post_id
	 */
	function ere_display_property_label( $post_id ) {

		$label_text = get_post_meta( $post_id, 'inspiry_property_label', true );
		$color      = get_post_meta( $post_id, 'inspiry_property_label_color', true );
		if ( ! empty( $label_text ) ) {
			?>
			<span 
			<?php
			if ( ! empty( $color ) ) {
				?>
				style="background: <?php echo esc_attr( $color ); ?>"<?php } ?>
				  class='property-label'><?php echo esc_html( $label_text ); ?></span>
			<?php

		}
	}
}

if ( ! function_exists( 'ere_include_compare_icon' ) ) {
	/**
	 * Include compare icon
	 */
	function ere_include_compare_icon() {

		if ( defined( 'INSPIRY_THEME_DIR' ) ) {
			include INSPIRY_THEME_DIR . '/images/icons/icon-compare.svg';
		} else {
			include ERE_PLUGIN_DIR . '/images/icons/icon-compare.svg';
		}

	}
}

if ( ! function_exists( 'ere_framework_excerpt' ) ) {
	/**
	 * Output custom excerpt of required length
	 *
	 * @param int    $len number of words
	 * @param string $trim string to appear after excerpt
	 */
	function ere_framework_excerpt( $len = 15, $trim = '&hellip;' ) {
		echo ere_get_framework_excerpt( $len, $trim );
	}
}

if ( ! function_exists( 'ere_get_framework_excerpt' ) ) {
	/**
	 * Returns custom excerpt of required length
	 *
	 * @param int    $len number of words
	 * @param string $trim string after excerpt
	 *
	 * @return array|string
	 */
	function ere_get_framework_excerpt( $len = 15, $trim = '&hellip;' ) {
		$limit     = $len + 1;
		$excerpt   = explode( ' ', get_the_excerpt(), $limit );
		$num_words = count( $excerpt );
		if ( $num_words >= $len ) {
			array_pop( $excerpt );
		} else {
			$trim = '';
		}
		$excerpt = implode( ' ', $excerpt ) . "$trim";

		return $excerpt;
	}
}

if ( ! function_exists( 'ere_social_networks' ) ) {
	/**
	 * Print social networks
	 *
	 * @param array $args Optional. Arguments to change container and icon classes.
	 */
	function ere_social_networks( $args = array() ) {

		$defaults = array(
			'container'       => 'ul',
			'container_class' => 'social_networks clearfix',
			'icon_size_class' => 'fa-lg',
			'replace_icons'   => array(),
			'link_target'     => '_blank',
		);

		$args = wp_parse_args( $args, $defaults );

		if ( 'true' === get_option( 'theme_show_social_menu', 'false' ) ) {

			$default_social_networks = array(
				'facebook'  => array(
					'url'  => get_option( 'theme_facebook_link' ),
					'icon' => 'fab fa-facebook-square',
				),
				'twitter'   => array(
					'url'  => get_option( 'theme_twitter_link' ),
					'icon' => 'fab fa-twitter',
				),
				'linkedin'  => array(
					'url'  => get_option( 'theme_linkedin_link' ),
					'icon' => 'fab fa-linkedin',
				),
				'instagram' => array(
					'url'  => get_option( 'theme_instagram_link' ),
					'icon' => 'fab fa-instagram',
				),
				'pinterest' => array(
					'url'  => get_option( 'theme_pinterest_link' ),
					'icon' => 'fab fa-pinterest',
				),
				'youtube'   => array(
					'url'  => get_option( 'theme_youtube_link' ),
					'icon' => 'fab fa-youtube',
				),
				'skype'     => array(
					'url'  => get_option( 'theme_skype_username' ),
					'icon' => 'fab fa-skype',
				),
				'rss'       => array(
					'url'  => get_option( 'theme_rss_link' ),
					'icon' => 'fas fa-rss',
				),
				'line'      => array(
					'url'  => get_option( 'theme_line_id' ),
					'icon' => 'fab fa-line',
				),
			);

			$additional_social_networks = get_option( 'theme_social_networks', array() );
			$social_networks            = apply_filters( 'inspiry_header_social_networks', $default_social_networks + $additional_social_networks );

			$html = '<' . $args['container'] . ' class="' . esc_attr( $args['container_class'] ) . '">';

			foreach ( $social_networks as $title => $social_network ) {

				$social_network_title = $title;
				$social_network_url   = $social_network['url'];
				$social_network_icon  = $social_network['icon'];

				if ( isset( $social_network['title'] ) && ! empty( $social_network['title'] ) ) {
					$social_network_title = strtolower( str_replace( ' ', '-', $social_network['title'] ) );
				}

				if ( ! empty( $social_network_title ) && ! empty( $social_network_url ) && ! empty( $social_network_icon ) ) {

					if ( 'skype' === $social_network_title ) {
						$social_network_url = esc_attr( 'skype:' . $social_network_url );
					} elseif ( 'line' === $social_network_title ) {
						$social_network_url = esc_url( 'https://line.me/ti/p/' . $social_network_url );
					} else {
						$social_network_url = esc_url( $social_network_url );
					}

					if ( ! empty( $args['replace_icons'] ) ) {

						if ( array_key_exists( $social_network_title, $args['replace_icons'] ) ) {
							$social_network_icon = $args['replace_icons'][ $social_network_title ];
						}
					}

					$social_network_icon = array(
						$social_network_icon,
						$args['icon_size_class'],
					);
					$icon_classes        = implode( ' ', $social_network_icon );

					if ( 'ul' === $args['container'] ) {
						$format = '<li class="%s"><a href="%s" target="%s"><i class="%s"></i></a></li>';
					} else {
						$format = '<a class="%s" href="%s" target="%s"><i class="%s"></i></a>';
					}

					$html .= sprintf( $format, esc_attr( $social_network_title ), $social_network_url, esc_attr( $args['link_target'] ), esc_attr( $icon_classes ) );
				}
			}

			$html .= '</' . $args['container'] . '>';

			echo $html;
		}
	}
}

if ( is_admin() && ! function_exists( 'inspiry_remove_revolution_slider_meta_boxes' ) ) {
	/**
	 * Remove Rev Slider Metabox
	 */
	function inspiry_remove_revolution_slider_meta_boxes() {

		$post_types = apply_filters(
			'inspiry_remove_revolution_slider_meta_boxes',
			array(
				'page',
				'post',
				'property',
				'agency',
				'agent',
				'partners',
				'slide',
			)
		);

		remove_meta_box( 'mymetabox_revslider_0', $post_types, 'normal' );
	}

	add_action( 'do_meta_boxes', 'inspiry_remove_revolution_slider_meta_boxes' );
}

if ( ! function_exists( 'inspiry_is_property_analytics_enabled' ) ) {
	/**
	 * Check property analytics feature is enabled or disabled.
	 */
	function inspiry_is_property_analytics_enabled() {
		return 'enabled' === get_option( 'inspiry_property_analytics_status', 'disabled' );
	}
}
