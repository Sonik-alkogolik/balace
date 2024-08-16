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
<form id="checkNumberForm">
    <input type="text" name="search_number" id="search_number" placeholder="Введите номер" required>
    <input type="text" name="file_url" id="file_url" placeholder="URL файла" value="<?php print_r($file);?>" style="display: none;">
    <button type="button" id="checkNumberButton">Проверить номер</button>
</form>

<div id="resultMessage"></div>

</section>

<?php
  get_footer();
?>
