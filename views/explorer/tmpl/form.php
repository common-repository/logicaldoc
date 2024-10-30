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
?>
<script language="javascript" type="text/javascript">

    jQuery(document).ready(function () {

        jQuery("#searchAdvanced").button().click(function () {
            var contenidoSA = jQuery('#contenidoSearchAdvanced').val();
            if (contenidoSA) {
                document.formSearchAdvanced.task.value = 'searchAdvanced';
                document.formSearchAdvanced.submit();
            }
            else {
		jQuery('#contenidoSearchAdvanced').validationEngine('showPrompt', "<?php _e('This field is required', 'codended');?>", 'error', true);
                return false;
            }
        });

        jQuery('#contenidoSearchAdvanced').keypress(function (e) {
            // works when enter key is pressed
            if (e.keyCode == 13) {
                var contenidoSA = jQuery('#contenidoSearchAdvanced').val();
                if (contenidoSA) {
                    document.formSearchAdvanced.task.value = 'searchAdvanced';
                    document.formSearchAdvanced.submit();
                }
                else {
                    jQuery('#contenidoSearchAdvanced').validationEngine('showPrompt', "<?php _e('This field is required', 'codended'); ?>", 'error', true);
                    return false;
                }
            }
        });

        jQuery("#searchReturn").button().click(function () {
            //document.formSearch.task.value = 'returnDesktop';
            //document.formSearch.submit();
        });

        jQuery("#tab").tabs();

        jQuery('#formSearchAdvanced').validationEngine();
    });


</script>
<form action="" method="GET" name="formSearchAdvanced" id="formSearchAdvanced" enctype="application/x-www-form-urlencoded">
    <div id="tab">
        <ul>
            <li><a href="#dato"><?php _e('Advanced Search', 'codended') ?></a></li>
        </ul>
        <div id="dato">
            <table id="datoTable" align="center">
                <tr>
                    <td align="right"><?php _e('Content', 'codended') ?>:</td>
                    <td>
<?php
   if (empty($_GET["contenido"])) {
       echo "<input type='text' name='contenido' id='contenidoSearchAdvanced' value=''/>";
   } else {
       $contentFiltered = filter_var($_GET["contenido"], FILTER_SANITIZE_STRING);
       echo "<input type='text' name='contenido' id='contenidoSearchAdvanced' value='" .$contentFiltered ."'/>";
   }
?>
                    </td>
                </tr>
                <tr>
                    <td align="right">Search Fields:</td>
                    <td>
                        <input type="checkbox" name="sfields[]" id="sfieldsc" value="content" checked="checked"/>Content
                        <input type="checkbox" name="sfields[]" id="sfieldst" value="title" checked="checked"/>Title
                        <input type="checkbox" name="sfields[]" id="sfieldsk" value="tags" checked="checked"/>Tags
                    </td>
                </tr>
                <tr>
                    <td><?php _e('Document Type', 'codended'); ?>:</td>
                    <td>
                        <select id="tipoDocumento" name="tipoDocumento">
                            <option value=""></option>
                            <option value="pdf,doc,docx,odt,rtf">Document</option>
                            <option value="xls,xlsx,ods">Spreadsheet</option>
                            <option value="ppt,pptx,odp">Presentation</option>
                            <option value="txt,html,htm,xml">Text</option>
                            <option value="jpg,png,gif,tif,psd,dwg,bmp,tiff">Image</option>
                            <option value="mp3,wav">Audio</option>
                            <option value="avi,mkv,mp4,wmv">Video</option>
                            <option value="eml,msg">Email</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
        <table width="100%" id="buttonTable">
            <tr>
                <td align="right" colspan="2">
                    <?php
                      $backAddr = "?option=com_logicaldoc&view=explorer&task=folder&folderID=" .$_SESSION['folderID'];
		      echo '<a id="searchReturn" href="' . $backAddr . '" class="button">' . __('Go Back', 'codended') . '</a>';
 ?>
                    <button id="searchAdvanced">
                        <?php _e('Search', 'codended'); ?>
                    </button>
                </td>
            </tr>
        </table>
        <input type="hidden" name="view" value="search"/>
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <input type="hidden" name="task" value=""/>
        <input type="hidden" name="documento" id="documentoSearchAdvanced" value="1"/>
    </div><!--fin del tabs-->
</form>
