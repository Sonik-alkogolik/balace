<section class="section-faq">
<?php
$Faq = get_field('list_questions');
if ($Faq) {

    $Faq_questions1 = $Faq['question_1'];
    $Faq_answer_1 = $Faq['answer_question_1'];
    $Faq_questions2 = $Faq['question_2'];
    $Faq_answer_2 = $Faq['answer_question_2'];
    $Faq_questions3 = $Faq['question_3'];
    $Faq_answer_3 = $Faq['answer_question_3'];
    $Faq_questions4 = $Faq['question_4'];
    $Faq_answer_4 = $Faq['answer_question_4'];
?>
            <div class="faq-wrapp">
                <div class="faq-content">
                <div class="faq-item left">
                    <h3 class="h3 text_main">Часто задаваемые вопросы:</h3>
                </div>
                <div class="faq-item right">
                    <div class="faq-item-content background_main">
                        <p class="h6 text_main"><?php echo esc_html($Faq_questions1);?></p>
                        <span class="h6 text_main"><?php echo esc_html($Faq_answer_1);?></span>
                    </div>
                    <div class="faq-item-content background_main">
                        <p class="h6 text_main"><?php echo esc_html($Faq_questions2);?></p>
                        <span class="h6 text_main"><?php echo esc_html($Faq_answer_2);?></span>
                    </div>
                    <div class="faq-item-content background_main">
                        <p class="h6 text_main"><?php echo esc_html($Faq_questions3);?></p>
                        <span class="h6 text_main"><?php echo esc_html($Faq_answer_3);?></span>
                    </div>
                    <div class="faq-item-content background_main">
                        <p class="h6 text_main"><?php echo esc_html($Faq_questions4);?></p>
                        <span class="h6 text_main"><?php echo esc_html($Faq_answer_4);?></span>
                    </div>
                </div>
                </div>
            </div>



<?php
} else {
?>
<div class="faq-wrapp">
                <div class="faq-content">
                <div class="faq-item left">
                    <h3 class="h3 text_main">Часто задаваемые вопросы:</h3>
                </div>
                <div class="faq-item right">
                    <div class="faq-item-content background_main">
                        <p class="h6 text_main">Какие&nbsp;способы доставки&nbsp;возможны?</p>
                        <span class="h6 text_main">Ответ Какие&nbsp;способы доставки&nbsp;возможны!</span>
                    </div>
                    <div class="faq-item-content background_main">
                        <p class="h6 text_main">Какие способы оплаты доступны?</p>
                        <span class="h6 text_main">Ответ Какие способы оплаты доступны!</span>
                    </div>
                    <div class="faq-item-content background_main">
                        <p class="h6 text_main">Как получить заказ?</p>
                        <span class="h6 text_main">Ответ Как получить заказ!</span>
                    </div>
                    <div class="faq-item-content background_main">
                        <p class="h6 text_main">Сотрудничество с юридическими лицами</p>
                        <span class="h6 text_main">Ответ Сотрудничество с юридическими лицами!</span>
                    </div>
                </div>
                </div>
            </div>
<?php
}
?>
</section>