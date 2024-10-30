<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 *
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
<script type="text/javascript">

    jQuery(document).ready(function ($) {

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
            jQuery('#tablaSearch').dataTable({
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
                                //return mydt.toLocaleDateString() + " " + mydt.toLocaleTimeString();
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
        });
    });
</script>
<style type="text/css">
    #advanced {
        margin-top: 10px;
        margin-bottom: 10px;
    }
</style>
<?php

if ($viewObj->error == 0) {
    ?>
    <div id="advanced">
        <?php require_once(LOGICALDOC_PATH . '/views/explorer/tmpl/form.php'); ?>
    </div>
    <table id="tablaSearch" width="95%" class="display" cellpadding="0" cellspacing="0" border="0">
        <thead>
        <tr>
            <th></th>
            <th><?php _e('Name', 'codended'); ?></th>
	    <th><?php _e('Size', 'codended'); ?></th>
            <th><?php _e('Type', 'codended'); ?></th>
            <th><?php _e('Modified', 'codended'); ?></th>            
            <th><?php _e('Author', 'codended'); ?></th>
            <th><?php _e('Version', 'codended'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($viewObj->resultArray)) {
            if (is_array($viewObj->resultArray)) {
                foreach ($viewObj->resultArray as $result) {
                    ldoc_print_document($result, $id);
                }
            } else {
                ldoc_print_document($viewObj->resultArray, $id);
            }
        }
        ?>
        </tbody>
    </table>

<?php } else { ?>
    <h2><?php _e('Error - The configuration is not correct please check your LogicalDOC configuration to connect to', 'codended'); ?>
        .</h2>
    <?php
} ?>
