<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="woocommerce-billing-fields">
	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		

	<?php else : ?>

		<h3><?php //esc_html_e( 'Billing details', 'woocommerce' ); ?></h3>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<div class="woocommerce-billing-fields__field-wrapper">
	<div class="block-input">
        <div class="billing-title">
        <p>1/3</p> <h3> Адрес и доставка <?php //esc_html_e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3>
        </div>
    <div class="block-input-item">
   
    <?php
// Поля для формы оформления заказа
$fields = $checkout->get_checkout_fields('billing');

// Определяем необходимые поля
$address_fields = array(
    'billing_city'        => array(
        'placeholder' => 'Населённый пункт',
    ),
    'billing_address_1'   => array(
        'placeholder' => 'Улица и дом',
    ),
    'billing_address_2'   => array(
        'placeholder' => 'Квартира',
    ),
    'billing_doorbell'    => array(
        'placeholder' => 'Домофон',
        
    ),
    'billing_entrance'    => array(
        'placeholder' => 'Подъезд',
        
    ),
    'billing_floor'       => array(
        'placeholder' => 'Этаж',
        
    ),
    
);

foreach ($address_fields as $field_key => $field_params) {
    echo '<div class="form-row form-row-wide address-field" id="' . esc_attr($field_key) . '_field">';
    echo '<input type="text" class="input-text" name="' . esc_attr($field_key) . '" id="' . esc_attr($field_key) . '" placeholder="' . esc_attr($field_params['placeholder']) . '" value="' . esc_attr($checkout->get_value($field_key)) . '">';
    echo '</div>';
}

$delivery_fields = array(
    'custom_delivery_method' => array(
        'type'        => 'select',
        'options'     => array(
            'courier' => 'Курьерская доставка',
            'pickup'  => 'Самовывоз',
        ),
        'label'       => 'Способ доставки',
    ),
);

foreach ($delivery_fields as $delivery_key => $delivery_params) {
    echo '<div class="form-group form-group-custom-delivery">';
    echo '<label id="custom_delivery_method" for="' . esc_attr($delivery_key) . '">' . esc_html($delivery_params['label']) . '</label>';
    
    if ($delivery_params['type'] == 'select') {
        echo '<div class="select-wrapper">';
        echo '<input type="hidden" id="' . esc_attr($delivery_key) . '" name="' . esc_attr($delivery_key) . '">';
        echo '<ul class="custom-select-delivery-method" style="display:none;">';
        foreach ($delivery_params['options'] as $option_value => $option_label) {
            echo '<li data-value="' . esc_attr($option_value) . '">' . esc_html($option_label) . '</li>';
        }
        echo '</ul>';
        echo '</div>';
    }
    
    echo '</div>';
}
?>
      </div>
    </div>
    </div>
<div class="woocommerce-billing-fields__field-wrapper">
   <div class="block-input">
   <div class="billing-title">
		<p>2/3</p> <h3>Получатель </h3>
     </div>
        <div class="block-input-item">
       
        <?php

$fields = $checkout->get_checkout_fields('billing');

$recipient_fields = array(
    'billing_first_name' => array(
        'type'        => 'text',
        'placeholder' => 'Имя',
    ),
    'billing_last_name'  => array(
        'type'        => 'text',
        'placeholder' => 'Фамилия',
    ),
    'billing_phone'      => array(
        'type'        => 'tel',
        'placeholder' => 'Телефон',
    ),
    'billing_email'      => array(
        'type'        => 'email',
        'placeholder' => 'Электронная почта',
    ),
   
);

foreach ($recipient_fields as $field_key => $field_params) {
    if ($field_params['type'] === 'select') {
        echo '<div class="form-row form-row-wide">';
        echo '<label for="' . esc_attr($field_key) . '">' . esc_html($field_params['label']) . '</label>';
        echo '<select name="' . esc_attr($field_key) . '" id="' . esc_attr($field_key) . '">';
        foreach ($field_params['options'] as $value => $label) {
            $selected = selected($checkout->get_value($field_key), $value, false);
            echo '<option value="' . esc_attr($value) . '" ' . $selected . '>' . esc_html($label) . '</option>';
        }
        echo '</select>';
        echo '</div>';
    } else {
        echo '<div class="form-row form-row-wide">';
        echo '<input type="' . esc_attr($field_params['type']) . '" class="input-text" name="' . esc_attr($field_key) . '" id="' . esc_attr($field_key) . '" placeholder="' . esc_attr($field_params['placeholder']) . '" value="' . esc_attr($checkout->get_value($field_key)) . '">';
        echo '</div>';
    }
}

$chekbox_input = array(
    'accept_terms' => array(
        'type'        => 'checkbox',
        'label'       => 'Я согласен с обработкой персональных данных',
        'checked'     => true,
    ),
);

// Отображаем чекбокса
foreach ($chekbox_input as $checkbox_key => $checkbox_params) {
    echo '<div class="form-group agree-personal-data">';
    echo '<input type="checkbox" id="' . esc_attr($checkbox_key) . '" name="' . esc_attr($checkbox_key) . '" ' . ($checkbox_params['checked'] ? 'checked' : '') . '>';
    echo '<span class="checkbox-custom checked"></span>'; 
    echo '<label class="subtitle1" for="' . esc_attr($checkbox_key) . '">' . esc_html($checkbox_params['label']) . '</label>';
    echo '</div>';
}

?>

    </div>
  </div>
	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>

<div class="woocommerce-billing-fields__field-wrapper">
<div class="block-input">
<div class="billing-title">
 <p>3/3</p><h3>После оформления заказа с вами свяжется наш менеджер для подтверждения и оплаты</h3>
    </div>
    <div class="">
        
        <?php //wc_get_template( 'checkout/payment.php' ); ?>
    </div>
</div>
  
</div>

<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
	<div class="woocommerce-account-fields">
		<?php if ( ! $checkout->is_registration_required() ) : ?>

			<p class="form-row form-row-wide create-account">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> type="checkbox" name="createaccount" value="1" /> <span><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></span>
				</label>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

			<div class="create-account">
				<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	</div>
<?php endif; ?>
