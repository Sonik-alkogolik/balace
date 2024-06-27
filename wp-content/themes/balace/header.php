
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
    <title><?php wp_title(); ?></title>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="container">
 <section class="header-section">
            <div class="header-wrapp">
                <header>
                 <div class="header-desktop">
                    <div class="logo">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="">
                    </div>
                     <div class="header-menu">
                            <button class="btn_header_menu desktop">
                            </button>
                     </div>
                     <div class="header-search">
                            <input type="text" placeholder="быстрый и удобный поиск"> 
                    </div>
                    <div class="header-link-pages">
                        <a class="subtitle2 text_main" href="">О нас</a>
                        <a class="subtitle2 text_main" href="">Сравнение товаров</a>
                    </div>
                    <div class="header-product-actions">
                        <button class="btn_add-to-wishlist"></button>
                        <button class="btn_basket"></button>
                    </div>
                    </div>
                    <div class="header-mob">
                    <div class="header-mob-left-item">
                      <div class="header-menu">
                            <button class="btn_header_menu mob">
                            </button>
                       </div>
                       <div class="header-search mob">
                    
                      </div>
                      
                      </div>
                        <div class="logo">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="">
                       </div>
                       <div class="header-product-actions">
                        <button class="btn_add-to-wishlist"></button>
                        <button class="btn_basket"></button>
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
                                                        echo '<div class="product_cat_item"><p>' . $category->name . '</p>';
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
                                                        <a href="" class="product_cat_item_all_category"> смотреть всё </a>
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
                            <input type="text" placeholder="быстрый и удобный поиск"> 
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
                                                        echo '<div class="product_cat_item"><p>' . $category->name . '</p>';
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
                                                        <a href="" class="product_cat_item_all_category"> смотреть всё </a>
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
                                                        echo '<div class="product_cat_item"><p>' . $category->name . '</p>';
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
                                                        <a href="" class="product_cat_item_all_category"> смотреть всё </a>
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





