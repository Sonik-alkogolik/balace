<section>
    <div class="blog-wrapp">
        <div class="blog-item-title mob">
                        <h3 class="h3">Блог</h3>
                    </div>
        <?php
        $args_first_post = array(
            'post_type' => 'blog',
            'posts_per_page' => 1, 
        );
        $query_first_post = new WP_Query($args_first_post);

        if ($query_first_post->have_posts()) :
            while ($query_first_post->have_posts()) : $query_first_post->the_post();
                ?>
                 <div class="blog-wrapp-item left-item">
                   <div class="blog-item-title tablet">
                        <h3 class="h3">Блог</h3>
                        <a class="btn_learn_more h6" href="<?php the_permalink(); ?>">Узнать больше</a>
                     </div>
                     <a href="<?php echo esc_url(get_permalink()); ?>" class="post-link">
                        <div class="thumbnail">
                            <?php the_post_thumbnail(); ?>
                        </div>
                        <div class="blog-wrapp-item-content-tablet">
                        <div class="title">
                            <h4 class="h4 text_main"><?php the_title(); ?></h4>
                        </div>
                        <div class="description h6 text_main">
                        <?php
                            $excerpt = get_the_excerpt();
                            echo wp_trim_words($excerpt, 12, '...');
                            ?>
                        </div>
                        <div class="publish-date h6 text_main ">
                            <?php echo get_the_date(); ?>
                        </div>
                        </div>
                       </a>
                    </div>
            <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
        <div class="blog-wrapp-item right-item">
                    <div class="blog-item-title desktop">
                        <h3 class="h3">Блог</h3>
                        <a class="btn_learn_more h6" href="/блог/">Узнать больше</a>
                    </div>
               
            <div class="blog-news-wrapp desktop">
            <?php
            $args_news = array(
                'post_type' => 'blog',
                'posts_per_page' => 3,
                'offset' => 1, 
            );
            $query_news = new WP_Query($args_news);

            if ($query_news->have_posts()) :
                while ($query_news->have_posts()) : $query_news->the_post();
                    ?>
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="post-link">
                <div class="blog-news-item">
                    <div class="thumbnail">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <div class="title">
                        <h4 class="h6"><?php the_title(); ?></h4>
                    </div>
                    <div class="publish-date">
                        <p class="body1"><?php echo get_the_date(); ?></p>
                    </div>
                </div>
            </a>
                <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
            </div>
        </div>
        <a class="btn_learn_more blog-mob h6" href="/блог/">Узнать больше</a>
    </div>
</section>
