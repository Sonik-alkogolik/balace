<?php
session_start();

if (!isset($_COOKIE['preloader_shown'])) {
    setcookie('preloader_shown', 'true', 0, '/');
    $show_preloader = true;
    //echo 'Прелоадер будет показан.';
} else {
    $show_preloader = false;
   // echo 'Прелоадер уже был показан.';
}
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
    <title><?php wp_title(); ?></title>
</head>


<style>
.dws-progress-bar {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 100;
}

.progress-percentage {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #FFFFFF;
    font-family: "Manrope", sans-serif;
    font-size: 48px;
    font-weight: 500;
    line-height: 56.02px;
    letter-spacing: 0.01em;
    text-align: center;

}

#preloader {
    position: fixed;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    z-index: 100;
    background: #645F4D;
}

</style>
<script src="<?php get_template_directory_uri() ?>/wp-content/themes/balace/assets/js/scircular-plugin.js"></script> 
<script src="<?php get_template_directory_uri() ?>/wp-content/themes/balace/assets/js/circular-script.js"></script> 

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if ($show_preloader): ?>
<div id="preloader">
    <div class="dws-progress-bar"></div>
    <div class="preloader-logo-div">
        <img src="<?php echo get_template_directory_uri(); ?>/wp-content/themes/balace/img/icon/preloader_logo.png" alt="logo">
    </div>
</div>
<?php endif; ?>

        <div class="age-verification" style="display: none;">
        <p class="age-no-text">Будем ждать в нашем магазине, когда достигнете совершеннолетия! </p>
        <div class="age-verification-wrapp">
          <span>18+</span>
            <p>Сайт содержит информацию, которая не рекомендована лицам, не достигшим совершеннолетия. Для входа на сайт, подтвердите свой возраст.</p>
         <div class="age-verification-btn">
           <button class="age-yes">Подтверждаю, что мне 18 лет</button>
           <button class="age-no">Мне ещё нет 18</button>
        </div>
    </div>
    <div class="age-verification-logo-div">
            <img src="<?php get_template_directory_uri() ?>/wp-content/themes/balace/img/icon/age-verification-logo.png" alt="logo">
        </div>
</div>



<div class="container">
 <section class="header-section">
            <div class="header-wrapp">
                <header>
                 <div class="header-desktop">
                    <div class="logo">
                        <a href="/">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="">
                        </a>
                    </div>
                     <div class="header-menu">
                            <button class="btn_header_menu desktop">
                            </button>
                     </div>
                     <div class="header-search">
                     <?php echo do_shortcode('[woo_search]'); ?>
                    </div>
                    <div class="header-link-pages">
                        <a class="subtitle2 text_main" href="">О нас</a>
                        <a class="subtitle2 text_main" href="/?page_id=388">Сравнение товаров</a>
                    </div>
                    <div class="header-product-actions">
                        <button class="btn_add-to-wishlist">
                            <a class="" href="/wishlist/"></a>
                        </button>
                        <button class="btn_basket">
                            <img class="basket-empty" src="/wp-content/themes/balace/img/icon/active_basket_img.png" alt="">
                        </button>

                      <?php get_template_part( 'pages/templates-parts/popup-product-add' ); ?>
                    </div>
                    </div>
                    <div class="header-mob">
                    <div class="header-mob-left-item">
                      <div class="header-menu">
                            <button class="btn_header_menu mob">
                            </button>
                       </div>
                       <div class="header-search mob">
                       <svg id="searchIcon width="52" height="52" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="20" cy="20" r="19.25" stroke="#ECE9DB" stroke-width="1.5"/>
                        <path d="M14.2747 21.3369C14.8332 22.6512 15.8911 23.6898 17.2154 24.2242C18.5397 24.7586 20.0221 24.745 21.3364 24.1865C22.6507 23.6279 23.6894 22.5701 24.2238 21.2457C24.7581 19.9214 24.7445 18.439 24.1859 17.1247C23.6274 15.8104 22.5696 14.7718 21.2452 14.2374C19.9209 13.703 18.4385 13.7166 17.1242 14.2752C15.8099 14.8337 14.7713 15.8915 14.2369 17.2159C13.7025 18.5402 13.7161 20.0226 14.2747 21.3369Z" stroke="#645F4D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M23.0762 23.0771L26.1531 26.1541" stroke="#645F4D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                      </div>
                      
                      </div>
                        <div class="logo">
                        <a href="/">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="">
                        </a>
                       </div>
                       <div class="header-product-actions">
                        <button class="btn_add-to-wishlist"></button>
                        <button class="btn_basket">
                          <img class="basket-empty" src="/wp-content/themes/balace/img/icon/active_basket_img.png" alt="">
                        </button>
                        <?php get_template_part( 'pages/templates-parts/popup-product-add-mob' ); ?>
                       </div>
                       
                    </div>
                    </header>
                 

                
                <div class="header-catalog desktop background_main hide">
                    <div class="header-catalog-content">
                      <div class="header-catalog-wrapp">
                            <div class="header-catalog-item catalog-menu">
                              <nav>
                                 <?php
                                   wp_nav_menu(array(
                                    'theme_location' => 'top-nav-menu',
                                    'container' => false,
                                    'menu_class' => 'nav-menu',
                                    'fallback_cb' => false,
                                    'items_wrap' => '<ul>%3$s</ul>',
                                    'depth' => 1,
                                   ));
                                  ?>
                               </nav>
                            </div>
                            <div class="header-catalog-item action-item ">
                            <?php
                                $args = array(
                                    'post_type' => 'promotions',
                                    'posts_per_page' => 1,
                                );

                                $query = new WP_Query($args);

                                if ($query->have_posts()) {
                                    while ($query->have_posts()) {
                                        $query->the_post();
                                        $title = get_the_title();
                                        $discount_percentage = get_field('discount_percentage');
                                        $date = get_the_date('d.m.y');
                                        $permalink = get_permalink();
                                        $image_url = get_the_post_thumbnail_url(null, 'full'); 
                                ?>
                                <div class="action-content">
                                  <a href="<?php echo esc_url($permalink); ?>">
                                    <img src="<?php echo esc_url($image_url); ?>" alt="">
                                    <div class="action-content-deskription background_light">
                                        <div class="content-deskription-top">
                                            <p class="h6"><?php echo esc_html($title); ?></p>
                                            <?php if ($discount_percentage) : ?>
                                                <span class="h3"><?php echo esc_html($discount_percentage); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="content-deskription-bottom">
                                            <p class="subtitle1"><?php echo esc_html($date); ?></p>
                                            <a href="<?php echo esc_url($permalink); ?>" class="caption">подробнее</a>
                                        </div>
                                    </div>
                                  </a>
                                </div>
                                <?php
                                    }
                                    wp_reset_postdata();
                                } else {
                                    //echo 'Записей не найдено.';
                                }
                                ?>

                                <div class="woocommerce_categories desktop background_main hide">
                                    <?php                                                                                                                
                                            $categories = get_terms(array(
                                                'taxonomy' => 'product_cat',
                                                'hide_empty' => false,
                                            ));
                                            $desired_categories = array('balace', 'balace natural pharm');

                                            if (!empty($categories) ) {
                                                foreach ($categories as $category) {
                                                    if ($category->parent == 0 && in_array($category->name, $desired_categories)) {
                                                        $category_url = get_term_link($category); 
                                                        echo '<div class="product_cat_item"><a href="'  . esc_url($category_url) .  '">' . htmlspecialchars($category->name) . '</a>';
                                                        $subcategories = get_terms(array(
                                                            'taxonomy' => 'product_cat',
                                                            'hide_empty' => false,
                                                            'parent' => $category->term_id,
                                                        ));
                                                        
                                                        if (!empty($subcategories)) {
                                                            echo '<ul class="product_cat_list">';
                                                            foreach ($subcategories as $subcategory) {
                                                                $subcategory_link = get_term_link($subcategory);
                                                                echo '<li><a class="product_cat_sub_menu_active subtitle1" >' . $subcategory->name . '</a>';
                                                                $subsubcategories = get_terms(array(
                                                                    'taxonomy' => 'product_cat',
                                                                    'hide_empty' => false,
                                                                    'parent' => $subcategory->term_id,
                                                                ));
                                                                
                                                                if (!empty($subsubcategories) ) {
                                                                    echo '<ul class="header_product_cat_sub_menu hide">';
                                                                    foreach ($subsubcategories as $subsubcategory) {
                                                                        $subsubcategory_link = get_term_link($subsubcategory);
                                                                        echo '<li><a class="subtitle1 text_dark" href="' . esc_url($subsubcategory_link) . '">' . $subsubcategory->name . '</a></li>';
                                                                    }
                                                                    echo '</ul>';
                                                                }
                                                                
                                                                echo '</li>';
                                                            }
                                                            echo '</ul>';
                                                        } else {
                                                            //echo '<ul><li>Нет подкатегорий</li></ul>';
                                                        }
                                                        
                                                        echo '
                                                        <a href="'. esc_url($category_url) .'" class="product_cat_item_all_category"> смотреть всё </a>
                                                        </div>';
                                                    }
                                                }
                                            } else {
                                               // echo 'Нет категорий';
                                            }
                                    ?>
                                </div>

                            </div>
                        </div>
                        <div class="header-catalog-info">
                        <div class="catalog-info-link">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'catalog-info-menu',
                                'container' => false,
                                'menu_class' => '', 
                                'fallback_cb' => false,
                                'items_wrap' => '%3$s',
                                'depth' => 1,
                            ));
                            ?>
                        </div>
                                <div class="catalog-info-phone">
                                    <p>Телефон</p>
                                    <a class="h4" href="tel:+78432345678">+7 (843) 234 56 78</a>
                                </div>
                                <div class="catalog-info-mail">
                                    <p>E-mail</p>
                                    <a class="h4" href="mailto:mail@balace.ru">mail@balace.ru</a>
                                </div>
                        </div>
                      </div>
                </div>
                
                
            </div>
            <div class="search-mob-wrapp hide">
                <div class="search-mob-input-wrapp">
                <?php echo do_shortcode('[woo_search]'); ?>
                            </div>
                        </div>
                        <div class="header-catalog mob background_main hide">
                    <div class="header-catalog-content mob">
                      <div class="header-catalog-wrapp">
                            <div class="header-catalog-item catalog-menu mob">
                            <nav>
                                <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'top-nav-menu',
                                    'container' => false,
                                    'menu_class' => 'nav-menu',
                                    'fallback_cb' => false,
                                    'items_wrap' => '<ul>%3$s</ul>',
                                    'depth' => 1,
                                ));
                                ?>
                            </nav>
                            </div>
                            <div class="header-catalog-item action-item tablet">
                            <?php

                                $args = array(
                                    'post_type' => 'promotions',
                                    'posts_per_page' => 1, 
                                );

                                $query = new WP_Query($args);

                                if ($query->have_posts()) {
                                    while ($query->have_posts()) {
                                        $query->the_post();
                                        $title = get_the_title();
                                        $discount_percentage = get_field('discount_percentage');
                                        $date = get_the_date('d.m.y');
                                        $permalink = get_permalink();
                                        $image_url = get_the_post_thumbnail_url(null, 'full'); 

                                ?>
                                <div class="action-content">
                                  <a href="<?php echo esc_url($permalink); ?>">
                                    <img src="<?php echo esc_url($image_url); ?>" alt="">
                                    <div class="action-content-deskription background_light">
                                        <div class="content-deskription-top">
                                            <p class="h6"><?php echo esc_html($title); ?></p>
                                            <?php if ($discount_percentage) : ?>
                                                <span class="h3"><?php echo esc_html($discount_percentage); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="content-deskription-bottom">
                                            <p class="subtitle1"><?php echo esc_html($date); ?></p>
                                            <a href="<?php echo esc_url($permalink); ?>" class="caption">подробнее</a>
                                        </div>
                                    </div>
                                  </a>
                                </div>
                                <?php
                                    }
                                    wp_reset_postdata();
                                } else {
                                
                                    //echo 'Записей не найдено.';
                                }
                                ?>
                                <div class="woocommerce_categories tablet background_main hide">
                                    <?php                                                                                                                
                                            $categories = get_terms(array(
                                                'taxonomy' => 'product_cat',
                                                'hide_empty' => false,
                                            ));
                                            $desired_categories = array('balace', 'balace natural pharm');

                                            if (!empty($categories) ) {
                                                foreach ($categories as $category) {
                                                    if ($category->parent == 0 && in_array($category->name, $desired_categories)) {
                                                        $category_url = get_term_link($category);
                                                        echo '<div class="product_cat_item"><a href="'  . esc_url($category_url) .  '">' . htmlspecialchars($category->name) . '</a>';
                                                        $subcategories = get_terms(array(
                                                            'taxonomy' => 'product_cat',
                                                            'hide_empty' => false,
                                                            'parent' => $category->term_id,
                                                        ));
                                                       
                                                        if (!empty($subcategories)) {
                                                            echo '<ul class="product_cat_list">';
                                                            foreach ($subcategories as $subcategory) {
                                                                $subcategory_link = get_term_link($subcategory);
                                                                echo '<li><a class="product_cat_sub_menu_active subtitle1" >' . $subcategory->name . '</a>';
                                                                $subsubcategories = get_terms(array(
                                                                    'taxonomy' => 'product_cat',
                                                                    'hide_empty' => false,
                                                                    'parent' => $subcategory->term_id,
                                                                ));
                                                                
                                                                if (!empty($subsubcategories) ) {
                                                                    echo '<ul class="header_product_cat_sub_menu hide">';
                                                                    foreach ($subsubcategories as $subsubcategory) {
                                                                        $subsubcategory_link = get_term_link($subsubcategory);
                                                                        echo '<li><a class="subtitle1 text_dark" href="' . esc_url($subsubcategory_link) . '">' . $subsubcategory->name . '</a></li>';
                                                                    }
                                                                    echo '</ul>';
                                                                }
                                                                
                                                                echo '</li>';
                                                            }
                                                            echo '</ul>';
                                                        } else {
                                                            //echo '<ul><li>Нет подкатегорий</li></ul>';
                                                        }
                                                        
                                                        echo '
                                                        <a href="' . esc_url($category_url) . '" class="product_cat_item_all_category"> смотреть всё </a>
                                                        </div>';
                                                    }
                                                }
                                            } else {
                                               // echo 'Нет категорий';
                                            }
                                    ?>
                                </div>

                            </div>
                   </div>
                    <div class="header-catalog-info">
                        <div class="catalog-info-link mob">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'catalog-info-menu',
                                'container' => false,
                                'menu_class' => '', 
                                'fallback_cb' => false,
                                'items_wrap' => '%3$s',
                                'depth' => 1,
                            ));
                            ?>
                        </div>
                        <div class="catalog-info-wrapp mob">
                                <div class="catalog-info-phone">
                                    <p>Телефон</p>
                                    <a class="h5" href="tel:+78432345678">+7 (843) 234 56 78</a>
                                </div>
                                <div class="catalog-info-mail">
                                    <p>E-mail</p>
                                    <a class="h6" href="mailto:mail@balace.ru">mail@balace.ru</a>
                                </div>
                            </div>
                        </div>
                        <div class="header-catalog-item action-item mob">
                        <?php

                            $args = array(
                                'post_type' => 'promotions',
                                'posts_per_page' => 1, 
                            );

                            $query = new WP_Query($args);

                            if ($query->have_posts()) {
                                while ($query->have_posts()) {
                                    $query->the_post();

                                    $title = get_the_title();
                                    $discount_percentage = get_field('discount_percentage');
                                    $date = get_the_date('d.m.y');
                                    $image_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');

                                         ?>
                                        <div class="action-content mob background_main">
                                            <div class="action-content-deskription">
                                                <div class="content-deskription-top mob">
                                                    <p class="caption"><?php echo esc_html($title); ?></p>
                                                    <?php if ($discount_percentage) : ?>
                                                        <span class="h5"><?php echo esc_html($discount_percentage); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="content-deskription-bottom mob">
                                                    <p class="body2"><?php echo esc_html($date); ?></p>
                                                    <a href="<?php the_permalink(); ?>" class="caption">подробнее</a>
                                                </div>
                                            </div>
                                            <img src="<?php echo esc_url($image_url); ?>" alt="">
                                        </div>
                                        <?php
                                            }
                                            wp_reset_postdata(); 
                                        } else {

                                        // echo 'Записей не найдено.';
                                        }
                                        ?>

                                  </div>
                       <div class="woocommerce_categories mob background_main hide">
                                    <?php                                                                                                                
                                            $categories = get_terms(array(
                                                'taxonomy' => 'product_cat',
                                                'hide_empty' => false,
                                            ));
                                            $desired_categories = array('balace', 'balace natural pharm');

                                            if (!empty($categories) ) {
                                                foreach ($categories as $category) {
                                                    if ($category->parent == 0 && in_array($category->name, $desired_categories)) {
                                                        $category_url = get_term_link($category);
                                                        echo '<div class="product_cat_item"><a href="'  . esc_url($category_url) .  '">' . htmlspecialchars($category->name) . '</a>';
                                                        $subcategories = get_terms(array(
                                                            'taxonomy' => 'product_cat',
                                                            'hide_empty' => false,
                                                            'parent' => $category->term_id,
                                                        ));
                                                        
                                                        if (!empty($subcategories)) {
                                                            echo '<ul class="product_cat_list">';
                                                            foreach ($subcategories as $subcategory) {
                                                                $subcategory_link = get_term_link($subcategory);
                                                                echo '<li><a class="product_cat_sub_menu_active subtitle1" >' . $subcategory->name . '</a>';
                                                                $subsubcategories = get_terms(array(
                                                                    'taxonomy' => 'product_cat',
                                                                    'hide_empty' => false,
                                                                    'parent' => $subcategory->term_id,
                                                                ));
                                                                
                                                                if (!empty($subsubcategories) ) {
                                                                    echo '<ul class="header_product_cat_sub_menu hide">';
                                                                    foreach ($subsubcategories as $subsubcategory) {
                                                                        $subsubcategory_link = get_term_link($subsubcategory);
                                                                        echo '<li><a class="subtitle1 text_dark" href="' . esc_url($subsubcategory_link) . '">' . $subsubcategory->name . '</a></li>';
                                                                    }
                                                                    echo '</ul>';
                                                                }
                                                                
                                                                echo '</li>';
                                                            }
                                                            echo '</ul>';
                                                        } else {
                                                            //echo '<ul><li>Нет подкатегорий</li></ul>';
                                                        }
                                                        
                                                        echo '
                                                        <a href="'. esc_url($category_url) .'" class="product_cat_item_all_category"> смотреть всё </a>
                                                        </div>';
                                                    }
                                                }
                                            } else {
                                               // echo 'Нет категорий';
                                            }
                                    ?>
                                </div>
                </div>

</section>
<section class="section-breadcrumbs">
    <?php
    if(!is_front_page()){
        if ( function_exists( 'yoast_breadcrumb' ) ) :
        yoast_breadcrumb( '<div id="breadcrumbs">', '</div>' );
        endif;
     } else {
        echo 
        '<style>
          .section-breadcrumbs {
            display:none;
           }
         </style>
        ';
     }
    ?>
</section>







