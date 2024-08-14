<?php
/*
Template Name: Лицензии
*/
get_header();
?>

<section>
    <div class="licenses-title">
    <h1>
        <?php 
          the_title();
        ?>
    </h1>
    </div>


    <div class="licenses-wrapp">
        <?php
                $args = array(
                    'post_type' => 'licenses',
                    'posts_per_page' => -1
                );

                $licenses_query = new WP_Query($args);

                if ($licenses_query->have_posts()) : 
                    while ($licenses_query->have_posts()) : $licenses_query->the_post(); ?>
                        <div class="licenses-item">
                            <div class="licenses-item-title">
                                <?php the_title(); ?>
                            </div>
                            <div class="licenses-item-img">
                                <?php the_post_thumbnail('full'); ?>
                            </div>
                            <div class="open-document">
                                Открыть документ
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                else : ?>
                    <p>Лицензии не найдены.</p>
        <?php endif; ?>
    </div>


</section>


<?php
get_footer();
?>
