<?php get_header(); ?>
<?php    $date_event = get_field('date_event'); ?>
<section>
    <div class="single-promotion-wrapp background_main">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="single-promotion-item-left">
      <div class="single-promotion-item-content-wrapp">
    <div class="single-promotion-title">
        <h1><?php the_title(); ?></h1>
      </div>
      <div class="single-promotion-content-top">
          <?php //the_content(); ?>
      </div>
      </div>
      <div class="single-promotion-dates">
        <p><?php echo esc_html($date_event); ?></p>
      </div>
      </div>
      <div class="single-promotion-item-right">
        <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>">
      </div>
      <?php endwhile; else: ?>
    <?php endif; ?>
</div>
<div class="single-promotion-content-bottom">
  <div class="single-promotion-content-text">
      <?php the_content();?>
  </div>
</section>

<?php get_footer(); ?>