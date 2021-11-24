<?php

/**
 * total functions and definitions
 *
 * @package total
 */
if (!defined('TOTAL_VERSION')) {
    $total_get_theme = wp_get_theme();
    $total_version = $total_get_theme->Version;
    define('TOTAL_VERSION', $total_version);
}

if (!function_exists('total_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function total_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on total, use a find and replace
         * to change 'total' to the name of your theme in all the template files
         */
        load_theme_textdomain('total', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support('post-thumbnails');
        add_image_size('total-portfolio-thumb', 400, 400, true);
        add_image_size('total-team-thumb', 350, 420, true);
        add_image_size('total-blog-thumb', 400, 280, true);
        add_image_size('total-thumb', 100, 100, true);
        add_image_size('total-blog-header', 720, 360, true);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'total'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('total_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        add_theme_support('custom-logo', array(
            'height' => 62,
            'width' => 300,
            'flex-height' => true,
            'flex-width' => true,
            'header-text' => array('.ht-site-title', '.ht-site-description'),
        ));

        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');

        // Add support for Block Styles.
        add_theme_support('wp-block-styles');

        // Add support for full and wide align images.
        add_theme_support('align-wide');

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Add support for responsive embedded content.
        add_theme_support('responsive-embeds');

        add_theme_support('custom-line-height');

        add_theme_support('custom-spacing');

        add_theme_support('custom-units');

        /*
         * This theme styles the visual editor to resemble the theme style,
         * specifically font, colors, icons, and column width.
         */
        add_editor_style(array('css/editor-style.css', total_fonts_url()));
    }

endif; // total_setup
add_action('after_setup_theme', 'total_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function total_content_width() {
    $GLOBALS['content_width'] = apply_filters('total_content_width', 640);
}

add_action('after_setup_theme', 'total_content_width', 0);

/**
 * Enables the Excerpt meta box in Page edit screen.
 */
function total_add_excerpt_support_for_pages() {
    add_post_type_support('page', 'excerpt');
}

add_action('init', 'total_add_excerpt_support_for_pages');

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function total_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('Right Sidebar', 'total'),
        'id' => 'total-right-sidebar',
        'description' => esc_html__('Add widgets here to appear in your sidebar.', 'total'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Left Sidebar', 'total'),
        'id' => 'total-left-sidebar',
        'description' => esc_html__('Add widgets here to appear in your sidebar.', 'total'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    if (total_is_woocommerce_activated()) {
        register_sidebar(array(
            'name' => esc_html__('Shop Sidebar', 'total'),
            'id' => 'total-shop-sidebar',
            'description' => esc_html__('Add widgets here to appear in your sidebar of shop page.', 'total'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        ));
    }

    register_sidebar(array(
        'name' => esc_html__('Footer One', 'total'),
        'id' => 'total-footer1',
        'description' => esc_html__('Add widgets here to appear in your Footer.', 'total'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Two', 'total'),
        'id' => 'total-footer2',
        'description' => esc_html__('Add widgets here to appear in your Footer.', 'total'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Three', 'total'),
        'id' => 'total-footer3',
        'description' => esc_html__('Add widgets here to appear in your Footer.', 'total'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Four', 'total'),
        'id' => 'total-footer4',
        'description' => esc_html__('Add widgets here to appear in your Footer.', 'total'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
}

add_action('widgets_init', 'total_widgets_init');

if (!function_exists('total_fonts_url')) :

    /**
     * Register Google fonts for Total.
     *
     * @since Total 1.0
     *
     * @return string Google fonts URL for the theme.
     */
    function total_fonts_url() {
        $fonts_url = '';
        $subsets = 'latin,latin-ext';
        $fonts = $standard_font_family = $default_font_list = $font_family_array = $variants_array = $font_array = $google_fonts = array();

        $customizer_fonts = apply_filters('total_customizer_fonts', array(
            'total_body_family' => 'Poppins',
            'total_menu_family' => 'Oswald',
            'total_h_family' => 'Oswald'
        ));

        $standard_font = total_standard_font_array();
        $google_font_list = total_google_font_array();
        $default_font_list = total_default_font_array();

        foreach ($standard_font as $key => $value) {
            $standard_font_family[] = $value['family'];
        }

        foreach ($default_font_list as $key => $value) {
            $default_font_family[] = $value['family'];
        }

        foreach ($customizer_fonts as $key => $value) {
            $font_family_array[] = get_theme_mod($key, $value);
        }

        $font_family_array = array_unique($font_family_array);
        $font_family_array = array_diff($font_family_array, array_merge($standard_font_family, $default_font_family));

        foreach ($font_family_array as $font_family) {
            $font_array = total_search_key($google_font_list, 'family', $font_family);
            $variants_array = $font_array['0']['variants'];
            $variants_keys = array_keys($variants_array);
            $variants = implode(',', $variants_keys);

            $fonts[] = $font_family . ':' . str_replace('italic', 'i', $variants);
        }
        /*
         * Translators: To add an additional character subset specific to your language,
         * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
         */
        $subset = _x('no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'total');

        if ('cyrillic' == $subset) {
            $subsets .= ',cyrillic,cyrillic-ext';
        } elseif ('greek' == $subset) {
            $subsets .= ',greek,greek-ext';
        } elseif ('devanagari' == $subset) {
            $subsets .= ',devanagari';
        } elseif ('vietnamese' == $subset) {
            $subsets .= ',vietnamese';
        }

        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urlencode(implode('|', $fonts)),
                'subset' => urlencode($subsets),
                'display' => 'swap',
                    ), '//fonts.googleapis.com/css');
        }

        return $fonts_url;
    }

endif;

/**
 * Enqueue scripts and styles.
 */
function total_scripts() {
    wp_enqueue_script('jquery-nav', get_template_directory_uri() . '/js/jquery.nav.js', array('jquery'), TOTAL_VERSION, true);
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), TOTAL_VERSION, true);
    wp_enqueue_script('isotope-pkgd', get_template_directory_uri() . '/js/isotope.pkgd.js', array('jquery', 'imagesloaded'), TOTAL_VERSION, true);
    wp_enqueue_script('nivo-lightbox', get_template_directory_uri() . '/js/nivo-lightbox.js', array('jquery'), TOTAL_VERSION, true);
    wp_enqueue_script('superfish', get_template_directory_uri() . '/js/superfish.js', array('jquery'), TOTAL_VERSION, true);
    wp_enqueue_script('jquery-stellar', get_template_directory_uri() . '/js/jquery.stellar.js', array('imagesloaded'), TOTAL_VERSION, false);
    wp_enqueue_script('odometer', get_template_directory_uri() . '/js/odometer.js', array('jquery'), TOTAL_VERSION, true);
    wp_enqueue_script('waypoint', get_template_directory_uri() . '/js/waypoint.js', array('jquery'), TOTAL_VERSION, true);
    wp_enqueue_script('headroom', get_template_directory_uri() . '/js/headroom.js', array('jquery'), TOTAL_VERSION, true);
    wp_enqueue_script('total-custom', get_template_directory_uri() . '/js/total-custom.js', array('jquery'), TOTAL_VERSION, true);
    wp_localize_script('total-custom', 'total_localize', array('template_path' => get_template_directory_uri()));

    wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.css', array(), TOTAL_VERSION);
    wp_enqueue_style('font-awesome-4.7.0', get_template_directory_uri() . '/css/font-awesome-4.7.0.css', array(), TOTAL_VERSION);
    wp_enqueue_style('font-awesome-5.2.0', get_template_directory_uri() . '/css/font-awesome-5.2.0.css', array(), TOTAL_VERSION);
    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css', array(), TOTAL_VERSION);
    wp_enqueue_style('nivo-lightbox', get_template_directory_uri() . '/css/nivo-lightbox.css', array(), TOTAL_VERSION);
    wp_enqueue_style('total-fonts', total_fonts_url(), array(), NULL);
    wp_enqueue_style('total-style', get_stylesheet_uri(), array(), TOTAL_VERSION);
    wp_add_inline_style('total-style', total_dymanic_styles());


    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'total_scripts');

/**
 * Enqueue admin style
 */
function total_admin_scripts() {
    wp_enqueue_style('total-admin-style', get_template_directory_uri() . '/css/admin-style.css', array(), TOTAL_VERSION);
    wp_enqueue_media();
    wp_enqueue_script('total-admin-scripts', get_template_directory_uri() . '/js/admin-scripts.js', array('jquery'), TOTAL_VERSION, true);
}

add_action('admin_enqueue_scripts', 'total_admin_scripts');
add_action('elementor/editor/before_enqueue_scripts', 'total_admin_scripts');

if (!function_exists('wp_body_open')) {

    function wp_body_open() {
        do_action('wp_body_open');
    }

}

/**
 * Breadcrumb
 */
require get_template_directory() . '/inc/breadcrumbs.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/helper-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Metabox additions.
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Hooks
 */
require get_template_directory() . '/inc/hooks.php';

/**
 * Dynamic Styles additions.
 */
require get_template_directory() . '/inc/style.php';

/**
 * Widgets additions.
 */
require get_template_directory() . '/inc/widgets/widget-fields.php';
require get_template_directory() . '/inc/widgets/widget-contact-info.php';
require get_template_directory() . '/inc/widgets/widget-personal-info.php';
require get_template_directory() . '/inc/widgets/widget-latest-post.php';

/**
 * Welcome Page.
 */
require get_template_directory() . '/welcome/welcome.php';

/**
 * TGMPA
 */
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';
