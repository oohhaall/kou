//CKEDITOR.replaceAll("detay_ck");
var sortableLinks = $(".detay_popup");
$(sortableLinks).sortable();
$( ".detay_popup" ).sortable({
       update: function() {
          var current_effect = $('#waitMe_ex_effect').val();
          run_waitMe_login(current_effect);
            var gunc_list = $('.detay_popup').sortable('serialize');
            var post_dt = $(this).attr("dt_table");
            var post_uri = $(this).attr("post_uri");
            var g_uri = $(this).attr("post_uri");
            
          $.post("piston/control/list_update.php?gunc_page="+post_uri+"&g_id="+$("#koleksiyon_change").val()+"&dt="+post_dt,gunc_list,function(sonuc,sc){
              if(sc=="success" && sonuc=="guncellendi"){
                  $(".detay_resim_ic .img_list").load("piston/control/"+glob_page_uri+"_pop_load.php?uid="+$("input[name='sid']").val());
                  $('#main_full_page').waitMe('hide');
              }
          });
        
        }       
});


function scroll_slow_slider(scroll_id,height_id,form_id,type=0){  /// Açılacak olan form = scroll_id, yuksekligi alınacak div = height_id, Eklencek olan resmin formu form_id
  $("#"+form_id+" input[name='sid']").val("0");
 // $("#"+form_id+" input[name='slider_resim']").removeAttr("readonly");

    $.each( dil_text, function( key, value ) {
          $("img[name='on_"+key+"']").css("display","none");
          $("img[name='on_"+key+"']").attr("src","");
          $(".img_del_"+key).css("display","none");
          $("input[name='baslik_"+key+"']").val("");
      
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
        $("a[href='#baslik_tr']").click();
        $("a[href='#aciklama_tr']").click();
}

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
           var current_effect = $('#waitMe_ex_effect').val();
          run_waitMe_login(current_effect);

          var yeni_u = 0;
          if($("#"+form_id+" input[name='yeni_urun']").is(':checked')){
          		yeni_u = "1";
          }
       var formData = new FormData();
        formData.append("sid",$("#"+form_id+" input[name='sid']").val());
        formData.append("kid",$("#koleksiyon_change").val());
        formData.append("tip",$("#"+form_id+" input[name='tip']").val());

          $.each(dil_text, function( key, value ) {
              formData.append("baslik_"+key,$("#"+form_id+" input[type=text][name='baslik_"+key+"']").val());
            //  formData.append("aciklama_"+key,CKEDITOR.instances["aciklama_"+key].getData());

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
                $("#"+info_field).html(sonuc);
                $(".detay_popup").load("piston/control/"+glob_page_uri+"_load.php?uid="+$("#koleksiyon_change").val());
               // var tops = (parseInt($("li[menu_id='"+glob_page_uri+"'] .count_inf").html())+1);
               // $("li[menu_id='"+glob_page_uri+"'] .count_inf").html(tops);
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
       }/*else{
          alert("Slider eklemek için lütfen herhangi bir dil de en az bir resim seçiniz");
       }*/

       return false;

}

function slider_duzenle(dz_id){
	window.location = "panel.php?page=urun_list_duzenle&uid="+dz_id;
}


 //slider_sil

 function slider_sil(sil_id,info_field){
  var conf = confirm("İçeriği Silmek İstediğinize Eminmisiniz ?");
    if(conf){

        var current_effect = $('#waitMe_ex_effect').val();
        run_waitMe_login(current_effect);

        $.post('piston/control/'+glob_page_uri+".php",{sid:sil_id,islem:"sil"},function(sonuc,sc){
              if(sc=="success"){
                $(".detay_popup").load("piston/control/"+glob_page_uri+"_load.php?uid="+$("#koleksiyon_change").val());
                $("#"+info_field).html(sonuc);
                $('#main_full_page').waitMe('hide');    
                $('html,body').animate({scrollTop: parseInt($("body").height()) }, 1000);
              }
        });
    }
 }
/*
koleksiyon_change
*/

$("#koleksiyon_change").on("change",function(){
		//detay_popup
			var current_effect = $('#waitMe_ex_effect').val();
        run_waitMe_login(current_effect);

                $(".detay_popup").load("piston/control/"+glob_page_uri+"_load.php?uid="+$(this).val());

                $('#main_full_page').waitMe('hide');

			console.log($(this).val());
});