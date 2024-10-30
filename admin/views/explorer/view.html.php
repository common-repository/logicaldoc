<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Copyright (c) 2006-2020 LogicalDOC
 * WebSites: www.logicaldoc.com
 *
 * No bytes were intentionally harmed during the development of this application.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */
class LogicalDOCViewExplorer
{
    public $token;
    public $session;
    public $LDAuth;
    public $LDDocument;
    public $LDFolder;
    public $folderID;
    public $error;

    public $entrar;
    public $mensaje;

    public $idConfiguration;

    public $path;
    public $properties;
    public $content;

    function __construct($idConfiguration)
    {
        $this->idConfiguration = $idConfiguration;
    }

    public function render()
    {
        $url = acf_get_field('url', $this->idConfiguration);
        $user = acf_get_field('user', $this->idConfiguration);
        $password = acf_get_field('password', $this->idConfiguration);
        $accessLevel = acf_get_field('access_level', $this->idConfiguration);
        $ldFolderID = acf_get_field('folder_id', $this->idConfiguration);

        $error = 0;
        $layout = 'view';

        if ($layout == 'view') {

            if ($accessLevel == 'Private') {
                $this->entrar = (!isset($_SESSION['logicalDoc_entrar']) ? (NULL) : ($_SESSION['logicalDoc_entrar']));
                if ($this->entrar == null) {
                    $this->entrar = 0;
                }
            } else {
                $this->entrar = 1;
            }

            if ($this->entrar == 1) {
                try {
                    // Register WSDL
                    $LDAuth = new SoapClient($url . '/services/Auth?wsdl');

                    // Login
                    $loginResp = $LDAuth->login(array('username' => $user, 'password' => $password));
                    $token = $loginResp->return;
                    $this->token = $token;

                    $LDDocument = new SoapClient($url . '/services/Document?wsdl');
                    $LDFolder = new SoapClient($url . '/services/Folder?wsdl');

                    $folderID = ldoc_get_var('folderID', '', 'int');
                    if ($folderID == '' || $folderID == $ldFolderID) {
                        $folderID = $ldFolderID;
                    }

                    $_SESSION['folderID'] = $folderID;

                    $this->LDAuth = $LDAuth;
                    $this->LDDocument = $LDDocument;
                    $this->LDFolder = $LDFolder;
                    $this->folderID = $folderID;
                    $this->startFolderID = $ldFolderID;
                    $this->error = $error;

                    $this->session = $_SESSION;
                } catch (Exception $e) {
                    $error = 1;
                }
            }//fin if entrar

            $this->mensaje = (isset($_SESSION['logicalDoc_mensaje']) ? ($_SESSION['logicalDoc_mensaje']) : (NULL));
        }
    }

}

?>
