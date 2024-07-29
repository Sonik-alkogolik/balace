<?php
/*
Template Name: Акции
*/
get_header();
?>

    <section>
        <div class="promotion-wrapp">
    <?php
            $args = array(
                'post_type' => 'promotions',
                'posts_per_page' => -1,
                );

                 $query = new WP_Query( $args );

                if ( $query->have_posts() ) :
                    while ( $query->have_posts() ) : $query->the_post();
                    $date_event = get_field('date_event');
                    ?>
                        <div class="promotion-item background_main">
                            <div class="promotion-column-left">
                                <div class="promotion-title-content">
                                 <p class="promotion-item-title"><?php the_title(); ?></p>
                                 <p class="promotion-subtitle">познакомьтесь с победителями</p>
                               </div>
                              <div class="promotion-dates">
                                  <button class="promotion-link-button">
                                    <a href="<?php the_permalink(); ?>" class="promotion-link">подробнее</a>
                                 </button>
                                 <p><?php echo esc_html($date_event); ?></p>
                              </div>
                            </div>
                            <div class="promotion-column-right">
                            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>">
                            </div>
                        </div>

                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
        </div>
    </section>
<?php
get_footer();
?>
