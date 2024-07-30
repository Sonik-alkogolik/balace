<?php
/*
Template Name: Блог
*/
get_header();
?>


<section>
<div class="blog-wrapp">
    <div class="blog-titel">
        <h1>Блог</h1>
    </div>
    <div class="blog-item-wrapp">
    <?php
    // Ваши параметры запроса
    $args_first_post = array(
        'post_type' => 'blog',
        'posts_per_page' => 10, 
        'paged' => get_query_var('paged') ? get_query_var('paged') : 1 
    );
    $first_post_query = new WP_Query($args_first_post);
    
    if ($first_post_query->have_posts()) :
        $post_count = 0; 
        ?>

        <div class="blog-item-wrapp-top">
            <?php
            while ($first_post_query->have_posts()) : $first_post_query->the_post();
                $post_id = get_the_ID();
                $post_title = get_the_title();
                $post_excerpt = get_the_excerpt();
                $post_date = get_the_date();
                $post_thumbnail_url = get_the_post_thumbnail_url($post_id, 'full'); 
                $post_permalink = get_permalink();
                if ($post_count < 3) :
                    ?>
                    <div class="blog-item">
                        <a href="<?php echo esc_url($post_permalink); ?>" class="blog-item-link">
                            <img src="<?php echo esc_url($post_thumbnail_url); ?>" alt="<?php echo esc_attr($post_title); ?>">
                            <div class="blog-item-description">
                                <div class="blog-item-date"><?php echo esc_html($post_date); ?></div>
                                <div class="blog-item-title"><p><?php echo esc_html($post_title); ?></p></div>
                                <div class="blog-item-excerpt"><?php
                            $excerpt = get_the_excerpt();
                            echo wp_trim_words($excerpt, 20, '...');
                            ?></div>
                            </div>
                        </a>
                    </div>
                    <?php
                endif;
                $post_count++;
            endwhile;
            ?>
        </div>

        <div class="blog-item-wrapp-bottom">
            <?php
            $post_count = 0;
            $first_post_query->rewind_posts();
            while ($first_post_query->have_posts()) : $first_post_query->the_post();
                if ($post_count >= 3) :
                    $post_id = get_the_ID();
                    $post_title = get_the_title();
                    $post_excerpt = get_the_excerpt();
                    $post_date = get_the_date();
                    $post_thumbnail_url = get_the_post_thumbnail_url($post_id, 'full'); 
                    $post_permalink = get_permalink();
                    ?>
                    <div class="blog-item">
                        <a href="<?php echo esc_url($post_permalink); ?>" class="blog-item-link">
                            <img src="<?php echo esc_url($post_thumbnail_url); ?>" alt="<?php echo esc_attr($post_title); ?>">
                            <div class="blog-item-description">
                                <div class="blog-item-date"><?php echo esc_html($post_date); ?></div>
                                <div class="blog-item-title"><p><?php echo esc_html($post_title); ?></p></div>
                                <div class="blog-item-excerpt"><?php
                            $excerpt = get_the_excerpt();
                            echo wp_trim_words($excerpt, 12, '...');
                            ?></div>
                            </div>
                        </a>
                    </div>
                    <?php
                endif;
                $post_count++;
            endwhile;
            ?>

            <?php
            // Сброс данных
            wp_reset_postdata();
            ?>
        </div>

    <?php
    else :
        echo '<p>No posts found.</p>';
    endif;
    ?>
</div>


<!-- Пагинация -->

<?php
$total_pages = $first_post_query->max_num_pages;
$current_page = max(1, get_query_var('paged'));
$pagination_args = array(
    'total' => $total_pages,
    'current' => $current_page,
    'prev_text' => '',
    'next_text' => '',
);
$pagination_links = paginate_links($pagination_args);

echo '<div class="pagination">';

if ($current_page > 1) {
    $prev_link = get_pagenum_link($current_page - 1);
    echo '<a class="pagination-prev" href="' . esc_url($prev_link) . '">Предыдущая</a>';
}else {
    echo '<a class="pagination-prev no-link">Предыдущая</a>';
}

echo '<div class="num-page-pagin">';
echo $pagination_links;
echo '</div>';

if ($current_page < $total_pages) {
    $next_link = get_pagenum_link($current_page + 1);
    echo '<a class="pagination-next" href="' . esc_url($next_link) . '">Следующая</a>';
}

echo '</div>';
?>


<!-- /Пагинация -->
</div>

</section>
<?php
get_footer();
?>
