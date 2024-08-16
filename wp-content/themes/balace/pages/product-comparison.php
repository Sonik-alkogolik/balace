<?php
/*
Template Name: Страница сравнения товаров
*/
get_header();
?>


<section> 
    <div class="compare-title">
        <h1>Сравнения товаров</h1>
    </div>
    <div class="wrapp-btn-compare-mob">

    </div>
</section>


<section class="compare-wrapp">
<?php 
   echo do_shortcode('[evercompare_table]'); 
?>
</section>


<?php
get_footer();
?>
