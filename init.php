<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action('init', 'ldoc_create_list_configuration');
add_action('admin_menu', 'ldoc_admin_menu');
define('LOGICALDOC_PATH', plugin_dir_path(__FILE__));
define('LOGICALDOC_URL', plugins_url('', __FILE__));

add_action('wp_ajax_add_foobar', 'prefix_ajax_add_foobar');
add_action('wp_ajax_nopriv_add_foobar', 'prefix_ajax_add_foobar');

/*
Including ACF Plugin if not previousy Activated 
*/
if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
}
if (!is_plugin_active('advanced-custom-fields/acf.php')) {
    require_once('advanced-custom-fields/acf.php');
    define('ACF_LITE', true);
}


/*
Including JavaScript Code to handle Ajax (Connection)
*/
add_action('admin_head', 'ldoc_test_connection_javascript');

function ldoc_test_connection_javascript()
{
    ?>
    <script type="text/javascript">

        jQuery(document).ready(function ($) {
            function displayOverlay(text) {
                $("<table id='overlay'><tbody><tr><td>" + text + "</td></tr></tbody></table>").css({
                    "position": "fixed",
                    "top": "0px",
                    "left": "0px",
                    "width": "100%",
                    "height": "100%",
                    "background-color": "rgba(0,0,0,.5)",
                    "z-index": "10000",
                    "vertical-align": "middle",
                    "text-align": "center",
                    "color": "#fff",
                    "font-size": "40px",
                    "font-weight": "bold",
                    "cursor": "wait"
                }).appendTo("body");
            }

            function removeOverlay() {
                $("#overlay").remove();
            }

            $('.testBTN').click(function () {
                displayOverlay("Please Wait...");
                var connID = $(this).attr("data-connid");
                var data = {
                    action: 'test_connection',
                    connID: connID
                };

                // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
                $.post(ajaxurl, data, function (response) {

		    //alert('Got this from the server: ' + response);

                    if ($('#message').length) {
                        $('#message').replaceWith('<div id="message" class="notice notice-info is-dismissible"><p><strong>' + response + '</strong>.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>');
                    } else {
			$('<div id="message" class="notice notice-info is-dismissible"><p><strong>' + response + '</strong>.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>').insertAfter('h1');
                    }   
                    removeOverlay();                   
                });
            });


        });
    </script>
    <?php

}

add_action('init', 'ldoc_start_session', 1);
add_action('wp_logout', 'ldoc_end_session');
add_action('wp_login', 'ldoc_end_session');

function ldoc_start_session()
{
    if (!session_id()) {
        session_start();
    }
}

function ldoc_end_session()
{
    //session_destroy();

    unset($_SESSION['sessionSearch']);
    unset($_SESSION['logicalDoc_entrar']);
    unset($_SESSION['folderID']);
    unset($_SESSION['logicalDoc_mensaje']);
}

function ldoc_get_var($input, $default, $returnType = NULL)
{
    if (isset($_GET[$input]) && !empty($_GET[$input])) {
        $input = filter_var($_GET[$input], FILTER_SANITIZE_STRING);

        switch ($returnType) {
            case 'int':
                return preg_replace('/[^0-9]/', '', $input);
                break;

            default:
                return $input;
                break;
        }
    } else {
        return $default;
    }

}











