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
                  $(".mozaik_dekor .img_list").load("piston/control/"+glob_page_uri+"_pop_load.php?uid="+$("input[name='sid']").val());
                  $('.main_full_pop').waitMe('hide');
              }
          });
        
        }       
});
/*
function dosya_duzenle(form_id,item_id,info_field){
	 $("#"+form_id+" input[name='eid']").val(item_id);
		$.each(dil_text, function( key, value ) {
             $("#"+form_id+" input[type=text][name='tab_dekor_baslik_"+key+"']").val($("g[m_id='"+item_id+"'][type='"+key+"']").html()); 
        });
}
*/
function dosya_ekle(form_id,info_field){
	   var bak = 0;
       $.each(dil_text, function(key,value) {
            if($("#"+form_id+" input[type=text][name='tab_dekor_baslik_"+key+"']").val().length ==0){
              bak = 1;
              $("#"+form_id+" a[href='#tab_dekor_baslik_"+key+"']").parent("li").css("border-top-color","#bc0101");
            }else{
              $("#"+form_id+" a[href='#tab_dekor_baslik_"+key+"']").parent("li").css("border-top-color","");
            }
           
       });
      if(bak!=1){
      	    var current_effect = $('#waitMe_ex_effect').val();
	        run_waitMe_pop(current_effect);
	       	var formData = new FormData();
	        //formData.append("sid",sid);
	        formData.append("eid",$("input[name='eid']").val());

          $.each(dil_text, function( key, value ) {
              formData.append("tab_dekor_baslik_"+key,$("#"+form_id+" input[type=text][name='tab_dekor_baslik_"+key+"']").val());
          });
              formData.append("resim",$("#"+form_id+" input[type=file][name='resim']")[0].files[0]);

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
                $(".mozaik_dekor .img_list").load("piston/control/"+glob_page_uri+"_pop_load.php?uid="+sid);
                $(".detay_popup").load("piston/control/"+glob_page_uri+"_load.php?uid="+sid);
                $('.main_full_pop').waitMe('hide');
                //$("#"+dis_div+" .box-primary").slideToggle("slow");
                $("#"+form_id)[0].reset();
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
              $(".mozaik_dekor .img_list").load("piston/control/"+glob_page_uri+"_pop_load.php?uid="+sid);
              $(".detay_popup").load("piston/control/"+glob_page_uri+"_load.php?uid="+sid);
              $("#"+info_field).html(jqXHR);
              $('.main_full_pop').waitMe('hide');
              //$("#"+dis_div+" .box-primary").slideToggle("slow");
            }
        });
     	 $("#"+form_id+" input[name='eid']").val("0");
	
	 $("input[name='resim']").removeAttr("readonly");
	 $("input[name='resim']").attr("required","");
	 $(".on_").css("display","none");
       }


	return false;
}

function dosya_duzenle(item_id,form_id,info_field){
		$('.fancybox-inner').animate({scrollTop: 0 }, 1000);
	 $(".on_").attr("src",$("img[m_id='"+item_id+"']").attr("src"));
	 $("#"+form_id+" input[name='eid']").val(item_id);
	 //$("select[name='renk'] option[value='"+$("renk[m_id='"+item_id+"']").html()+"']").prop("selected",true);

	  $.each(dil_text, function(key,value) {
            $("#"+form_id+" input[type=text][name='tab_dekor_baslik_"+key+"']").val($("li[m_id='"+item_id+"'] g[type='"+key+"']").html());
       });

	 $(".on_").css("display","inline-block");

	 $("input[name='resim']").removeAttr("required");
	 $("input[name='resim']").attr("readonly","");

	 $("input[name='eid']").val(item_id);
}


 function dosya_sil(sil_id,info_field){
    var sil_e = confirm("İçeriği silmek istediğinize eminmimisiniz ?");
    
    if(sil_e){
      var current_effect = $('#waitMe_ex_effect').val();
          run_waitMe_pop(current_effect);
        $.post("piston/control/"+glob_page_uri+".php",{eid:sil_id,islem:"sil"},function(sonuc,sc){
            if(sc=="success" && sonuc != "ok"){
                alert("Şuanda işlem yapılamıyor");
                    $('.detay_popup').load("piston/control/"+glob_page_uri+"_load.php?uid="+sid);
                    $(".mozaik_dekor .img_list").load("piston/control/"+glob_page_uri+"_pop_load.php?uid="+sid);

                    $('.main_full_pop').waitMe('hide');
            }else{
              //  $("#list_update_"+sil_id).remove();
                   $('.detay_popup').load("piston/control/"+glob_page_uri+"_load.php?uid="+sid);
                  $(".mozaik_dekor .img_list").load("piston/control/"+glob_page_uri+"_pop_load.php?uid="+sid);

                $('.main_full_pop').waitMe('hide');

            }


        })
    }
 }    