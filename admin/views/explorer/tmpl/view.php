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


require_once(LOGICALDOC_PATH . 'admin/LogicalDOC_IconSelector.php'); ?>
<?php

function ldoc_print_folder($folder, $exitemid = null)
{
    //$folderUrl = "index.php?option=com_logicaldoc&view=explorer&task=folder&folderID=" . $folder->id;
    $folderUrl = "index.php?folderID=" . $folder->id;		
    if (!empty($exitemid)) {
        $folderUrl = $folderUrl . "&Itemid=" . $exitemid;
    }
    ?>
    <tr>
        <td align="center">
            <img src="<?php echo LOGICALDOC_URL; ?>/assets/images/menuitem_childs.png"/>
        </td>
        <td>
            <a href="<?php echo $folderUrl; ?>">
                <?php echo $folder->name; ?>
            </a>
        </td>
        <td></td>
	<td>Folder</td>
        <td>
            <?php
            $ymd = DateTime::createFromFormat('Y-m-d H:i:s O', $folder->lastModified);
            echo $ymd->format('c');
            ?>
        </td>
        <td>
            <?php echo $folder->creator ?>
        </td>
        <td></td>
    </tr>
    <?php
}

function ldoc_print_document($document, $idConfiguration)
{
    ?>
    <tr>
        <td align="center">
            <img
                src="<?php echo LOGICALDOC_URL; ?>/assets/mimes/<?php echo LogicalDOC_IconSelector::selectIcon($document->type); ?>"/>
        </td>
        <td>
            <a href="#" class="download-logicaldoc" data-id="<?php echo $idConfiguration; ?>"
               data-documentID="<?php echo $document->id; ?>">
                <?php echo $document->fileName; ?>
            </a>
        </td>
        <td style="text-align:right">
            <?php echo $document->fileSize; ?>
        </td>
        <td>
            <?php echo LogicalDOC_IconSelector::getType($document->type); ?>
        </td>
        <td>
            <?php
            $ymd = DateTime::createFromFormat('Y-m-d H:i:s O', $document->date);
            echo $ymd->format('c');
            ?>
        </td>
        <td>
            <?php echo $document->publisher; ?>
        </td>
        <td style="text-align:right">
            <?php echo $document->fileVersion; ?>
        </td>
    </tr>
    <?php
}

?>
