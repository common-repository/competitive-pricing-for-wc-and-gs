<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
   die;
}

// register plugin settings
function api_pp_register_settings() {
	// Register the plugin settings
	register_setting(
		'api_pp_options',
		'api_pp_options',
		'api_pp_validate_options'
	);

    // Add the settings page sections
	add_settings_section(
		'api_pp_general_options_section',
		'API Options',
		'api_pp_general_options_section_callback',
		'api-pp-settings'
	);
	add_settings_section(
		'api_pp_update_options_section',
		'Update Product Data Options',
		'api_pp_update_options_section_callback',
		'api-pp-settings'
	);
	add_settings_section(
		'api_pp_assign_attributes_section',
		'Assign Attribute Options',
		'api_pp_assign_attributes_section_callback',
		'api-pp-settings'
	);

    // register settings
    add_settings_field(
		'api_pp_api_key',
		'API Key',
		'api_pp_text_field_callback',
		'api-pp-settings',
		'api_pp_general_options_section',
		[ 'id' => 'api_pp_api_key', 'label' => 'You can obtain your API Key by logging in or registering an account on <a href="https://www.apigenius.io/software/competitive-pricing-for-woocommerce-google-shopping/" target="_blank">ApiGenius.io</a>.' ]
	);
    add_settings_field(
        'api_pp_your_domain',
        'Your Domain',
        'api_pp_text_field_callback',
        'api-pp-settings',
        'api_pp_update_options_section',
        [ 'id' => 'api_pp_your_domain', 'label' => 'Your root domain WITHOUT the www, for example: <u>ecomapi.io</u>.' ]
    );

    // Assign attributes
    add_settings_field(
		'api_pp_upc_attribute',
		'UPC Attribute',
		'api_pp_select_callback',
        'api-pp-settings',
        'api_pp_assign_attributes_section',
		[ 'id' => 'api_pp_upc_attribute', 'label' => '' ]
	);

    add_settings_field(
		'api_pp_ean_attribute',
		'EAN Attribute',
		'api_pp_select_callback',
        'api-pp-settings',
        'api_pp_assign_attributes_section',
		[ 'id' => 'api_pp_ean_attribute', 'label' => '' ]
	);

    add_settings_field(
		'api_pp_part_number_attribute',
		'Part Number Attribute',
		'api_pp_select_callback',
        'api-pp-settings',
        'api_pp_assign_attributes_section',
		[ 'id' => 'api_pp_part_number_attribute', 'label' => '' ]
	);

    add_settings_field(
		'api_pp_brand_attribute',
		'Brand Attribute',
		'api_pp_select_callback',
        'api-pp-settings',
        'api_pp_assign_attributes_section',
		[ 'id' => 'api_pp_brand_attribute', 'label' => '' ]
	);

    add_settings_field(
		'api_pp_manufacturer_attribute',
		'Manufacturer Attribute',
		'api_pp_select_callback',
        'api-pp-settings',
        'api_pp_assign_attributes_section',
		[ 'id' => 'api_pp_manufacturer_attribute', 'label' => '' ]
	);

    add_settings_field(
		'api_pp_model_attribute',
		'Model Attribute',
		'api_pp_select_callback',
        'api-pp-settings',
        'api_pp_assign_attributes_section',
		[ 'id' => 'api_pp_model_attribute', 'label' => '' ]
	);

    add_settings_field(
		'api_pp_color_attribute',
		'Color Attribute',
		'api_pp_select_callback',
        'api-pp-settings',
        'api_pp_assign_attributes_section',
		[ 'id' => 'api_pp_color_attribute', 'label' => '' ]
	);

    add_settings_field(
		'api_pp_size_attribute',
		'Size Attribute',
		'api_pp_select_callback',
        'api-pp-settings',
        'api_pp_assign_attributes_section',
		[ 'id' => 'api_pp_size_attribute', 'label' => '' ]
	);

}
add_action( 'admin_init', 'api_pp_register_settings' );
