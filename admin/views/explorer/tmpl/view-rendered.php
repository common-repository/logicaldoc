<style type="text/css">
    #basic {
        padding: 10px;
    }
</style>
<script type="text/javascript">

    jQuery(document).ready(function () {

        var iDisplayLength = <?php echo acf_get_field('show_in_table', $id);?>;
        var icon = <?php echo(in_array('Icon', acf_get_field('show_fields', $id)) ? (1) : (0));?>;	
        var size = <?php echo(in_array('Size', acf_get_field('show_fields', $id)) ? (1) : (0));?>;
        var type = <?php echo(in_array('Type', acf_get_field('show_fields', $id)) ? (1) : (0));?>;
        var updateDate = <?php echo(in_array('Update Date', acf_get_field('show_fields', $id)) ? (1) : (0));?>;
        var author = <?php echo(in_array('Author', acf_get_field('show_fields', $id)) ? (1) : (0));?>;
        var version = <?php echo(in_array('Version', acf_get_field('show_fields', $id)) ? (1) : (0));?>;

        var iconValor = false;
        var sizeValor = false;
        var typeValor = false;
        var updateDateValor = false;
        var authorValor = false;
        var versionValor = false;

        if (icon == 1) {
            iconValor = true;
        }
        if (size === 1) {
            sizeValor = true;
        }
        if (type === 1) {
            typeValor = true;
        }
        if (updateDate == 1) {
            updateDateValor = true;
        }
        if (author == 1) {
            authorValor = true;
        }
        if (version == 1) {
            versionValor = true;
        }
        var asInitVals = new Array();
        var oTable = jQuery('#tablaExplorer').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "iDisplayLength": iDisplayLength,
            "bFilter": true,
	    "bAutoWidth": false,                              
            "aoColumns": [
                {"bSortable": false, "bSearchable": false, "sWidth": "16px", "bVisible": iconValor},
                {"bSortable": true, "bVisible": true},
		{"bSortable": true, "bVisible": sizeValor,
			"mRender": function(size, type, full) {
					if (type == 'display') {
                                                if (size === '0') {return '0 B';}
                                                if (size == 0) {return ' ';}
						//var i = Math.floor( Math.log(size) / Math.log(1024) );
					//return ( size / Math.pow(1024, i) ).toFixed(2) * 1 + ' ' + ['B', 'KB', 'MB', 'GB', 'TB'][i];
					//return ( size / Math.pow(1024, i) ).toFixed(1) * 1 + ' ' + ['B', 'KB', 'MB', 'GB', 'TB'][i];
					//return ( size / Math.pow(1024, i) ).toFixed(0) * 1 + ' ' + ['B', 'KB', 'MB', 'GB', 'TB'][i];
					var sizek = Math.floor( size / 1024 ).toFixed(0) * 1;
					return sizek.toLocaleString() + ' KB';
					}
				   	return size;
				   }
      		},
		{"bSortable": true, "bVisible": typeValor},
                {"bSortable": true, "bVisible": updateDateValor,
                    "mRender": function (date, type, full) {
                        if (type == 'display') {
                            var mydt = new Date(date);
                            //var options = {hour: '2-digit', minute:'2-digit'}; 
                            //return mydt.toLocaleDateString() + " " + mydt.toLocaleTimeString();
                       //return mydt.toLocaleDateString() + " " + mydt.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
			return mydt.toLocaleDateString([], {day: '2-digit', month:'2-digit', year:'numeric'}) + " " + mydt.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});  
                        }
                        return date;
                    }
                },
                {"bSortable": true, "bVisible": authorValor},
                {"bSortable": false, "bVisible": versionValor}
            ],
            "aaSorting": [[0, "asc"]],
            "oLanguage": {
                "sProcessing": "<?php _e('Please wait ...', 'codended'); ?>",
                "sLengthMenu": "<?php echo _e('Show', 'codended'); ?> _MENU_ <?php _e('entries', 'codended'); ?>",
                "sZeroRecords": "<?php _e('Nothing found - sorry', 'codended'); ?>",
                "sInfo": "<?php _e('Showing', 'codended'); ?> _START_ <?php _e('to', 'codended'); ?> _END_ <?php _e('of', 'codended'); ?> _TOTAL_ <?php _e('entries', 'codended'); ?>",
                "sInfoEmpty": "<?php _e('Showing', 'codended'); ?> 0 <?php _e('to', 'codended'); ?> 0 <?php _e('of', 'codended'); ?> 0 <?php _e('entries', 'codended'); ?>",
                "sInfoFiltered": "(<?php _e('filtered from', 'codended'); ?> _MAX_ <?php _e('total entries', 'codended'); ?>)",
                "sInfoPostFix": "",
                "sSearch": "<?php _e('Filter', 'codended'); ?>",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "<?php _e('First', 'codended'); ?>",
                    "sPrevious": "<?php _e('Previous', 'codended'); ?>",
                    "sNext": "<?php _e('Next', 'codended'); ?>",
                    "sLast": "<?php _e('Last', 'codended'); ?>"
                }
            }
        });

        jQuery('#searchBasic').button().click(function () {
            if (jQuery('#formSearch').validationEngine('validate')) {
                document.formSearch.task.value = 'searchBasic';
                document.formSearch.submit();
            }
            return false;
        });

        jQuery('#contenido').keypress(function (e) {
            // works when enter key is pressed
            if (e.keyCode == 13) {
                var contenido = jQuery('#contenido').val();
                if (contenido) {
                    document.formSearch.task.value = 'searchAdvanced';
                    document.formSearch.submit();
                }
                else {
                    jQuery('#contenido').validationEngine('showPrompt', "<?php _e('This field is required', 'codended'); ?>", 'error', true);
                    return false;
                }
            }
        });

        jQuery('#cbSearchAdvanced').button().click(function () {
            if (jQuery(this).is(':checked')) {
                jQuery('#basic').css('display', 'none');
                jQuery('#advanced').css('display', '');
                jQuery('#tablaExplorer_wrapper').css('display', 'none');
                jQuery("#spanAdvancedSearch").css('display', 'none');
            }
        });

        jQuery('#formSearch').validationEngine();
    });
</script>
<?php
if ($viewObj->entrar == 0) { ?>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('#enviar').click(function () {
                document.formAcceso.task.value = 'enviar';
                document.formAcceso.submit();
            });

            jQuery("#enviar").button();
        });
    </script>
    <div class="">
        <?php if ($viewObj->mensaje != '') { ?>
            <p style="color: #ff0000;"><?php echo $viewObj->mensaje; ?></p>
        <?php } ?>
        <h3 class="contentpassword-title"><?php _e('Restricted content', 'codended') ?></h3>
        <p class="contentpassword-description"><?php _e('Protected area', 'codended') ?><br>
            <?php _e('You need a password to accessing this content', 'codended') ?></p>
        <form action="" method="post" id="formAcceso" name="formAcceso" class="contentpassword-form">
            <table>
                <tr>
                    <td align="right"><?php _e('Password', 'codended') ?></td>
                    <td><input type="password" name="accessPassword" id="accessPassword" value=""/></td>
                    <td><button id="enviar"><?php _e('Send', 'codended'); ?></button></td>
                </tr>
            </table>
            <input type="hidden" name="option" value="com_logicaldoc"/>
            <input type="hidden" name="view" value="explorer"/>
            <input type="hidden" name="task" value=""/>
            <input type="hidden" name="id" value="<?php echo $viewObj->idConfiguration; ?>"/>
        </form>
    </div>
    <?php
} else if ($viewObj->error == 0) {

    // List Folder
    $getChildrenFolder = $viewObj->LDFolder->listChildren(array('sid' => $viewObj->token, 'folderId' => $viewObj->folderID));

    if (!empty ($getChildrenFolder->folder)) {
        $folderArray = $getChildrenFolder->folder;
        if (!is_array($folderArray)) {
            $folderArray = array();
            $folderArray [0] = $getChildrenFolder->folder;
        }
    }

    //List Document
    $getChildrenDocument = $viewObj->LDDocument->listDocuments(array('sid' => $viewObj->token, 'folderId' => $viewObj->folderID));

    if (!empty ($getChildrenDocument->document)) {
        $documentArray = $getChildrenDocument->document;
        if (!is_array($documentArray)) {
            $documentArray = array();
            $documentArray[0] = $getChildrenDocument->document;
        }
    }

    $getPathResult = $viewObj->LDFolder->getPath(array('sid' => $viewObj->token, 'folderId' => $viewObj->folderID));

    if (!empty ($getPathResult->folders)) {
        $folderPath = $getPathResult->folders;
        if (!is_array($folderPath)) {
            $folderPath = array();
            $folderPath[0] = $getPathResult->folders;
        }
    }

    $viewObj->LDAuth->logout(array('sid' => $viewObj->token));
    ?>
    <h3><?php _e('Path', 'codended'); ?>:

        <?php
        $exitemid = '';

        $canprint = 0;
        $startFolder = $viewObj->startFolderID;
        for ($i = 0; $i < count($folderPath); $i++) {
            if ($folderPath[$i]->id == $startFolder) {
                $canprint = 1;
            }
            if ($canprint) {
                //$folderPathUri = "index.php?option=com_logicaldoc&view=explorer&task=folder&folderID=" . $folderPath[$i]->id;
		$folderPathUri = "index.php?folderID=" . $folderPath[$i]->id;
                if (!empty($exitemid)) {
                    $folderPathUri .= "&Itemid=" . $exitemid;
                }
                ?>
                <a href="<?php echo $folderPathUri; ?>">
                    <?php
                    if ($i != 0) {
                        echo '/' . $folderPath[$i]->name;
                    } else {
                        echo _e('Root', 'codended');
                    }
                    ?>
                </a>
            <?php }
        } ?></h3>


    <div id="basic" width="100%">
        <form method="GET" action="" name="formSearch" id="formSearch">
            <span><?php _e('Search by content', 'codended') ?>:</span>
            <span><input type="text" name="contenido" id="contenido" value="" size="50" class="validate[required] text-input"/></span>
            <span><button id="searchBasic"><img src="<?php echo LOGICALDOC_URL; ?>/assets/images/search.png" width="16"/></button></span>
            <input type="hidden" name="view" value="search"/>
            <input type="hidden" name="id" value="<?php $id; ?>"/>
            <input type="hidden" name="task" value=""/>
            <input type="hidden" name="documento" id="documento" value="1"/>
        </form>
    </div>
    <div id="advanced" style="display: none;">
        <?php require_once(LOGICALDOC_PATH . '/views/explorer/tmpl/form.php'); ?>
    </div>
    <span id="spanAdvancedSearch">
	<input type="checkbox" name="cbSearchAdvanced" id="cbSearchAdvanced"/>
	<label id="lSearch" for="cbSearchAdvanced"><?php echo _e('Advanced Search', 'codended'); ?></label>
    </span>
    <table id="tablaExplorer" width="95%" class="display">
        <thead>
        <tr>
            <th></th>
            <th><?php _e('Name', 'codended'); ?></th>
            <th><?php _e('Size', 'codended') ?></th>
	    <th><?php _e('Type', 'codended') ?></th>
            <th><?php _e('Modified', 'codended'); ?></th>
            <th><?php _e('Author', 'codended'); ?></th>
            <th><?php _e('Version', 'codended'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php

        if (!empty($folderArray)) {
            if (is_array($folderArray)) {
                foreach ($folderArray as $folder) {
                    ldoc_print_folder($folder, $exitemid);
                }
            } else {
                if (isset($folderArray)) {
                    ldoc_print_folder($folderArray, $exitemid);
                }
            }
        }

        if (!empty($documentArray)) {
            if (is_array($documentArray)) {
                foreach ($documentArray as $document) {
                    ldoc_print_document($document, $id);
                }
            } else {
                if (isset($documentArray)) {
                    ldoc_print_document($documentArray, $id);
                }
            }
        }

        ?>
        </tbody>
    </table>
<?php } else { ?>

    <h2><?php _e('Error - The configuration is not correct please check your LogicalDOC configuration to connect to', 'codended'); ?>
        .</h2>
<?php }
