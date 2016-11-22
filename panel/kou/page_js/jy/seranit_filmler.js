function dosya_duzenle(form_id,item_id,info_field){
	 $("#"+form_id+" input[name='eid']").val(item_id);
		$.each(dil_text, function( key, value ) {
             $("#"+form_id+" input[type=text][name='tab_dekor_baslik_"+key+"']").val($("g[m_id='"+item_id+"'][type='"+key+"']").html()); 
        });
}

function dosya_ekle(form_id,info_field){
	  var bak = 0;
       $.each(dil_text, function(key,value) {
            if($("#"+form_id+" input[type=text][name='video_kodu_"+key+"']").val().length ==0){
              bak = 1;
              $("#"+form_id+" a[href='#video_kodu_"+key+"']").parent("li").css("border-top-color","#bc0101");
            }else{
              $("#"+form_id+" a[href='#video_kodu_"+key+"']").parent("li").css("border-top-color","");
            }


              if($("#"+form_id+" input[type=text][name='baslik_"+key+"']").val().length ==0){
              bak = 1;
              $("#"+form_id+" a[href='#baslik_"+key+"']").parent("li").css("border-top-color","#bc0101");
            }else{
              $("#"+form_id+" a[href='#baslik_"+key+"']").parent("li").css("border-top-color","");
            }
           
       });
       if(bak!=1){
      	  var current_effect = $('#waitMe_ex_effect').val();
	        run_waitMe_login(current_effect);
	       	var formData = new FormData();
	        //formData.append("sid",sid);
	        formData.append("eid",$("input[name='eid']").val());

          $.each(dil_text, function( key, value ) {
              formData.append("baslik_"+key,$("#"+form_id+" input[type=text][name='baslik_"+key+"']").val());
              formData.append("video_kodu_"+key,$("#"+form_id+" input[type=text][name='video_kodu_"+key+"']").val());
          });

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
               // $(".mozaik_dekor .img_list").load("piston/control/"+glob_page_uri+"_pop_load.php");
                $(".list_comp").load("piston/control/"+glob_page_uri+"_load.php");
                $('#main_full_page').waitMe('hide');
                //$("#"+dis_div+" .box-primary").slideToggle("slow");
                $("#"+form_id)[0].reset();
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
             // $(".mozaik_dekor .img_list").load("piston/control/"+glob_page_uri+"_pop_load.php");
              $(".list_comp").load("piston/control/"+glob_page_uri+"_load.php");
              $("#"+info_field).html(jqXHR);
              $('#main_full_page').waitMe('hide');
              //$("#"+dis_div+" .box-primary").slideToggle("slow");
            }
        });
     	 $("#"+form_id+" input[name='eid']").val("0");
       $("#"+form_id+" a[href='#baslik_tr']").click();
    	 $("#"+form_id+" a[href='#video_kodu_tr']").click();
	 
      }


	return false;
}

function dosya_duzenle(item_id,form_id,info_field){
		$('html,body').animate({scrollTop: 0 }, 1000);
	 $("#"+form_id+" input[name='eid']").val(item_id);
	 //$("select[name='renk'] option[value='"+$("renk[m_id='"+item_id+"']").html()+"']").prop("selected",true);

	  $.each(dil_text, function(key,value) {
           $("#"+form_id+" input[type=text][name='baslik_"+key+"']").val($("li[m_id='"+item_id+"'] g[type='"+key+"']").html());
           $("#"+form_id+" input[type=text][name='video_kodu_"+key+"']").val($("li[m_id='"+item_id+"'] vid[type='"+key+"']").html());
       });

	
}


 function dosya_sil(sil_id,info_field){
    var sil_e = confirm("İçeriği silmek istediğinize eminmimisiniz ?");
    
    if(sil_e){
      var current_effect = $('#waitMe_ex_effect').val();
          run_waitMe_login(current_effect);
        $.post("piston/control/"+glob_page_uri+".php",{eid:sil_id,islem:"sil"},function(sonuc,sc){
            if(sc=="success"){
              //  alert("Şuanda işlem yapılamıyor");
                    $('.list_comp').load("piston/control/"+glob_page_uri+"_load.php");
                     $("#"+info_field).html(sonuc);
                     $('#main_full_page').waitMe('hide');
            }else{
             
                   $('.list_comp').load("piston/control/"+glob_page_uri+"_load.php");
                $("#"+info_field).html(sonuc);
               $('#main_full_page').waitMe('hide');

            }


        })
    }
 }    