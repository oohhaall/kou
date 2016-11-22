CKEDITOR.replaceAll("ck_edit");
function scroll_slow_slider(scroll_id,height_id,form_id,type=0){  /// Açılacak olan form = scroll_id, yuksekligi alınacak div = height_id, Eklencek olan resmin formu form_id
  $("#"+form_id+" input[name='sid']").val("0");
 // $("#"+form_id+" input[name='slider_resim']").removeAttr("readonly");
    if(type==0){
      $.each( dil_text, function( key, value ) {
          CKEDITOR.instances["arastirma_alani_"+key].setData("");
      });
    }
          $(".on_").css("display","none");
          $(".on_").attr("src","");
          $("#"+form_id+" input[type=file][name='slider_resim']").removeAttr("readonly");
          $("#"+form_id+" input[type=file][name='slider_resim']").attr("required","");
  if($("#"+scroll_id+" .box-primary").css("display") == "none"){
  	var height   = $("#"+height_id).height();
	  var f_height = $("#"+scroll_id).height();
	  var tp_heiht = height+f_height;
    $("#"+scroll_id+" .box-primary").slideToggle("slow");
    $('html,body').animate({scrollTop: tp_heiht }, 1000);
  }else{
      $("#"+form_id)[0].reset();
      var height = $("#"+height_id).height();
      var f_height = $("#"+scroll_id).height();
      var tp_heiht = height+f_height;
      $('html,body').animate({scrollTop: tp_heiht }, 1000);
      //$("#"+form_id+" img").css("display","none");
  }

        $("a[href='#arastirma_alani_tr']").click();

}

function slider_duzenle(scroll_id,item_id,height_id,form_id){
    scroll_slow_slider(scroll_id,height_id,form_id,1);
          $.each(dil_text, function( key, value ) {
              CKEDITOR.instances["arastirma_alani_"+key].setData($("arastirma[type='"+key+"'][m_id='"+item_id+"']").html().trim());
          });
            $(".on_").css("display","inline-block");
            $(".on_").attr("src",$("img[m_id='"+item_id+"']").attr("src"));
            $("#"+form_id+" input[type=file][name='slider_resim']").removeAttr("required");
            $("#"+form_id+" input[type=file][name='slider_resim']").attr("readonly","");
              $("#"+form_id+" input[name='isim']").val($("g[m_id='"+item_id+"']").html().trim());
              $("#"+form_id+" input[name='oda']").val($("oda[m_id='"+item_id+"']").html().trim());
              $("#"+form_id+" input[name='email']").val($("email[m_id='"+item_id+"']").html().trim());
              $("#"+form_id+" input[name='telefon']").val($("tel[m_id='"+item_id+"']").html().trim());
              $("#"+form_id+" input[name='anabilimdali']").val($("anabil[m_id='"+item_id+"']").html().trim());
              $("#"+form_id+" input[name='url']").val($("url[m_id='"+item_id+"']").html().trim());


    $("#"+form_id+" input[name='sid']").val(item_id);
    $('html,body').animate({scrollTop: parseInt($("html,body").height())}, 1000);
}

function slider_ekle(dis_div,form_id,info_field,close_field){
    //'a_slider_ekle','info_field','ana_slider_ekle'

    var bak = 0;
              if(CKEDITOR.instances["arastirma_alani_tr"].getData().length==0){
                   bak = 1;
                 $("#"+form_id+" a[href='#arastirma_alani_tr']").parent("li").css("border-top-color","#bc0101");
              }else{
                $("#"+form_id+" a[href='#arastirma_alani_tr']").parent("li").css("border-top-color","");
              }

      if((bak!=1 && $("#"+form_id+" input[name='sid']").val()==0) || ($("#"+form_id+" input[name='sid']").val()!=0)){
           var current_effect = $('#waitMe_ex_effect').val();
        run_waitMe_login(current_effect);
       var formData = new FormData();
        formData.append("sid",$("#"+form_id+" input[name='sid']").val());
        formData.append("tip",$("#"+form_id+" input[name='tip']").val());
              formData.append("slider_resim",$("#"+form_id+" input[type=file][name='slider_resim']")[0].files[0]);

          $.each(dil_text, function( key, value ) {
              formData.append("arastirma_alani_"+key,CKEDITOR.instances["arastirma_alani_"+key].getData());
          });
              formData.append("isim",$("#"+form_id+" input[type=text][name='isim']").val());
              formData.append("oda",$("#"+form_id+" input[name='oda']").val());
              formData.append("email",$("#"+form_id+" input[name='email']").val());
              formData.append("telefon",$("#"+form_id+" input[name='telefon']").val());
              formData.append("url",$("#"+form_id+" input[name='url']").val());
              formData.append("anabilim_dali",$("#"+form_id+" input[name='anabilimdali']").val());
             



     $.ajax({
            url: 'kou/control/'+glob_page_uri+".php",
            type: 'POST',
            data: formData,
            cache: false,
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            success: function(sonuc, textStatus, jqXHR)
            {
                $("#"+info_field).html(sonuc);
                $(".list_comp").load("kou/control/"+glob_page_uri+"_load.php?load_max="+$(".list_comp").attr("goster_num"));
                $('#main_full_page').waitMe('hide');
                $("#"+dis_div+" .box-primary").slideToggle("slow");
                $("#"+form_id)[0].reset();
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
              $("#"+info_field).html(jqXHR);
              $('#main_full_page').waitMe('hide');
              $("#"+dis_div+" .box-primary").slideToggle("slow");
            }
        });
       }

       return false;

}

function slider_sil(scroll_id,item_id,height_id,form_id,info_field){

    var confirm_ = confirm("İçeriği Silmek Istediginizden Eminmisiniz ?");
    if(confirm_){
      $.post("kou/control/"+glob_page_uri+".php",{"islem":"sil","sid":item_id},function(sonuc,sc){
          if(sc=="success"){
               $("#"+info_field).html(sonuc);
               $(".list_comp").load("kou/control/"+glob_page_uri+"_load.php?load_max="+$(".list_comp").attr("goster_num"));
                var height = $("#"+height_id).height();
                var f_height = $("#"+scroll_id).height();
                var tp_heiht = height+f_height;
                $('html,body').animate({scrollTop: tp_heiht }, 1000);
          }
      });
    }

}


