function scroll_slow_tab_boyut(scroll_id,height_id,form_id,type=0){  /// Açılacak olan form = scroll_id, yuksekligi alınacak div = height_id, Eklencek olan resmin formu form_id
  $("#"+form_id+" input[name='eid']").val("0");

  if($("#"+scroll_id+" .box-primary").css("display") == "none"){
	  var f_height = parseInt($(".fancybox-inner").height());
   	$("#"+scroll_id+" .box-primary").slideToggle("slow");
    $('.fancybox-inner').animate({scrollTop: f_height }, 1000,hizala_fancy);
  }else{
      $("#"+form_id)[0].reset();
	  var f_height = parseInt($(".fancybox-inner").height());
      $('.fancybox-inner').animate({scrollTop: f_height }, 1000,hizala_fancy);

  }

        $("a[href='#kenar_tr']").click();
        hizala_fancy();
}

function tab_ekle(dis_div,form_id,info_field,close_field){
	   var bak = 0;
       $.each(dil_text, function(key,value) {
            if($("#"+form_id+" input[type=text][name='kenar_"+key+"']").val().length ==0){
              bak = 1;
              $("#"+form_id+" a[href='#kenar_"+key+"']").parent("li").css("border-top-color","#bc0101");
            }else{
              $("#"+form_id+" a[href='#kenar_"+key+"']").parent("li").css("border-top-color","");
            }
           
       });
      if(bak!=1){
      	    var current_effect = $('#waitMe_ex_effect').val();
          run_waitMe_pop(current_effect);
       var formData = new FormData();
	        formData.append("sid",sid);
	        formData.append("eid",$("input[name='eid']").val());

          $.each(dil_text, function( key, value ) {
              formData.append("kenar_"+key,$("#"+form_id+" input[type=text][name='kenar_"+key+"']").val());
          });
              formData.append("boyut",$("#"+form_id+" input[type=text][name='boyut']").val());
              formData.append("kaymazlik",$("#"+form_id+" input[type=text][name='kaymazlik']").val());
              formData.append("kalinlik",$("#"+form_id+" input[type=text][name='kalinlik']").val());

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
                $(".boyut_tp .img_list").load("piston/control/"+glob_page_uri+"_pop_load.php?uid="+sid);
                $(".up_top").load("piston/control/"+glob_page_uri+"_load.php?uid="+sid);
                $('.main_full_pop').waitMe('hide');
                $("#"+dis_div+" .box-primary").slideToggle("slow");
                $("#"+form_id)[0].reset();
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                $(".boyut_tp .img_list").load("piston/control/"+glob_page_uri+"_pop_load.php?uid="+sid);
              $(".up_top").load("piston/control/"+glob_page_uri+"_load.php?uid="+sid);
              $("#"+info_field).html(jqXHR);
              $('.main_full_pop').waitMe('hide');
              $("#"+dis_div+" .box-primary").slideToggle("slow");
            }
        });
       }
	
	return false;
}

function tab_boyut_duzenle(scroll_id,item_id,height_id,form_id){
		 scroll_slow_tab_boyut(scroll_id,height_id,form_id);
		$("#"+form_id+" input[name='eid']").val(item_id);
		$("#"+form_id+" input[name='boyut']").val($.trim($("tr[m_id='"+item_id+"'] .boyut").html()));
		$("#"+form_id+" input[name='kaymazlik']").val($.trim($("tr[m_id='"+item_id+"'] .kaymazlik").html()));
		$("#"+form_id+" input[name='kalinlik']").val($.trim($("tr[m_id='"+item_id+"'] .kalinlik").html()));
		 $.each(dil_text, function( key, value ) {
				$("#"+form_id+" input[name='kenar_"+key+"']").val($.trim($("tr[m_id='"+item_id+"'] .kenar span[dil_type='"+key+"']").html()));
	      });
}


function tab_boyut_sil(scroll_id,item_id,height_id,form_id,info_field){

    var confirm_ = confirm("İçeriği Silmek Istediginizden Eminmisiniz ?");
    if(confirm_){
    	    var current_effect = $('#waitMe_ex_effect').val();
          run_waitMe_pop(current_effect);
      $.post("piston/control/"+glob_page_uri+".php",{"islem":"sil","eid":item_id},function(sonuc,sc){
          if(sc=="success"){
               $("#"+info_field).html(sonuc);
                $(".boyut_tp .img_list").load("piston/control/"+glob_page_uri+"_pop_load.php?uid="+sid);
               $(".up_top").load("piston/control/"+glob_page_uri+"_load.php?uid="+sid);
                var height = $("#"+height_id).height();
                var f_height = $("#"+scroll_id).height();
                var tp_heiht = height+f_height;
                $('.fancybox-inner').animate({scrollTop: tp_heiht }, 1000);
                $('.main_full_pop').waitMe('hide');
                
          }
      });
    }

}