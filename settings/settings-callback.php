<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
   die;
}

// callback: login section
function api_pp_general_options_section_callback() {
	echo '<p></p>';
}
// callback: admin section
function api_pp_update_options_section_callback() {
	echo '<p>With these options you can decide whick data you would like to update.</p>';
}
// callback: admin section
function api_pp_assign_attributes_section_callback() {
	echo '<p>With these options you can assign attributes to there correct attribute slug.</p>';
}

// callback: text field
function api_pp_text_field_callback( $args ) {
	$options = get_option( 'api_pp_options', api_pp_default_options() );
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
	echo '<input id="api_pp_options_'. $id .'" name="api_pp_options['. $id .']" type="text" size="40" value="'. $value .'"><br />';
	echo '<label for="api_pp_options_'. $id .'">'. $label .'</label>';
}

// callback: checkbox field
function api_pp_check_box_callback( $args ) {
	$options = get_option( 'api_pp_options', api_pp_default_options() );
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	$checked = isset( $options[$id] ) ? checked( $options[$id], 1, false ) : '';
	echo '<input id="api_pp_options_'. $id .'" name="api_pp_options['. $id .']" type="checkbox" value="1"'. $checked .'> ';
	echo '<label for="api_pp_options_'. $id .'">'. $label .'</label>';
}

// callback: select field
function api_pp_select_lowest_price( $args ) {
	$options = get_option( 'api_pp_options', api_pp_default_options() );
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	$selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
    $select_options = array(
        ''   => '',
		'dollar'    => '$',
		'percent'   => '%',
	);
	echo '<select id="api_pp_options_'. $id .'" name="api_pp_options['. $id .']">';
	foreach ( $select_options as $value => $option ) {
		$selected = selected( $selected_option === $value, true, false );
		echo '<option value="'. $value .'"'. $selected .'>'. $option .'</option>';
	}
	echo '</select> <label for="api_pp_options_'. $id .'">'. $label .'</label>';
}

// callback: select field
function api_pp_select_lowest_price_global( $args ) {
	$options = get_option( 'api_pp_options', api_pp_default_options() );
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	$selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
    $select_options = array(
        ''   => '',
		'dollar'    => '$',
		'percent'   => '%',
	);
	echo '<select id="api_pp_options_'. $id .'" name="api_pp_options['. $id .']">';
	foreach ( $select_options as $value => $option ) {
		$selected = selected( $selected_option === $value, true, false );
		echo '<option value="'. $value .'"'. $selected .'>'. $option .'</option>';
	}
	echo '</select> <label for="api_pp_options_'. $id .'">'. $label .'</label>';
}

// callback: select field
function api_pp_select_callback( $args ) {
	$options = get_option( 'api_pp_options', api_pp_default_options() );
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	$selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
    $attribute_taxonomies = wc_get_attribute_taxonomies();
    $select_options = array( 'default' => '' );
    foreach ( $attribute_taxonomies as $taxonomy ) {
        $taxonomy_name = $taxonomy->attribute_name;
        $taxonomy_label = $taxonomy->attribute_label;
        $name_label_array = array( $taxonomy_name => $taxonomy_label );
        $select_options = array_merge( $select_options, $name_label_array );
    }
	echo '<select id="api_pp_options_'. $id .'" name="api_pp_options['. $id .']">';
	foreach ( $select_options as $value => $option ) {
		$selected = selected( $selected_option === $value, true, false );
		echo '<option value="'. $value .'"'. $selected .'>'. $option .'</option>';
	}
	echo '</select> <label for="api_pp_options_'. $id .'">'. $label .'</label>';
}

if (!function_exists ('api_pp_country_radio_field_callback_options')) {
    function api_pp_country_radio_field_callback_options() {
    	return array(
            'us'  => esc_html__('United States', 'competitive-pricing-for-woocommerce'),
    		'ca'  => esc_html__('Canada', 'competitive-pricing-for-woocommerce'),
    	);
    }
}
if (!function_exists ('api_pp_country_radio_field_callback')) {
    function api_pp_country_radio_field_callback($args) {
    	$plugin_options = wp_parse_args(get_option('api_pp_options'), api_pp_default_options());
    	$id    = isset($args['id'])    ? sanitize_text_field($args['id'])    : '';
    	$label = isset($args['label']) ? sanitize_text_field($args['label']) : '';
    	$selected_option = isset($plugin_options[$id]) ? sanitize_text_field($plugin_options[$id]) : '';
    	$radio_options = api_pp_country_radio_field_callback_options();
    	foreach ($radio_options as $value => $label) {
    		$checked = checked($selected_option === $value, true, false);
    		echo '<label><input name="api_pp_options['. esc_html($id) .']" type="radio" value="'. esc_html($value) .'"'. esc_html($checked) .'> ';
    		echo '<span>'. esc_html($label) .'</span></label><br />';
    	}
    }
}
