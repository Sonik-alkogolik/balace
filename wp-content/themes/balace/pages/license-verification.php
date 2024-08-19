<?php
/*
Template Name: Лицензии проверка
*/
get_header();
?>
<?php 
$file = get_field('uploaded_file');
// echo '<pre>';
// print_r($file);
// echo '</pre>';
?>

<section>
  <div class="check-wrap">
<form id="checkNumberForm">
    <input type="text" name="search_number" id="search_number" placeholder="Введите номер лицензии" required>
    <input type="text" name="file_url" id="file_url" placeholder="URL файла" value="<?php print_r($file);?>" style="display: none;">
</form>
<button type="button" class="checkNumberButton desk">Проверить номер</button>
<button type="button" class="checkNumberButton mob">Проверить</button>
</div>
<div class="result-search">
     <div class="result-number-search">
        <p>№ лицензии</p>
        <span class="result-number-span"></span>
     </div>
     <div id="resultMessage">

     </div>
</div>
<div class="check-bottom-text">проверьте правильность введенного номера</div>

<div class="block-inform-bad desk">
  <div class="block-inform-bad-text">
    <p>Биодобавки не являются лекарственными средствами 
    и не могут заменять полноценное питание, но могут использоваться для профилактики и поддержания здоровья. Качество и безопасность   биодобавок строго контролирует государство.</p>
    <span>
      Законодательством запрещена торговля без разрешительных документов, оформляемых по результатам исследований, которые проводятся в рамках подтверждения соответствия продукта требованиям технического регламента Таможенного союза (ТР ТС). Правонарушители будут привлечены к ответственности, предусмотренной КоАП РФ.
    </span>
 </div>
</div>
<div class="block-inform-bad mob">
  <div class="block-inform-bad-img"></div>
     <p>Биодобавки не являются лекарственными средствами 
        и не могут заменять полноценное питание, но могут использоваться для профилактики и поддержания здоровья. Качество и безопасность   биодобавок строго контролирует государство.</p>
    <span>
      Законодательством запрещена торговля без разрешительных документов, оформляемых по результатам исследований, которые проводятся в рамках подтверждения соответствия продукта требованиям технического регламента Таможенного союза (ТР ТС). Правонарушители будут привлечены к ответственности, предусмотренной КоАП РФ.
    </span>
</div>
</section>

<?php
  get_footer();
?>
