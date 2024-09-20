<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>


<section class="section-page-product-card">
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

    <div class="product-card-wrapp background_main">
        <div class="product-card-item left">

            <?php 
				// Функция для получения атрибутов товара
				function get_product_attributes($product_id) {
					$product_attributes = array();
					$product = wc_get_product($product_id);
					if ( $product ) {
						$attributes = $product->get_attributes();
						foreach ($attributes as $attribute) {
							$name = $attribute->get_name();
							if (!isset($product_attributes[$name])) {
								$product_attributes[$name] = array();
							}
							$terms = wc_get_product_terms($product_id, $name, array('fields' => 'all'));
							$product_attributes[$name] = array_merge($product_attributes[$name], $terms);
						}
					}
					foreach ($product_attributes as &$terms) {
						$terms = array_unique($terms, SORT_REGULAR);
					}
					return $product_attributes;
				}
				$product_id = $product->get_id();
				$product_attributes = get_product_attributes($product_id);
				echo '<div class="product-attribute">';
				 echo '<ul>';
					foreach ($product_attributes as $attribute_name => $terms) {
						foreach ($terms as $term) {
							echo '<li>' . esc_html($term->name) . '</li>';
						}
					}
				 echo '</ul>';
				echo '</div>';
			?>

            <div class="product-card-item-title">
                <?php echo '<h1>' . get_the_title() . '</h1>'; ?>
            </div>

            <div class="block-card-info-wrapp">
			<div class="card-info-item">
							<img src="/wp-content/themes/balace/img/icon/statick-img-card.png" />
							    <div class="card-info-item-deskription">
								<p class="h6">Эффективность</p>
							<span class="body2">8 из 10 опрошенных заметили положительный эффект с 1 недели</span>
								</div>
						</div>

						<div class="card-info-item">
						<img src="/wp-content/themes/balace/img/icon/statick-img-card2.png" />
						    <div class="card-info-item-deskription">
							<p class="h6">Качественные компоненты</p>
							<span class="body2">Рецептура и сырьё из Европы</span>
							</div>
						</div>

						<div class="card-info-item">
						<img src="/wp-content/themes/balace/img/icon/statick-img-card3.png" />
						    <div class="card-info-item-deskription">
							<p class="h6">Доступность</p>
							<span class="body2">Профессиональная косметика по разумной цене</span>
							</div>
						</div>

						<div class="card-info-item">
						<img src="/wp-content/themes/balace/img/icon/statick-img-card4.png" />
						    <div class="card-info-item-deskription">
							<p class="h6">Animal friendly</p>
							<span class="body2">Мы не проводим испытания на животных</span>
							</div>
						</div>
            </div> 
			
			
             <div class="card-deskription-wrapp">
			 <?php 
				$active_substances = get_field('active_substance_list');

				if (is_array($active_substances) && (
					!empty($active_substances['picture_substance']) || 
					!empty($active_substances['description_substance']) || 
					!empty($active_substances['picture_substance_2']) || 
					!empty($active_substances['description_substance_2']) || 
					!empty($active_substances['picture_substance_3']) || 
					!empty($active_substances['description_substance_3'])
				)) {
					?>
					<div class="card-deskription-content">
						<p class="h6">Действующее вещество</p>
						<div class="card-deskription-list">
							<?php
							if (!empty($active_substances['picture_substance']) && !empty($active_substances['description_substance'])) {
								echo '<div class="card-deskription-list-item">';
								echo '<img src="' . esc_url($active_substances['picture_substance']) . '" />';
								echo '<p class="body1">' . esc_html($active_substances['description_substance']) . '</p>';
								echo '</div>';
							}
							if (!empty($active_substances['picture_substance_2']) && !empty($active_substances['description_substance_2'])) {
								echo '<div class="card-deskription-list-item">';
								echo '<img src="' . esc_url($active_substances['picture_substance_2']) . '" />';
								echo '<p class="body1">' . esc_html($active_substances['description_substance_2']) . '</p>';
								echo '</div>';
							}
							if (!empty($active_substances['picture_substance_3']) && !empty($active_substances['description_substance_3'])) {
								echo '<div class="card-deskription-list-item">';
								echo '<img src="' . esc_url($active_substances['picture_substance_3']) . '" />';
								echo '<p class="body1">' . esc_html($active_substances['description_substance_3']) . '</p>';
								echo '</div>';
							}
							?>
						</div>
					</div>
					<?php 
				}

				?>

                <div class="card-deskription-product">
                    <div class="deskription-product-item">
                        <span class="h6">Описание</span>
                        <?php  echo $product->get_description();?>
                     </div>

					<div class="deskription-product-item">
						<span class="h6">Состав</span>

						<?php
						$composition = get_field('composition_list');
						if ($composition) {
							echo '<p class="h6">' . esc_html($composition['composition_deskription']) . '</p>';
						} 
						?>

					</div>



					<div class="deskription-product-item">
						<span class="h6">Противопоказания</span>
						<?php
							$contraindications_list = get_field('contraindications');
							if (isset($contraindications_list['contraindications_text'])) {
								echo '<p class="h6">' . esc_html($contraindications_list['contraindications_text']) . '</p>';
							}
						?>
					</div>


                </div> <!-- .card-deskription-product -->

                <div class="method-application-wrapp">
                    <div class="method-application">
                        <p class="h6">Способ применения</p>
                        <div class="method-application-list">
						 <?php
							$method_application_list = get_field('method_application_list');
							if ($method_application_list) {
								$method_list = array(
									'method_application_1',
									'method_application_2',
									'method_application_3',
								);
								$additional_text = 'method_application_deskription_text';
								foreach ($method_list as $index => $method) {
									if (isset($method_application_list[$method])) {
										echo '<div class="method-application-list-item">';
										echo '<span class="number_method">'. ($index + 1) . '</span> ';
										echo '<p class="body1 text_dark">'. $method_application_list[$method] . '</p>';
										echo '</div>';
									}
								}
								if (isset($method_application_list[$additional_text])) {
									echo '<span class="text_dark">' . $method_application_list[$additional_text] . '</span>';
								}
							 }
							?>
                        </div> 
                    </div> 
                </div>

                <div class="her-him-wrapp">
                    <div class="her-him-title">
                        <?php echo '<p class="h5">' . get_field('her_him_text') . '</p>';?>
                    </div>
                    <img src="<?php echo get_field('her_him_img'); ?>" />
                </div>

            </div>
			
        </div>

       <div class="product-card-item right">
		<div class="product-card-item-img">
		<div class="swiper-container product-gallery-slider">
        <div class="swiper-wrapper">
           <?php
            $product = wc_get_product(get_the_ID());
             $gallery_ids = $product->get_gallery_image_ids();
        
               if ($gallery_ids) {
               foreach ($gallery_ids as $gallery_id) {
                $image_url = wp_get_attachment_image_url($gallery_id, 'full');
                
                if ($image_url) {
                    echo '<div class="swiper-slide card-slide">';
                    echo '<img src="' . esc_url($image_url) . '" alt="">';
                    echo '</div>';
                }
               }
           }
          ?>
       </div>
    <div class="btn_slider_left card-slider-gallery"></div>
    <div class="btn_slider_right card-slider-gallery"></div>

	<button class="ever_compare_button"> 
		<?php echo do_shortcode('[evercompare_button]'); ?>
	</button>
     
	<div class="btn_ever_compare" style="display: none;">
     <a href="/sravnenie-tovarov/">В сравнение</a>
   </div>
	<?php 
$video_url = get_field('url_video_link'); 
if ($video_url): ?>
    <button class="card-play-video"></button>
    <button class="card-sound-toggle">🔊</button> 
    <video id="video-frame" width="560" height="315" muted style="display: none;">
        <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>
<?php endif; ?>



	<div class="product-card-item-bottom">
		   <button class="add_to_cart_button">
		   <a href="?add-to-cart=<?php echo esc_attr( $product_id ); ?>" 
				data-quantity="1" 
				class="add_to_cart_button ajax_add_to_cart" 
				data-product_id="<?php echo esc_attr( $product_id ); ?>" 
				data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>" 
				aria-label="Add to cart: <?php echo esc_attr( $product->get_name() ); ?>" 
				rel="nofollow">
				В корзину
				</a>
			</button>
			<a role="button" 
			tabindex="0" 
			name="" 
			aria-label="Добавить в избранное" 
			class="tinvwl_add_to_wishlist_button tinvwl-icon-heart no-txt tinvwl-position-after tinvwl-loop" 
			data-tinv-wl-list="[]" 
			data-tinv-wl-product="<?php echo esc_attr( $product_id ); ?>" 
			data-tinv-wl-productvariation="0" 
			data-tinv-wl-productvariations="[]" 
			data-tinv-wl-producttype="simple" 
			data-tinv-wl-action="addto">
			</a>
		   <a class="btn_ozon_white product-page"></a>
           <a class="btn_wild_white product-page"></a>
        </div> 
</div>

	  </div>
	  
        </div>
    </div> 

<?php
/**
 * Hook: woocommerce_after_single_product.
 *
 * @hooked woocommerce_output_product_data_tabs - 10
 * @hooked woocommerce_upsell_display - 15
 * @hooked woocommerce_output_related_products - 20
 */
do_action( 'woocommerce_after_single_product' );
?>
</section>
<section class="section-recommend-card">
<?php
		// Получаем рекомендованные товары
	$recommended_products = get_field('recommend_products');
	if ($recommended_products):
	?>
	 <div class="recommend-products-wrapp">
				<div class="recommend-products-item left">
					<div class="recommend-products-title desktop">
						<h2 class="h3">Рекомендуем так же</h2>
					</div>
					<?php foreach ($recommended_products as $post): ?>
					<?php
					setup_postdata($post);
					$product = wc_get_product($post->ID);
					?>
					<div class="recommend-products-deskription">
					  <?php  echo $product->get_description();?>
					</div>
					<?php endforeach; ?>
					<div class="recommend-products-btn-go-catalog">
					<?php
						global $product;
						$terms = get_the_terms($product->get_id(), 'product_cat');

						if ($terms && !is_wp_error($terms)) {
							$category_ids = array();
							foreach ($terms as $term) {
							$category_ids[] = $term->term_id;
							}
							$first_category_id = reset($category_ids);
							$category_link = get_term_link($first_category_id, 'product_cat');
						}
            		?>
            <a class="btn_go_catalog primery_main h6 text_main" href="<?php echo esc_url($category_link); ?>">
			<span>Вернуться в каталог</span>
			</a>
					</div>
				</div>

				<div class="recommend-products-item right">
				<div class="recommend-products-title mob">
						<h2 class="h3">Рекомендуем так же</h2>
					</div>
				<?php foreach ($recommended_products as $post): ?>
        <?php
        setup_postdata($post);
        $product = wc_get_product($post->ID);
        ?>
		 <div class="recommend-products-item-product">
            <div class="recommend-products-card">
                <li <?php post_class('product_item'); ?>>
                    <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                        <div class="product_image_item">
                            <?php echo get_the_post_thumbnail($product->get_id(), 'woocommerce_thumbnail', array('class' => 'attachment-woocommerce_thumbnail size-woocommerce_thumbnail')); ?>
                        </div>
                        <?php custom_product_attributes($product); ?>
                        <?php
                        woocommerce_template_loop_add_to_cart(array(
                            'class' => 'btn_add_to_basket button product_type_simple add_to_cart_button ajax_add_to_cart',
                        ), $product);
                        ?>
                        <?php echo do_shortcode('[ti_wishlists_addtowishlist]'); ?>
                    </a>
                </li>
            </div>
        </div>
          <?php endforeach; ?>
				</div>
	 <?php endif; ?>
	</div>
</div> 
</section>
<?php get_template_part( '/pages/templates-parts/FAQ' ); ?> 