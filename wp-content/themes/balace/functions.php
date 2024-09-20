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

//redirect
add_action('template_redirect', 'redirect_shop_to_balace');
function redirect_shop_to_balace() {
    if (is_shop()) { 
        wp_redirect(home_url('/balace/'), 301);
        exit;
    }
}


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
    wp_enqueue_style('basket-style', get_template_directory_uri() . '/assets/css/layouts/popup-basket.css');
    wp_enqueue_script('jquery');
    wp_enqueue_script('header-script', get_template_directory_uri() . '/assets/js/header.js');
	



	if ( is_front_page() ) {
		wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css');
		wp_enqueue_style('home-style', get_template_directory_uri() . '/assets/css/pages/home-page.css');
        wp_enqueue_style('block-blog-style', get_template_directory_uri() . '/assets/css/layouts/block-blog.css');
        wp_enqueue_style('catalog-style', get_template_directory_uri() . '/assets/css/layouts/catalog-product.css');
		wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js');
		wp_enqueue_script('slider-prom-script', get_template_directory_uri() . '/assets/js/slider-promotional.js');
        wp_enqueue_script('slider-advan-script', get_template_directory_uri() . '/assets/js/slider-advantages.js');
		wp_enqueue_script('marquee-jq', get_template_directory_uri() . '/assets/js/marquee_jq.js');
		wp_enqueue_script('marquee', get_template_directory_uri() . '/assets/js/marquee.js');
		wp_enqueue_script('faq', get_template_directory_uri() . '/assets/js/faq.js');
        
	}
 
     if (strpos($_SERVER['REQUEST_URI'], '/balace/') !== false) {
        wp_enqueue_style('page-category', get_template_directory_uri() . '/assets/css/pages/page-category.css');
        wp_enqueue_style('catalog-style', get_template_directory_uri() . '/assets/css/layouts/catalog-product.css');
         wp_dequeue_style('woocommerce-layout');
        wp_dequeue_style('woocommerce-general');
        wp_dequeue_style('woocommerce-smallscreen');
    } elseif (strpos($_SERVER['REQUEST_URI'], '/balace-natural-pharm/') !== false) {
        wp_enqueue_style('page-category', get_template_directory_uri() . '/assets/css/pages/page-category.css');
        wp_enqueue_style('catalog-style', get_template_directory_uri() . '/assets/css/layouts/catalog-product.css');
        wp_dequeue_style('woocommerce-layout');
        wp_dequeue_style('woocommerce-general');
        wp_dequeue_style('woocommerce-smallscreen');
    }
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles_scripts');



function enqueue_swiper_slider() {
    if (is_product_category()) {
        wp_enqueue_style('rage-style', get_template_directory_uri() . '/assets/css/layouts/jquery-ui.css');
        wp_enqueue_style('page-category', get_template_directory_uri() . '/assets/css/pages/page-category.css');
        wp_enqueue_style('catalog-style', get_template_directory_uri() . '/assets/css/layouts/catalog-product.css');
        wp_enqueue_style('best-products-slider', get_template_directory_uri() . '/assets/css/layouts/best-products-slider.css');
        wp_enqueue_style('page-catalog-products', get_template_directory_uri() . '/assets/css/layouts/category-products.css');
        wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css');
        wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js');
        wp_enqueue_script('best-products', get_template_directory_uri() . '/assets/js/best-product-slider.js');
        // wp_enqueue_script('ajax-filter', get_template_directory_uri() . '/assets/js/ajax-filter.js');
        wp_enqueue_script('price-rage-slider', get_template_directory_uri() . '/assets/js/price-range.js');
        wp_enqueue_script('jquery-rage-slider', get_template_directory_uri() . '/assets/js/jquery-ui.min.js');
        wp_enqueue_script('jquery-ui-touch-punch', get_template_directory_uri() . '/assets/js/jquery.ui.touch-punch.min.js');
    }
    if (is_product()) {
        wp_enqueue_script('faq', get_template_directory_uri() . '/assets/js/faq.js', array('jquery'), '1.0', true);

    }
}
add_action('wp_enqueue_scripts', 'enqueue_swiper_slider');

function enqueue_about_page_styles() {
    if (is_page_template('pages/about.php')) {
        wp_enqueue_style('about-style', get_template_directory_uri() . '/assets/css/pages/about.css');
        wp_enqueue_style('block-blog-style', get_template_directory_uri() . '/assets/css/layouts/block-blog.css');
        wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css');
        wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js');
        wp_enqueue_script('best-products', get_template_directory_uri() . '/assets/js/best-product-slider.js');
        wp_enqueue_script('marquee-jq', get_template_directory_uri() . '/assets/js/marquee_jq.js');
        wp_enqueue_script('marquee', get_template_directory_uri() . '/assets/js/marquee.js');
        wp_enqueue_script('history', get_template_directory_uri() . '/assets/js/history-company-slider.js');
    }
   
}
add_action('wp_enqueue_scripts', 'enqueue_about_page_styles');


remove_action('woocommerce_product_loop_start', 'woocommerce_product_loop_start', 10);
remove_action('woocommerce_product_loop_end', 'woocommerce_product_loop_end', 10);

function enqueue_promotions_page_styles() {
    if (is_page_template('pages/promotions.php') || is_post_type_archive('promotions') || is_singular('promotions')) {
        wp_enqueue_style('blog-style', get_template_directory_uri() . '/assets/css/pages/promotions.css');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_promotions_page_styles');


function custom_product_loop_start() {
    $current_post_id = get_the_ID();
    if (is_front_page()) {
        echo '<ul class="products product-main">';
    } elseif ($current_post_id == 394 || $current_post_id == 397) {
        echo '<ul class="products category-main">';
    } else {
        echo '<ul class="products sub-category">';
    }
}
add_action('woocommerce_product_loop_start', 'custom_product_loop_start', 10);

function custom_product_loop_end() {
    echo '</ul>';
}
add_action('woocommerce_product_loop_end', 'custom_product_loop_end', 10);



// Удаляем стандартные действия по выводу заголовка, цены и изображения товара
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

// Добавляем кастомизированное отображение товара в ленте категории и на главной странице магазина
add_action('woocommerce_before_shop_loop_item_title', 'custom_woocommerce_template_loop_product', 10);
add_action('woocommerce_after_shop_loop_item_title', 'custom_product_attributes', 15);

function custom_woocommerce_template_loop_product() {
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

    echo '<div class="product-attribute-wrapp">';
    echo '<h2 class="woocommerce-loop-product__title h4 text_main">' . get_the_title() . '</h2>';

    if (!empty($attribute_type)) {
        echo '<div class="product-attribute-type" ><p class="body2 text_main">' . esc_html($attribute_type) . '</p></div>';
    }

    echo '<div class="product_attribute_container" >';

    if (!empty($price)) {
        echo '<div class="h6 text_dark" title="' . esc_attr($price) . '">' . $price . '</div>';
    }

    if (!empty($attribute_volume)) {
        echo '<div class="product-attribute-value"><p class="h6 text_light">' . esc_html($attribute_volume) . '</p></div>';
    }

    echo '</div>';
    echo '</div>';
}

add_filter('woocommerce_loop_add_to_cart_link', 'custom_woocommerce_loop_add_to_cart_link', 10, 3);

function custom_woocommerce_loop_add_to_cart_link($button, $product, $args) {
    $button = preg_replace('/>[^<]*</', '><', $button);
    $button = str_replace('class="', 'class="btn_add_to_basket ', $button);
    return $button;
}


add_action( 'init', 'true_register_post_type_promotions' );
function true_register_post_type_promotions() {
    $labels_prom = array(
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
    $args_prom = array(
        'labels' => $labels_prom,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-admin-post',
        // 'rewrite' => array('slug' => 'promotions'),
        'menu_position' => 2,
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'author', 'comments' ),
        'taxonomies' => array( 'category', 'post_tag' )
    );
    register_post_type( 'promotions', $args_prom );
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

add_action('init', 'remove_woocommerce_breadcrumbs');


function enqueue_blog_page_styles() {
    if (is_page_template('pages/blog-page.php') || is_post_type_archive('blog') || is_singular('blog')) {
        wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css');
        wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js');
        wp_enqueue_style('blog-style', get_template_directory_uri() . '/assets/css/pages/blog-page.css');
        wp_enqueue_script('blog-slider', get_template_directory_uri() . '/assets/js/article-slider.js');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_blog_page_styles');

function remove_woocommerce_breadcrumbs() {
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
}
function remove_woocommerce_sidebar() {
    if (is_product()) {
        remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
    }
}
add_action('wp', 'remove_woocommerce_sidebar');

function remove_woocommerce_styles() {
    if (is_product()) {
        wp_dequeue_style('woocommerce-layout');
        wp_dequeue_style('woocommerce-general');
        wp_dequeue_style('woocommerce-smallscreen');
        wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css');
        wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js');
        wp_enqueue_style('block-blog-style', get_template_directory_uri() . '/assets/css/pages/card-product-page.css');
        wp_enqueue_script('card-slider ', get_template_directory_uri() . '/assets/js/card-slider-gallery.js');
    }
}
add_action('wp_enqueue_scripts', 'remove_woocommerce_styles', 100);



function add_ajax_scripts() {
    wp_enqueue_script('ajax-script-handle', get_template_directory_uri() . '/assets/js/ajax-filter.js', array('jquery'), null, true);
    wp_localize_script('ajax-script-handle', 'ajax_object', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'ajax_nonce' => wp_create_nonce('ajax-nonce')
    ));
}
add_action('wp_enqueue_scripts', 'add_ajax_scripts');

function get_category_products() {
    check_ajax_referer('ajax-nonce', 'nonce');
    if (isset($_POST['attributes']) && isset($_POST['name'])) {
        $attributes_value = $_POST['attributes'];
        $attributes_name = $_POST['name'];

        // Создаем массив аргументов для WP_Query
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'pa_тип-товара', 
                    'field' => 'name',
                    'terms' => $attributes_value, 
                ),
            ),
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $product = wc_get_product(get_the_ID());
                
                if (!$product) {
                    continue; 
                }
                echo '<li ';
                post_class('product_item');
                echo '>';
                echo '<a href="' . esc_url(get_permalink()) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
                echo '<div class="product_image_item">';
                echo get_the_post_thumbnail($product->get_id(), 'woocommerce_thumbnail', array('class' => 'attachment-woocommerce_thumbnail size-woocommerce_thumbnail'));
                echo '</div>';
                custom_product_attributes($product);
           
			   
                woocommerce_template_loop_add_to_cart(array(
                    'class' => 'btn_add_to_basket button product_type_simple add_to_cart_button ajax_add_to_cart', 
                ), $product);

                 echo do_shortcode('[ti_wishlists_addtowishlist]');

                echo '</a>';
                echo '</li>';
            }
            
            wp_reset_postdata();
        } else {
            echo 'No posts found.';
        }
    } else {
        echo 'Attributes or name not provided.';
    }

    wp_die();
}

add_action('wp_ajax_get_category_products', 'get_category_products');
add_action('wp_ajax_nopriv_get_category_products', 'get_category_products');


function filter_products_by_price() {
    check_ajax_referer('ajax-nonce', 'nonce');
    $min_price = isset($_POST['min_price']) ? floatval($_POST['min_price']) : 0;
    $max_price = isset($_POST['max_price']) ? floatval($_POST['max_price']) : PHP_INT_MAX;
    $tax_query = array('relation' => 'AND');

    if (isset($_POST['category_id']) && !empty($_POST['category_id'])) {
        $category_id = intval($_POST['category_id']);
        $category = get_term_by('id', $category_id, 'product_cat');

        if ($category) {
            $tax_query[] = array(
                'taxonomy' => 'product_cat',
                'field' => 'id',
                'terms' => $category_id,
            );
           // echo " esc_html($category_id) ;
        } else {
           // echo "Категория ID.<br>";
        }
    } else {
        //echo "нет категории";
    }

    if (isset($_POST['attributes']) && is_array($_POST['attributes']) && !empty($_POST['attributes'])) {
        $tax_query[] = array(
            'taxonomy' => 'pa_тип-товара',
            'field' => 'name',
            'terms' => $_POST['attributes'],
        );
       
    } else {
        
    }

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => '_price',
                'value' => $min_price,
                'compare' => '>=',
                'type' => 'NUMERIC'
            ),
            array(
                'key' => '_price',
                'value' => $max_price,
                'compare' => '<=',
                'type' => 'NUMERIC'
            )
        ),
        'tax_query' => $tax_query,
    );

    $query = new WP_Query($args);
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $product = wc_get_product(get_the_ID());

            if (!$product) {
                continue;
            }

            echo '<li ';
            post_class('product_item');
            echo '>';
            echo '<a href="' . esc_url(get_permalink()) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
            echo '<div class="product_image_item">';
            echo get_the_post_thumbnail($product->get_id(), 'woocommerce_thumbnail', array('class' => 'attachment-woocommerce_thumbnail size-woocommerce_thumbnail'));
            echo '</div>';
            custom_product_attributes($product);
            woocommerce_template_loop_add_to_cart(array(
                'class' => 'btn_add_to_basket button product_type_simple add_to_cart_button ajax_add_to_cart',
            ), $product);
            echo '<div class="tinv-wraper woocommerce tinvwishlist tinvwl-after-add-to-cart tinvwl-loop-button-wrapper tinvwl-woocommerce_after_shop_loop_item" data-tinvwl_product_id="' . esc_attr($product->get_id()) . '">';
            echo do_shortcode('[ti_wishlists_addtowishlist]');
            echo '</div>';
            echo '</a>';
            echo '</li>';
        }

        wp_reset_postdata();
    } else {
        //echo 'Нет товаров';
    }

    wp_die();
}

add_action('wp_ajax_filter_products_by_price', 'filter_products_by_price');
add_action('wp_ajax_nopriv_filter_products_by_price', 'filter_products_by_price');



// .... Стандартная сортировка woocommerce GET в файле filter-options .....
add_action('woocommerce_catalog_ordering', 'woocommerce_catalog_ordering', 30);

// // Добавление в корзину
function enqueue_custom_scripts() {
    wp_enqueue_script('ajax-add-to-cart', get_template_directory_uri() . '/assets/js/ajax-add-to-cart.js', array('jquery'), null, true);

    wp_localize_script('ajax-add-to-cart', 'ajax_add_to_cart_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('ajax-add-to-cart-nonce')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

function my_custom_add_to_cart_function() {
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'ajax-add-to-cart-nonce' ) ) {
        wp_send_json_error('Nonce verification failed');
        return;
    }
    
    // Получаем данные из запроса
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);
    if ( $product_id <= 0 || $quantity <= 0 ) {
        wp_send_json_error('Invalid product ID or quantity');
        return;
    }

    // Добавляем товар в корзину
    $added = WC()->cart->add_to_cart($product_id, $quantity);
    if ( !$added ) {
        wp_send_json_error('Failed to add product to cart');
        return;
    }

    // Обновляем корзину
    ob_start();
    wc_get_template_part('pages/templates-parts/popup-basket');
    $cart_html = ob_get_clean();

    ob_start();
    do_action('woocommerce_cart_collaterals');
    $cart_collaterals = ob_get_clean();

    wp_send_json_success(array(
        'cart_html' => $cart_html,
        'cart_collaterals' => $cart_collaterals
    ));
}

add_action('wp_ajax_add_to_cart', 'my_custom_add_to_cart_function');
add_action('wp_ajax_nopriv_add_to_cart', 'my_custom_add_to_cart_function');

// Кнопка очистить корзину 
function enqueue_clear_cart_script() {
    wp_enqueue_script( 'clear-cart-script',  get_template_directory_uri() . '/assets/js/clear-cart.js', array( 'jquery' ), null, true );
    wp_localize_script( 'clear-cart-script', 'wc_clear_cart_params', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'clear_cart_nonce' )
    ) );
}
add_action( 'wp_enqueue_scripts', 'enqueue_clear_cart_script' );

function handle_clear_cart() {
    check_ajax_referer( 'clear_cart_nonce', 'security' );
    // Очистка корзины
    WC()->cart->empty_cart();
    wp_send_json_success();
}
add_action( 'wp_ajax_clear_cart', 'handle_clear_cart' );
add_action( 'wp_ajax_nopriv_clear_cart', 'handle_clear_cart' ); 



function enqueue_remove_from_cart_script() {
    wp_enqueue_script('remove-from-cart-script', get_template_directory_uri() . '/assets/js/ajax-remove.js', array('jquery'), null, true);
    wp_localize_script('remove-from-cart-script', 'wc_remove_from_cart_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('remove_from_cart_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_remove_from_cart_script');

function remove_from_cart() {
    check_ajax_referer('remove_from_cart_nonce', 'nonce');

    if (isset($_POST['cart_key'])) {
        $cart_key = sanitize_text_field($_POST['cart_key']);

        // Удаляем товар из корзины
        WC()->cart->remove_cart_item($cart_key);

        // Обновляем корзину
        ob_start();

        // Проверяем, пуста ли корзина
        if ( WC()->cart->is_empty() ) {
            echo ' <div class="popup-div-wrapp">';
            echo '<button class="clouse-basket-popup">
               <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="M4.25732 3.75732L12.7426 12.2426" stroke="#221D17" stroke-linecap="round"/>
               <path d="M4.25732 12.2427L12.7426 3.75739" stroke="#221D17" stroke-linecap="round"/>
               </svg>
               </button>';
            echo '<p class="empty-cart-message">Ваша корзина пуста.</p>';
            echo '</div>';
        } else {
            echo '<style>
                .basket-empty{
                    display: flex;
                }
                 </style>';
            // Если корзина не пуста, загружаем шаблон корзины
            wc_get_template_part('pages/templates-parts/popup-basket'); 
        }

        $cart_html = ob_get_clean();

        ob_start();
        do_action('woocommerce_cart_collaterals'); 
        $cart_totals = ob_get_clean();

        wp_send_json_success(array(
            'cart_html' => $cart_html,
            'cart_totals' => $cart_totals 
        ));
    } else {
        wp_send_json_error('Ошибка удаления товара');
    }
}

add_action('wp_ajax_remove_from_cart', 'remove_from_cart');
add_action('wp_ajax_nopriv_remove_from_cart', 'remove_from_cart');

function custom_cart_content_check() {
    if ( WC()->cart->is_empty() ) {
        echo ' <div class="popup-div-wrapp">';
        echo '<button class="clouse-basket-popup">
              <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4.25732 3.75732L12.7426 12.2426" stroke="#221D17" stroke-linecap="round"></path>
            <path d="M4.25732 12.2427L12.7426 3.75739" stroke="#221D17" stroke-linecap="round"></path>
            </svg>
         </button>';
        echo '<p class="empty-cart-message">Ваша корзина пуста.</p>';
        echo '<style>
                .wrapp-popup-basket { display: none; }
              </style>';
        echo '</div>';
    } else {
        echo '<button class="clouse-basket-popup">
        <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M4.25732 3.75732L12.7426 12.2426" stroke="#221D17" stroke-linecap="round"></path>
      <path d="M4.25732 12.2427L12.7426 3.75739" stroke="#221D17" stroke-linecap="round"></path>
      </svg>
   </button>';
        echo '<style>
        .basket-empty{
            display: flex;
        }
         </style>';
        //wc_get_template_part('pages/templates-parts/popup-basket');
    }
}
add_action('woocommerce_before_cart', 'custom_cart_content_check');


function dequeue_woocommerce_styles_on_checkout() {

    if ( is_checkout() ) {
        wp_dequeue_style('woocommerce-layout');
        wp_dequeue_style('woocommerce-general');
        wp_dequeue_style('woocommerce-smallscreen');
        wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css');
        wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js');
        wp_enqueue_script( 'checkout-slider-script',  get_template_directory_uri() . '/assets/js/checkout.js', array( 'jquery' ), null, true );
        wp_enqueue_style('checkout-style', get_template_directory_uri() . '/assets/css/pages/checkout.css');
        wp_enqueue_script( 'quantity-control-script',  get_template_directory_uri() . '/assets/js/quantity-control.js', array( 'jquery' ), null, true );
    }
}
add_action('wp_enqueue_scripts', 'dequeue_woocommerce_styles_on_checkout', 20);



// Добавляем кастомные поля в форму оформления заказа
add_filter('woocommerce_checkout_fields', 'add_custom_checkout_fields');
function add_custom_checkout_fields($fields) {
    $fields['billing']['billing_doorbell'] = array(
        'label'       => 'Домофон',
        'placeholder' => '',
        'required'    => false,
        'class'       => array('form-row-wide'),
        'clear'       => true
    );
    $fields['billing']['billing_entrance'] = array(
        'label'       => 'Подъезд',
        'placeholder' => '',
        'required'    => false,
        'class'       => array('form-row-wide'),
        'clear'       => true
    );
    $fields['billing']['billing_floor'] = array(
        'label'       => 'Этаж',
        'placeholder' => 'Введите номер этажа',
        'required'    => false,
        'class'       => array('form-row-wide'),
        'clear'       => true
    );
    $fields['billing']['custom_delivery_method'] = array(
        'type'        => 'select',
        'label'       => 'Способ доставки',
        'options'     => array(
            '' => 'Выберите способ доставки',
            'courier' => 'Курьерская доставка',
            'pickup'  => 'Самовывоз',
        ),
        'required'    => false,
        'class'       => array('form-row-wide'),
        'clear'       => true
    );
    return $fields;
}

// Сохраняем кастомные поля
add_action('woocommerce_checkout_update_order_meta', 'save_custom_checkout_fields');
function save_custom_checkout_fields($order_id) {
    if (!empty($_POST['billing_doorbell'])) {
        update_post_meta($order_id, '_billing_doorbell', sanitize_text_field($_POST['billing_doorbell']));
    }
    if (!empty($_POST['billing_entrance'])) {
        update_post_meta($order_id, '_billing_entrance', sanitize_text_field($_POST['billing_entrance']));
    }
    if (!empty($_POST['billing_floor'])) {
        update_post_meta($order_id, '_billing_floor', sanitize_text_field($_POST['billing_floor']));
    }
    if (!empty($_POST['custom_delivery_method'])) {
        update_post_meta($order_id, '_custom_delivery_method', sanitize_text_field($_POST['custom_delivery_method']));
    }
}


add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields_two');
function custom_override_checkout_fields_two($fields) {
    unset($fields['billing']['billing_country']);
    unset($fields['shipping']['shipping_country']);
    return $fields;
}

// Отображаем кастомные поля в админке заказа
add_action('woocommerce_admin_order_data_after_billing_address', 'display_custom_fields_in_admin_order', 10, 1);
function display_custom_fields_in_admin_order($order) {
    $doorbell = get_post_meta($order->get_id(), '_billing_doorbell', true);
    $entrance = get_post_meta($order->get_id(), '_billing_entrance', true);
    $floor = get_post_meta($order->get_id(), '_billing_floor', true);
    $delivery_method = get_post_meta($order->get_id(), '_custom_delivery_method', true);

    echo '<p><strong>Домофон:</strong> ' . esc_html($doorbell) . '</p>';
    echo '<p><strong>Подъезд:</strong> ' . esc_html($entrance) . '</p>';
    echo '<p><strong>Этаж:</strong> ' . esc_html($floor) . '</p>';
    echo '<p><strong>Способ доставки:</strong> ' . esc_html($delivery_method) . '</p>';
}

// Устанавливаем страну по умолчанию
add_filter('woocommerce_customer_get_shipping_country', 'carrie_customer_default_shipping_country', 10, 2);
function carrie_customer_default_shipping_country($value, $customer) {
    $value = !empty($value) ? $value : 'RU';
    return $value;
}


add_action('wp_ajax_woocommerce_update_cart_item', 'woocommerce_update_cart_item');
add_action('wp_ajax_nopriv_woocommerce_update_cart_item', 'woocommerce_update_cart_item');


function woocommerce_update_cart_item() {

    if (!isset($_POST['cart_item_key']) || !isset($_POST['quantity'])) {
        wp_send_json_error('Missing cart_item_key or quantity');
        return;
    }
    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    $quantity = absint($_POST['quantity']);
    if (!$cart_item_key || !$quantity) {
        wp_send_json_error('Invalid cart_item_key or quantity');
        return;
    }

    // Обновляем корзину
    WC()->cart->set_quantity($cart_item_key, $quantity);
    $cart_item = WC()->cart->get_cart_item($cart_item_key);
    if (!$cart_item) {
        wp_send_json_error('Cart item not found');
        return;
    }
    $product = $cart_item['data'];
    if (!$product) {
        wp_send_json_error('Product not found');
        return;
    }
    ob_start();
    wc_cart_totals_order_total_html();
    $order_total = ob_get_clean();
    ob_start();
    wc_cart_totals_subtotal_html();
    $subtotal = ob_get_clean();
    ob_start();
    woocommerce_quantity_input(array(
        'input_value' => $quantity,
    ), $product);
    $quantity_html = ob_get_clean();

    // Возвращаем
    wp_send_json_success(array(
        'order_total' => $order_total,
        'subtotal'    => $subtotal,
        'quantity_html' => $quantity_html
    ));
}

add_filter( 'woocommerce_checkout_fields', 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_postcode']);
    return $fields;
}

add_filter( 'woocommerce_order_button_html', 'truemisha_order_button_html' );
 
function truemisha_order_button_html( $button_html ) {
	return ( '<button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="Оформить покупку" data-value="Оформить покупку">Оформить покупку</button>');
}

add_filter( 'woocommerce_available_payment_gateways', 'truemisha_payments_on_shipping' );
 
function truemisha_payments_on_shipping( $available_gateways ) {
 
	if( is_admin() ) {
		return $available_gateways;
	}
 
	if( is_wc_endpoint_url( 'order-pay' ) ) {
		return $available_gateways;
	}
 
	$chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
 
	//echo '<pre>';print_r( $chosen_methods );
 
	if ( isset( $available_gateways[ 'cod' ] ) && 'free_shipping:1' == $chosen_methods[0] ) {
		unset( $available_gateways[ 'cod' ] ); // отключаем оплату при доставке
	}
 
	return $available_gateways;
 
}

add_action('wp_ajax_remove_cart_item', 'chekout_remove_cart_item');
add_action('wp_ajax_nopriv_remove_cart_item', 'chekout_remove_cart_item');

function chekout_remove_cart_item() {
    if (!isset($_POST['cart_item_key'])) {
        wp_send_json_error('Invalid request.');
    }
    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    if (!WC()->cart || WC()->cart->is_empty()) {
        wp_send_json_error('Cart is empty.');
    }
    // Удаление товара из корзины
    WC()->cart->remove_cart_item($cart_item_key);
    WC()->cart->calculate_totals();
    // ответ
    wp_send_json_success();
}

function comparison_page_styles() {
    if (is_page_template('pages/product-comparison.php')) {
        wp_enqueue_style('comparison-page-style', get_template_directory_uri() . '/assets/css/pages/comparison.css');
        wp_enqueue_script( 'compare-script', get_template_directory_uri() . '/assets/js/compare.js', array('jquery'), null, true );
    }
}
add_action('wp_enqueue_scripts', 'comparison_page_styles');

function translate_wcboost_compare_texts($translated_text, $text) {
    if (is_page_template('pages/product-comparison.php')) {
        switch ($text) {
            case 'Title':
                $translated_text = 'Заголовок';
                break;
            case 'Price':
                $translated_text = 'Цена';
                break;
            case 'Add To Cart':
                $translated_text = 'Добавить в корзину';
                break;
            case 'Availability':
                $translated_text = 'Наличие';
                break;
            case 'Sku':
                $translated_text = 'Артикул';
                break;
            case 'Dimensions':
                $translated_text = 'Размеры';
                break;
        }
    }
    return $translated_text;
}
add_filter('gettext', 'translate_wcboost_compare_texts', 20, 3);


function contacts_page_styles() {
    if (is_page_template('pages/сontacts.php')) {
        wp_enqueue_style('contacts-page-style', get_template_directory_uri() . '/assets/css/pages/contacts.css');
        wp_enqueue_script( 'contact_page_popup', get_template_directory_uri() . '/assets/js/contact_page_popup.js', null, true );
    }
}
add_action('wp_enqueue_scripts', 'contacts_page_styles');

function wishlist_page_styles() {
    if (is_page_template('pages/wishlist-page.php')) {
        wp_dequeue_style('tinvwl'); 
        wp_dequeue_style('woocommerce-layout');
        wp_dequeue_style('woocommerce-general');
        wp_dequeue_style('woocommerce-smallscreen');
        wp_enqueue_style('wishlist-page-style', get_template_directory_uri() . '/assets/css/pages/wishlist.css');
        wp_enqueue_script( 'wishlist', get_template_directory_uri() . '/assets/js/wishlist.js', null, true );
    }
}
add_action('wp_enqueue_scripts', 'wishlist_page_styles');

function reviews_page_styles() {
    if (is_page_template('pages/reviews.php')) {
        wp_enqueue_style('reviews-page-style', get_template_directory_uri() . '/assets/css/pages/reviews.css');
        wp_enqueue_script( 'reviews', get_template_directory_uri() . '/assets/js/reviews.js', null, true );
    }
}
add_action('wp_enqueue_scripts', 'reviews_page_styles');



// Добавляем мета-бокс для рейтинга
function add_journal_meta_boxes() {
    add_meta_box(
        'journal_rating_meta_box',  
        'Рейтинг',                  
        'render_journal_rating_meta_box',  
        'journal',                 
        'side',                  
        'default'                  
    );
}
add_action('add_meta_boxes', 'add_journal_meta_boxes');

// Функция для отображения мета-бокса
function render_journal_rating_meta_box($post) {
    $rating = get_post_meta($post->ID, '_journal_rating', true);
    ?>
    <label for="journal_rating">Рейтинг (1-5):</label>
    <input type="number" id="journal_rating" name="journal_rating" value="<?php echo esc_attr($rating); ?>" min="0.1" max="5" step="0.1" />
    <?php
}

// Сохраняем данные из мета-бокса
function save_journal_meta_box_data($post_id) {
    if (array_key_exists('journal_rating', $_POST)) {
        update_post_meta(
            $post_id,
            '_journal_rating',
            sanitize_text_field($_POST['journal_rating'])
        );
    }
}
add_action('save_post', 'save_journal_meta_box_data');

add_action( 'init', 'create_post_type' );
 
function create_post_type() {
  register_post_type( 'journal',
   array(
    'public' => true,
    'has_archive' => false,
    'menu_icon' => 'dashicons-testimonial', 
    'menu_position' => 2,
    'labels' => array(
      'name' => 'Все Отзывы',
      'singular_name' => 'Отзыв',
      'menu_name' => 'Отзывы',
      'all_items' => 'Все отзывы',
      'add_new' => 'Добавить',
      'add_new_item' => 'Добавить',
      'edit_item' => 'Редактировать',
      'not_found' => 'Ничего не найдено',
      'not_found_in_trash' => 'Корзина отзывов пуста'
   ),

   'supports' => array('title', 'thumbnail', 'editor'),
  ));
}

add_action('wpcf7_mail_sent', 'hookToProcessFormData', 10, 1);
function hookToProcessFormData($contact_form) {
    if ($contact_form->id() == "527") { 
        $post_data = WPCF7_Submission::get_instance();
        if ($post_data) {
            $posted_data = $post_data->get_posted_data();

            $meta_fields = array(
                'text-805' => '_journal_last_name', 
                'text-807' => '_journal_first_name',
                'email-335' => '_journal_email', 
                'star_rating-852' => '_journal_rating', 
            );

            $meta_input = array();
            foreach ($meta_fields as $field => $metakey) {
                $meta_input[$metakey] = isset($posted_data[$field]) ? trim(strip_tags($posted_data[$field])) : '';
            }

            // Проверяем на "Анонимный"
            $last_name = !empty($meta_input['_journal_last_name']) ? $meta_input['_journal_last_name'] : 'Анонимный';
            $first_name = !empty($meta_input['_journal_first_name']) ? $meta_input['_journal_first_name'] : '';
            if (empty($first_name)) {
                $post_title = $last_name;
            } else {
                $post_title = $last_name . ' ' . $first_name;
            }

            $post_arr = array(
                'post_title'   => $post_title,
                'post_type'    => 'journal',
                'post_status'  => 'pending',
                'post_content' => trim(strip_tags($posted_data['textarea-465'])), 
                'meta_input'   => $meta_input,
            );

            // Вставляем запись в базу данных
            $my_post_id = wp_insert_post($post_arr);
        } else {
            //error_log('нет данных');
        }
    } else {
        // Логируем ошибку, если ID формы не совпадает
       // error_log('Form ID does not match');
    }
}


add_action( 'init', 'licenses_post_type' );
 
function licenses_post_type() {
  register_post_type( 'licenses',
   array(
    'public' => true,
    'has_archive' => false,
    'menu_icon' => 'dashicons-testimonial', 
    'menu_position' => 2,
    'labels' => array(
      'name' => 'Все лицензии',
      'singular_name' => 'лицензии',
      'menu_name' => 'лицензии',
      'all_items' => 'Все лицензии',
      'add_new' => 'Добавить',
      'add_new_item' => 'Добавить',
      'edit_item' => 'Редактировать',
      'not_found' => 'Ничего не найдено',
      'not_found_in_trash' => 'Корзина лицензии пуста'
   ),

   'supports' => array( 'title','thumbnail'),
  ));
}
function licenses_page_styles() {
    if (is_page_template('pages/licenses-page.php')) {
        wp_enqueue_style('licenses-page-style', get_template_directory_uri() . '/assets/css/pages/licenses.css');
        wp_enqueue_script( 'licenses', get_template_directory_uri() . '/assets/js/licenses.js', null, true );
    }
}
add_action('wp_enqueue_scripts', 'licenses_page_styles');

function delivery_page_styles() {
    if (is_page_template('pages/delivery-page.php')) {
        wp_enqueue_style('delivery-page-style', get_template_directory_uri() . '/assets/css/pages/delivery.css');
    }
}
add_action('wp_enqueue_scripts', 'delivery_page_styles');

function license_verification_page_styles() {
    if (is_page_template('pages/license-verification.php')) {
        wp_enqueue_style('license-verification-page-style', get_template_directory_uri() . '/assets/css/pages/license-verification.css');
       
    }
}
add_action('wp_enqueue_scripts', 'license_verification_page_styles');

function licenseVerification() {
    wp_enqueue_script('license-verification-js', get_template_directory_uri() . '/assets/js/license-verification.js', array('jquery'), null, true);
    wp_localize_script('license-verification-js', 'licenseVerification', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'licenseVerification');


function error_page() {
    if (is_404()) {
        wp_enqueue_style('404-page-style', get_template_directory_uri() . '/assets/css/pages/404.css');
    }
}
add_action('wp_enqueue_scripts', 'error_page');

function check_number_in_file() {
    $file_url = isset($_POST['file_url']) ? esc_url_raw($_POST['file_url']) : '';
    $search_number = isset($_POST['search_number']) ? sanitize_text_field($_POST['search_number']) : '';

    if (empty($file_url) || empty($search_number)) {
        echo 'Введите номер для поиска.';
        exit;
    }
    $file_extension = pathinfo($file_url, PATHINFO_EXTENSION);
    if ($file_extension === 'csv') {
        if (($handle = fopen($file_url, "r")) !== FALSE) {
            $found = false;
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if (in_array($search_number, $data)) {
                    $found = true;
                    break;
                }
            }
            fclose($handle);
            echo $found ? 'существует' : '<span class="error_number">не существует</span> <style>.check-bottom-text{ display: flex;}</style>';
        } else {
            //echo 'Не удалось открыть CSV файл.';
        }
    } elseif ($file_extension === 'xml') {
        $xml = simplexml_load_file($file_url);
        if ($xml === false) {
            //echo 'Не удалось загрузить XML файл.';
            exit;
        }
        $found = false;
        foreach ($xml->children() as $element) {
            if (strpos((string)$element, $search_number) !== false) {
                $found = true;
                break;
            }
        }
        echo $found ? 'существует' : '<span class="error_number">не существует</span> <style>.check-bottom-text{ display: flex;}</style>';
    } else {
       // echo 'Поддерживаются только файлы CSV и XML.';
    }
    exit;

}
add_action('wp_ajax_check_number_in_file', 'check_number_in_file');
add_action('wp_ajax_nopriv_check_number_in_file', 'check_number_in_file');






//Поиск
add_shortcode("woo_search", "woo_search_func");
function woo_search_func($atts)
{
    $atts = shortcode_atts(
        [
            "image" => "true",
            "check_stock" => "", // on
            "sku" => "", // off
            "description" => "", // off
            "price" => "", // off
            "num" => "5",
            "cat" => "on", // on
        ],
        $atts,
        "woo_search"
    );
    static $woo_search_first_call = 1;
    $image = $atts["image"];
    $stock = $atts["check_stock"];
    $sku = $atts["sku"];
    $description = $atts["description"];
    $price = $atts["price"];
    $num = $atts["num"];
    $cat = $atts["cat"];

    $woo_search_form =
        '<div class="woo_search_bar woo_bar_el">
    <form class="woo_search woo_bar_el" id="woo_search' .
        $woo_search_first_call .
        '" action="/" method="get" autocomplete="off">
		<span class="loading woo_bar_el" >
		<svg width="25px" height="25px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="none" class="hds-flight-icon--animation-loading woo_bar_el">
<g fill="#676767" fill-rule="evenodd" clip-rule="evenodd">
<path d="M8 1.5a6.5 6.5 0 100 13 6.5 6.5 0 000-13zM0 8a8 8 0 1116 0A8 8 0 010 8z" opacity=".2"/>
<path d="M7.25.75A.75.75 0 018 0a8 8 0 018 8 .75.75 0 01-1.5 0A6.5 6.5 0 008 1.5a.75.75 0 01-.75-.75z"/>
</g>
</svg>
		</span>
        <input type="search" name="s" placeholder="быстрый и удобный поиск" id="keyword" class="input_search input_search_header woo_bar_el" onkeyup="searchFetch(this)"><button type="button" id="mybtn" class="btn_search_header search' .
        $woo_search_first_call .
        ' woo_bar_el">
        </button>
        <input type="hidden" name="post_type" value="product">
        <input type="hidden" name="search_id" value="' .
        $woo_search_first_call .
        '">
        <input type="hidden" name="check_stock" value="' .
        $stock .
        '">
        <input type="hidden" name="sku" value="' .
        $sku .
        '">
        <input type="hidden" name="description" value="' .
        $description .
        '">
        <input type="hidden" name="price" value="' .
        $price .
        '">
        <input type="hidden" name="num" value="' .
        $num .
        '">
        <input type="hidden" name="cat" value="' .
        $cat .
        '">
    </form><div class="search_result woo_bar_el" id="datafetch" style="display: none;">
        <ul>
            <li>Please wait..</li>
        </ul>
    </div></div>';
    $java =
        '<script>
function searchFetch(e) {
const searchForm = e.parentElement;	
searchForm.querySelector(".loading").style.visibility = "visible";

var datafetch = e.parentElement.nextSibling
if (e.value.trim().length > 0) { datafetch.style.display = "block"; } else { datafetch.style.display = "none"; }

e.nextSibling.value = "Please wait..."
var formdata' .
        $woo_search_first_call .
        ' = new FormData(searchForm);
formdata' .
        $woo_search_first_call .
        '.append("image", "' .
        $image .
        '") 
formdata' .
        $woo_search_first_call .
        '.append("action", "woo_search") 
Ajaxwoo_search(formdata' .
        $woo_search_first_call .
        ',e) 

}
async function Ajaxwoo_search(formdata,e) {
  const url = "' .
        admin_url("admin-ajax.php") .
        '?action=woo_search";
  const response = await fetch(url, {
      method: "POST",
      body: formdata,
  });
  const data = await response.text();
if (data){	e.parentElement.nextSibling.innerHTML = data}else  {
e.parentElement.nextSibling.innerHTML = `<ul><a href="#" style="display: block; padding-inline-start: 14px;"><li>Ничего не найдено</li></a></ul>`
}
e.parentElement.querySelector(".loading").style.visibility = "hidden";
}	
function goSearch(id){document.querySelector(id).click(); console.log(`clicked`) }

document.addEventListener("click", function(e) { if (document.activeElement.classList.contains("woo_bar_el") == false ) { [...document.querySelectorAll("div.search_result")].forEach(e => e.style.display = "none") } else {if  (e.target?.value.trim().length > 0) { e.target.parentElement.nextSibling.style.display = "block"}} })

</script>';
    $css = '<style>
</style>';
    if ($woo_search_first_call == 1) {
        $woo_search_first_call++;
        return "{$woo_search_form}{$java}{$css}";
    } elseif ($woo_search_first_call > 1) {
        $woo_search_first_call++;
        return "{$woo_search_form}";
    }
}

add_action("wp_ajax_woo_search", "woo_search");
add_action("wp_ajax_nopriv_woo_search", "woo_search");
function woo_search()
{
    //sleep(1s);
    $search_id = esc_attr($_POST["search_id"]);
    $stock = "";
    $sku = esc_attr($_POST["sku"]);
    $description = esc_attr($_POST["description"]);
    $price = esc_attr($_POST["price"]);
    $num = esc_attr($_POST["num"]);
    $cat = "";
    $search_term = esc_attr($_POST["s"]);

    if ($sku == "off") {
        $sku = "style='display: none;'";
    }
    if ($description == "off") {
        $description = "style='display: none;'";
    }

    if ($cat == "on") {
        // Get categories

        $categories = get_terms([
            "taxonomy" => "product_cat",
            "name__like" => $search_term,
            "orderby" => "name",
            "order" => "ASC",
        ]);

        if (!empty($categories) && !is_wp_error($categories)) {
            echo '<p class="search_title">CATEGORIES</p> ';
            echo '<hr class="search_title">';
            echo '<ul class="cat_ul woo_bar_el">';

            foreach ($categories as $category) {
                $category_link = get_term_link(
                    $category->term_id,
                    "product_cat"
                );
                $product_count = $category->count;
                echo '<li class="cat_li woo_bar_el"><a class="cat_a woo_bar_el" href="' .
                    esc_url($category_link) .
                    '">' .
                    esc_html($category->name) .
                    " (" .
                    $product_count .
                    ")</a></li>";
            }
            echo "</ul>";
        }
    }

    $the_query = new WP_Query([
        "posts_per_page" => $num,
        "post_type" => "product",
        "s" => $search_term,
    ]);

    if (!$the_query->have_posts()) {
        $the_query = new WP_Query([
            "posts_per_page" => $num,
            "post_type" => "product",
            "meta_query" => [
                [
                    "key" => "_sku",
                    "value" => $search_term,
                    "compare" => "LIKE",
                ],
            ],
        ]);
    }

    $number_of_result = $the_query->found_posts;
    if ($number_of_result > 20) {
        $show_all =
            '<button class="show_all woo_bar_el" style="text-align: center; background: white; width: 100%; padding: 5px; color: #666464; cursor: pointer; font-size: 0.95em;border: none; "   onclick="goSearch(`button.search' .
            $search_id .
            '`)"  >SEE ALL PRODUCTS.. (' .
            $number_of_result .
            ")</button>";
    } else {
        $show_all = "";
    }

    if ($the_query->have_posts()):
        if ($cat == "on") {
            echo '<p class="search_title">PRODUCTS</p> ';
            echo '<hr class="search_title">';
        }

        echo '<ul class="woo_bar_el">';
        while ($the_query->have_posts()):

            $the_query->the_post();
            $product = wc_get_product();
            $current_price = $product->get_price_html();
            if ($current_price == "") {
                $current_price = "SOLD OUT";
                $sold_style =
                    "style='font-size: 0.75em; font-weight: bold; color: red; '";
            } else {
                $sold_style = "";
            }
            if ($current_price == "SOLD OUT" && $stock == "on") {
                $stock_hide = "style='display: none;'";
            } else {
                $stock_hide = "";
            }
            ?>
        
            <a href="<?php echo esc_url(
                post_permalink()
            ); ?>" class="woo_bar_el" <?= $stock_hide ?> >
<?php $image = wp_get_attachment_image_src(
    get_post_thumbnail_id(),
    "single-post-thumbnail"
); ?>                               
<?php if (
    $image[0] &&
    trim(esc_attr($_POST["image"])) == "true"
) { ?>  <img src="<?php the_post_thumbnail_url(
      "thumbnail"
  ); ?>" style="height: 60px;padding: 0px 5px; display:none;">
<li><span class="title_r_1"><h5><?php the_title(); ?></h5 class="product_name"><h5 style="height: 60px;padding: 0px 5px; display:none;" class="sku" <?= $sku ?> >(SKU:  <?php echo $product->get_sku(); ?>) </h5></span><p class="des" <?= $description ?> > <?php echo wp_trim_words(
     $product->get_short_description(),
     15,
     "..."
 ); ?> </p> </li>	


<?php if ($price != "off") { ?> 
	<span class="price" <?= $sold_style ?> > <span> <?= $current_price ?> </span></span>
 <?php }} ?> 
</a>
        <?php
        endwhile;
        echo $show_all;
        echo "</ul>";
        wp_reset_postdata();
    endif;
    die();
}

// удаляем 0 после запятой 
add_filter('woocommerce_price_trim_zeros', 'wc_hide_trailing_zeros', 10, 1);
function wc_hide_trailing_zeros( $trim ) {
    return true;
}

add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);
function change_existing_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
          case 'RUB': $currency_symbol = 'р'; break;
     }
     return $currency_symbol;
}




function check_compare_status_js() {
    if (is_product()) {
    wp_enqueue_script('check-compare-status', get_template_directory_uri() . '/assets/js/chek_compare_status.js', array('jquery'), null, true);
    wp_localize_script('check-compare-status', 'ajax_compare_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('check_compare_nonce')
    ));
}
}
add_action('wp_enqueue_scripts', 'check_compare_status_js');


add_action('wp_ajax_check_compare_status', 'check_compare_status');
add_action('wp_ajax_nopriv_check_compare_status', 'check_compare_status');

function check_compare_status() {
    check_ajax_referer('check_compare_nonce', 'nonce');
    $product_id = intval($_POST['product_id']);

    error_log("Проверка продукта с ID: " . $product_id);

    // Проверяем, находится ли товар в сравнении
    if (ever_compare_remove_from_compare($product_id)) {
        // Товар успешно удален из сравнения
        error_log("Товар успешно удален из сравнения.");
        wp_send_json_success(['in_compare' => false]);
    } elseif (ever_compare_add_to_compare($product_id)) {
        // Товар успешно добавлен в сравнение
        error_log("Товар успешно добавлен в сравнение.");
        wp_send_json_success(['in_compare' => true]);
    } else {
        // Если ни одна из функций не сработала
        error_log("Не удалось изменить статус товара.");
        wp_send_json_error(['in_compare' => false]);
    }
}

