<?php
add_action( 'wpcf7_init', 'srffcf7_add_form_tag_button', 10, 0 );
function srffcf7_add_form_tag_button() {
wpcf7_add_form_tag(  array('star_rating','star_rating*'), 'srffcf7_button_form_tag_handler',array(
    'name-attr' => true,
    ) );
}

function srffcf7_button_form_tag_handler( $tag ) {
    if ( empty( $tag->name ) ) {
    	return '';
 	}

    $validation_error = wpcf7_get_validation_error( $tag->name );

    $class = wpcf7_form_controls_class( $tag->type );

    $atts = array();

    $atts['name'] = $tag->name;
    $atts['class'] = $tag->get_class_option( $class );
    $atts['id'] = $tag->get_id_option();
    $atts['tabindex'] = $tag->get_option( 'tabindex', 'signed_int', true );
    $atts['max'] = $tag->get_option( 'max', 'signed_int', true );
    $atts['score'] = $tag->get_option( 'score', 'signed_int', true );

    $html = '' ;

    $html .= '<div target_pos="'.$tag->name.'" class="star_rating_class" score="'.$atts['score'].'"></div>';  
    $html .= '<span  class="wpcf7-form-control-wrap '.sanitize_html_class($tag->name).'" data-name="'.$tag->name.'">';  
    $html .= '<input type="hidden" name="'.$tag->name.'" class="custom_radio_class '.$tag->name.'" value=""/>';
    $html .= $validation_error;
    $html .= '</span>';  

    return $html;
}

add_filter( 'wpcf7_validate_star_rating' , 'srffcf7_star_rating_validation_filter' , 10, 2 );
add_filter( 'wpcf7_validate_star_rating*' , 'srffcf7_star_rating_validation_filter' , 10, 2 );  
function srffcf7_star_rating_validation_filter( $result, $tag ) {
    $dscf7data_image = sanitize_text_field($_POST[$tag->name]);

    $value = isset( $_POST[$tag->name] ) ? sanitize_text_field(trim( strtr( (string) $dscf7data_image, "\n", " " ) )) : '';
    if ( 'star_rating' == $tag->basetype ) {
        if ( $tag->is_required() and '' === $value ) {
            $result->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
        }
    }
    return $result;
}