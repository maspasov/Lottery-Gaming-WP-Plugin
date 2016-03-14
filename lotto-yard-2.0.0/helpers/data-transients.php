<?php

//TODO Create Class for API Call & Set Transients
if (!function_exists('get_transient_by_url')) :
    function get_transient_by_url($transient_key, $api_method, $request=null)
    {
        $transient = get_transient($transient_key);
        if (!empty($transient)) {
            return  $transient;
        } else {
            $url = BASE_API_URL.$api_method;

            $data = $request;
            $data["BrandID"] = BRAND_ID;
            $data_string = json_encode($data);

            $response = wp_remote_post($url, array(
                'headers' => array(
                    'Token' => TOKEN,
                    'Content-Type' => 'application/json'
                ),
                'sslverify' => false,
                'body' => $data_string
            ));

            if (is_wp_error($response)) {
                $error_message = $response->get_error_message();
                return "Something went wrong: $error_message";
            } else {
                $decode_response = json_decode(wp_remote_retrieve_body($response), false);
                set_transient($transient_key, $decode_response, 60 * 5);
                return $decode_response;
            }
        }
    }
endif;

add_action('after_setup_theme', 'get_data_from_api');
if (!function_exists('get_data_from_api')) :
    function get_data_from_api()
    {
        global $prices_by_brand_and_productid; //for special lottary games home page/cart
        global $all_brand_draws;
        global $lotteries_results;
        global $product_rules;
        $prices_by_brand_and_productid = get_transient_by_url('lotto_prices_by_brand_and_productid', 'globalinfo/get-prices-by-brand-and-productid', array('productIds'=>'1,2,3,14'));
        $all_brand_draws = get_transient_by_url('lotto_all_brand_draws', 'globalinfo/get-all-brand-draws');
        $lotteries_results = get_transient_by_url('lotto_lotteries_results', 'globalinfo/get-lotteries-results');
        $product_rules = get_transient_by_url('lotto_product_rules', 'globalinfo/product-rules');
    }
endif;
