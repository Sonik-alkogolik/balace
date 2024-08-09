<?php
/*
Template Name: Список желаний
*/
get_header();
?>
    <section>
        <?php 
        echo do_shortcode('[ti_wishlistsview]');
        ?>
    </section>
<?php
get_footer();
?>