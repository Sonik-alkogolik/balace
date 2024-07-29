<?php
/*
Template Name:Записи блога
*/
get_header();
?>

<main id="primary" class="site-main">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" class="article-wrapp">
        <div class="article-column-left">
           <div class="article-title">
            <h1>
              <?php the_title(''); ?>
            </h1>
            <div class="article-bottom-title">
                <?php 
                     get_the_date();
                ?>
                <div class="social-networks">
                <ul class="social-links">
                    <li><a href="https://vk.com" target="_blank" rel="noopener noreferrer" aria-label="">ВК</a></li>
                    <li><a href="https://t" target="_blank" rel="noopener noreferrer" aria-label="">Телеграм</a></li>
                    <li><a href="https://w" target="_blank" rel="noopener noreferrer" aria-label="">Ватсап</a></li>
                </ul>
                <p>Поделиться новостью</p>
                </div>
            </div>
           </div>
        </div>
        <div class="article-column-right">
            <?php
            if ( has_post_thumbnail() ) {
                the_post_thumbnail('full');
            } else {
                echo '<img src="' . get_template_directory_uri() . '/assets/images/placeholder.jpg" alt="Placeholder Image">';
            }

            the_content();
            ?>
        </div>
        </article>
        <?php
        endwhile;
    else :
        echo '<p>Записи не найдены.</p>';
    endif;
    ?>
</main>


<?php
$term = get_term_by('slug', 'balace', 'product_cat');
$link_to_catalog = $term ? get_term_link($term) : '#';
?>


<section class="best-products">
    <div class="best-products-block">
        <div class="best-products-block-title">
            <p class="h4 text_light">Подборка продуктов</p>
            <div class="about-link-go-catalog">
              <a href="<?php echo esc_url($link_to_catalog); ?>">Перейти в каталог</a>
            </div>
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
        <div class="swiper-wrapper">
            <?php
            $args = array(
                'post_type' => 'blog', 
                'posts_per_page' => -1, 
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
            ?>
                <div class="swiper-slide">
                    <div class="article-item">
                        <a href="<?php the_permalink();?>">
                        <?php
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('medium'); 
                        } else {
                            echo '<img src="' . get_template_directory_uri() . '/assets/images/placeholder.jpg" alt="Placeholder Image">';
                        }
                        ?>
                        <p><?php the_date(); ?></p>
                        <h3 class="article-title"><?php the_title(); ?></h3>
                        <p class="article-excerpt"><?php the_excerpt(); ?></p>
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
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>

<?php
get_footer();
?>
