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

// Отладочная информация: вывод товаров текущей категории
if ($products_query->have_posts()) {
    echo '<h2>Товары текущей категории:</h2>';
    echo '<ul>';
    while ($products_query->have_posts()) {
        $products_query->the_post();
        global $product;

        // Получаем атрибуты товара
        $product_attributes = $product->get_attributes();

        // Отладочная информация: вывод атрибутов товара
        echo '<li>' . get_the_title() . ' - Атрибуты: ';
        foreach ($product_attributes as $attribute) {
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
            <!-- Ваш код для вывода брендов здесь -->
        </div>

        <div id="category">
            <span>Категория</span>
            <!-- Ваш код для вывода подкатегорий здесь -->
        </div>

        <select id="product_type" name="product_type">
            <option value="">Тип товара</option>
            <!-- Ваш код для вывода типов товара (атрибутов) здесь -->
        </select>

        <button id="your-button-id">Фильтровать</button>
    </div>
</section>
