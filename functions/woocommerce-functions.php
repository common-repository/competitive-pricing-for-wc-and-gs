<?php

// If this file is called directly, abort.
if (! defined('WPINC')) {
   die;
}

// Check to make sure WooCommerce is active
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    // only run if there's no other class with this name
    if (! class_exists('API_pp_CUSTOM_FIELDS')){
        class API_pp_CUSTOM_FIELDS {
            public function __construct(){
                add_filter('woocommerce_product_data_tabs', array($this, 'api_pp_tab'), 20);
                add_action('woocommerce_product_data_panels', array($this, 'woocommerce_product_data_panels'));
                add_action('woocommerce_process_product_meta', 'API_pp_CUSTOM_FIELDS::save', 20, 2);
            }

            public function api_pp_tab($product_data_tabs){
                $product_data_tabs['api_pp_tabs'] = array(
                    'label'  => __('Product Pricing', 'api-pp-custom-fields'),
                    'target' => 'api_pp_tabs',
                    'class'  => array()
               );

                return $product_data_tabs;
            }

            public static function save($post_id, $post){
                // update post meta
                if(isset($_POST['api_pp_margin_percent'])){
                    update_post_meta($post_id, 'api_pp_margin_percent', wc_clean($_POST['api_pp_margin_percent']));
                }
                if(isset($_POST['api_pp_margin_dollar'])){
                    update_post_meta($post_id, 'api_pp_margin_dollar', wc_clean($_POST['api_pp_margin_dollar']));
                }
                if(isset($_POST['api_pp_job_status'])){
                    update_post_meta($post_id, 'api_pp_job_status', wc_clean($_POST['api_pp_job_status']));
                }
                if(isset($_POST['api_pp_lowest_acceptable_price'])){
                    update_post_meta($post_id, 'api_pp_lowest_acceptable_price', wc_clean($_POST['api_pp_lowest_acceptable_price']));
                }
                if(isset($_POST['api_pp_lowest_advertised_price'])){
                    update_post_meta($post_id, 'api_pp_lowest_advertised_price', wc_clean($_POST['api_pp_lowest_advertised_price']));
                }
                if(isset($_POST['api_pp_lowest_domain'])){
                    update_post_meta($post_id, 'api_pp_lowest_domain', wc_clean($_POST['api_pp_lowest_domain']));
                }
                if(isset($_POST['api_pp_ad_rank'])){
                    update_post_meta($post_id, 'api_pp_ad_rank', wc_clean($_POST['api_pp_ad_rank']));
                }
                if(isset($_POST['api_pp_advertise'])){
                    update_post_meta($post_id, 'api_pp_advertise', wc_clean($_POST['api_pp_advertise']));
                }
                if(isset($_POST['_alg_wc_cog_cost'])){
                    update_post_meta($post_id, '_alg_wc_cog_cost', wc_clean($_POST['_alg_wc_cog_cost']));
                }
                if(isset($_POST['api_pp_identifier_type'])){
                    update_post_meta($post_id, 'api_pp_identifier_type', wc_clean($_POST['api_pp_identifier_type']));
                }
                if(isset($_POST['api_pp_identifier'])){
                    update_post_meta($post_id, 'api_pp_identifier', wc_clean($_POST['api_pp_identifier']));
                }
                if(isset($_POST['api_pp_identifier_competitor'])){
                    update_post_meta($post_id, 'api_pp_identifier_competitor', wc_clean($_POST['api_pp_identifier_competitor']));
                }
                if(isset($_POST['api_pp_json'])){
                    update_post_meta($post_id, 'api_pp_json', wc_clean($_POST['api_pp_json']));
                }
                if(isset($_POST['api_pp_last_updated'])){
                    update_post_meta($post_id, 'api_pp_last_updated', wc_clean($_POST['api_pp_last_updated']));
                }
                if (isset($_POST['api_pp_dont_update_price'])) {
                    $dont_update_price = 'yes';
            	} else {
                    $dont_update_price = 'no';
                }
                update_post_meta($post_id, 'api_pp_dont_update_price', wc_clean($dont_update_price));

                if (isset($_POST['api_pp_always_advertise'])) {
                    $always_advertise = 'yes';
                    update_post_meta($post_id, 'api_pp_advertise', 'yes');
            	} else {
                    $always_advertise  = 'no';
                }
                update_post_meta($post_id, 'api_pp_always_advertise', wc_clean($always_advertise));
            }

            public function woocommerce_product_data_panels(){
                ?>
                <div id='api_pp_tabs' class='panel woocommerce_options_panel'>
                    <?php
                    woocommerce_wp_text_input(array(
                        'id'          => '_alg_wc_cog_cost',
                        'label'       => __('Product Cost', 'api-pp-custom-fields'),
                        'data_type' => 'price',
                        'description' => 'If you want product margin reporting on the dashboard or are using the global margin settings, the field is Required.  This is the raw cost of the product.  If you are using the <a href="https://woocommerce.com/products/woocommerce-cost-of-goods/" target="_blank">Woocommerce Cost of Goods</a> plugin, this field auto populates.',
                        'desc_tip'    => true
                   ));

                    woocommerce_wp_text_input(array(
                        'id'          => 'api_pp_lowest_acceptable_price',
                        'label'       => __('Lowest Acceptable Price', 'api-pp-custom-fields'),
                        'data_type' => 'price',
                        'description' => 'If you are Not using the global margin settings, this field is required.  This is the lowest you are willing to price this product.',
                        'desc_tip'    => true
                   ));

                    woocommerce_wp_text_input(array(
                        'id'          => 'api_pp_desired_lowest_price',
                        'label'       => __('Desired Lowest Price', 'api-pp-custom-fields'),
                        'data_type' => 'price',
                        'description' => 'This is the price you would like your product to be based on the plugin settings.  If your lowest acceptable price is below this price, the product will be changed to it.  If not, it will be changed to the lowest acceptable price.',
                        'desc_tip'    => true
                   ));

                    woocommerce_wp_text_input(array(
                        'id'          => 'api_pp_identifier',
                        'label'       => __('Identifier', 'api-pp-custom-fields'),
                        'description' => 'The plugin will automatically use the upc, part number and title, in that order during pricing updates.  If you would like to use a different identifier like a competitors product, you can input it hear.  This will override any other method.',
                        'desc_tip'    => true,
                   ));

                    woocommerce_wp_text_input(array(
                        'id'          => 'api_pp_identifier_competitor',
                        'label'       => __('Competitor Identifier', 'api-pp-custom-fields'),
                        'description' => 'This would be a competing product similar to yours that you can use in pricing updates.',
                        'desc_tip'    => true,
                   ));

                    woocommerce_wp_checkbox(array(
                        'id'            => 'api_pp_dont_update_price',
                        'label'         => __('Dont Update Pricing', 'woocommerce'),
                        'description'   => __('If you would not like the plugin to update the pricing for this product, you can check this box.', 'woocommerce'),
                        'desc_tip'    => true,
                   ));

                    woocommerce_wp_checkbox(array(
                        'id'            => 'api_pp_always_advertise',
                        'label'         => __('Always Advertise', 'woocommerce'),
                        'description'   => __('If you are using a Google Product Feed integration and would like the api_pp_always_advertise custom field marked yes regardless of the ad rank and any other plugin setting - tick this option.', 'woocommerce'),
                        'desc_tip'    => true
                   ));

                    woocommerce_wp_text_input(array(
                        'id'          => 'api_pp_job_status',
                        'data_type'   => 'text',
                        'label'       => __('Pricing Job Status', 'api-pp-custom-fields'),
                        'custom_attributes' => array('readonly' => 'readonly')
                   ));

                    woocommerce_wp_text_input(array(
                        'id'          => 'api_pp_ad_rank',
                        'label'       => __('Ad Rank', 'api-pp-custom-fields'),
                        'data_type' => 'text',
                        'description'   => __('This is the rank of your pricing compared to the competition.  A 1 means you have the lowest price, 2 means the 2nd lowest, and so on.', 'woocommerce'),
                        'desc_tip'    => true,
                        'custom_attributes' => array('readonly' => 'readonly')
                   ));

                    woocommerce_wp_text_input(array(
                        'id'          => 'api_pp_advertise',
                        'data_type'   => 'text',
                        'label'       => __('Advertising', 'api-pp-custom-fields'),
                        'placeholder' => '',
                        'description'   => __('This field will be marked yes or no based on the auto advertise option in the plugin settings.', 'woocommerce'),
                        'desc_tip'    => true,
                        'custom_attributes' => array('readonly' => 'readonly')
                   ));

                    woocommerce_wp_text_input(array(
                        'id'          => 'api_pp_margin_percent',
                        'data_type'   => 'text',
                        'label'       => __('Profit Margin', 'api-pp-custom-fields'),
                        'description'   => __('This field will only be populated if you have entered the product cost.', 'woocommerce'),
                        'desc_tip'    => true,
                        'custom_attributes' => array('readonly' => 'readonly')
                   ));

                    woocommerce_wp_text_input(array(
                        'id'          => 'api_pp_margin_percent',
                        'data_type'   => 'text',
                        'label'       => __('Profit Margin Percent', 'api-pp-custom-fields'),
                        'description'   => __('This field will only be populated if you have entered the product cost.', 'woocommerce'),
                        'desc_tip'    => true,
                        'custom_attributes' => array('readonly' => 'readonly')
                   ));

                    woocommerce_wp_text_input(array(
                        'id'          => 'api_pp_margin_dollar',
                        'data_type'   => 'text',
                        'label'       => __('Profit Margin Dollar', 'api-pp-custom-fields'),
                        'description'   => __('This field will only be populated if you have entered the product cost.', 'woocommerce'),
                        'desc_tip'    => true,
                        'custom_attributes' => array('readonly' => 'readonly')
                   ));

                    woocommerce_wp_text_input(array(
                        'id'          => 'api_pp_identifier_type',
                        'data_type'   => 'text',
                        'label'       => __('Identifier Type', 'api-pp-custom-fields'),
                        'description'   => __('This is the identifier that was used during the pricing update.', 'woocommerce'),
                        'desc_tip'    => true,
                        'custom_attributes' => array('readonly' => 'readonly')
                   ));

                    woocommerce_wp_text_input(array(
                        'id'          => 'api_pp_last_updated',
                        'data_type'   => 'text',
                        'label'       => __('Pricing Last Updated', 'api-pp-custom-fields'),
                        'placeholder' => '',
                        'description'   => __('This is the date of the last pricing update.', 'woocommerce'),
                        'desc_tip'    => true,
                        'custom_attributes' => array('readonly' => 'readonly')
                   ));

                    woocommerce_wp_text_input(array(
                       'id'          => 'api_pp_lowest_advertised_domain',
                       'data_type'   => 'text',
                       'label'       => __('Lowest Advertiser', 'api-pp-custom-fields'),
                       'placeholder' => '',
                       'description'   => __('The advertiser with the lowest price on Google Shopping.', 'woocommerce'),
                       'desc_tip'    => true,
                       'custom_attributes' => array('readonly' => 'readonly')
                    ));

                    woocommerce_wp_text_input(array(
                      'id'          => 'api_pp_lowest_advertised_price',
                      'data_type'   => 'text',
                      'label'       => __('Lowest Advertised Price', 'api-pp-custom-fields'),
                      'placeholder' => '',
                      'description'   => __('The lowest advertised price on Google Shopping.', 'woocommerce'),
                      'desc_tip'    => true,
                      'custom_attributes' => array('readonly' => 'readonly')
                    ));

                    woocommerce_wp_text_input(array(
                       'id'          => 'api_pp_lowest_advertised_domain_second',
                       'data_type'   => 'text',
                       'label'       => __('2nd Lowest Advertiser', 'api-pp-custom-fields'),
                       'placeholder' => '',
                       'description'   => __('The advertiser with the 2nd lowest price on Google Shopping.', 'woocommerce'),
                       'desc_tip'    => true,
                       'custom_attributes' => array('readonly' => 'readonly')
                    ));

                    woocommerce_wp_text_input(array(
                      'id'          => 'api_pp_lowest_advertised_price_second',
                      'data_type'   => 'text',
                      'label'       => __('2nd Lowest Advertised Price', 'api-pp-custom-fields'),
                      'placeholder' => '',
                      'description'   => __('The 2nd lowest advertised price on Google Shopping.', 'woocommerce'),
                      'desc_tip'    => true,
                      'custom_attributes' => array('readonly' => 'readonly')
                    ));

                    woocommerce_wp_text_input(array(
                       'id'          => 'api_pp_lowest_advertised_domain_third',
                       'data_type'   => 'text',
                       'label'       => __('3rd Lowest Advertiser', 'api-pp-custom-fields'),
                       'placeholder' => '',
                       'description'   => __('The advertiser with the 3rd lowest price on Google Shopping.', 'woocommerce'),
                       'desc_tip'    => true,
                       'custom_attributes' => array('readonly' => 'readonly')
                    ));

                    woocommerce_wp_text_input(array(
                      'id'          => 'api_pp_lowest_advertised_price_third',
                      'data_type'   => 'text',
                      'label'       => __('3rd Lowest Advertised Price', 'api-pp-custom-fields'),
                      'placeholder' => '',
                      'description'   => __('The 3rd lowest advertised price on Google Shopping.', 'woocommerce'),
                      'desc_tip'    => true,
                      'custom_attributes' => array('readonly' => 'readonly')
                    ));

                    woocommerce_wp_textarea_input(array(
                        'id'          => 'api_pp_json',
                        'data_type'   => 'json',
                        'label'       => __('Pricing JSON', 'api-pp-custom-fields'),
                        'description'   => __('This is the raw pricing json data.', 'woocommerce'),
                        'desc_tip'    => true,
                        'custom_attributes' => array('readonly' => 'readonly')
                   ));

                    ?>
                </div>
                <?php
            }

        }
        $GLOBALS['api_pp_identifier'] = new API_pp_CUSTOM_FIELDS();
    }
}
