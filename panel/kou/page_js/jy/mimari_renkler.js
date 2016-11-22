var sortableLinks = $(".detay_popup");
$(sortableLinks).sortable();
$( ".detay_popup" ).sortable({
       update: function() {
          var current_effect = $('#waitMe_ex_effect').val();
          run_waitMe_pop(current_effect);
            var gunc_list 	= $('.detay_popup').sortable('serialize');
            var post_dt 	= $(this).attr("dt_table");
            var post_uri 	= $(this).attr("post_uri");
            var g_uri 		= $(this).attr("post_uri");
            
          $.post("piston/control/list_update.php?gunc_page="+post_uri+"&g_id="+$("input[name='sid']").val()+"&dt="+post_dt,gunc_list,function(sonuc,sc){
              if(sc=="success" && sonuc=="guncellendi"){
                  $(".mimari_renk .img_list").load("piston/control/"+glob_page_uri+"_pop_load.php?uid="+$("input[name='sid']").val());
                  $('.main_full_pop').waitMe('hide');
              }
          });
        
        }       
});


 function dosya_sil(sil_id,info_field,form_id){
    var sil_e = confirm("İçeriği silmek istediğinize eminmimisiniz ?");
    var current_effect = $('#waitMe_ex_effect').val();
          run_waitMe_pop(current_effect);
    if(sil_e){
        $.post("piston/control/"+glob_page_uri+".php",{eid:sil_id,islem:"sil"},function(sonuc,sc){
            if(sc=="success"){
               // alert("Şuanda işlem yapılamıyor");
                    $('.detay_popup').load("piston/control/"+glob_page_uri+"_load.php?uid="+$("input[name='sid']").val());
                    $(".mimari_renk .img_list").load("piston/control/"+glob_page_uri+"_pop_load.php?uid="+$("input[name='sid']").val());
                    $("#"+info_field).html(sonuc);

                    $('.main_full_pop').waitMe('hide');
            }else{
              //  $("#list_update_"+sil_id).remove();
                  $('.detay_popup').load("piston/control/"+glob_page_uri+"_load.php?uid="+$("input[name='sid']").val());
                  $(".mimari_renk .img_list").load("piston/control/"+glob_page_uri+"_pop_load.php?uid="+$("input[name='sid']").val());
                  $("#"+info_field).html(sonuc);
                  $('.main_full_pop').waitMe('hide');

            }

               $("#"+form_id)[0].reset();
                $("input[name='resim']").removeAttr("readonly");
             $("input[name='resim']").attr("required","");
               $("input[name='eid']").val("0");
             $(".on_").css("display","none");
        });
    }
 }    
function dosya_ekle(form_id,info_field){

	  var formData = new FormData();
        formData.append("sid",$("#"+form_id+" input[name='sid']").val());
        formData.append("tip",$("#"+form_id+" input[name='tip']").val());
        formData.append("eid",$("#"+form_id+" input[name='eid']").val());

        formData.append("resim",$("#"+form_id+" input[name='resim']")[0].files[0]);
        formData.append("renk",$("#"+form_id+" select[name='renk']").val());

        $.ajax({
            url: 'piston/control/'+glob_page_uri+".php",
            type: 'POST',
            data: formData,
            cache: false,
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            success: function(sonuc, textStatus, jqXHR)
            {
                $("#"+info_field).html(sonuc);
                $(".detay_popup").load("piston/control/"+glob_page_uri+"_load.php?uid="+$("#"+form_id+" input[name='sid']").val());
               // var tops = (parseInt($("li[menu_id='"+glob_page_uri+"'] .count_inf").html())+1);
               // $("li[menu_id='"+glob_page_uri+"'] .count_inf").html(tops);
                  $(".mimari_renk .img_list").load("piston/control/"+glob_page_uri+"_pop_load.php?uid="+$("input[name='sid']").val());

                $('.main_full_pop').waitMe('hide');
               // $("#"+dis_div+" .box-primary").slideToggle("slow");
                $("#"+form_id)[0].reset();
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
              $("#"+info_field).html(jqXHR);
              $("#"+form_id)[0].reset();
                  $(".mimari_renk .img_list").load("piston/control/"+glob_page_uri+"_pop_load.php?uid="+$("input[name='sid']").val());

              $('.main_full_pop').waitMe('hide');
            //  $("#"+dis_div+" .box-primary").slideToggle("slow");
            }
        });
        /*
			Burada işlem yap
        */
  		 $("input[name='resim']").removeAttr("readonly");
		 $("input[name='resim']").attr("required","");
	   	 $("input[name='eid']").val("0");
		 $(".on_").css("display","none");

  return false;
}
function dosya_duzenle(item_id,form_id,info_field){
//fancybox-inner
	 $('.fancybox-inner').animate({scrollTop: 0 }, 1000);
	 $(".on_").attr("src",$("img[m_id='"+item_id+"']").attr("src"));
	 $("#"+form_id+" input[name='eid']").val("item_id");
	 $("select[name='renk'] option[value='"+$("renk[m_id='"+item_id+"']").html()+"']").prop("selected",true);
	 $(".on_").css("display","inline-block");

	 $("input[name='resim']").removeAttr("required");
	 $("input[name='resim']").attr("readonly","");

	 $("input[name='eid']").val(item_id);

}