<?php
/*
Template Name: Отзывы
*/
get_header();
?>


<?php

$rating_counts = array(
    5 => 0,
    4 => 0,
    3 => 0,
    2 => 0,
    1 => 0,
);
$total_rating_sum = 0;
$total_posts = 0;
$args = array(
    'post_type' => 'journal',
    'post_status' => 'publish',
    'posts_per_page' => -1,
);

$query = new WP_Query($args);
if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        $rating = get_post_meta(get_the_ID(), '_journal_rating', true);
        if (is_numeric($rating) && isset($rating_counts[$rating])) {
            $rating_counts[$rating]++;
            $total_rating_sum += $rating;
            $total_posts++;
        }
    }
    wp_reset_postdata();
}
$average_rating = $total_posts > 0 ? $total_rating_sum / $total_posts : 0;
foreach ($rating_counts as $stars => $count) {
    echo '<p>' . $stars . ' звёзд: ' . $count . '</p>';
}
echo '<p>' . round($average_rating, 1) . ' / 5</p>';
?>



<?php 
$args = array(
    'post_type' => 'journal',
    'post_status' => 'publish',
    'posts_per_page' => -1, 
);

$journal_query = new WP_Query($args);

if ($journal_query->have_posts()) : 
    while ($journal_query->have_posts()) : $journal_query->the_post(); 
        $rating = get_post_meta(get_the_ID(), '_journal_rating', true);
        $last_name = get_post_meta(get_the_ID(), '_journal_last_name', true);
        $first_name = get_post_meta(get_the_ID(), '_journal_first_name', true);
        ?>
        <div class="reviews-wrapp">
            <div class="reviews-row left">
            <p>
        <?php 
        $title = get_the_title();
        $first_letter = mb_substr($title, 0, 1);

        if ($title === 'Анонимный') {
            echo '<img src="/wp-content/themes/balace/img/icon/anonim.png" alt="Анонимный">';
        } else {
            echo $first_letter; 
        }
        ?>
    </p>
            </div>
            <div class="reviews-row right">
                <?php
                $title = get_the_title();
                $words = explode(' ', $title);
                if (isset($words[1])) {
                    $second_word_first_letter = mb_substr($words[1], 0, 1, 'UTF-8');
                    $new_title = $words[0] . ' ' . $second_word_first_letter;
                } else {
                    $new_title = $title;
                }
                echo '<h2>' . esc_html($new_title) . '.</h2>';
                ?>
                <p><strong>Оценка:</strong> <?php echo esc_html($rating); ?> </p>
            <div class="star-rating" data-rating="<?php echo esc_attr($rating); ?>">
                <img alt="1" src="http://balace/wp-content/plugins/star-rating-field-for-contact-form-7/public/jquery.rating/images/star-off.png" data-value="1">
                <img alt="2" src="http://balace/wp-content/plugins/star-rating-field-for-contact-form-7/public/jquery.rating/images/star-off.png" data-value="2">
                <img alt="3" src="http://balace/wp-content/plugins/star-rating-field-for-contact-form-7/public/jquery.rating/images/star-off.png" data-value="3">
                <img alt="4" src="http://balace/wp-content/plugins/star-rating-field-for-contact-form-7/public/jquery.rating/images/star-off.png" data-value="4">
                <img alt="5" src="http://balace/wp-content/plugins/star-rating-field-for-contact-form-7/public/jquery.rating/images/star-off.png" data-value="5">
            </div>
            </div>
                </div> 
                <div class="content">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    <?php endwhile;
    wp_reset_postdata();
else :
    echo '<p>Нет отзывов</p>';
endif;

?>

<?php echo do_shortcode('[contact-form-7 id="3cfea36" title="Form reviews"]'); ?>
<?php
get_footer();
?>
