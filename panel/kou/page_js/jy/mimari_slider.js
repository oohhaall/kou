var sortableLinks = $(".detay_popup");
$(sortableLinks).sortable();
$( ".detay_popup" ).sortable({
       update: function() {
          var current_effect = $('#waitMe_ex_effect').val();
          run_waitMe_pop(current_effect);
            var gunc_list = $('.detay_popup').sortable('serialize');
            var post_dt = $(this).attr("dt_table");
            var post_uri = $(this).attr("post_uri");
            var g_uri = $(this).attr("post_uri");
            
          $.post("piston/control/list_update.php?gunc_page="+post_uri+"&g_id="+$("input[name='sid']").val()+"&dt="+post_dt,gunc_list,function(sonuc,sc){
              if(sc=="success" && sonuc=="guncellendi"){
                  $(".slider_resim_ic .img_list").load("piston/control/"+glob_page_uri+"_pop_load.php?uid="+$("input[name='sid']").val());
                  $('.main_full_pop').waitMe('hide');
              }
          });
        
        }       
});

  var extraObj =null;

    $(".brs").html("<div id='extraupload'></div>");
   
     extraObj = $("#extraupload").uploadFile({
                url:"piston/control/"+glob_page_uri+".php",
                fileName:"docs",
                multiple:true,
                extraHTML:function()
              {
                   var html = "<input type='hidden' name='sid' value='"+$("input[name='sid']").val()+"'>";
                   html += "<input type='hidden' name='eid' value='"+$("input[name='eid']").val()+"'>";
                   return html;  
              },
               onSubmit:function(){

                   // $("textarea[name='baslik']").attr("disabled","disabled");
                    
                },afterUploadAll:function(obj)
                {
                  var tp = ($(".ajax-file-upload-statusbar").length-1);
                      $(".ajax-file-upload-statusbar").each(function(say){
                        var ht ="<div class='ajax-file-upload-filename'>"+$(".ajax-file-upload-filename",this).html()+"</div>";
                            ht+= obj.responses[tp];
                          $(this).html(ht);
                          tp--;
                      });

                  $('.detay_popup').load("piston/control/"+glob_page_uri+"_load.php?uid="+$("input[name='sid']").val());
                  $(".slider_resim_ic .img_list").load("piston/control/"+glob_page_uri+"_pop_load.php?uid="+$("input[name='sid']").val());

                },
                autoSubmit:false
                });


 function dosya_sil(sil_id,info_field){
    var sil_e = confirm("İçeriği silmek istediğinize eminmimisiniz ?");
    var current_effect = $('#waitMe_ex_effect').val();
          run_waitMe_pop(current_effect);
    if(sil_e){
        $.post("piston/control/mimari_detay_resim.php",{eid:sil_id},function(sonuc,sc){
            if(sc=="success" && sonuc != "ok"){
                alert("Şuanda işlem yapılamıyor");
                    $('.detay_popup').load("piston/control/"+glob_page_uri+"_load.php?uid="+$("input[name='sid']").val());
                    $(".slider_resim_ic .img_list").load("piston/control/"+glob_page_uri+"_pop_load.php?uid="+$("input[name='sid']").val());

                    $('.main_full_pop').waitMe('hide');
            }else{
              //  $("#list_update_"+sil_id).remove();
                   $('.detay_popup').load("piston/control/"+glob_page_uri+"_load.php?uid="+$("input[name='sid']").val());
                  $(".slider_resim_ic .img_list").load("piston/control/"+glob_page_uri+"_pop_load.php?uid="+$("input[name='sid']").val());

                $('.main_full_pop').waitMe('hide');

            }


        })
    }
 }    
function dosya_ekle(){
    if($("input[name='eid']").val() == 0){
      extraObj.startUpload();
      //$(".btn-box-tool").click();
  }else{
      /*if($(".ajax-file-upload-statusbar").length){
          extraObj.startUpload();
            $.post("piston/control/brosur.php?type=duz",{"baslik":$("input[name='baslik']").val(),"sid":$("input[name='sid']").val()},function(sonuc,sc){
            if(sc=="success" && sonuc=="ok"){
                    $(".list_comp").load("piston/control/loader.php?page=brosurler");   
            }
          });

          //console.log("dolu");
      }else{
         // console.log("boş");
          $.post("piston/control/brosur.php?type=duz",{"baslik":$("input[name='baslik']").val(),"sid":$("input[name='sid']").val()},function(sonuc,sc){
            if(sc=="success" && sonuc=="ok"){
                    $(".list_comp").load("piston/control/loader.php?page=brosurler");   
                     $(".btn-box-tool").click();
            }
          });
         

      }*/
    }
      
  return false;
}