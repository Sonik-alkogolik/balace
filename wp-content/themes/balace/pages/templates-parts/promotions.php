
<section>
                <div class="promotional-wrapp">
                    <div class="promotional-item left">
                     <div class="promotional-title h3">Наши текущие акции</div>
                     <div class="slider-btn-wrapp">
                       <div class="promotional-button-next btn_slider_left"></div>
                       <div class="promotional-button-prev btn_slider_right"></div>
                    </div>
                   </div>
                   <div class="promotional-item right">
                      <div class="swiper-container promotional-swiper">
                         <div class="swiper-wrapper">
                        <?php
                            $args = array(
                                'post_type' => 'promotions',
                                'posts_per_page' => -1, 
                            );

                            $query = new WP_Query( $args );

                            if ( $query->have_posts() ) : 
                                while ( $query->have_posts() ) : $query->the_post();
                                    ?>
                                    <div class="swiper-slide promotional-slide">
                                        <div class="promotional-slider-content">
                                            <p class="h6"><?php the_title(); ?></p>
                                            <span class="overline"><?php echo get_the_date( 'd.m.y' ); ?></span>
                                            <?php if ( has_post_thumbnail() ) : ?>
                                                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>">
                                            <?php else : ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/img/default-placeholder.png" alt="Default Image">
                                            <?php endif; ?>
                                            <a class="caption text_main" href="<?php the_permalink(); ?>">подробнее</a>
                                        </div>
                                    </div>
                                    <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                    </div>
                
                </div>
                  </div>
                </div>
        </section>