function scroll_slow_slider(scroll_id,height_id,form_id){  /// Açılacak olan form = scroll_id, yuksekligi alınacak div = height_id, Eklencek olan resmin formu form_id
  $("#"+form_id+" input[name='sid']").val("0");
 // $("#"+form_id+" input[name='slider_resim']").removeAttr("readonly");

    $.each( dil_text, function( key, value ) {
          $("img[name='on_"+key+"']").css("display","none");
          $("img[name='on_"+key+"']").attr("src","");
          $(".img_del_"+key).css("display","none");
          $("input[name='baslik_"+key+"']").val("");
          $("input[name='aciklama_"+key+"']").val("");

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
        $("a[href='#aciklama_tr']").click();
}


$("#ulke_s").change(function(){

    $.post("piston/control/ref_sehir.php",{uid:$(this).val()},function(sonuc,sc){
          if(sc=="success"){
                $("#sehir_s").html(sonuc);
          }

    });
});


function slider_ekle(dis_div,form_id,info_field,close_field){
    //'a_slider_ekle','info_field','ana_slider_ekle'

    var bak = 0;
       $.each(dil_text, function( key, value ) {
            if($("#"+form_id+" input[type=text][name='baslik_"+key+"']").val().length ==0){
              bak = 1;
              $("#"+form_id+" a[href='#baslik_"+key+"']").parent("li").css("border-top-color","#bc0101");
            }else{
              $("#"+form_id+" a[href='#baslik_"+key+"']").parent("li").css("border-top-color","");

            }
       });

     
      if(bak != 1 && ($("#"+form_id+" input[name='sid']").val()==0) || ($("#"+form_id+" input[name='sid']").val()!=0)){

       var formData = new FormData();
        formData.append("sid",$("#"+form_id+" input[name='sid']").val());
        formData.append("tip",$("#"+form_id+" input[name='tip']").val());

          $.each(dil_text, function( key, value ) {
              formData.append("baslik_"+key,$("#"+form_id+" input[type=text][name='baslik_"+key+"']").val());
          });
            formData.append("slider_resim",$("#"+form_id+" input[type=file][name='slider_resim']")[0].files[0]);
            formData.append("kategori",$("#"+form_id+" select[name='kategori']").val());
            formData.append("ulke",$("#"+form_id+" select[name='ulke']").val());
            formData.append("sehir",$("#"+form_id+" select[name='sehir']").val());


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
                $(".list_comp").load("piston/control/"+glob_page_uri+"_load.php?load_max="+$(".list_comp").attr("goster_num"));
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


function slider_duzenle(scroll_id,item_id,height_id,form_id){
    scroll_slow_slider(scroll_id,height_id,form_id);

          $("img[name='on_']").css("display","block");
          $("img[name='on_']").attr("src",$("img[m_id='"+item_id+"']").attr("src"));
          $("input[name='slider_resim']").removeAttr("required");
          $("input[name='slider_resim']").attr("readonly","");
     

        /*                 
                            <kt m_id='' style="display: none;"><?php echo $value["kid"]; ?></kt>
                            <ulk m_id='' style="display: none;"><?php echo $value["uid"]; ?></ulk>
                            <sid m_id='' style="display: none;"><?php echo $value["sid"]; ?></sid>
        */
             $.post("piston/control/ref_sehir.php",{uid:$("ulk[m_id='"+item_id+"']").html(),sec:$("sid[m_id='"+item_id+"']").html()},function(sonuc,sc){
                  if(sc=="success"){
                        $("#sehir_s").html(sonuc);
                  }
            });
           // console.log($("sid[m_id='"+item_id+"']").html());
              $("select[name='kategori'] option[value='"+$("kt[m_id='"+item_id+"']").html()+"']").prop("selected",true);
              $("select[name='ulke'] option[value='"+$("ulk[m_id='"+item_id+"']").html()+"']").prop("selected",true);
            //  $("select[name='sehir'] option[value='"+$("sid[m_id='"+item_id+"']").html()+"']").prop("selected",true);

    $.each( dil_text, function( key, value ) {
          $("input[name='baslik_"+key+"']").val($("g[type='"+key+"'][m_id='"+item_id+"']").html());
    });

    $("#"+form_id+" input[name='sid']").val(item_id);

}

function slider_sil(scroll_id,item_id,height_id,form_id,info_field){

    var confirm_ = confirm("Referansı Silmek Istediginizden Eminmisiniz ?");

    if(confirm_){
      $.post("piston/control/"+glob_page_uri+".php",{"islem":"sil","sid":item_id},function(sonuc,sc){
          if(sc=="success"){
               $("#"+info_field).html(sonuc);
               //{"load_max":goster_num,"filt_mark":$(".mark_filt").val()}
               $(".list_comp").load("piston/control/"+glob_page_uri+"_load.php?load_max="+$(".list_comp").attr("goster_num"));
                var height = $("#"+height_id).height();
                var f_height = $("#"+scroll_id).height();
                var tp_heiht = height+f_height;
                $('html,body').animate({scrollTop: tp_heiht }, 1000);
          }
      });
    }

}