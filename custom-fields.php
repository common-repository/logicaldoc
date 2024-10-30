<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if (function_exists("acf_register_field_group")) {

    acf_register_field_group(array(
        'id' => 'acf_access-configuration',
        'title' => 'Access Configuration',
        'fields' => array(
            array(
                'key' => 'field_57fd1af981617',
                'label' => 'Name',
                'name' => 'name',
                'type' => 'text',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_57fd1bd49eacc',
                'label' => 'User',
                'name' => 'user',
                'type' => 'text',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_57fd1c3b9eacd',
                'label' => 'Password',
                'name' => 'password',
                'type' => 'password',
                'required' => 1,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'field_57fd1c4f9eace',
                'label' => 'URL',
                'name' => 'url',
                'type' => 'text',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_57fd1c799eacf',
                'label' => 'Folder ID',
                'name' => 'folder_id',
                'type' => 'number',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'min' => '',
                'max' => '',
                'step' => '',
            ),
            array(
                'key' => 'field_57fd1c8c9ead0',
                'label' => 'Access Level',
                'name' => 'access_level',
                'type' => 'select',
                'choices' => array(
                    'Public' => 'Public',
                    'Private' => 'Private',
                ),
                'default_value' => '',
                'allow_null' => 0,
                'multiple' => 0,
            ),
            array(
                'key' => 'field_57fd1cc19ead1',
                'label' => 'Access Password',
                'name' => 'access_password',
                'type' => 'password',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'list_configurations',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array(),
        ),
        'menu_order' => 0,
    ));

    acf_register_field_group(array(
        'id' => 'acf_setting-the-table',
        'title' => 'Setting the Table',
        'fields' => array(
            array(
                'key' => 'field_57fd1e5103627',
                'label' => 'Show Fields (Registries)',
                'name' => 'show_fields',
                'type' => 'checkbox',
                'choices' => array(
                    'Icon' => 'Icon',
                    'Size' => 'Size',
		    'Type' => 'Type',
                    'Update Date' => 'Update Date',
                    'Author' => 'Author',
                    'Version' => 'Version',
                ),
                'default_value' => '',
                'layout' => 'horizontal',
            ),
            array(
                'key' => 'field_57fd1ea903628',
                'label' => 'Show in Table',
                'name' => 'show_in_table',
                'type' => 'select',
                'choices' => array(
                    10 => 10,
                    25 => 25,
                    50 => 50,
                    100 => 100,
                ),
                'default_value' => '',
                'allow_null' => 0,
                'multiple' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'list_configurations',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array(),
        ),
        'menu_order' => 1,
    ));
}
