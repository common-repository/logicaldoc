<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once('admin/views/explorer/tmpl/view.php');

function ldoc_test_enviar_callback($viewObj, $id)
{
    $accessPassword = acf_get_field('access_password', $id);
    $acceder = $_POST['accessPassword'];

    $mensaje = __('Incorrect Password', 'codended');
    if (substr_compare($accessPassword, $acceder, 0) == 0) {
        $_SESSION['logicalDoc_entrar'] = 1;
        $mensaje = __('Correct Password', 'codended');
    }
    $_SESSION['logicalDoc_mensaje'] = $mensaje;
}

function logicalDoc_function($atts)
{
    extract(shortcode_atts(array(
        'id' => 1,
    ), $atts));

    $view = ldoc_get_var('view', 'explorer', '');
    if ($view == 'search') {
        //Search 
        require_once('admin/views/search/view.html.php');
        $viewObj = new LogicalDOCViewSearch($id);
        if (isset($_POST['accessPassword'])) {
            ldoc_test_enviar_callback($viewObj, $id);
        }
        $viewObj->render();

    } else {
        require_once('admin/views/explorer/view.html.php');
        $viewObj = new LogicalDOCViewExplorer($id);
        if (isset($_POST['accessPassword'])) {
            ldoc_test_enviar_callback($viewObj, $id);
        }
        $viewObj->render();
    }


    if ($viewObj->error == 0) {
        if ($view == 'search') {
            require_once('admin/views/search/tmpl/result.php');
        } else {
            require_once('admin/views/explorer/tmpl/view-rendered.php');
        }

    }
}

add_shortcode('logicalDoc', 'logicalDoc_function'); ?>
