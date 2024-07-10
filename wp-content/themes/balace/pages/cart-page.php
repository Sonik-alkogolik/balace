<?php
/*
Template Name: Корзина
*/
get_header();
?>

<?php 
echo do_shortcode('[woocommerce_cart]');
?>

<?php
get_footer();
?>