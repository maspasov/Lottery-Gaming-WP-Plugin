<?php

Carbon_Container::factory('theme_options', __('API Options', 'crb'))
    ->add_fields(array(
            Carbon_Field::factory('text', 'lotto_access_token', __('Access Token', 'crb'))
                ->set_default_value(''),
            Carbon_Field::factory('text', 'lotto_base_api_url', __('Base API URL', 'crb'))
                ->set_default_value(''),
            Carbon_Field::factory('text', 'lotto_cashier_url', __('Cashier URL', 'crb'))
                ->set_default_value(''),
            Carbon_Field::factory('text', 'brand_id', __('Brand ID', 'crb'))
                ->set_default_value(''),
            Carbon_Field::factory('text', 'currency', __('Currency', 'crb'))
                ->set_default_value('$'),
    ));
