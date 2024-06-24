<?php
/**
 * BALACE functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BALACE
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function balace_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on BALACE, use a find and replace
		* to change 'balace' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'balace', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'balace' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'balace_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'balace_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function balace_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'balace_content_width', 640 );
}
add_action( 'after_setup_theme', 'balace_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function balace_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'balace' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'balace' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'balace_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function balace_scripts() {
	wp_enqueue_style( 'balace-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'balace-style', 'rtl', 'replace' );

	//wp_enqueue_script( 'balace-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'balace_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


add_theme_support( 'woocommerce' );


function top_nav_menu() {
    register_nav_menus(
        array(
            'top-nav-menu' => __( 'top-nav-menu' ),
        )
    );
}
add_action( 'init', 'top_nav_menu' );

function filter_class_on_li($classes, $item, $args) {
    if($args->theme_location == 'top-nav-menu') {
        $classes[] = 'nav-item';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'filter_class_on_li', 1, 3);

function add_menu_link_class($atts, $item, $args, $depth) {
    static $first_item = true;
    if ($args->theme_location == 'top-nav-menu') {
        $classes = 'h5';
        if ($item->title == 'Каталог') {
            $classes .= ' catalog-header';
        }
        if ($first_item) {
            $atts['href'] = '#';
            $first_item = false;
			$atts['class'] = $classes;
        } else {
            $atts['class'] = $classes;
        }
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_link_class', 10, 4);

function Top_bottom_Nav() {
    register_nav_menus(
        array(
            'top-nav-menu' => __( 'Top Navigation Menu' ),
            'catalog-info-menu' => __( 'Catalog Info Menu' ),
        )
    );
}
add_action( 'init', 'Top_bottom_Nav' );

function add_link_class($atts, $item, $args, $depth) {
    if ($args->theme_location == 'catalog-info-menu') {
        $classes = 'body2';
        $atts['class'] = $classes;
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_link_class', 10, 4);

function footer_menus() {
    register_nav_menus(
        array(
            'footer-menu-left' => __( 'Footer Menu Left' ),
            'footer-menu-right' => __( 'Footer Menu Right' ),
        )
    );
}
add_action( 'init', 'footer_menus' );

function add_footer_menu_left_classes($classes, $item, $args, $depth) {
    if ($args->theme_location === 'footer-menu-left') {
        $classes[] = 'footer__list-item';
        return $classes;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_footer_menu_left_classes', 10, 4);

function add_footer_menu_left_link_attributes($atts, $item, $args) {
    if ($args->theme_location === 'footer-menu-left') {
        $atts['class'] = 'footer__link body2';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_footer_menu_left_link_attributes', 10, 3);

function add_footer_menu_right_classes($classes, $item, $args, $depth) {
    if ($args->theme_location === 'footer-menu-right') {
        $classes[] = 'footer__list-item';
        return $classes;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_footer_menu_right_classes', 10, 4);

function add_footer_menu_right_link_attributes($atts, $item, $args) {
    if ($args->theme_location === 'footer-menu-right') {
        $atts['class'] = 'footer__link body2';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_footer_menu_right_link_attributes', 10, 3);
function my_theme_enqueue_styles_scripts() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap', array(), null);
	wp_enqueue_style('color-style', get_template_directory_uri() . '/assets/css/layouts/color.css');
    wp_enqueue_style('main-style', get_template_directory_uri() . '/assets/css/custom.css');
	wp_enqueue_style('btn-style', get_template_directory_uri() . '/assets/css/layouts/btn.css');
	wp_enqueue_style('header-style', get_template_directory_uri() . '/assets/css/layouts/header.css');
	wp_enqueue_style('footer-style', get_template_directory_uri() . '/assets/css/layouts/footer.css');
	wp_enqueue_style('catalog-style', get_template_directory_uri() . '/assets/css/layouts/catalog-product.css');
    wp_enqueue_script('jquery');
    wp_enqueue_script('header-script', get_template_directory_uri() . '/assets/js/header.js');
	



	if ( is_front_page() ) {
		wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css');
		wp_enqueue_style('home-style', get_template_directory_uri() . '/assets/css/pages/home-page.css');
		wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js');
		wp_enqueue_script('slider-prom-script', get_template_directory_uri() . '/assets/js/slider-promotional.js');
        wp_enqueue_script('slider-advan-script', get_template_directory_uri() . '/assets/js/slider-advantages.js');
		wp_enqueue_script('marquee-jq', get_template_directory_uri() . '/assets/js/marquee_jq.js');
		wp_enqueue_script('marquee', get_template_directory_uri() . '/assets/js/marquee.js');
		wp_enqueue_script('faq', get_template_directory_uri() . '/assets/js/faq.js');
	}

}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles_scripts');




function custom_product_loop_start() {
    echo '<ul class="products product-main">';
}
add_action('woocommerce_product_loop_start', 'custom_product_loop_start', 10);


remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
function add_custom_class_to_product_title() {
    echo '';
}
add_action('woocommerce_shop_loop_item_title', 'add_custom_class_to_product_title', 10);

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('woocommerce_before_shop_loop_item_title', 'custom_woocommerce_template_loop_product_image', 10);
add_action('woocommerce_after_shop_loop_item_title', 'custom_product_attributes', 15);

function custom_woocommerce_template_loop_product_image() {
    global $product;
    echo '<div class="product_image_item">';
    echo woocommerce_get_product_thumbnail();
    echo '</div>';
}


function custom_product_attributes() {
    global $product;
    $attribute_type = $product->get_attribute('тип-товара');
    $attribute_volume = $product->get_attribute('объём');
    $price = $product->get_price_html();
	if (!empty($attribute_type)) {
        echo '<div class="product-attribute-type" title="' . esc_attr($attribute_type) . '"><p class="body2 text_main">' . esc_html($attribute_type) . '</p></div>';
    }
    echo '<div class="product-attribute-wrapp">';
    echo '<h2 class="woocommerce-loop-product__title h4 text_main">' . get_the_title() . '</h2>';
    echo '<div class="product_attribute_container" title="' . esc_attr($attribute_volume) . '">';
	if (!empty($price)) {
        echo '<div class="h6 text_dark" title="' . esc_attr($price) . '">' . $price . '</div>';
    }
	if (!empty($attribute_volume)) {
        echo '<div class="product-attribute-value"><p class="h6 text_light">' . esc_html($attribute_volume) . '</div>';
    }
    echo '</div>';
    echo '</div>';
}

add_filter( 'woocommerce_loop_add_to_cart_link', 'custom_woocommerce_loop_add_to_cart_link', 10, 3 );
function custom_woocommerce_loop_add_to_cart_link( $button, $product, $args ) {
    $button = preg_replace( '/>[^<]*</', '><', $button );
    $button = str_replace( 'class="', 'class="btn_add_to_basket ', $button );
    return $button;
}


add_action( 'init', 'true_register_post_type_promotions' );
function true_register_post_type_promotions() {
    $labels = array(
        'name' => 'Акции',
        'singular_name' => 'Акция',
        'add_new' => 'Добавить акцию',
        'add_new_item' => 'Добавить акцию',
        'edit_item' => 'Редактировать акцию',
        'new_item' => 'Новая акция',
        'all_items' => 'Все акции',
        'search_items' => 'Искать акции',
        'not_found' => 'Акций по заданным критериям не найдено.',
        'not_found_in_trash' => 'В корзине нет акций.',
        'menu_name' => 'Акции'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => false,
        'has_archive' => false,
        'menu_icon' => 'dashicons-admin-post',
        'menu_position' => 2,
		'supports' => array( 'title', 'editor', 'thumbnail' ) 
    );
    register_post_type( 'promotions', $args );
}

add_action( 'init', 'true_register_post_type_blog' );
function true_register_post_type_blog() {
    $labels = array(
        'name' => 'Блог',
        'singular_name' => 'Запись блога',
        'add_new' => 'Добавить запись',
        'add_new_item' => 'Добавить запись',
        'edit_item' => 'Редактировать запись',
        'new_item' => 'Новая запись',
        'all_items' => 'Все записи',
        'search_items' => 'Искать записи',
        'not_found' => 'Записей по заданным критериям не найдено.',
        'not_found_in_trash' => 'В корзине нет записей.',
        'menu_name' => 'Блог'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-admin-post',
        'menu_position' => 5,
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'author', 'comments' ),
        'taxonomies' => array( 'category', 'post_tag' )
    );
    register_post_type( 'blog', $args );
}