CKEDITOR.replaceAll("ck_edit");
function scroll_slow_slider(scroll_id,height_id,form_id,type=0){  /// Açılacak olan form = scroll_id, yuksekligi alınacak div = height_id, Eklencek olan resmin formu form_id
  $("#"+form_id+" input[name='sid']").val("0");

    $.each( dil_text, function( key, value ) {
          $("img[name='on_"+key+"']").css("display","none");
          $("img[name='on_"+key+"']").attr("src","");
          $(".img_del_"+key).css("display","none");
          $("input[name='baslik_"+key+"']").val("");
         // $("input[name='aciklama_"+key+"']").val("");
          if(type==1){
            CKEDITOR.instances["baslik_"+key].setData("");
          }

    });

  if($("#"+scroll_id+" .box-primary").css("display") == "none"){
  	var height = $("#"+height_id).height();
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

        $("a[href='#slider_resim_tr']").click();
        $("a[href='#baslik_tr']").click();
       // $("a[href='#aciklama_tr']").click();
}

function slider_duzenle(scroll_id,item_id,height_id,form_id){
    scroll_slow_slider(scroll_id,height_id,form_id);
    $.each( dil_text, function( key, value ) {

          $("input[name='baslik_"+key+"']").val($("g[type='"+key+"'][m_id='"+item_id+"']").html());
          //$("input[name='aciklama_"+key+"']").val($("i[type='"+key+"'][m_id='"+item_id+"']").html());
            CKEDITOR.instances["baslik_"+key].setData($("g[type='"+key+"'][m_id='"+item_id+"']").html().trim());

    });
          $("input[name='link']").val($("u[m_id='"+item_id+"']").html().trim());

    $("#"+form_id+" input[name='sid']").val(item_id);
 $('html,body').animate({scrollTop: parseInt($("html,body").height()) }, 1000);
}

function slider_ekle(dis_div,form_id,info_field,close_field){
    //'a_slider_ekle','info_field','ana_slider_ekle'

    var bak = 0;
       $.each(dil_text, function( key, value ) {
            if($("#"+form_id+" input[type=file][name='slider_resim_"+key+"']")[0].files[0]){
              bak = 1
            }
       });

      if((bak==1 && $("#"+form_id+" input[name='sid']").val()==0) || ($("#"+form_id+" input[name='sid']").val()!=0)){

       var formData = new FormData();
        formData.append("sid",$("#"+form_id+" input[name='sid']").val());
        formData.append("tip",$("#"+form_id+" input[name='tip']").val());

          $.each(dil_text, function( key, value ) {
              formData.append("slider_resim_"+key,$("#"+form_id+" input[type=file][name='slider_resim_"+key+"']")[0].files[0]);
              formData.append("baslik_"+key,CKEDITOR.instances["baslik_"+key].getData());
          });
              formData.append("link",$("#"+form_id+" input[type=text][name='link']").val());



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
       }else{
          alert("Slider eklemek için lütfen herhangi bir dil de en az bir resim seçiniz");
       }

       return false;

}

function slider_sil(scroll_id,item_id,height_id,form_id,info_field){

    var confirm_ = confirm("Slider Silmek Istediginizden Eminmisiniz ?");
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


