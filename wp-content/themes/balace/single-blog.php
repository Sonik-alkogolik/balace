<?php
/*
Template Name:Записи блога
*/
get_header();
?>

<script type="text/javascript">
        var timeToReload = 15000; 
        function reloadPage() {
            window.location.reload();
        }
        setTimeout(reloadPage, timeToReload);
    </script>

<section>

<main id="primary" class="site-main">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" class="article-wrapp">
        <div class="article-column-left">
           <div class="article-title">
            <h1 class="h3">
              <?php the_title(''); ?>
            </h1>
            <div class="article-bottom-title">
                <?php
            $date_string = get_the_date('Y-m-d');
        $date_object = new DateTime($date_string);
        // Массив с русскими названиями месяцев
        $months = array(
            1 => 'января', 2 => 'февраля', 3 => 'марта', 4 => 'апреля',
            5 => 'мая', 6 => 'июня', 7 => 'июля', 8 => 'августа',
            9 => 'сентября', 10 => 'октября', 11 => 'ноября', 12 => 'декабря'
        );
        $day = $date_object->format('j');
        $month_num = $date_object->format('n');
        $month = $months[$month_num];
        $year = $date_object->format('Y'); 

        ?>
        <div class="date-block">
        <p class="h5 text_light"><?php echo esc_html($day . ' ' . $month); ?></p>
        <span class="caption text_light"><?php echo esc_html($year); ?></span>
        </div>
                <div class="social-networks">
                <ul class="social-links">
                    <li><a href="https://vk.com" target="_blank" rel="noopener noreferrer" aria-label=""><img src="/wp-content/themes/balace/img/icon/icon_vk.png" alt=""></a></li>
                    <li><a href="https://t" target="_blank" rel="noopener noreferrer" aria-label=""><img src="/wp-content/themes/balace/img/icon/icon_telegram.png" alt=""></a></li>
                    <li><a href="https://w" target="_blank" rel="noopener noreferrer" aria-label=""><img src="/wp-content/themes/balace/img/icon/icon_watsaap.png" alt=""></a></li>
                </ul>
                <p class="text_dark">Поделиться новостью</p>
                </div>
            </div>
           </div>
           <div class="img-article-tablet">
            <div class="article-single-img">
              <?php
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail('');
                } 
                ?>
            </div>
           </div>
        </div>
        <div class="article-column-right">
            <div class="article-single-img">
            <?php
            if ( has_post_thumbnail() ) {
                the_post_thumbnail('');
            } 
            ?>
            </div>
           <div class="article-content">
              <?php 
                   the_content();
              ?>
           </div>

        </div>
        </article>
        <?php
        endwhile;
    else :
        echo '<p>Записи не найдены.</p>';
    endif;
    ?>
</main>
</section>

<?php
$term = get_term_by('slug', 'balace', 'product_cat');
$link_to_catalog = $term ? get_term_link($term) : '#';
?>


<section class="best-products">
    <div class="best-products-block">
        <div class="best-products-block-title">
            <p class="h4 text_light">Подборка продуктов</p>
        </div>
<div class="woocommerce best_products">
<ul class="product-list">
<?php
$related_products = get_field('recommended_products_blog');
if ($related_products) {
    $product_ids = array_map(function($post) {
        return $post->ID;
    }, $related_products);
    $args = array(
        'post_type' => 'product',
        'post__in' => $product_ids,
        'posts_per_page' => -1, 
        'orderby' => 'post__in',
        'post_status' => 'publish'
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) :
            $query->the_post();
    ?>
        <li class="product-item">
            <a href="<?php the_permalink(); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                <div class="product_image_item">
                    <?php
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('woocommerce_thumbnail');
                    } else {
                        echo '<img src="' . wc_placeholder_img_src() . '" alt="Placeholder" width="300" height="300" />';
                    }
                    ?>
                </div>
                <div class="product-attribute-type">
                    <p class="body2 text_main"><?php echo get_post_meta(get_the_ID(), 'pa_type', true); ?></p>
                </div>
                <div class="product-attribute-wrapp">
                    <h2 class="woocommerce-loop-product__title h4 text_main"><?php the_title(); ?></h2>
                    <div class="product_attribute_container" title="<?php echo get_post_meta(get_the_ID(), '_price', true); ?>">
                        <div class="h6 text_dark price-mob-slider-best">
                            <?php
                            global $product;
                            echo $product->get_price_html();
                            ?>
                        </div>
                    </div>
                </div>
            </a>
            <?php
            woocommerce_template_loop_add_to_cart();
            do_action('woocommerce_after_shop_loop_item');
            ?>
        </li>
    <?php
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p>' . __('No products found') . '</p>';
    endif;
} else {
    echo '<p>' . __('No related products found') . '</p>';
}
?>
</ul>
</div>


<div class="about-link-go-catalog mob">
    <a href="<?php echo esc_url($link_to_catalog); ?>">Перейти в каталог</a>
</div>
    </div>
</section>

<section class="article-swiper">
    <div class="swiper-container-article">
        <div class="swiper-article-title">
            <p class="h3">Читайте далее</p>
            <div class="article-btn-swiper">
            <div class="swiper-button-prev btn_slider_right best-slider-btn"></div>
              <div class="swiper-button-next btn_slider_left best-slider-btn"></div>
            </div>
        </div>
        <div class="swiper-wrapper swiper-wrapper-article">
            <?php
            $args = array(
                'post_type' => 'blog', 
                'posts_per_page' => -1, 
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
            ?>
                <div class="swiper-slide article-slide">
                    <div class="article-item">
                        <a href="<?php the_permalink();?>">
                        <div class="article-item-img">
                        <?php
                            the_post_thumbnail(''); 
                        ?>
                        </div>
                        <p class="date caption"><?php the_date(); ?></p>
                        <h3 class="article-title  text_main h5"><?php the_title(); ?></h3>
                        <p class="article-excerpt text_dark body1">
                            <?php $excerpt = get_the_excerpt();
                            echo wp_trim_words($excerpt, 12, '...');?>
                        </p>
                        </a>
                    </div>
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>No articles found</p>';
            endif;
            ?>
        </div>
    
    </div>
</section>


<?php
$current_post_id = get_the_ID();
?>

<section class="section-article-mob">
    <div class="article-container-mob">
        <div class="article-title-mob">
            <p class="h3 mob">Читайте далее</p>
      
        </div>
        <div id="article-list-mob" class="article-list-mob mob">
            <?php
            $args = array(
                'post_type' => 'blog',
                'posts_per_page' => -1, 
                'post__not_in' => array($current_post_id)
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) :
                $post_count = 0; 
                while ($query->have_posts()) : $query->the_post();
                    $post_count++;
                    ?>
                    <div class="article-item-mob" style="display: <?php echo ($post_count <= 2) ? 'block' : 'none'; ?>;">
                        <a href="<?php the_permalink(); ?>">
                            <div class="article-item-img-mob">
                                <?php the_post_thumbnail(''); ?>
                            </div>
                            <p class="date-caption-mob"><?php the_date(); ?></p>
                            <h3 class="article-title-mob text_main h5"><?php the_title(); ?></h3>
                            <p class="article-excerpt-mob text_dark body1">
                                <?php $excerpt = get_the_excerpt(); echo wp_trim_words($excerpt, 12, '...'); ?>
                            </p>
                        </a>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p class="no-articles-found-mob mob">No articles found</p>';
            endif;
            ?>
        </div>
        <button id="load-more-posts-mob" class="btn-load-more-mob mob">Узнать больше</button>
    </div>
</section>


<?php
get_footer();
?>
