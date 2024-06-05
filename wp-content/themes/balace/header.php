
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
<section>
        <div class="container">
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
                        <a class="subtitle2" href="">О нас</a>
                        <a class="subtitle2" href="">Сравнение товаров</a>
                    </div>
                    <div class="header-product-actions">
                        <button class="btn_add-to-wishlist"></button>
                        <button class="btn_add-to-cart"></button>
                      </div>
                </header>
                <div class="header-catalog background_main hide">
                    <div class="header-catalog-content">
                      <div class="header-catalog-wrapp">
                            <div class="header-catalog-item catalog-menu">
                                <nav>
                                    <ul>
                                        <li>  <a   class="h5" href="">Каталог</a> </li>
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
        </div>
    </section>