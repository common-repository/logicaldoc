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
class LogicalDOCViewSearch
{
    public $token;
    public $session;
    public $LDAuth;
    public $LDDocument;
    public $LDFolder;
    public $folderID;
    public $error;
    public $rowConfiguration;

    public $entrar;
    public $mensaje;

    public $idConfiguration;

    public $path;
    public $properties;
    public $content;

    public $sessionSearch;

    public $resultArray;


    function __construct($idConfiguration)
    {
        $this->idConfiguration = $idConfiguration;
        $this->entrar = 1;
    }

    public function render()
    {
        $layout = 'result';
        $error = 0;

        $url = acf_get_field('url', $this->idConfiguration);
        $user = acf_get_field('user', $this->idConfiguration);
        $password = acf_get_field('password', $this->idConfiguration);

        if ($layout == 'result') {
            try {
                $contenido = ldoc_get_var('contenido', '', '');
                $nombre = ldoc_get_var('nombre', '', '');
                $palabraClave = ldoc_get_var('palabraClave', '', '');
                $documento = ldoc_get_var('documento', '', '');
                $carpeta = ldoc_get_var('carpeta', '', '');
                $tipoDocumento = ldoc_get_var('tipoDocumento', '', '');

                $_SESSION['sessionSearch']['contenido'] = $contenido;
                $_SESSION['sessionSearch']['nombre'] = $nombre;
                $_SESSION['sessionSearch']['palabraClave'] = $palabraClave;
                $_SESSION['sessionSearch']['documento'] = $documento;
                $_SESSION['sessionSearch']['carpeta'] = $carpeta;
                $_SESSION['sessionSearch']['tipoDocumento'] = $tipoDocumento;

                $sessionSearch = $_SESSION['sessionSearch'];
                $this->sessionSearch = $sessionSearch;

                // Register WSDL
                $LDAuth = new SoapClient($url . '/services/Auth?wsdl');

                // Login
                $loginResp = $LDAuth->login(array('username' => $user, 'password' => $password));
                $token = $loginResp->return;

                // Register WSDL
                $LDSearch = new SoapClient($url . '/services/Search?wsdl');

                $soptions = new LogicalDOC_SearchOptions();

                $scontent = ldoc_get_var('contenido', '', '');
                $soptions->expression = $scontent;

                // Setup the startfolder (limit the search to just the sub-tree starting from the configured folder)
                $startFolder = acf_get_field('folder_id', $this->idConfiguration);
                $soptions->folderId = $startFolder;

                if (isset($_POST['sfields'])) {
                    $soptions->fields = array();
                    $fArray = $_POST['sfields'];
                    for ($i = 0; $i < count($fArray); $i++) {
                        array_push($soptions->fields, $fArray[$i]);
                    }
                } else {
                    // user searched from the simple search (just filling the field contenido)
                    $soptions->fields = array('content', 'title', 'tags');
                    if (!isset($_POST['sfields'])) {
                        $_POST['sfields'] = array('content', 'title', 'tags');
                    }
                }

                $findResp = $LDSearch->find(array('sid' => $token, 'options' => $soptions));
                //error_log("SfindResp->searchResult->hits: " . print_r($findResp, true), 0);

                $resultArray = '';
                if (!empty($findResp->searchResult->hits)) {
                    $resultArray = $findResp->searchResult->hits;

                    //filter the result in the array based on Document Type        
                    if (!empty($tipoDocumento)) {
                        $resultArray = array();
                        $fdocs = $findResp->searchResult->hits;

                        if (!is_array($fdocs)) {
                            error_log("is NOT an Array!!", 0); 
                            $fdocs = array();
                            $fdocs[] = $findResp->searchResult->hits;
                            //error_log("count(Sfdocs) 01: " .count($fdocs), 0);
                        }

                        //error_log("count(Sfdocs) 02: " .count($fdocs), 0);
                        // Filter results by document-type (tipoDocumento)
                        for ($i = 0; $i < count($fdocs); $i++) {
                            $docext = $fdocs[$i]->type;
                            if (!empty($docext)) {
                                $docext = strtolower($docext);
                                if (strpos($tipoDocumento, $docext) !== false) {
                                    $resultArray[] = $fdocs[$i];
                                }
                            }
                        }
                    } else {
			            //error_log("StipoDocumento is EMPTY", 0);
			            //error_log("findResp->searchResult->hits: " .$findResp->searchResult->hits, 0);
		            }
                } else {
                    //error_log("SfindResp->searchResult->hits: " .$findResp->searchResult->hits, 0);
                }

                //error_log("count(Sfdocs) 03: " .count($fdocs), 0);
                $LDAuth->logout(array('sid' => $token));
                $this->resultArray = $resultArray;

                //error_log("count(Sthis->resultArray): " .count($this->resultArray), 0);
                $this->error = $error;
            } catch (Exception $e) {
                $error = 1;
                $this->error = $error;
            }
        }

    }

}

class LogicalDOC_SearchOptions
{
    var $type = 0; // 0 is full-text query
    var $expression = '';
    var $expressionLanguage = 'en';
    var $maxHits = 50;
    //var $language = 'en'; // search documents in english
    var $retrieveAliases = 0; // requested but not used
    var $caseSensitive = 0; // requested but not used
    //var $fields = array ('title','tags','content');
    var $fields = array();
    var $searchInSubPath = true;
    var $folderId = 4; // Default workspace ID
}


?>
