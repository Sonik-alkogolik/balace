<?php
/*
Template Name: Контакты
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
<div class="contact-wrapp">
    <div class="contact-title">
        <h1 class="h3 text_main">
          <?php the_title()?>
        </h1>
    </div>

    <div class="contact-info-block">
        <div class="contact-info-item">
            <p>Телефон</p>
            <a href="<?php echo esc_html(get_field('telephone_contact')); ?>"><?php echo esc_html(get_field('telephone_contact')); ?></a>
            
        </div>
        <div class="contact-info-item">
            <p>E-mail</p>
            <a href="<?php echo esc_html(get_field('e_mail_contact')); ?>"><?php echo esc_html(get_field('e_mail_contact')); ?></a>
        </div>
        <div class="contact-info-item">
            <p>Юридический адрес</p>
            <span><?php echo esc_html(get_field('legal_address')); ?></span>
        </div>
    </div>
    <div class="btn-form-wrapp">
        <button class="btn-form-popup">Связаться</button>
    </div>
    <div class="contact-map">
    <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A534e1450a21574e5323b24afceefc1e7310ff06f31c1affc4e01fcbf9a4cf158&amp;width=100%&amp;height=100%&amp;lang=ru_RU&amp;scroll=true"></script>
    </div>
</div>
</section>

  <div class="popup-wrapp-container">
      <div class="popup-content">
       <?php echo do_shortcode('[contact-form-7 id="fc6df74" title="Form Contact page"]'); ?>
      </div>
  </div>
  <div class="send-popup">
        <div class="send-content">
          <p>Ваше сообщение успешно отправлен! </p>
          <span>Служба поддержки в скором времени ответит 
                на ваше обращение по электронной почте. 
                Не забудьте проверить папку «Спам». </span>
            <button class="close-popup-btn">Хорошо</button>
        </div>
      </div>
<?php
get_footer();
?>
