function slider_ekle(dis_div,form_id,info_field,close_field){


     
     

       var formData = new FormData();
        formData.append("sid",$("#"+form_id+" input[name='sid']").val());
 
              formData.append("baslik",$("#"+form_id+" input[type=text][name='baslik']").val());
              formData.append("s_id",$("#"+form_id+" select[name='sehir']").val());
              formData.append("uid",$("#"+form_id+" select[name='ulke']").val());
    
            
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
                $(".kategori_list").load("piston/control/"+glob_page_uri+"_load.php?load_max="+$(".kategori_list").attr("goster_num")+"&u_id="+$("#"+form_id+" select[name='ulke']").val()+"&s_id="+$("#"+form_id+" select[name='sehir']").val());
                $('#main_full_page').waitMe('hide');
               // $("#"+form_id)[0].reset();
            $("#"+form_id+" input[name='sid']").val("0");
             //   $("#"+form_id+" a[href='#baslik_tr']").click();
            $("input[name='baslik']").val("");
            $("#"+form_id+" input[name='sid']").val('0');

            },
            error: function(jqXHR, textStatus, errorThrown)
            {
              $("#"+info_field).html(jqXHR);
              $('#main_full_page').waitMe('hide');
            }
        });
       

       return false;

}
function slider_duzenle(scroll_id,item_id,height_id,form_id){
          $("input[name='baslik']").val($("g[m_id='"+item_id+"']").html());
  
    $("#"+form_id+" input[name='sid']").val(item_id);
    $('html,body').animate({scrollTop: 0 }, 1000);
}
function slider_sil(scroll_id,item_id,height_id,form_id,info_field){
    var confirm_ = confirm("İçeriği Silmek İstediğinizden Eminmisiniz ?");
    if(confirm_){
      $.post("piston/control/"+glob_page_uri+".php",{"islem":"sil","sid":item_id},function(sonuc,sc){
          if(sc=="success"){
               $("#"+info_field).html(sonuc);
               //{"load_max":goster_num,"filt_mark":$(".mark_filt").val()}
              $(".kategori_list").load("piston/control/"+glob_page_uri+"_load.php?load_max="+$(".kategori_list").attr("goster_num")+"&u_id="+$("select[name='ulke']").val()+"&s_id="+$("select[name='sehir']").val());
                var height = $("#"+height_id).height();
                var f_height = $("#"+scroll_id).height();
                var tp_heiht = height+f_height;
                $('html,body').animate({scrollTop: 0 }, 1000);
          }
      });
    }

}
$("#ref_ulk").change(function(){
     $("select[name='sehir']").load("piston/control/satis_sehir_l.php?uid="+$(this).val(),function(s,stat){
          if(stat=="success"){
              $(".kategori_list").load("piston/control/"+glob_page_uri+"_load.php?load_max="+$(".kategori_list").attr("goster_num")+"&u_id="+$("select[name='ulke']").val()+"&s_id="+$("select[name='sehir']").val());
          }
     });
});

$("#sehir_select").change(function(){
       $(".kategori_list").load("piston/control/"+glob_page_uri+"_load.php?load_max="+$(".kategori_list").attr("goster_num")+"&u_id="+$("select[name='ulke']").val()+"&s_id="+$("select[name='sehir']").val());
});