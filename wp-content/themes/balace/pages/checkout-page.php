<?php
/*
Template Name: Оформление заказа
*/
get_header();
?>

<?php 
echo do_shortcode('[woocommerce_checkout]');
?>

<?php
get_footer();
?>