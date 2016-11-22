function slider_ekle(dis_div,form_id,info_field,close_field){



    ///  if(bak != 1 && ($("#"+form_id+" input[name='sid']").val()==0) || ($("#"+form_id+" input[name='sid']").val()!=0)){

       var formData = new FormData();
        formData.append("sid",$("#"+form_id+" input[name='sid']").val());
        formData.append("uid",$("#ref_ulk").val());
          //$.each(dil_text, function( key, value ) {
              formData.append("baslik",$("#"+form_id+" input[type=text][name='baslik']").val());
        //  });
            
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
                $(".kategori_list").load("piston/control/"+glob_page_uri+"_load.php?ulke="+$("#ref_ulk").val());
                $('#main_full_page').waitMe('hide');
                $("#"+form_id+" input[name='sid']").val("0");
                $("#"+form_id+" input[type=text][name='baslik']").val("")

            },
            error: function(jqXHR, textStatus, errorThrown)
            {
              $("#"+info_field).html(jqXHR);
              $('#main_full_page').waitMe('hide');
            }
        });
    //   }

       return false;

}
function slider_duzenle(scroll_id,item_id,height_id,form_id){
 //   $.each( dil_text, function( key, value ) {
          $("input[name='baslik']").val($("g[m_id='"+item_id+"']").html());
   /// });
    $("#"+form_id+" input[name='sid']").val(item_id);
    $('html,body').animate({scrollTop: 0 }, 1000);
}
function slider_sil(scroll_id,item_id,height_id,form_id,info_field){
    var confirm_ = confirm("İçeriği Silmek Istediginizden Eminmisiniz ?");
    if(confirm_){
      $.post("piston/control/"+glob_page_uri+".php",{"islem":"sil","sid":item_id},function(sonuc,sc){
          if(sc=="success"){
               $("#"+info_field).html(sonuc);
               //{"load_max":goster_num,"filt_mark":$(".mark_filt").val()}
               $(".kategori_list").load("piston/control/"+glob_page_uri+"_load.php?ulke="+$("#ref_ulk").val());
                var height = $("#"+height_id).height();
                var f_height = $("#"+scroll_id).height();
                var tp_heiht = height+f_height;
                $('html,body').animate({scrollTop: 0 }, 1000);
          }
      });
    }

}

$("#ref_ulk").change(function(){
       $(".kategori_list").load("piston/control/"+glob_page_uri+"_load.php?ulke="+$(this).val());
});