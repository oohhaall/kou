function scroll_slow_slider(scroll_id,height_id,form_id){  /// Açılacak olan form = scroll_id, yuksekligi alınacak div = height_id, Eklencek olan resmin formu form_id
          $("#"+form_id+" input[name='sid']").val("0");
          $("img[name='on_']").css("display","none");
          $("img[name='on_']").attr("src","");
          $(".on_p").css("display","none");

          $("input[name='slider_resim']").removeAttr("readonly");
          $("input[name='slider_resim']").attr("required","");
          
          $("input[name='pdf']").removeAttr("readonly");
          $("input[name='pdf']").attr("required","");

    $.each( dil_text, function( key, value ) {
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
  }

        $("a[href='#baslik_tr']").click();

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

function slider_duzenle(scroll_id,item_id,height_id,form_id){
    scroll_slow_slider(scroll_id,height_id,form_id);

          $(".on_p").css("display","block");
          $(".on_p").attr("href",$("pd[m_id='"+item_id+"']").html());
          $("img[name='on_']").css("display","block");
          $("img[name='on_']").attr("src",$("img[m_id='"+item_id+"']").attr("src"));
          $("input[name='slider_resim']").removeAttr("required");
          $("input[name='slider_resim']").attr("readonly","");

          $("input[name='pdf']").removeAttr("required");
          $("input[name='pdf']").attr("readonly","");
          

          var tar = $("t[m_id='"+item_id+"']").html().split("-");

          date_picker(tar[2]+"/"+tar[1]+"/"+tar[0]);

    $.each( dil_text, function( key, value ) {
          $("input[name='baslik_"+key+"']").val($("g[type='"+key+"'][m_id='"+item_id+"']").html());
    });

    $("#"+form_id+" input[name='sid']").val(item_id);

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

       var formData = new FormData();
        formData.append("sid",$("#"+form_id+" input[name='sid']").val());
        formData.append("tip",$("#"+form_id+" input[name='tip']").val());

          $.each(dil_text, function( key, value ) {
             // formData.append("slider_resim_"+key,$("#"+form_id+" input[type=file][name='slider_resim_"+key+"']")[0].files[0]);
              formData.append("baslik_"+key,$("#"+form_id+" input[type=text][name='baslik_"+key+"']").val());
             // formData.append("aciklama_"+key,$("#"+form_id+" input[type=text][name='aciklama_"+key+"']").val());
          });
              formData.append("tarih",$("#"+form_id+" input[type=text][name='tarih']").val());
            //  console.log($("#"+form_id+" input[type=text][name='tarih']").val());
              formData.append("slider_resim",$("#"+form_id+" input[type=file][name='slider_resim']")[0].files[0]);
              formData.append("pdf",$("#"+form_id+" input[type=file][name='pdf']")[0].files[0]);
          
        //formData.append("islem","sil");


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

function slider_sil(scroll_id,item_id,height_id,form_id,info_field){

    var confirm_ = confirm("Katalog Silmek Istediginizden Eminmisiniz ?");
    if(confirm_){
      $.post("piston/control/"+glob_page_uri+".php",{"islem":"sil","sid":item_id},function(sonuc,sc){
          if(sc=="success"){
               $("#"+info_field).html(sonuc);
               $(".list_comp").load("piston/control/"+glob_page_uri+"_load.php?load_max="+$(".list_comp").attr("goster_num"));
                var height = $("#"+height_id).height();
                var f_height = $("#"+scroll_id).height();
                var tp_heiht = height+f_height;
                $('html,body').animate({scrollTop: tp_heiht }, 1000);
          }
      });
    }

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

//console.log(dsad);
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