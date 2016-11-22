///CKEDITOR.replaceAll("detay_ck");
  $('.popup_page').on("click", function (e) {
  	var uri = $(this).attr("d_h");
    e.preventDefault(); // avoids calling preview.php
    $.ajax({
      type: "POST",
      cache: false,
      url: "piston/popup/"+uri+".php",
      data:{page_uri:uri,uid:$("input[name='sid']").val()},
      success: function (data) {
        $.fancybox(data,{
          fitToView: true,
          autoSize: true,
          openEffect: 'none',
          closeEffect: 'none',
          minWidth:500
        }); // fancybox
      } // success
    }); // ajax
  }); // on



$(".iframe_popup").on("click",function(e){
    var uri = $(this).attr("d_h");
         $.fancybox.open({
          href : "piston/popup/"+uri+".php?uid="+$("input[name='sid']").val(),
          type : 'iframe',
          padding : 5
        });

});




 $('#keep-order').multiSelect();
 $('#keep-order2').multiSelect();
 $('#keep-order3').multiSelect();
 $('#keep-order4').multiSelect();

$("select[op_select='up_select']").on("change",function(){
     var current_effect = $('#waitMe_ex_effect').val();
          run_waitMe_login(current_effect);
      $.post("piston/control/mimari_detay_up.php",{mid:$("input[name='sid']").val(),dt_tab:$(this).attr("dt_table"),up_tab:$(this).attr("up_dt"),up_val:$(this).val()},function(sonuc,sc){
            if(sc=="success"){
                //console.log(sonuc);
                $('#main_full_page').waitMe('hide');

            }
      });
     // console.log($(this).val());
});


$("select[op_select='up_img']").on("change",function(){
     var current_effect = $('#waitMe_ex_effect').val();
          run_waitMe_login(current_effect);
      $.post("piston/control/mimari_detay_up.php",{mid:$("input[name='sid']").val(),dt_tab:$(this).attr("dt_table"),up_tab:$(this).attr("up_dt"),up_val:$(this).val()},function(sonuc,sc){
            if(sc=="success"){
                
                $('#main_full_page').waitMe('hide');
                
            }
      });
     // console.log($(this).val());
});




$(".ref_ek_click").click(function(){
    //console.log("geldim gördüm mesaj veriyorum");
});


function hizala_fancy(){

    $.fancybox.update();
}


 $(".picker_hide").imagepicker({
      /*limit_reached:  function(){alert('We are full!')},*/
      hide_select:    false
  });

 $(".picker_hide2").imagepicker({
      /*limit_reached:  function(){alert('We are full!')},*/
      hide_select:    false
  });




function slider_ekle(form_id,info_field){
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
          var current_effect = $('#waitMe_ex_effect').val();
          run_waitMe_login(current_effect);
           var yeni_u = 0;
          if($("#"+form_id+" input[name='yeni_urun']").is(':checked')){
              yeni_u = "1";
          }
       var formData = new FormData();
        formData.append("sid",$("#"+form_id+" input[name='sid']").val());
        formData.append("tip",$("#"+form_id+" input[name='tip']").val());

          $.each(dil_text, function( key, value ) {
              formData.append("baslik_"+key,$("#"+form_id+" input[type=text][name='baslik_"+key+"']").val());
          });

              formData.append("urun_resmi",$("#"+form_id+" input[type=file][name='urun_resmi']")[0].files[0]);
              formData.append("yeni_urun",yeni_u);
              //formData.append("mobil_resim",$("#"+form_id+" input[type=file][name='mobil_resim']")[0].files[0]);
              formData.append("kutu_palet",$("#"+form_id+" input[type=file][name='kutu_palet']")[0].files[0]);
              formData.append("aksesuar_doc",$("#"+form_id+" input[type=file][name='aksesuar_doc']")[0].files[0]);


     $.ajax({
            url: 'piston/control/'+glob_page_uri+".php",
            type: 'POST',
            data: formData,
            cache: false,
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            success: function(sonuc, textStatus, jqXHR)
            {
               if(sonuc.trim()=="ok"){
                  alert("İçerik Güncellendi.");
                  location.reload();
               }
                $("#"+info_field).html(sonuc);
                $('#main_full_page').waitMe('hide');
                $('html,body').animate({scrollTop: 0 }, 1000);
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
              $("#"+info_field).html(jqXHR);
              $('#main_full_page').waitMe('hide');
              $('html,body').animate({scrollTop: 0 }, 1000);

            }
        });
       }

       return false;

}