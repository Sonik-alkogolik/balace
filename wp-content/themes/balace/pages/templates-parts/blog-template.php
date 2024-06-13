<section>
    <div class="blog-wrapp">
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
                  <a href="<?php echo esc_url(get_permalink()); ?>" class="post-link">
                        <div class="thumbnail">
                            <?php the_post_thumbnail(); ?>
                        </div>
                        <div class="title">
                            <h4 class="h4 text_main"><?php the_title(); ?></h4>
                        </div>
                        <div class="description h6 text_main">
                            <?php the_excerpt(); ?>
                        </div>
                        <div class="publish-date h6 text_main ">
                            <?php echo get_the_date(); ?>
                        </div>
                    </a>
                    </div>
            <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
 <div class="blog-wrapp-item right-item">
                    <div class="blog-item-title">
                        <h3 class="h3">Блог</h3>
                        <a class="btn_learn_more h6" href="<?php the_permalink(); ?>">Узнать больше</a>
                    </div>
               
        <div class="blog-news-wrapp">
            <?php
            $args_news = array(
                'post_type' => 'blog',
                'posts_per_page' => 2,
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
    </div>
</section>
