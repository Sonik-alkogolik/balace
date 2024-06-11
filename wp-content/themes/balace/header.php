
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
                    <div class="logo">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="">
                    </div>
                     <div class="header-menu">
                            <button class="btn_header_menu">
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
                </header>
                <div class="header-catalog background_main hide">
                    <div class="header-catalog-content">
                      <div class="header-catalog-wrapp">
                            <div class="header-catalog-item catalog-menu">
                                <nav>
                                    <ul>
                                        <li>  <a class="h5 catalog-header" >Каталог</a> </li>
                                        <li> <a  class="h5" href=""> Акции и розыгрыши</a></li>
                                        <li> <a  class="h5" href=""> Отзывы</a></li>
                                        <li> <a  class="h5" href="">Блог</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="header-catalog-item action-item ">
                                <div class="action-content">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/action_img.webp" alt="">
                                    <div class="action-content-deskription background_light">
                                        <div class="content-deskription-top">
                                            <p class="h6">Текст текущей акции</p>
                                            <span class="h3">-25%</span>
                                        </div>
                                        <div class="content-deskription-bottom">
                                            <p class="subtitle1">12.07.24</p>
                                            <a class="caption">подробнее</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="woocommerce_categories background_main hide">
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
                                    <a class="body2" href="">доставка и оплата</a>
                                    <a class="body2" href="">проверка лицензии</a>
                                    <a class="body2" href="">оформление заказа</a>
                                    <a class="body2" href="">документы</a>
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
</section>



