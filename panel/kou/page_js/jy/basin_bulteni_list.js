CKEDITOR.replaceAll("ck_area");
  $('.popup_page').on("click", function (e) {
    var uri = $(this).attr("d_h");
    var uuid = $(this).attr("sid");
    e.preventDefault(); // avoids calling preview.php
    $.ajax({
      type: "POST",
      cache: false,
      url: "piston/popup/"+uri+".php",
      data:{page_uri:uri,uid:uuid},
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


function scroll_slow_slider(scroll_id,height_id,form_id,type=0){  /// Açılacak olan form = scroll_id, yuksekligi alınacak div = height_id, Eklencek olan resmin formu form_id
  $("#"+form_id+" input[name='sid']").val("0");
 // $("#"+form_id+" input[name='slider_resim']").removeAttr("readonly");
 // $("#"+form_id+" input[name='mail']").val("");

    $.each( dil_text, function( key, value ) {
          $("input[name='baslik_"+key+"']").val("");
          if(type==0)
            CKEDITOR.instances["aciklama_"+key].setData("");
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
         $("input[name='kategori_seranit']").prop("checked", true );
          $("input[name='kategori_grup']").prop("checked", false );
        $("a[href='#baslik_tr']").click();
        $("a[href='#aciklama_tr']").click();
}


function slider_ekle(dis_div,form_id,info_field,close_field){

    var bak = 0;
       $.each(dil_text, function(key,value) {
            if($("#"+form_id+" input[type=text][name='baslik_"+key+"']").val().length ==0){
              bak = 1;
              $("#"+form_id+" a[href='#baslik_"+key+"']").parent("li").css("border-top-color","#bc0101");
            }else{
              $("#"+form_id+" a[href='#baslik_"+key+"']").parent("li").css("border-top-color","");
            }
       });

      if((bak!=1 && $("#"+form_id+" input[name='sid']").val()==0) || ($("#"+form_id+" input[name='sid']").val()!=0)){
           var current_effect = $('#waitMe_ex_effect').val();
        run_waitMe_login(current_effect);
        var kategori = 0;
        if($("input[name='kategori_seranit']").is(":checked")){
           kategori += parseInt($("input[name='kategori_seranit']").val());
        }
        if($("input[name='kategori_grup']").is(":checked")){
           kategori += parseInt($("input[name='kategori_grup']").val());
        }
        

       var formData = new FormData();
        formData.append("sid",$("#"+form_id+" input[name='sid']").val());
        formData.append("tip",$("#"+form_id+" input[name='tip']").val());
        formData.append("kategori",kategori);

          $.each(dil_text, function( key, value ) {
              formData.append("baslik_"+key,$("#"+form_id+" input[type=text][name='baslik_"+key+"']").val());
              formData.append("aciklama_"+key,CKEDITOR.instances["aciklama_"+key].getData());
          });
            //  formData.append("mail",$("#"+form_id+" input[name='mail']").val());
              formData.append("tarih",$("#"+form_id+" input[type=text][name='tarih']").val());



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
                $(".up_lo").load("piston/control/"+glob_page_uri+"_load.php?load_max="+$(".up_lo").attr("goster_num"));
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
    scroll_slow_slider(scroll_id,height_id,form_id,1);

       $("input[name='kategori_seranit']").prop("checked", false );
       $("input[name='kategori_grup']").prop("checked", false );
    $.each( dil_text, function( key, value ) {
          $("input[name='baslik_"+key+"']").val($("g[type='"+key+"'][m_id='"+item_id+"']").html());
          CKEDITOR.instances["aciklama_"+key].setData($("ac[type='"+key+"'][m_id='"+item_id+"']").html());
          var tar = $("m[m_id='"+item_id+"']").html().split("-");
          date_picker(tar[2]+"/"+tar[1]+"/"+tar[0]);
    });
    
   //console.log($("kt[m_id='"+item_id+"']").html());
          
    
    switch(parseInt($("kt[m_id='"+item_id+"']").html())){
        case  1:
           $("input[name='kategori_seranit']").prop("checked", true );
        break;
        case 2:
          $("input[name='kategori_grup']").prop("checked", true );
        break;
        case 3:
          $("input[name='kategori_seranit']").prop("checked", true );
          $("input[name='kategori_grup']").prop("checked", true );
        break;
    }
    $("#"+form_id+" input[name='sid']").val(item_id);

}


function slider_sil(scroll_id,item_id,height_id,form_id,info_field){

    var confirm_ = confirm("İçeriği Silmek İstediginizden Eminmisiniz ?");
    if(confirm_){
      $.post("piston/control/"+glob_page_uri+".php",{"islem":"sil","sid":item_id},function(sonuc,sc){
          if(sc=="success"){
               $("#"+info_field).html(sonuc);
               $(".up_lo").load("piston/control/"+glob_page_uri+"_load.php?load_max="+$(".up_lo").attr("goster_num"));
                var height = $("#"+height_id).height();
                var f_height = $("#"+scroll_id).height();
                var tp_heiht = height+f_height;
                $('html,body').animate({scrollTop: tp_heiht }, 1000);
          }
      });
    }

}



date_picker();

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