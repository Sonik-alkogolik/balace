<?php
// Получение текущей категории товара
function get_current_category() {
    $current_category_slug = get_query_var('product_cat');
    $current_category = get_term_by('slug', $current_category_slug, 'product_cat');
    return $current_category;
}

// Получение брендов
function get_brands() {
    return get_terms(array(
        'taxonomy' => 'product_cat',
        'hide_empty' => false,
        'exclude' => '20',
        'parent' => 0,
    ));
}

// Получение подкатегорий
function get_subcategories($current_category_id) {
    return get_terms(array(
        'taxonomy' => 'product_cat',
        'hide_empty' => false,
        'exclude' => '20',
        'parent' => $current_category_id,
    ));
}

// Получение параметров для запроса товаров
function get_product_query_args($current_category_id) {
    return array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $current_category_id,
            ),
        ),
    );
}

// Функция для получения всех атрибутов товаров
function get_product_attributes($products_query) {
    $product_attributes = array();

    if ($products_query->have_posts()) {
        while ($products_query->have_posts()) {
            $products_query->the_post();
            global $product;
            $attributes = $product->get_attributes();

            foreach ($attributes as $attribute) {
                $name = $attribute->get_name();

                // Check if the attribute name is 'pa_тип-товара'
                if ($name === 'pa_тип-товара') {
                    if (!isset($product_attributes[$name])) {
                        $product_attributes[$name] = array();
                    }
                    $terms = wc_get_product_terms($product->get_id(), $name, array('fields' => 'all'));
                    $product_attributes[$name] = array_merge($product_attributes[$name], $terms);
                }
            }
        }
        wp_reset_postdata();
    }

    foreach ($product_attributes as &$terms) {
        $terms = array_unique($terms, SORT_REGULAR);
    }

    return $product_attributes;
}

// Получение текущей категории ID
$current_category = get_current_category();
$current_category_id = $current_category ? $current_category->term_id : 0;
$brands = get_brands();
$subcategories = !empty($current_category_id) ? get_subcategories($current_category_id) : array();
$args = get_product_query_args($current_category_id);
$products_query = new WP_Query($args);
// if ($current_category) {
//     echo '<p>Текущая категория товара: ' . esc_html($current_category->slug) . '</p>';
//     echo '<p>Текущая категория ID: ' . esc_html($current_category_id) . '</p>';
// }
$product_attributes = get_product_attributes($products_query);
?>

<section>
<div class="products-filter">
    <div class="filter-block" id="brand">
        <span>Бренд</span>
        <div class="filter-list">
        <?php foreach ($brands as $brand) : ?>
            <label class="custom-checkbox">
            <span class="checkbox-image"></span> 
                <input type="checkbox" name="brands[]" value="<?php echo esc_attr($brand->slug); ?>" data-url="<?php echo esc_url(get_term_link($brand)); ?>">
               <p><?php echo esc_html($brand->name); ?></p> 
            </label>
        <?php endforeach; ?>
        </div>
    </div>

    <div class="filter-block" id="category">
        <span>Категории</span>
        <div class="filter-list">
        <?php if (!is_wp_error($subcategories) && !empty($subcategories)) : ?>
            <?php foreach ($subcategories as $subcategory) : ?>
                <label class="custom-checkbox">
                <span class="checkbox-image"></span> 
                    <input type="checkbox" name="categories[]" value="<?php echo esc_attr($subcategory->slug); ?>" data-url="<?php echo esc_url(get_term_link($subcategory)); ?>">
                   <p><?php echo esc_html($subcategory->name); ?></p> 
                </label>
            <?php endforeach; ?>
        <?php else : ?>
            <p></p>
        <?php endif; ?>
        </div>
    </div>

    <div class="filter-block" id="product_attributes">
    <span>Тип продукта</span>
    <div class="filter-list">
        <?php
        if (!empty($product_attributes['pa_тип-товара'])) {
            $terms = array_unique($product_attributes['pa_тип-товара'], SORT_REGULAR);
            foreach ($terms as $term) :
        ?>
                <label class="custom-checkbox">
                    <span class="checkbox-image"></span> 
                    <input type="checkbox" name="pa_тип-товара[]" value="<?php echo esc_html($term->name); ?>">
                    <p><?php echo esc_html($term->name); ?></p> 
                </label>
        <?php
            endforeach;
        } else {
            //echo '<p>No attributes found.</p>';
        }
        ?>
    </div>
</div>
    <div class="filter-block" id="product-price">
        <span>Цена</span>
        <div class="filter-list">
            Цена $
          </div>
    </div>
</div>
</section>
