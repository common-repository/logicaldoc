<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_filter('manage_list_configurations_posts_columns', 'ST4_columns_list_configurations_head');
add_action('manage_list_configurations_posts_custom_column', 'ST4_columns_list_configurations_content', 10, 2);
add_filter('manage_list_configurations_posts_columns', 'ST4_columns_remove_category');

function ldoc_admin_menu()
{
    add_menu_page('LogicalDOC', 'LogicalDOC', 'manage_options', 'logicaldoc/logical-doc-admin.php', 'myplguin_admin_page', 'dashicons-tickets', 6);
}

function ldoc_create_list_configuration()
{
    register_post_type('list_configurations',
        array(
            'labels' => array(
                'name' => 'List Configurations',
                'singular_name' => 'List Configuration',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Configuration',
                'edit' => 'Edit',
                'edit_item' => 'Edit Configuration',
                'new_item' => 'New Configuration',
                'view' => 'View',
                'view_item' => 'View Configuration',
                'search_items' => 'Search list Configurations',
                'not_found' => 'No configurations found',
                'not_found_in_trash' => 'No Configurations found in Trash',
                'parent' => 'Parent Movie Review'
            ),

            'public' => true,
            'menu_position' => 15,
            'supports' => array('title'),
            'taxonomies' => array(''),
            'has_archive' => false,
            'show_in_menu' => 'logicaldoc/logical-doc-admin.php',
            'exclude_from_search' => true,
            'publicly_queryable' => false,
        )
    );
}

// ADD TWO NEW COLUMNS
function ST4_columns_list_configurations_head($defaults)
{
    $defaults['logicaldoc_name'] = 'Name';
    $defaults['logicaldoc_user'] = 'User';
    $defaults['logicaldoc_url'] = 'URL';
    $defaults['logicaldoc_folderid'] = 'Folder ID';
    $defaults['logicaldoc_access'] = 'Access';
    $defaults['logicaldoc_connection'] = 'Connection';

    $defaults['logicaldoc_shortcode'] = 'Shortcode';
    return $defaults;
}

function ST4_columns_list_configurations_content($column_name, $post_ID)
{
    switch ($column_name) {
        case 'logicaldoc_name':
            echo acf_get_field('name', $post_ID);
            break;
        case 'logicaldoc_user':
            echo acf_get_field('user', $post_ID);
            break;
        case 'logicaldoc_url':
            echo acf_get_field('url', $post_ID);
            break;
        case 'logicaldoc_folderid':
            echo acf_get_field('folder_id', $post_ID);
            break;
        case 'logicaldoc_access':
            echo acf_get_field('access_level', $post_ID);
            break;

        case 'logicaldoc_connection':
            echo '<input type="button" data-connid="' . $post_ID . '"  value="Test" class="button testBTN"/>';
            break;

        case 'logicaldoc_shortcode':
            echo '<strong>[logicalDoc id="' . $post_ID . '"]</strong>';
            break;

        default:
            return;
            break;
    }
}

// REMOVE DEFAULT CATEGORY COLUMN
function ST4_columns_remove_category($defaults)
{
    // to get defaults column names:
    //print_r($defaults);
    unset($defaults['title']);
    unset($defaults['date']);
    return $defaults;
}

