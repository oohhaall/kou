$(function () {
   var dt_table = $("#data_table").DataTable({
            "language": {
                "url": "plugins/datatables/turkish.json"
            }
        });

});


function scroll_slow_slider(scroll_id,height_id,form_id){  /// Açılacak olan form = scroll_id, yuksekligi alınacak div = height_id, Eklencek olan resmin formu form_id
  $("#"+form_id+" input[name='sid']").val("0");

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
  }

       $("a[href='#slider_resim_tr']").click();
        $("a[href='#baslik_tr']").click();
        $("a[href='#aciklama_tr']").click();
}




function slider_ekle(dis_div,form_id,info_field,close_field){

       var formData = new FormData();
        formData.append("sid",$("#"+form_id+" input[name='sid']").val());
        formData.append("tip",$("#"+form_id+" input[name='tip']").val());

        formData.append("ulke",$("#"+form_id+" select[name='ulke']").val());
        formData.append("sehir",$("#"+form_id+" select[name='sehir']").val());
        formData.append("ilce",$("#"+form_id+" select[name='ilce']").val());
        formData.append("unvan",$("#"+form_id+" input[name='unvan']").val());
        formData.append("tel",$("#"+form_id+" input[name='tel']").val());
        formData.append("fax",$("#"+form_id+" input[name='fax']").val());
        formData.append("email",$("#"+form_id+" input[name='email']").val());
        formData.append("adres",$("#"+form_id+" input[name='adres']").val());
        formData.append("maps",$("#"+form_id+" input[name='maps']").val());

         

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
                $('#main_full_page').waitMe('hide');
                $("#"+dis_div+" .box-primary").slideToggle("slow");
                $("#"+form_id)[0].reset();
                /*
var table = $('#example').DataTable();
 
table.row.add( ( [ $("#"+form_id+" input[name='unvan']").val(), $("#"+form_id+" select[name='ulke']").val(), $("#"+form_id+" select[name='sehir']").val(),$("#"+form_id+" select[name='ilce']").val(),] ).draw();
                */
              //  $.post("piston/control/"+glob_page_uri+"_load.php",{},function(sonuc,sc){
          //table.row.add( ( [ $("#"+form_id+" input[name='unvan']").val(), $("#"+form_id+" select[name='ulke']").val(), $("#"+form_id+" select[name='sehir']").val(),$("#"+form_id+" select[name='ilce']").val(),] ).draw();

               /* var table = $('#example').DataTable();
                table.row.add(sonuc).draw();
              */

               // });

                $("#ex").load("piston/control/"+glob_page_uri+"_load.php");

            },
            error: function(jqXHR, textStatus, errorThrown)
            {
              $("#"+info_field).html(jqXHR);
              $('#main_full_page').waitMe('hide');
              $("#"+dis_div+" .box-primary").slideToggle("slow");
            }
        });
       

       return false;

}

function slider_duzenle(scroll_id,item_id,height_id,form_id){
    scroll_slow_slider(scroll_id,height_id,form_id);


        $("#"+form_id+" input[name='unvan']").val($("tr[m_id='"+item_id+"'] td[data_name='firma']").html());
        $("#"+form_id+" input[name='tel']").val($("bilgi[m_id='"+item_id+"'] tel").html());
        $("#"+form_id+" input[name='fax']").val($("bilgi[m_id='"+item_id+"'] fax").html());
        $("#"+form_id+" input[name='email']").val($("bilgi[m_id='"+item_id+"'] mail").html());
        $("#"+form_id+" input[name='adres']").val($("bilgi[m_id='"+item_id+"'] adres").html());
        $("#"+form_id+" input[name='maps']").val($("bilgi[m_id='"+item_id+"'] harita").html());


//$('#gouv option[value="' + ident +'"]').prop("selected", true);

 $("#"+form_id+" select[name='ulke'] option[value='"+$("bilgi[m_id='"+item_id+"'] ulke").html()+"']").prop("selected",true);
      $("select[name='sehir']").load("piston/control/satis_sehir_l.php?uid="+$("bilgi[m_id='"+item_id+"'] ulke").html(),function(s,stat){
          if(stat=="success"){
              $("#ilce_select").load("piston/control/satis_ilce_l.php?sid="+$("bilgi[m_id='"+item_id+"'] sehir").html()+"&uid="+$("bilgi[m_id='"+item_id+"'] ulke").html(),function(ss,sstat){
                  if(sstat == "success"){
                      $("#"+form_id+" select[name='sehir'] option[value='"+$("bilgi[m_id='"+item_id+"'] sehir").html()+"']").prop("selected",true);
                      $("#"+form_id+" select[name='ilce'] option[value='"+$("bilgi[m_id='"+item_id+"'] ilce").html()+"']").prop("selected",true);
                  }
              });          
            }
     });

    $("#"+form_id+" input[name='sid']").val(item_id);

}

$("#ref_ulk").change(function(){
     $("select[name='sehir']").load("piston/control/satis_sehir_l.php?uid="+$(this).val(),function(s,stat){
          if(stat=="success"){
              $("#ilce_select").load("piston/control/satis_ilce_l.php?sid="+$("select[name='sehir']").val()+"&uid="+$("#ref_ulk").val());          
            }
     });
});

$("#sehir_select").change(function(){
    $("#ilce_select").load("piston/control/satis_ilce_l.php?sid="+$(this).val()+"&uid="+$("#ref_ulk").val());
});

function slider_sil(scroll_id,item_id,height_id,form_id,info_field){

    var confirm_ = confirm("Slider Silmek Istediginizden Eminmisiniz ?");
    if(confirm_){
      $.post("piston/control/"+glob_page_uri+".php",{"islem":"sil","sid":item_id},function(sonuc,sc){
          if(sc=="success"){
               $("#"+info_field).html(sonuc);
                $("#ex").load("piston/control/"+glob_page_uri+"_load.php");
              
                $('html,body').animate({scrollTop: 200 }, 1000);
          }
      });
    }

}
