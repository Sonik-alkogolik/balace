<?php
/*
Template Name: Отзывы
*/
get_header();
?>

<section>

    <div class="block-title">
            <div class="block-title-content">
                <div class="block-title-row left">
                    <h1 class="h3 text_main"><?php 
                    the_title();
                    ?>
                    </h1>
                </div>
                <div class="block-title-row right">
             <div class="progress-bar-wrapp">
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
                            echo '<div class="progress-wrapp">';
                            echo '<div class="porgress-item">';
                            echo '<p class="caption">' . $stars . ' звёзд </p>';
                            echo '<img class="star-progress-bar" src="/wp-content/plugins/star-rating-field-for-contact-form-7/public/jquery.rating/images/star-on.png"> ';
                            echo '</div>';
                            echo '<progress value="'. $count .'" max="'. $total_posts .'"><div id="progress" class="graph"><div id="bar" style="width:34%"><p></p></div></div></progress> <span  class="caption">' . $count . '</span>';
                            echo '</div>';
                        }
                       
                        ?>
                    </div>
                      <div class="total_posts_btn_wrapp">
                        <?php 
                             echo '<p>' . round($average_rating, 1) . ' / 5 <img class="star-progress-bar" src="/wp-content/plugins/star-rating-field-for-contact-form-7/public/jquery.rating/images/star-on.png"> </p>';
                            echo '<button class="total_posts_btn">';
                            echo $total_posts;
                            echo '  отзывов </button>';
                        ?>
                   </div>
                </div>
            </div>

       </div>





        <?php 
        $args = array(
            'post_type' => 'journal',
            'post_status' => 'publish',
            'posts_per_page' => -1, 
        );

        $journal_query = new WP_Query($args);
         ?>
    <div class="reviews-wrapp">
        
       <?php 
          if ($journal_query->have_posts()) : 
            while ($journal_query->have_posts()) : $journal_query->the_post(); 
                $rating = get_post_meta(get_the_ID(), '_journal_rating', true);
                $last_name = get_post_meta(get_the_ID(), '_journal_last_name', true);
                $first_name = get_post_meta(get_the_ID(), '_journal_first_name', true);
        ?>
         <div class="reviews-row-item">
            <div class="reviews-row-item-content">
            <div class="reviews-row left">
                <div class="icon-wrapp">
                    <div class="icon-item">
                        <p>
                            <?php 
                                $title = get_the_title();
                                $first_letter = mb_substr($title, 0, 1);

                                if ($title === 'Анонимный') {
                                    echo '<img class="anonim-img" src="/wp-content/themes/balace/img/icon/anonim.png" alt="Анонимный">';
                                } else {
                                    echo $first_letter; 
                                }
                            ?>
                        </p>
                    </div>
                </div>
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
                      

                            <div class="content">
                            <?php the_content(); ?>
                          </div>

                        <div class="rating-item">
                            <div class="star-rating" data-rating="<?php echo esc_attr($rating); ?>">
                                <img alt="1" src="http://balace/wp-content/plugins/star-rating-field-for-contact-form-7/public/jquery.rating/images/star-off.png" data-value="1">
                                <img alt="2" src="http://balace/wp-content/plugins/star-rating-field-for-contact-form-7/public/jquery.rating/images/star-off.png" data-value="2">
                                <img alt="3" src="http://balace/wp-content/plugins/star-rating-field-for-contact-form-7/public/jquery.rating/images/star-off.png" data-value="3">
                                <img alt="4" src="http://balace/wp-content/plugins/star-rating-field-for-contact-form-7/public/jquery.rating/images/star-off.png" data-value="4">
                                <img alt="5" src="http://balace/wp-content/plugins/star-rating-field-for-contact-form-7/public/jquery.rating/images/star-off.png" data-value="5">
                            </div> 
                            <?php 
                                    if ($rating == 5) {
                                        echo esc_html($rating) . ' звёзд';
                                    } else {
                                        echo esc_html($rating) . ' звезды';
                                    }
                            ?>
                         </div>
                           
                    </div>
                </div>

             </div>

     <?php 
         endwhile;
            wp_reset_postdata();
        else :
            echo '<p>Нет отзывов</p>';
        endif;

        ?>       
    </div>
    <?php echo do_shortcode('[contact-form-7 id="3cfea36" title="Form reviews"]'); ?>

    <div class="send-popup">
        <div class="send-content">
          <p>Ваш отзыв успешно отправлен! </p>
          <span>Служба поддержки проверит и опубликует ваш отзыв.</span>
            <button class="close-popup-btn">Хорошо</button>
        </div>
      </div>
</section>

<?php
get_footer();
?>
