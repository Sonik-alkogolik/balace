<?php
/*
Template Name: Доставка и оплата
*/
get_header();
?>

<section>
<div class="delivery-wrapp">
    <div class="delivery-item left">
        <div class="delivery-title">
        <h1 class="h3 text_main">
            <?php 
            the_title();
            ?>
        </h1>
        <div class="delivery-title-bottom">
        <p>действует быстрая доставка</p>
        <a class="btn_go_catalog primery_main h6 text_main" href="/product-category/balace/">
                <span>Перейти в каталог </span>    
            </a>
        </div>
        </div>
      </div>
      <div class="delivery-item right">
              <?php 
                the_content();
              ?>
      </div>
    </div>


</section>


<?php
get_footer();
?>
