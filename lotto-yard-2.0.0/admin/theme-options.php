<?php

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;

Container::factory('theme_options', __('API Options', 'crb'))
    ->add_fields(array(
        Field::factory('text', 'lotto_access_token', __('Access Token', 'crb'))
            ->set_default_value(''),
        Field::factory('text', 'lotto_base_api_url', __('Base API URL', 'crb'))
            ->set_default_value(''),
        Field::factory('text', 'lotto_cashier_url', __('Cashier URL', 'crb'))
            ->set_default_value(''),
        Field::factory('text', 'lotto_brand_id', __('Brand ID', 'crb'))
            ->set_default_value(''),
        Field::factory('text', 'lotto_currency', __('Currency', 'crb'))
            ->set_default_value('$'),
        Field::make("checkbox", "lotto_ngcart", "Use ngCart for Cart Page")
            ->set_option_value('yes')
    ));
