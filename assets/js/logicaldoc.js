
jQuery(document).ready(function($) {

    $("#tablaExplorer").on("click", ".download-logicaldoc", function(){
       var id = $(this).attr('data-id');
       var documentID = $(this).attr('data-documentID');
       window.location = ajaxurl+"?action=ldoc_download_file&id="+id+"&documentID="+documentID+"";
       return false;
    });

    $("#tablaSearch").on("click", ".download-logicaldoc", function(){
       var id = $(this).attr('data-id');
       var documentID = $(this).attr('data-documentID');
       window.location = ajaxurl+"?action=ldoc_download_file&id="+id+"&documentID="+documentID+"";
       return false;
    });
        
});

