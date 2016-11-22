function yuzey_ekle(form_id,info_field){
	 var current_effect = $('#waitMe_ex_effect').val();
          run_waitMe_pop(current_effect);
	 var bak = 0;
       $.each(dil_text, function( key, value ) {
            if($("#"+form_id+" input[type=text][name='yuzeybaslik_"+key+"']").val().length ==0){
              bak = 1;
              $("#"+form_id+" a[href='#yuzeybaslik_"+key+"']").parent("li").css("border-top-color","#bc0101");
            }else{
              $("#"+form_id+" a[href='#yuzeybaslik_"+key+"']").parent("li").css("border-top-color","");
            }
       });
      if(bak != 1){
		
      		var formData = new FormData();
	        formData.append("sid",$("#"+form_id+" input[name='sid']").val());
	        formData.append("tip",$("#"+form_id+" input[name='tip']").val());
	        formData.append("eid",$("#"+form_id+" input[name='eid']").val());

          $.each(dil_text, function( key, value ) {
              formData.append("yuzeybaslik_"+key,$("#"+form_id+" input[type=text][name='yuzeybaslik_"+key+"']").val());
          });

     $.ajax({
            url: 'piston/control/'+glob_page_uri+".php",
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(sonuc, textStatus, jqXHR)
            {
                $("#"+info_field).html(sonuc);
                $(".kategori_list").load("piston/control/"+glob_page_uri+"_pop_load.php");
                $('.main_full_pop').waitMe('hide');
                $("#"+form_id)[0].reset();
                $("#"+form_id+" input[name='eid']").val('0');
				//$('#keep-order').multiSelect('refresh');
				$(".yuzeyler_detay .img_list").load("piston/control/yuzey_list.php?uid="+$("#"+form_id+" input[name='sid']").val());
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
              $("#"+info_field).html(jqXHR);
              $('.main_full_pop').waitMe('hide');
				$(".yuzeyler_detay .img_list").load("piston/control/yuzey_list.php?uid="+$("#"+form_id+" input[name='sid']").val());

            }
        });
	  }else{
                $('.main_full_pop').waitMe('hide');
	  }
		




  	return false;
}

function yuzey_duzenle(form_id,item_id,info_field){
	 $("#"+form_id+" input[name='eid']").val(item_id);
		$.each(dil_text, function( key, value ) {
             $("#"+form_id+" input[type=text][name='yuzeybaslik_"+key+"']").val($("g[m_id='"+item_id+"'][type='"+key+"']").html()); 
        });

        $("a[href='#yuzeybaslik_tr']").click();
}

function yuzey_sil(form_id,item_id,info_field){

		var sil_ok = confirm("İçeriği silmek istediğinize eminmisinizi ?");
		if(sil_ok){
	      		var formData = new FormData();
		        formData.append("eid",item_id);
		        formData.append("islem","sil");

				  $.ajax({
		            url: 'piston/control/'+glob_page_uri+".php",
		            type: 'POST',
		            data: formData,
		            cache: false,
		            processData: false,
		            contentType: false,
		            success: function(sonuc, textStatus, jqXHR)
		            {
		                $("#"+info_field).html(sonuc);
		                $(".kategori_list").load("piston/control/"+glob_page_uri+"_pop_load.php");
		                $('.main_full_pop').waitMe('hide');
		                $("#"+form_id)[0].reset();
		                $("#"+form_id+" input[name='eid']").val('0');
						$(".yuzeyler_detay .img_list").load("piston/control/yuzey_list.php?uid="+$("#"+form_id+" input[name='sid']").val());

		            },
		            error: function(jqXHR, textStatus, errorThrown)
		            {
		              $("#"+info_field).html(jqXHR);
		              $('.main_full_pop').waitMe('hide');
					  $(".yuzeyler_detay .img_list").load("piston/control/yuzey_list.php?uid="+$("#"+form_id+" input[name='sid']").val());

		            }
		        });
		  }
}	