<?php
/**
 * The current version of the theme.
 *
 * @package REO
 */

// Theme version.
define( 'REO_THEME_VERSION', '1.0.0' );

// Framework Path.
define( 'REO_FRAMEWORK', get_template_directory() . '/framework/' );

// Design Variation
if ( ! defined( 'REO_DESIGN_VARIATION' ) ) {
	define( 'REO_DESIGN_VARIATION', get_option( 'inspiry_design_variation', 'modern' ) );
}

// Theme assets

if ( ! defined( 'REO_THEME_ASSETS' ) ) {
	define( 'REO_THEME_ASSETS', '/assets/' . REO_DESIGN_VARIATION );
}

// Theme directory.
if ( ! defined( 'REO_THEME_DIR' ) ) {
	define( 'REO_THEME_DIR', get_template_directory() . REO_THEME_ASSETS );
}

// Theme directory URI.
if ( ! defined( 'REO_DIR_URI' ) ) {
	define( 'REO_DIR_URI', get_template_directory_uri() . REO_THEME_ASSETS );
}

// Theme common directory.
if ( ! defined( 'REO_COMMON_DIR' ) ) {
	define( 'REO_COMMON_DIR', get_template_directory() . '/common/' );
}

// Theme common directory URI.
if ( ! defined( 'REO_COMMON_URI' ) ) {
	define( 'REO_COMMON_URI', get_template_directory_uri() . '/common/' );
}

// Includes directory path.
if ( ! defined( 'REO_INCLUDES_DIR' ) ) {
	define( 'REO_INCULDES_DIR', get_template_directory() . '/includes/' );
}

// Includes directory URL.
if ( ! defined( 'REO_INCLUDES_URI' ) ) {
	define( 'REO_INCULDES_URI', get_template_directory_uri() . '/includes/' );
}

if ( ! function_exists( 'reo_theme_setup' ) ) {
	/**
	 * 1. Load text domain
	 * 2. Add custom background support
	 * 3. Add automatic feed links support
	 * 4. Add specific post formats support
	 * 5. Add custom menu support and register a custom menu
	 * 6. Register required image sizes
	 * 7. Add title tag support
	 */
	function reo_theme_setup() {

		/**
		 * Load text domain for translation purposes
		 */
		$languages_dir = get_template_directory() . '/languages';
		if ( file_exists( $languages_dir ) ) {
			load_theme_textdomain( 'framework', $languages_dir );
		} else {
			load_theme_textdomain( 'framework' );   // For backward compatibility.
		}

		// Set the default content width.
		$GLOBALS['content_width'] = 828;

		/**
		 * Add Theme Support - Custom background
		 */
		add_theme_support( 'custom-background' );

		/**
		 * Add Automatic Feed Links Support
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Add Post Formats Support
		 */
		add_theme_support( 'post-formats', array( 'image', 'video', 'gallery' ) );

		/**
		 * Register custom menus
		 */
		$nav_menus = array(
			'main-menu'       => esc_html__( 'Main Menu', 'framework' ),
			'responsive-menu' => esc_html__( 'Responsive Menu', 'framework' ),
		);
		register_nav_menus( apply_filters( 'inspiry_nav_menus', $nav_menus ) );

		/**
		 * Add Post Thumbnails Support and Related Image Sizes
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 150, 150 );                                    // Default Post Thumbnail dimensions.
		add_image_size( 'property-thumb-image', 488, 326, true );               // (3) For Home page posts thumbnails/Featured Properties carousels thumb.
		add_image_size( 'property-detail-video-image', 818, 417, true );        // For Property detail page video image.
		add_image_size( 'agent-image', 210, 210, true );                        // For Agent Picture.
		add_image_size( 'partners-logo', 600, 9999, true );                     // For partner carousel logos

		if ( 'modern' === REO_DESIGN_VARIATION ) {
			/**
			 * Modern Design Image Sizes
			 */
			add_image_size( 'modern-property-child-slider', 680, 510, true );       // For Gallery, Child Property, Property Card, Property Grid Card, Similar Property.
			add_image_size( 'post-featured-image', 1240, 720, true );               // (1) For Blog featured image.
		} elseif ( 'classic' === REO_DESIGN_VARIATION ) {
			/**
			 * Classic Design Image Sizes
			 */
			add_image_size( 'gallery-two-column-image', 536, 269, true );           // For Gallery Two Column property Thumbnails.
			add_image_size( 'property-detail-slider-image-two', 1170, 648, true );  // (2) For Property detail page slider image.
			add_image_size( 'property-detail-slider-thumb', 82, 60, true );         // For Property detail page slider thumb.
		}

		add_theme_support( 'title-tag' );

		/**
		 * Add theme support for selective refresh
		 * of widgets in customizer.
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		if ( class_exists( 'Header_Footer_Elementor' ) ) {
			add_theme_support( 'header-footer-elementor' );
		}

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Small', 'framework' ),
					'shortName' => esc_html__( 'S', 'framework' ),
					'size'      => 14,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'Normal', 'framework' ),
					'shortName' => esc_html__( 'M', 'framework' ),
					'size'      => 16,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'framework' ),
					'shortName' => esc_html__( 'L', 'framework' ),
					'size'      => 28,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'framework' ),
					'shortName' => esc_html__( 'XL', 'framework' ),
					'size'      => 36,
					'slug'      => 'huge',
				),
			)
		);

		$editor_color_palette = array(
			array(
				'name'  => esc_html__( 'Primary', 'framework' ),
				'slug'  => 'primary',
				'color' => '#ec894d',
			),
			array(
				'name'  => esc_html__( 'Orange Dark', 'framework' ),
				'slug'  => 'orange-dark',
				'color' => '#dc7d44',
			),
			array(
				'name'  => esc_html__( 'Secondary', 'framework' ),
				'slug'  => 'secondary',
				'color' => '#4dc7ec',
			),
			array(
				'name'  => esc_html__( 'Blue Dark', 'framework' ),
				'slug'  => 'blue-dark',
				'color' => '#37b3d9',
			),
		);

		if ( 'modern' === REO_DESIGN_VARIATION ) {

			$editor_color_palette = array(
				array(
					'name'  => esc_html__( 'Primary', 'framework' ),
					'slug'  => 'primary',
					'color' => '#ea723d',
				),
				array(
					'name'  => esc_html__( 'Orange Dark', 'framework' ),
					'slug'  => 'orange-dark',
					'color' => '#e0652e',
				),
				array(
					'name'  => esc_html__( 'Secondary', 'framework' ),
					'slug'  => 'secondary',
					'color' => '#1ea69a',
				),
				array(
					'name'  => esc_html__( 'Green Dark', 'framework' ),
					'slug'  => 'blue-dark',
					'color' => '#1c9d92',
				),
			);
		}

		$editor_color_palette[] = array(
			'name'  => esc_html__( 'Black', 'framework' ),
			'slug'  => 'black',
			'color' => '#394041',
		);

		$editor_color_palette[] = array(
			'name'  => esc_html__( 'White', 'framework' ),
			'slug'  => 'white',
			'color' => '#fff',
		);

		// Editor color palette.
		add_theme_support( 'editor-color-palette', $editor_color_palette );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		global $pagenow;
		if ( is_admin() && 'themes.php' === $pagenow && isset( $_GET['activated'] ) ) {
			wp_redirect( admin_url( 'admin.php?page=realhomes-design' ) );
		}
	}

	add_action( 'after_setup_theme', 'reo_theme_setup' );
}

/**
 * Load functions files
 */
require_once REO_FRAMEWORK . 'functions/load.php';

/**
 * Google Fonts
 */
require_once REO_FRAMEWORK . 'customizer/google-fonts/google-fonts.php';

/**
 * Customizer
 */
require_once REO_FRAMEWORK . 'customizer/customizer.php';

/**
 * Functions
 */

require_once REO_INCLUDES_DIR . 'includes/functions/basic.php';  // basic functions.
require_once REO_INCLUDES_DIR . 'includes/functions/price.php';   // price functions.
require_once REO_INCLUDES_DIR . 'includes/functions/real-estate.php';   // real estate functions.
require_once REO_INCLUDES_DIR . 'includes/functions/agents.php';   // agents functions.
require_once REO_INCLUDES_DIR . 'includes/functions/agencies.php';   // agencies functions.
require_once REO_INCLUDES_DIR . 'includes/functions/gdpr.php';   // gdpr functions.
require_once REO_INCLUDES_DIR . 'includes/functions/google-recaptcha.php';   // google recaptcha functions.
require_once REO_INCLUDES_DIR . 'includes/functions/form-handlers.php';   // form handlers.
require_once REO_INCLUDES_DIR . 'includes/functions/members.php';   // members functions.
require_once REO_INCLUDES_DIR . 'includes/functions/property-submit.php';   // members functions.

// Require property analytics feature related files if it's enabled.
if ( inspiry_is_property_analytics_enabled() ) {
	require_once REO_INCLUDES_DIR . 'includes/property-analytics/class-property-analytics.php';   // property analytics model.
	require_once REO_INCLUDES_DIR . 'includes/property-analytics/class-property-analytics-view.php';   // property analytics view.
}

if ( inspiry_is_realhomes_registered() ) {
	require_once REO_INCLUDES_DIR . 'includes/functions/plugin-update.php';   // plugin update functions.
}

/**
 * Shortcodes
 */

require_once REO_INCLUDES_DIR . 'includes/shortcodes/columns.php';
require_once REO_INCLUDES_DIR . 'includes/shortcodes/elements.php';
require_once REO_INCLUDES_DIR . 'includes/shortcodes/vc-map.php';

/**
 * Widgets
 */

require_once REO_INCLUDES_DIR . 'includes/widgets/agent-properties-widget.php';
require_once REO_INCLUDES_DIR . 'includes/widgets/agents-list-widget.php';
require_once REO_INCLUDES_DIR . 'includes/widgets/agent-featured-properties-widget.php';
require_once REO_INCLUDES_DIR . 'includes/widgets/featured-properties-widget.php';
require_once REO_INCLUDES_DIR . 'includes/widgets/properties-widget.php';
require_once REO_INCLUDES_DIR . 'includes/widgets/property-types-widget.php';
require_once REO_INCLUDES_DIR . 'includes/widgets/advance-search-widget.php';
require_once REO_INCLUDES_DIR . 'includes/widgets/contact-form-widget.php';
require_once REO_INCLUDES_DIR . 'includes/widgets/mortgage-calculator-widget.php';

/**
 * Includes social login feature related files.
 */
require_once REO_INCLUDES_DIR . 'includes/social-login/autoload.php';  // Social login feature.

/**
 * Admin menu.
 */

require_once REO_INCLUDES_DIR . 'includes/admin-menu/class-ere-admin-menu.php';

/**
 * Custom Post Types
 */
require_once REO_INCLUDES_DIR . 'includes/custom-post-types/property.php';   // Property post type.
require_once REO_INCLUDES_DIR . 'includes/custom-post-types/agent.php';   // Agent post type.
require_once REO_INCLUDES_DIR . 'includes/custom-post-types/agency.php';   // Agency post type.
require_once REO_INCLUDES_DIR . 'includes/custom-post-types/partners.php';   // Partners post type.
require_once REO_INCLUDES_DIR . 'includes/custom-post-types/slide.php';   // Slide post type.

/**
 * Meta boxes
 */

require_once REO_INCLUDES_DIR . 'includes/mb/class-ere-meta-boxes.php';
require_once REO_INCLUDES_DIR . 'includes/mb/property-additional-fields.php';
