<?php
/*
Template Name: Главная
*/
get_header();
?>
<?php get_template_part( 'pages/templates-parts/home-page-top' ); ?>
<?php get_template_part( 'pages/templates-parts/product-brands' ); ?>
<?php get_template_part( 'pages/templates-parts/promotions' ); ?>
<?php get_template_part( 'pages/templates-parts/catalog-product' ); ?>
</div>
<?php get_template_part( 'pages/templates-parts/marquee' ); ?>

<div class="contaner">
<?php get_template_part( 'pages/templates-parts/advantages' ); ?> 
<?php get_template_part( 'pages/templates-parts/about-product' ); ?> 
<?php get_template_part( 'pages/templates-parts/blog-template' ); ?> 
</div>


<?php
get_footer();
?>
