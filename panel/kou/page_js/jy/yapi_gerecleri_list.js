 

/*$.each(dil_text, function( key, value ) {
           CKEDITOR.replaceAll('ck_editor_'+key);
    });*/
     CKEDITOR.replaceAll('ck_edit');

function slider_duzenle(scroll_id,item_id,height_id,form_id){
   scroll_slow_slider(scroll_id,height_id,form_id,0);
    
    $.each(dil_text, function( key, value ) {
          $("input[name='urunadi_"+key+"']").val($("g[type='"+key+"'][m_id='"+item_id+"']").html());
          
          if($("k[type='"+key+"'][m_id='"+item_id+"']").html().length){
            $(".pdf_del_"+key).css("display","inline-block");
            $(".kta_"+key).attr("href",$("k[type='"+key+"'][m_id='"+item_id+"']").html());
            $(".kta_"+key).css("display","inline-block");
          }




          if($("kt[type='"+key+"'][m_id='"+item_id+"']").html().length){
            $(".img_del_"+key).css("display","inline-block");
            $("img[name='on_"+key+"']").attr("src",$("kt[type='"+key+"'][m_id='"+item_id+"']").html());
            $("img[name='on_"+key+"']").css("display","inline-block");
          }
              

          if($("l[m_id='"+item_id+"']").html().length){
              $(".urun_logo_del").css("display","inline-block");

              $(".ur_lo").attr("src",$("l[m_id='"+item_id+"']").html());
              $(".ur_lo").css("display","inline-block");
          }

           if($("u[m_id='"+item_id+"']").html().length){
              $(".urn_res_del").css("display","inline-block");
              $(".ur_bi").attr("src",$("u[m_id='"+item_id+"']").html());
              $(".ur_bi").css("display","inline-block");
           }




        CKEDITOR.instances["aciklama_"+key].setData($("ac[type='"+key+"'][m_id='"+item_id+"']").html());

         
    });

    $("#"+form_id+" input[name='sid']").val(item_id);
}
function scroll_slow_slider(scroll_id,height_id,form_id,typ=1){  /// Açılacak olan form = scroll_id, yuksekligi alınacak div = height_id, Eklencek olan resmin formu form_id
  $("#"+form_id+" input[name='sid']").val("0");
 // $("#"+form_id+" input[name='slider_resim']").removeAttr("readonly");




    $.each(dil_text, function( key, value ) {


          $(".pdf_del_"+key).css("display","none");
          $(".img_del_"+key).css("display","none");
          $(".urun_logo_del").css("display","none");
          $(".urn_res_del").css("display","none");

          $("img[name='on_"+key+"']").css("display","none");
          $("img[name='on_"+key+"']").attr("src","");
          $(".img_del_"+key).css("display","none");
          $("input[name='baslik_"+key+"']").val("");
          $(".kta_"+key).attr("href","");
          $(".kta_"+key).css("display","none");

    });

   
     
      $(".ur_lo").attr("src","");
      $(".ur_lo").css("display","none");
      
      $(".ur_bi").attr("src","");
      $(".ur_bi").css("display","none");


    if(typ==1){
  var k = 0;
  for(var i in CKEDITOR.instances ){
    var currentInstance = i;
    var oEditor   = CKEDITOR.instances[currentInstance].setData("");
    k++;
  }}
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


function form_submit(dis_div,form_id,info_field,close_field){
  var k = 0;
  var ck_edit = [];
  for(var i in CKEDITOR.instances ){
    var currentInstance = i;
    var oEditor   = CKEDITOR.instances[currentInstance].getData();
    
    if(oEditor.length){
    
    ck_edit[k] = oEditor;
    }else{
    ck_edit[k] ="";
    }
    k++;
  }
       var formData = new FormData();
        formData.append("sid",$("#"+form_id+" input[name='sid']").val());
        formData.append("tip",$("#"+form_id+" input[name='tip']").val());
          k = 0;

          var kontrol = 0;
          var kontrol_2 = 0;
          $.each(dil_text, function( key, value ) {
              formData.append("urunadi_"+key,$("#"+form_id+" input[type=text][name='urunadi_"+key+"']").val());
              formData.append("katalog_"+key,$("#"+form_id+" input[type=file][name='katalog_"+key+"']")[0].files[0]);
              formData.append("katalog_gorsel_"+key,$("#"+form_id+" input[type=file][name='katalog_gorsel_"+key+"']")[0].files[0]);
              formData.append("aciklama_"+key,ck_edit[k]);

              if($("#"+form_id+" input[type=file][name='katalog_"+key+"']")[0].files[0]){
                  kontrol = 1;
              }

              if($("#"+form_id+" input[type=text][name='urunadi_"+key+"']").val().length){
                  kontrol_2 = 1;
              }

              ///formData.append("aciklama_"+key,CKEDITOR.instances['aciklama_'+key].getData());
              k++;
          });
             // formData.append("link",$("#"+form_id+" input[type=text][name='link']").val());
             formData.append("resim",$("#"+form_id+" input[type=file][name='resim']")[0].files[0]);
             formData.append("logo",$("#"+form_id+" input[type=file][name='logo']")[0].files[0]);
             //formData.append("islem","sil");
              
              if($("#"+form_id+" input[name='sid']").val() == 0 && (kontrol==0 || kontrol_2 ==0)){
                  alert("Lütfen katalog seçtiğinizden ve başlık girdiğinizden emin olunuz.");
                  return false;
              }


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

       return false;
}



function slider_sil(scroll_id,item_id,height_id,form_id,info_field){

    var confirm_ = confirm("Yapıgereçlerini Silmek Istediginizden Eminmisiniz ?");
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

function alt_list_goruntule(grup_id){
        $("a[href='#list_page_tr']").click();
        $("#alt_kt input[name='grup_id']").val(grup_id);

      $.each(dil_text, function( key, value ) {
         $(".alt_grup_list_"+key).load("piston/control/"+glob_page_uri+"_alt_load.php?uid="+grup_id+"&dil_key="+key);
      });
      $(".full_galeri_list #list_slayt").css({"display":"block"});
       //  $(".box") $("g[m_id='"+grup_id+"']").html();

       $(".full_galeri_list .box-title").html("Yapı Gereçleri >"+$("g[m_id='"+grup_id+"']").html());
          var height = $("body").height();
         // $(".fiinns_c").attr("g__id",grup_id);
         // var f_height = $("#galeri_grub_ekle").height();
          var tp_heiht = height;
          $('html,body').animate({scrollTop: tp_heiht }, 1000);
        /*  $("#alt_kt input[name='alt_kt']").val(grup_id);
         // $("#galeri_grub_ekle").hide();*/
        // $(".ekle_slayt .btn-box-tool").click();
}

function alt_slider(form_id){
     /// $(".list_comp").load("piston/control/loader.php?page=finans_list_2&grup_id="+grup_id);
     $(".on_img").css("display","none");
     $(".on_img").attr("src","");
     $("#"+form_id+" input[name='sid']").val("0");
      $("#"+form_id).parents(".box").css({"display":"block"});
          var height = $("body").height();

          //$(".fiinns_c").attr("g__id",grup_id);
         // var f_height = $("#galeri_grub_ekle").height();
          var tp_heiht = height;
          $('html,body').animate({scrollTop: tp_heiht }, 1000);
        //  $("#alt_kt input[name='alt_kt']").val(grup_id);
         // $("#galeri_grub_ekle").hide();
        // $(".ekle_slayt .btn-box-tool").click();
}
function lang_change(dil_key){
     $("#alt_kt input[name='alt_sld_dil']").val(dil_key);
}
function alt_icerik_ekle(form_id,info_field){
//alt_sld_dil
    //formData.append("katalog_gorsel_"+key,$("#"+form_id+" input[type=file][name='katalog_gorsel_"+key+"']")[0].files[0]);
       var formData = new FormData();
          formData.append("uid",$("#"+form_id+" input[name='grup_id']").val());
          formData.append("dil_key",$("#"+form_id+" input[name='alt_sld_dil']").val());
          formData.append("resim",$("#"+form_id+" input[type=file][name='resim']")[0].files[0]);
          formData.append("sid",$("#"+form_id+" input[type=hidden][name='sid']").val());

           $.ajax({
            url: 'piston/control/'+glob_page_uri+"_alt.php",
            type: 'POST',
            data: formData,
            cache: false,
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            success: function(sonuc, textStatus, jqXHR)
            {
                $("#"+info_field).html(sonuc);
                $.each(dil_text, function( key, value ) {
                    $(".alt_grup_list_"+key).load("piston/control/"+glob_page_uri+"_alt_load.php?uid="+$("#"+form_id+" input[name='grup_id']").val()+"&dil_key="+key);
               });
                //$(".list_comp").load("piston/control/"+glob_page_uri+"_alt.php?load_max="+$(".list_comp").attr("goster_num"));
               // var tops = (parseInt($("li[menu_id='"+glob_page_uri+"'] .count_inf").html())+1);
               // $("li[menu_id='"+glob_page_uri+"'] .count_inf").html(tops);
                $('#main_full_page').waitMe('hide');
         $(".ekle_slayt .btn-box-tool").click();
               
                //console.log("ok");
                $("#"+form_id)[0].reset();
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
              $("#"+info_field).html(jqXHR);
              $('#main_full_page').waitMe('hide');
              //$("#"+dis_div+" .box-primary").slideToggle("slow");
            }
        });

    return false;
}


function alt_kat_duz(form_id,uid){
      alt_slider(form_id);
      $("#"+form_id+" input[name='sid']").val(uid);
      $(".on_img").attr("src",$(".slid_alt[m_id='"+uid+"']").attr("src"));
      $(".on_img").css("display","inline-block");
}
/*
info_field2
*/