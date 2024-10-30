<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action('wp_head', 'ldoc_ajaxurl');
add_action('wp_ajax_test_connection', 'ldoc_test_connection_callback');
add_action('wp_ajax_test_function', 'ldoc_test_function_callback');
add_action('wp_ajax_ldoc_download_file', 'ldoc_download_file');
add_action('wp_ajax_nopriv_ldoc_download_file', 'ldoc_download_file');

function ldoc_ajaxurl()
{
    echo '<script type="text/javascript"> var ajaxurl = "' . admin_url('admin-ajax.php') . '"; </script>';
}

function ldoc_test_connection_callback()
{
    $classObj = new LogicalDOCControllerConfiguration();
    $classObj->test($_POST['connID']);
    exit();
}

function ldoc_download_file()
{
    require_once(LOGICALDOC_PATH . '/admin/LogicalDOC_IconSelector.php');

    $idConfiguration = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $docID = filter_var($_GET['documentID'], FILTER_SANITIZE_NUMBER_INT);

    $user = acf_get_field('user', $idConfiguration);
    $password = acf_get_field('password', $idConfiguration);
    $url = acf_get_field('url', $idConfiguration);

// Register WSDL
    $LDAuth = new SoapClient($url . '/services/Auth?wsdl');

    $exceptionRaised = NULL;
    try {// Login
        $loginResp = $LDAuth->login(array('username' => $user, 'password' => $password));
        $token = $loginResp->return;

        $LDDocument = new SoapClient($url . '/services/Document?wsdl');

        $getPropertiesResp = $LDDocument->getDocument(array('sid' => $token, 'docId' => $docID));
        $properties = $getPropertiesResp->document;

        $getContent = $LDDocument->getContent(array('sid' => $token, 'docId' => $docID));
        $content = $getContent->return;

// Logout
        $LDAuth->logout(array('sid' => $token));

        header('Expires: Sat, 6 May 1971 12:00:00 GMT');
        header('Cache-Control: max-age=0, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0');
        header('Pragma: no-cache');

        $mimeType = LogicalDOC_IconSelector::get_mime_type($properties->type);
        header('Content-Type: ' . $mimeType);
        header('Content-Disposition: attachment; filename="' . $properties->fileName . '"');
        echo $content;
    } catch (Exception $e) {
        $exceptionRaised = true;
    }

    // Try again the logout
    if ($exceptionRaised) {
        try {
            $LDAuth->logout(array('sid' => $token));
        } catch (Exception $e) {
        }
    }

    die();
}

function ldoc_test_function_callback()
{
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, strpos($_SERVER["SERVER_PROTOCOL"], '/'))) . '://';
    $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $new_query = add_query_arg(array(
        'accessPassword' => false,
        'baz' => 'qux'
    ), $url);
    echo $new_query;
}


?>
