<?php
/*
Template Name: Категории каталога balace
*/
get_header();
?>
<section>

    <?php 
    $subcategory_id_first = 34;
    $subcategory_first = get_term($subcategory_id_first, 'product_cat');
 
    $subcategory_id_second = 35;
    $subcategory_second = get_term($subcategory_id_second, 'product_cat');

    $subcategory_id_third = 36;
    $subcategory_third = get_term($subcategory_id_third, 'product_cat');
    ?>
    <div class="wrapper_catalog">
        <div class="wrapper-catalog-category first clickable" data-url="<?php echo esc_url(get_term_link($subcategory_id_first, 'product_cat')); ?>">
            <div class="catalog-top-content">
                <div class="catalog-category-title">
                    <?php if ($subcategory_first) : ?>
                        <h2 class="h3"><?php echo esc_html($subcategory_first->name); ?></h2>
                        <?php
                        $args = array(
                            'taxonomy' => 'product_cat',
                            'child_of' => $subcategory_id_first,
                            'hide_empty' => false,
                        );
                        $child_categories = get_categories($args);
                        ?>
                        <?php if ($child_categories) : ?>
                            <div class="category_child_title_link">
                                <?php foreach ($child_categories as $child_category) : ?>
                                    <a class="subtitle1 text_dark" href="<?php echo esc_url(get_category_link($child_category->term_id)); ?>"><?php echo esc_html($child_category->name); ?></a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="catalog-category-description">
                    <?php if ($subcategory_first) : ?>
                        <p class="body1"><?php echo esc_html($subcategory_first->description); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="catalog-category-product">
                <?php echo do_shortcode('[products limit="4" columns="3" category="'.$subcategory_id_first.'"]'); ?>
            </div>
            <div class="description-bottom-link desktop">
                <a class="h6 text_dark" href="<?php echo esc_url(get_term_link($subcategory_id_first, 'product_cat')); ?>">перейти в каталог</a>
            </div>
        </div>
        
        <div class="wrapper-catalog-category second clickable" data-url="<?php echo esc_url(get_term_link($subcategory_id_second, 'product_cat')); ?>">
            <div class="catalog-top-content">
                <div class="catalog-category-title">
                    <?php if ($subcategory_second) : ?>
                        <h2 class="h3"><?php echo esc_html($subcategory_second->name); ?></h2>
                        <?php
                        $args = array(
                            'taxonomy' => 'product_cat',
                            'child_of' => $subcategory_id_second,
                            'hide_empty' => false,
                        );
                        $child_categories = get_categories($args);
                        ?>
                        <?php if ($child_categories) : ?>
                            <div class="category_child_title_link">
                                <?php foreach ($child_categories as $child_category) : ?>
                                    <a class="subtitle1 text_dark" href="<?php echo esc_url(get_category_link($child_category->term_id)); ?>"><?php echo esc_html($child_category->name); ?></a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="catalog-category-description">
                    <?php if ($subcategory_second) : ?>
                        <p class="body1"><?php echo esc_html($subcategory_second->description); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="catalog-category-product">
                <?php echo do_shortcode('[products limit="4" columns="3" category="'.$subcategory_id_second.'"]'); ?>
            </div>
            <div class="description-bottom-link desktop">
                <a class="h6 text_dark" href="<?php echo esc_url(get_term_link($subcategory_id_second, 'product_cat')); ?>">перейти в каталог</a>
            </div>
        </div>
        
        <div class="wrapper-catalog-category third clickable" data-url="<?php echo esc_url(get_term_link($subcategory_id_third, 'product_cat')); ?>">
            <div class="catalog-top-content">
                <div class="catalog-category-title">
                    <?php if ($subcategory_third) : ?>
                        <h2 class="h3"><?php echo esc_html($subcategory_third->name); ?></h2>
                        <?php
                        $args = array(
                            'taxonomy' => 'product_cat',
                            'child_of' => $subcategory_id_third,
                            'hide_empty' => false,
                        );
                        $child_categories = get_categories($args);
                        ?>
                        <?php if ($child_categories) : ?>
                            <div class="category_child_title_link">
                                <?php foreach ($child_categories as $child_category) : ?>
                                    <a class="subtitle1 text_dark" href="<?php echo esc_url(get_category_link($child_category->term_id)); ?>"><?php echo esc_html($child_category->name); ?></a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="catalog-category-description">
                    <?php if ($subcategory_third) : ?>
                        <p class="body1"><?php echo esc_html($subcategory_third->description); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="catalog-category-product">
                <?php echo do_shortcode('[products limit="4" columns="3" category="'.$subcategory_id_third.'"]'); ?>
            </div>
            <div class="description-bottom-link desktop">
                <a class="h6 text_dark" href="<?php echo esc_url(get_term_link($subcategory_id_third, 'product_cat')); ?>">перейти в каталог</a>
            </div>
        </div>

 
        <div class="description-bottom-catalog-category">
                <div class="item left">
                    <p class="h6">В основе нашей компании лежит стремление создавать продукты, которые сочетают в себе мощь природы и передовые технологии. Мы верим, что красота должна быть в гармонии со здоровьем, поэтому каждый наш продукт разработан с использованием только натуральных, органических ингредиентов</p>
                </div>
                <div class="item right">
                    <img src="/wp-content/themes/balace/img/catalog-page/bottom-catalog-category-balace.png" alt="">
                </div>
        </div>
            <div class="description-bottom-link">
                <a class="h6 text_dark" href="<?php echo esc_url(get_term_link($subcategory_id_third, 'product_cat')); ?>">перейти в каталог</a>
            </div>


    </div>
</section>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var clickableBlocks = document.querySelectorAll('.wrapper-catalog-category.clickable');
        
        clickableBlocks.forEach(function(block) {
            block.addEventListener('click', function() {
                var url = block.getAttribute('data-url');
                if (url) {
                    window.location.href = url;
                }
            });
        });
    });
</script>

<?php
get_footer();
?>
