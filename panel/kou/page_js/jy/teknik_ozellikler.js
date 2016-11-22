function dosya_ekle(form_id,info_field){

    var current_effect = $('#waitMe_ex_effect').val();
          run_waitMe_pop(current_effect);
	var formData = new FormData();
        formData.append("sid",$("#"+form_id+" input[name='sid']").val());
        formData.append("tip",$("#"+form_id+" input[name='tip']").val());
        formData.append("eid",$("#"+form_id+" input[name='eid']").val());

        formData.append("dosya",$("#"+form_id+" input[name='dosya']")[0].files[0]);
        formData.append("teknik_grup",$("#"+form_id+" input[name='teknik_grup']").val());

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
                  $(".teknik_ozellik").load("piston/control/"+glob_page_uri+"_load.php?uid="+$("#"+form_id+" input[name='sid']").val());
                  $(".teknik_ozellik_ic .img_list").load("piston/control/"+glob_page_uri+"_pop_load.php?uid="+$("input[name='sid']").val());

                  //var tops = (parseInt($("li[menu_id='"+glob_page_uri+"'] .count_inf").html())+1);
               	  //$("li[menu_id='"+glob_page_uri+"'] .count_inf").html(tops);
                  //$(".mimari_renk .img_list").load("piston/control/"+glob_page_uri+"_pop_load.php?uid="+$("input[name='sid']").val());

                $('.main_full_pop').waitMe('hide');
               // $("#"+dis_div+" .box-primary").slideToggle("slow");
                $("#"+form_id)[0].reset();
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
              $("#"+info_field).html(jqXHR);
              $("#"+form_id)[0].reset();
                 // $(".mimari_renk .img_list").load("piston/control/"+glob_page_uri+"_pop_load.php?uid="+$("input[name='sid']").val());

              $('.main_full_pop').waitMe('hide');
            //  $("#"+dis_div+" .box-primary").slideToggle("slow");
            }
        });

$("input[name='eid']").val('0');
 $("input[name='dosya']").removeAttr("readonly");

   $("input[name='dosya']").attr("require","");

	return false;
}

function dosya_duzenle(item_id,form_id,info_field){
   $('.fancybox-inner').animate({scrollTop: 0 }, 1000);
   $("#"+form_id+" input[name='eid']").val("item_id");
   $("input[name='teknik_grup']").val($("li[m_id='"+item_id+"'] .head_b").html());
   $("input[name='eid']").val(item_id);
   $("input[name='dosya']").removeAttr("require");
   $("input[name='dosya']").attr("readonly","");
}


 function dosya_sil(sil_id,info_field,form_id){
    var sil_e = confirm("İçeriği silmek istediğinize eminmimisiniz ?");

    if(sil_e){
          var current_effect = $('#waitMe_ex_effect').val();
          run_waitMe_pop(current_effect);
        $.post("piston/control/"+glob_page_uri+".php",{eid:sil_id,islem:"sil"},function(sonuc,sc){
            if(sc=="success"){
               // alert("Şuanda işlem yapılamıyor");
                    $('.teknik_ozellik').load("piston/control/"+glob_page_uri+"_load.php?uid="+$("input[name='sid']").val());
                    $(".teknik_ozellik_ic .img_list").load("piston/control/"+glob_page_uri+"_pop_load.php?uid="+$("input[name='sid']").val());
                    $("#"+info_field).html(sonuc);

                    $('.main_full_pop').waitMe('hide');
            }else{
              //  $("#list_update_"+sil_id).remove();
                  $('.teknik_ozellik').load("piston/control/"+glob_page_uri+"_load.php?uid="+$("input[name='sid']").val());
                  $(".teknik_ozellik_ic .img_list").load("piston/control/"+glob_page_uri+"_pop_load.php?uid="+$("input[name='sid']").val());
                  $("#"+info_field).html(sonuc);
                  $('.main_full_pop').waitMe('hide');

            }

               $("#"+form_id)[0].reset();
               $("input[name='dosya']").removeAttr("readonly");
               $("input[name='dosya']").attr("required","");
               $("input[name='eid']").val("0");
            // $(".on_").css("display","none");
        });
    }
 }    