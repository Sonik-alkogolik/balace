<?php
/*
Template Name: Страница сравнения товаров
*/
get_header();
?>

<script type="text/javascript">
        // var timeToReload = 25000; 
        // function reloadPage() {
        //     window.location.reload();
        // }
        // setTimeout(reloadPage, timeToReload);
    </script>
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
