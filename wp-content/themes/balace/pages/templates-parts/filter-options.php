<?php
// Получаем текущую категорию товара
$current_category_slug = get_query_var('product_cat');
$current_category = get_term_by('slug', $current_category_slug, 'product_cat');
$current_category_id = $current_category ? $current_category->term_id : 0;

// Отладочная информация: вывод текущей категории товара и её ID
if ($current_category) {
    echo '<p>Текущая категория товара: ' . esc_html($current_category_slug) . '</p>';
    echo '<p>Текущая категория ID: ' . esc_html($current_category_id) . '</p>';
}

// Получаем бренды
$brands = get_terms(array(
    'taxonomy' => 'product_cat',
    'hide_empty' => false,
    'exclude' => '20',
    'parent' => 0,
));

// Получаем подкатегории
$subcategories = get_terms(array(
    'taxonomy' => 'product_cat',
    'hide_empty' => false,
    'exclude' => '20',
    'parent' => $current_category_id,
));

// Параметры для запроса товаров
$args = array(
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

// Создаем новый запрос WP_Query
$products_query = new WP_Query($args);

// Массив для хранения уникальных атрибутов
$product_attributes = array();

// Отладочная информация: вывод товаров текущей категории
if ($products_query->have_posts()) {
    echo '<h2>Товары текущей категории:</h2>';
    echo '<ul>';
    while ($products_query->have_posts()) {
        $products_query->the_post();
        global $product;

        // Получаем атрибуты товара
        $attributes = $product->get_attributes();

        // Собираем уникальные атрибуты
        foreach ($attributes as $attribute) {
            $name = $attribute->get_name();
            if (!isset($product_attributes[$name])) {
                $product_attributes[$name] = wc_get_product_terms($product->get_id(), $name, array('fields' => 'all'));
            }
        }

        // Отладочная информация: вывод атрибутов товара
        echo '<li>' . get_the_title() . ' - Атрибуты: ';
        foreach ($attributes as $attribute) {
            echo $attribute->get_name() . ', ';
        }
        echo '</li>';
    }
    echo '</ul>';
} else {
    echo '<p>Товары не найдены для текущей категории.</p>';
}

// Сбрасываем запрос
wp_reset_postdata();
?>

<section>
<div class="products-filter">
    <div id="brand">
        <span>Бренд</span>
        <?php foreach ($brands as $brand) : ?>
            <label>
                <input type="checkbox" name="brands[]" value="<?php echo esc_attr($brand->slug); ?>" data-url="<?php echo esc_url(get_term_link($brand)); ?>">
                <?php echo esc_html($brand->name); ?>
            </label>
        <?php endforeach; ?>
    </div>

    <div id="category">
        <span>Категория</span>
        <?php if (!is_wp_error($subcategories) && !empty($subcategories)) : ?>
            <?php foreach ($subcategories as $subcategory) : ?>
                <label>
                    <input type="checkbox" name="categories[]" value="<?php echo esc_attr($subcategory->slug); ?>" data-url="<?php echo esc_url(get_term_link($subcategory)); ?>">
                    <?php echo esc_html($subcategory->name); ?>
                </label>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Подкатегории не найдены или произошла ошибка при получении</p>
        <?php endif; ?>
    </div>

    <div id="product_attributes">
        <span>Тип товара</span>
        <?php foreach ($product_attributes as $attribute_name => $terms) : ?>
            <?php foreach ($terms as $term) : ?>
                <label>
                    <input type="checkbox" name="product_attributes[<?php echo esc_attr($attribute_name); ?>][]" value="<?php echo esc_attr($term->slug); ?>">
                    <?php echo esc_html($term->name); ?>
                </label>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>

    <button id="your-button-id">Фильтровать</button>
</div>
</section>
