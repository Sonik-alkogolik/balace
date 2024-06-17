<section class="footer-section">
          <footer class="footer">
            <div class="footer-content">
           <div class="footer__item">
           <?php
            wp_nav_menu(array(
                'theme_location' => 'footer-menu-left',
                'container' => false, 
            ));
            ?>
           </div>
           <div class="footer__item footer__item_document">
           <?php
            wp_nav_menu(array(
                'theme_location' => 'footer-menu-left',
                'container' => false, 
            ));
            ?>
           </div>
           <div class="footer__item footer__item--contact">
        <p class="h4 footer__contact-title">Свяжитесь с нами и мы решим ваши вопросы</p>
        <a href="tel:+78009995999" class="h4">8 800 999-59-99</a>
        <a href="mailto:mail@balace.ru" class="h5">mail@balace.ru</a>
           </div>
         
           </div>
           <div class="footer__item--bottom">
            <div class="footer__bottom-logo">
                <img src="<?php echo get_template_directory_uri(); ?>/img/footer-logo.webp" alt="">
            </div>
            <div class="footer__bottom-center">
                <a href="#" class="caption">лицензии</a>
                <a href="#" class="caption">политика конфиденциальности</a>
            </div>
            <div class="footer__bottom-right">
              <p class="footer__copyright caption">© Все права защищены 2024 balace</p>
              <a href="#" class="footer__developer caption">Разработка сайта <img src="<?php echo get_template_directory_uri(); ?>/img/logo-jamit.png" alt=""></a>
            </div>
    </footer>
  </div>
</section>
<?php wp_footer(); ?>
</body>
</html>

