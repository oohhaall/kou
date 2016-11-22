function scroll_slow_slider(scroll_id,height_id,form_id,type=0){  /// Açılacak olan form = scroll_id, yuksekligi alınacak div = height_id, Eklencek olan resmin formu form_id
  $("#"+form_id+" input[name='sid']").val("0");

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

             var x = new Date();
      var dd = x.getDate();
      var mm = x.getMonth()+1; //January is 0!
      if(dd<10){
          dd='0'+dd
      } 
      if(mm<10){
          mm='0'+mm
      } 
      var yyyy = x.getFullYear();
      var dsad = dd+'/'+mm+'/'+yyyy;
          date_picker(dsad);
}

function date_picker(dsad=""){
  if(dsad==''){
      var x = new Date();
      var dd = x.getDate();
      var mm = x.getMonth()+1; //January is 0!
      if(dd<10){
          dd='0'+dd
      } 
      if(mm<10){
          mm='0'+mm
      } 
      var yyyy = x.getFullYear();
      var dsad = dd+'/'+mm+'/'+yyyy;
  }
      $('input[name="tarih"]').daterangepicker({
       locale: {
           format: 'DD/MM/YYYY'
        },
        dateFormat : 'DD/MM/YYYY',
        format: 'DD/MM/YYYY',
        startDate:dsad,
        singleDatePicker: true,
        showDropdowns: true
    }, 
    function(start, end, label) {
       var years = moment().diff(start.format("DD/MM/YYYY"), 'years');
        $("input[name='tarih']").val(end.format('DD/MM/YYYY'));
    });
    $("input[name='tarih']").val(dsad);
    


}

function open_picker(){
 $('input[name="tarih"]').click();
}

function slider_ekle(dis_div,form_id,info_field,close_field){

       var formData = new FormData();
        formData.append("sid",$("#"+form_id+" input[name='sid']").val());
        formData.append("tip",$("#"+form_id+" input[name='tip']").val());

              formData.append("tarih",$("#"+form_id+" input[type=text][name='tarih']").val());
              formData.append("slider_resim",$("#"+form_id+" input[type=file][name='slider_resim']")[0].files[0]);
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
                $(".basin_list").load("piston/control/"+glob_page_uri+"_load.php?load_max="+$(".basin_list").attr("goster_num"));
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
    

       return false;

}


function slider_duzenle(scroll_id,item_id,height_id,form_id){
    scroll_slow_slider(scroll_id,height_id,form_id);
          $("input[name='slider_resim']").removeAttr("required");
          $("input[name='slider_resim']").attr("readonly","");

          $("img[name='on_']").css("display","block");
          $("img[name='on_']").attr("src",$("img[m_id='"+item_id+"']").attr("src"));

          var tar = $("t[m_id='"+item_id+"']").html().split(".");
          console.log(tar);
          date_picker(tar[0]+"/"+tar[1]+"/"+tar[2]);

  /*  $.each( dil_text, function( key, value ) {
          $("input[name='baslik_"+key+"']").val($("g[type='"+key+"'][m_id='"+item_id+"']").html());
    });
*/
    $("#"+form_id+" input[name='sid']").val(item_id);

}

function slider_sil(scroll_id,item_id,height_id,form_id,info_field){

    var confirm_ = confirm("İçeriği Silmek Istediginizden Eminmisiniz ?");
    if(confirm_){
      $.post("piston/control/"+glob_page_uri+".php",{"islem":"sil","sid":item_id},function(sonuc,sc){
          if(sc=="success"){
               $("#"+info_field).html(sonuc);
               $(".basin_list").load("piston/control/"+glob_page_uri+"_load.php?load_max="+$(".basin_list").attr("goster_num"));
                var height = $("#"+height_id).height();
                var f_height = $("#"+scroll_id).height();
                var tp_heiht = height+f_height;
                $('html,body').animate({scrollTop: tp_heiht }, 1000);
          }
      });
    }

}
