<?php
/*
Template Name: Категории каталога balace natural
*/
get_header();
?>

<section>
<div class="wrapper_catalog">
        <div class="wrapper-catalog-category">
           <div class="catalog-top-content">
                <div class="catalog-category-title">
                        <?php
                        $subcategory_id = 34;
                        $subcategory = get_term($subcategory_id, 'product_cat');
                        if ($subcategory) {
                        echo '<h2>' . $subcategory->name . '</h2>';
                        $args = array(
                                'taxonomy' => 'product_cat',
                                'child_of' => $subcategory_id,
                                'hide_empty' => false,
                        );
                        $child_categories = get_categories($args);
                        if ($child_categories) {
                                echo '<p>';
                                foreach ($child_categories as $child_category) {
                                echo '<a href="' . get_category_link($child_category->term_id) . '">' . $child_category->name . '</a>, ';
                                }
                                echo '</p>';
                        }
                        }
                        ?>
                  </div>
                <div class="catalog-category-description">
                        <?php
                        if ($subcategory) {
                        echo '<p>' . $subcategory->description . '</p>';
                        }
                        ?>
                  </div>
                </div>

             <div class="catalog-category-product">
                <?php
                    echo do_shortcode('[products limit="4" columns="3" category="34"]');
                ?>
            </div>
        </div>
        <div class="wrapper-catalog-category">
           <div class="catalog-top-content">
                <div class="catalog-category-title">
                        <?php
                        $subcategory_id = 35;
                        $subcategory = get_term($subcategory_id, 'product_cat');
                        if ($subcategory) {
                        echo '<h2>' . $subcategory->name . '</h2>';
                        $args = array(
                                'taxonomy' => 'product_cat',
                                'child_of' => $subcategory_id,
                                'hide_empty' => false,
                        );
                        $child_categories = get_categories($args);
                        if ($child_categories) {
                                echo '<p>';
                                foreach ($child_categories as $child_category) {
                                echo '<a href="' . get_category_link($child_category->term_id) . '">' . $child_category->name . '</a>, ';
                                }
                                echo '</p>';
                        }
                        }
                        ?>
                  </div>
                <div class="catalog-category-description">
                        <?php
                        if ($subcategory) {
                        echo '<p>' . $subcategory->description . '</p>';
                        }
                        ?>
                  </div>
                </div>

             <div class="catalog-category-product">
                <?php
                echo do_shortcode('[products limit="4" columns="3" category="35"]');
                ?>
            </div>
        </div>
        <div class="wrapper-catalog-category">
           <div class="catalog-top-content">
                <div class="catalog-category-title">
                        <?php
                        $subcategory_id = 36;
                        $subcategory = get_term($subcategory_id, 'product_cat');
                        if ($subcategory) {
                        echo '<h2>' . $subcategory->name . '</h2>';
                        $args = array(
                                'taxonomy' => 'product_cat',
                                'child_of' => $subcategory_id,
                                'hide_empty' => false,
                        );
                        $child_categories = get_categories($args);
                        if ($child_categories) {
                                echo '<p>';
                                foreach ($child_categories as $child_category) {
                                echo '<a href="' . get_category_link($child_category->term_id) . '">' . $child_category->name . '</a>, ';
                                }
                                echo '</p>';
                        }
                        }
                        ?>
                  </div>
                <div class="catalog-category-description">
                        <?php
                        if ($subcategory) {
                        echo '<p>' . $subcategory->description . '</p>';
                        }
                        ?>
                  </div>
                </div>

             <div class="catalog-category-product">
                <?php
                echo do_shortcode('[products limit="4" columns="3" category="36"]');
                ?>
            </div>
        </div>
</section>




<?php
get_footer();
?>
