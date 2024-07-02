<section class="swiper-slider-best-products">
    <div class="best-products-block">
        <div class="best-products-block-title">
            <p class="h4 text_light">Популярные продукты</p>
            <div class="best-slider-btn">
                <div class="swiper-button-next btn_slider_left best-slider-btn"></div>
                <div class="swiper-button-prev btn_slider_right best-slider-btn"></div>
            </div>
        </div>
        <div class="swiper-container best_products">
            <ul class="swiper-wrapper">
                <?php
                $args = array(
                    'posts_per_page' => 10, 
                    'post_type' => 'product',
                    'meta_key' => 'total_sales', 
                    'orderby' => 'meta_value_num', 
                    'order' => 'DESC', 
                );

                $query = new WP_Query($args);
                if ($query->have_posts()) :
                    while ($query->have_posts()) :
                        $query->the_post();
                ?>
                           <li class="swiper-slide best_products_slide">
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
                ?>
            </ul>
        </div>
    </div>
</section>
