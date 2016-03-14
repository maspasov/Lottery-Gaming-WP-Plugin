<?php

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;

Container::factory('theme_options', __('API Options', 'crb'))
    ->add_fields(array(
        Field::factory('text', 'lotto_brand_id', __('Brand ID', 'crb'))
            ->set_default_value(''),
        Field::factory('text', 'lotto_access_token', __('Access Token', 'crb'))
            ->set_default_value(''),
        Field::factory('text', 'lotto_base_api_url', __('Base API URL', 'crb'))
            ->set_default_value('')
            ->help_text("required: Valid URL address. hint: 'http://'"),
        Field::make("checkbox", "lotto_ngcart", "Use ngCart for Cart Page")
            ->set_option_value('yes')
            ->help_text("Choose, if your theme support Lottery Platform Functionality Plugin version 2.0.0"),
        Field::factory('text', 'lotto_cashier_url', __('Cashier URL', 'crb'))
            ->set_default_value('')
            ->help_text("If 'Use ngCart for Cart Page' is checked you don't need for Cashier URL"),
        Field::factory('select', 'lotto_currency', __('Currency', 'crb'))
            ->add_options(array(
                '€' => '€',
                '$' => '$'
            ))
    ));
