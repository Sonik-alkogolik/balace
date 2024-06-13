<section>
<?php
$home_about_group = get_field('home-about-group');
if ($home_about_group) {
    $text_title = $home_about_group['text_title'];
    $description = $home_about_group['deskription'];
    $img = $home_about_group['img'];
    $text_below_description1 = $home_about_group['text_below_description1'];
    $img_below_deskription_1 = $home_about_group['img_below_deskription_1'];
    $text_below_description2 = $home_about_group['text_below_description2'];
    $img_below_deskription_2 = $home_about_group['img_below_deskription_2'];
    $text_below_description3 = $home_about_group['text_below_description3'];
    $img_below_deskription_3 = $home_about_group['img_below_deskription_3'];
?>
    <div class="about-product-wrapp">
        <div class="about-product-content">
        <div class="about-product-item img">
            <img src="<?php echo esc_url($img); ?>" alt="">
        </div>
        <div class="about-product-item deskription">
            <div class="about-product-deskription-title">
                <h3 class="h3"><?php echo esc_html($text_title); ?></h3>
                <p class="body1"><?php echo esc_html($description); ?></p>
            </div>

            <a  class="btn_learn_more h6" href="">Узнать больше</a>

            <div class="below_item_wrapp">
            <div class="below_item">
                <img src="<?php echo esc_url($img_below_deskription_1); ?>" alt="">
                <p class="h6"><?php echo esc_html($text_below_description1); ?></p>
            </div>
            <div class="below_item">
                <img src="<?php echo esc_url($img_below_deskription_2); ?>" alt="">
                <p class="h6"><?php echo esc_html($text_below_description2); ?></p>
            </div>
            <div class="below_item">
                <img src="<?php echo esc_url($img_below_deskription_3); ?>" alt="">
                <p class="h6"><?php echo esc_html($text_below_description3); ?></p>
            </div>
            </div>
        </div>
        </div>
    </div>
<?php
} else {
    //echo 'No fields found';
}
?>
</section>