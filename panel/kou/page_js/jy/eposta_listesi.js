$(function () {
   var dt_table = $("#data_table").DataTable({
            "language": {
                "url": "plugins/datatables/turkish.json"
            }
        });

});
function slider_sil(scroll_id,item_id,height_id,form_id,info_field){
	
    var confirm_ = confirm("İçeriği Silmek Istediginizden Eminmisiniz ?");
    if(confirm_){
      $.post("piston/control/"+glob_page_uri+".php",{"islem":"sil","sid":item_id},function(sonuc,sc){
          if(sc=="success"){
               $("#"+info_field).html(sonuc);
               $("#ex").load("piston/control/"+glob_page_uri+"_load.php");
                $('html,body').animate({scrollTop: $("body").height() }, 1000);
          }
      });
    }

}