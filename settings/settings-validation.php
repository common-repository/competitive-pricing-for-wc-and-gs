<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
   die;
}

 function api_pp_callback_validate_options( $input ) {

     // validation for general options
	if ( isset( $input['api_pp_api_key'] ) ) {
		$input['api_pp_api_key'] = sanitize_text_field( $input['api_pp_api_key'] );
	}
	if ( isset( $input['api_pp_your_domain'] ) ) {
		$input['api_pp_your_domain'] = sanitize_text_field( $input['api_pp_your_domain'] );
	}
    // ad rank limit

     $attribute_taxonomies = wc_get_attribute_taxonomies();
        $select_options = array( 'default' => '' );
        foreach ( $attribute_taxonomies as $taxonomy ) {
            $taxonomy_name = $taxonomy->attribute_name;
            $taxonomy_label = $taxonomy->attribute_label;
            $name_label_array = array( $taxonomy_name => $taxonomy_label );
            $select_options = array_merge( $select_options, $name_label_array );
        }
        // upc attribute callback
    	if ( ! isset( $input['api_pp_upc_attribute'] ) ) {
    		$input['api_pp_upc_attribute'] = null;
    	}
    	if ( ! array_key_exists( $input['api_pp_upc_attribute'], $select_options ) ) {
    		$input['api_pp_upc_attribute'] = null;
    	}
        // ean attribute callback
    	if ( ! isset( $input['api_pp_ean_attribute'] ) ) {
    		$input['api_pp_ean_attribute'] = null;
    	}
    	if ( ! array_key_exists( $input['api_pp_ean_attribute'], $select_options ) ) {
    		$input['api_pp_ean_attribute'] = null;
    	}
        // part_number attribute callback
    	if ( ! isset( $input['api_pp_part_number_attribute'] ) ) {
    		$input['api_pp_part_number_attribute'] = null;
    	}
    	if ( ! array_key_exists( $input['api_pp_part_number_attribute'], $select_options ) ) {
    		$input['api_pp_part_number_attribute'] = null;
    	}
        // brand attribute callback
    	if ( ! isset( $input['api_pp_brand_attribute'] ) ) {
    		$input['api_pp_brand_attribute'] = null;
    	}
    	if ( ! array_key_exists( $input['api_pp_brand_attribute'], $select_options ) ) {
    		$input['api_pp_brand_attribute'] = null;
    	}
        // manufacturer attribute callback
    	if ( ! isset( $input['api_pp_manufacturer_attribute'] ) ) {
    		$input['api_pp_manufacturer_attribute'] = null;
    	}
    	if ( ! array_key_exists( $input['api_pp_manufacturer_attribute'], $select_options ) ) {
    		$input['api_pp_manufacturer_attribute'] = null;
    	}
        // model attribute callback
    	if ( ! isset( $input['api_pp_model_attribute'] ) ) {
    		$input['api_pp_model_attribute'] = null;
    	}
    	if ( ! array_key_exists( $input['api_pp_model_attribute'], $select_options ) ) {
    		$input['api_pp_model_attribute'] = null;
    	}
        // color attribute callback
    	if ( ! isset( $input['api_pp_color_attribute'] ) ) {
    		$input['api_pp_color_attribute'] = null;
    	}
    	if ( ! array_key_exists( $input['api_pp_color_attribute'], $select_options ) ) {
    		$input['api_pp_color_attribute'] = null;
    	}
        // size attribute callback
    	if ( ! isset( $input['api_pp_size_attribute'] ) ) {
    		$input['api_pp_size_attribute'] = null;
    	}
    	if ( ! array_key_exists( $input['api_pp_size_attribute'], $select_options ) ) {
    		$input['api_pp_size_attribute'] = null;
    	}

        $radio_options = api_pp_country_radio_field_callback();
        if (! isset($input['api_pp_country'])) {
        	$input['api_pp_country'] = null;
        }
        if (! array_key_exists($input['api_pp_country'], $radio_options)) {
        	$input['api_pp_country'] = null;
        }

        $radio_options = api_pp_country_title_radio_field_callback();
        if (! isset($input['api_pp_country_title'])) {
        	$input['api_pp_country_title'] = null;
        }

    	return $input;
    }
