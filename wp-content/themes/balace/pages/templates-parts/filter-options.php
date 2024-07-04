<?php
// Получаем категорию
$current_category_slug = get_query_var('product_cat');
if ($current_category_slug) {
    $current_category = get_term_by('slug', $current_category_slug, 'product_cat');
    $current_category_id = $current_category ? $current_category->term_id : 0;
    $subcategories = get_terms(array(
        'taxonomy' => 'product_cat',
        'hide_empty' => false,
        'parent' => $current_category_id,
    ));
}

// бренды 
$brands = get_terms(array(
    'taxonomy' => 'product_cat',
    'hide_empty' => false,
    'exclude' => '20',
    'parent' => 0,
));

$product_types = get_terms( array(
    'taxonomy'   => 'pa_тип-товара', 
    'hide_empty' => false, 
) );
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
    <?php if (!empty($subcategories)) : ?>
        <?php foreach ($subcategories as $subcategory) : ?>
            <label>
                <input type="checkbox" name="categories[]" value="<?php echo esc_attr($subcategory->slug); ?>" data-url="<?php echo esc_url(get_term_link($subcategory)); ?>">
                <?php echo esc_html($subcategory->name); ?>
            </label>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

        <select id="product_type" name="product_type">
            <option value="">Тип товара</option>
            <?php foreach ($product_types as $type) : ?>
                <option value="<?php echo esc_attr($type->name); ?>" data-url="<?php echo esc_url(get_term_link($type)); ?>">
                    <?php echo esc_html($type->name); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button id="your-button-id">Категория</button>
                

    </div>
</section>

