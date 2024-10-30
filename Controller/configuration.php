<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class LogicalDOCControllerConfiguration
{
    public function test($connID)
    {
        $user = acf_get_field('user', $connID);
        $password = acf_get_field('password', $connID);
        $url = acf_get_field('url', $connID);
        $message = "";
        try {
            $LDAuth = new SoapClient($url . '/services/Auth?wsdl');
            // Login
            $loginResp = $LDAuth->login(array('username' => $user, 'password' => $password));
            $token = $loginResp->return;
            $LDAuth->logout(array('sid' => $token));
            $message = __('Connection Succeeded', 'codended');
        } catch (Exception $e) {
            $message = __('Cannot establish a connection', 'codended');
        }

        echo $message;
    }

}

?>
