var glob_page_uri = "";

var dil_text = {"tr":"Türkçe","en":"English"};
var dil_text_int = {0:"tr",1:"en"};


function page_go(page_uri){ // Sayfa Gecisi
      if(page_uri.length == 0)
        window.location = "panel.php?page=404";
      glob_page_uri = page_uri;
  
      var ust_page = $("li[menu_id='"+page_uri+"']").attr("ust_menu");
      $(".sidebar-menu li").removeClass("active");
      if(ust_page.length != 0){
        $(".sidebar-menu li[menu_id='"+ust_page+"']").addClass("active");
        $(".sidebar-menu li[menu_id='"+page_uri+"']").addClass("active");
      }else{
        $(".sidebar-menu li[menu_id='"+page_uri+"']").addClass("active");
      }
      glob_page_uri = page_uri;
}
function gunc_durum(s_id,up_class){ 
      var current_effect = $('#waitMe_ex_effect').val();
        run_waitMe_login(current_effect);
    var ups = up_class;
    if(up_class == undefined)
      ups = "slider-track";
    
     var post_t = $("."+ups).attr("post_type");
     var post_d = $("."+ups).attr("dt_table");
   //  var list_id = $(".slider-track").attr("item_id");

     $.post("kou/control/update_active.php?dt="+post_d,{islem:"durum",lid:s_id},function(sonuc,sc){

          if(sc=="success"){
                 $("."+ups+"[item_id='"+s_id+"']").toggleClass("acik_on");
          
              if($("."+ups).attr("class") == "slider-track acik_on")
                var g_durum = 1;
              else
                var g_durum = 0;


                   $('#main_full_page').waitMe('hide');

          }

     });
          
}




var sortableLinks = $(".list_comp");
$(sortableLinks).sortable();
$( ".list_comp" ).sortable({
       update: function() {
        var current_effect = $('#waitMe_ex_effect').val();
        run_waitMe_login(current_effect);
            var gunc_list = $('.list_comp').sortable('serialize');
            var post_dt = $(this).attr("dt_table");
            var post_uri = $(this).attr("post_uri");
            if(post_uri=="alt_kategori_list" || post_uri=="alt_kt_program"){
                post_uri += "&grup_id="+$(this).attr("g__id");
            }
          $.post("kou/control/list_update.php?gunc_page="+post_uri+"&dt="+post_dt,gunc_list,function(sonuc,sc){
              if(sc=="success" && sonuc=="guncellendi"){
                   $('#main_full_page').waitMe('hide');
              }
          });
           // console.log(order);
           // console.log($(this).attr("post_uri"));
        }       
});





function sifre_degis(form_id,info_id){
  var form_s = $("#"+form_id).serialize();
  var current_effect = $('#waitMe_ex_effect').val();
  run_waitMe_login(current_effect);
  $.post("kou/control/sifre_gunc.php",form_s,function(sonuc,sc){
        if(sc=="success"){
        $("#"+info_id).html(sonuc);
          $('#main_full_page').waitMe('hide');
          $("#"+form_id+" input[type='password']").val('');
    }
  });
  return false;
}
function run_waitMe_login(effect){
    $('#main_full_page').waitMe({
      effect: "bounce",
      bg: 'rgba(255,255,255,0.6)',
      color: '#000',
      maxSize: '',
      /*source: 'kou/images/gif.gif',*/
      onClose: function() {}
    });
}

function run_waitMe_pop(effect){
  $(".fancybox-inner").css({"overflow":"hidden"});
    $('.main_full_pop').waitMe({
      effect: "img",
      bg: 'rgba(255,255,255,0.6)',
      color: '#000',
      maxSize: '',
      source: 'kou/images/gif.gif',
      onClose: function() {
        $(".fancybox-inner").css({"overflow":"auto"});
      }
    });
}

function logout(){
    var cikis = confirm("Çıkış yapmak istediğinizden eminimisiniz ?");

    if(cikis)
        return true;
    else
      return false;
}




function daha_fazla_goster(goster_class){
      var current_effect = $('#waitMe_ex_effect').val();
      run_waitMe_login(current_effect);


      var goster_url = $("."+goster_class).attr("post_uri");
      var goster_num = parseInt($("."+goster_class).attr("goster_num"))+10;

        $("."+goster_class).attr("goster_num",goster_num);


        $.post("kou/control/"+goster_url+"_load.php",{"load_max":goster_num},function(sonuc,sc){
            if(sc=="success"){
                  $('#main_full_page').waitMe('hide');
                  $("."+goster_class).html(sonuc);
            }
        });



}




var sortableLinks = $(".list_comp_2");
$(sortableLinks).sortable();
$( ".list_comp_2" ).sortable({
       update: function() {
        var current_effect = $('#waitMe_ex_effect').val();
        run_waitMe_login(current_effect);
            var gunc_list = $('.list_comp_2').sortable('serialize');
            var post_uri = $(this).attr("post_uri");
            var post_dt = $(this).attr("dt_table");
          $.post("kou/control/list_update.php?gunc_page="+post_uri+"&dt="+post_dt,gunc_list,function(sonuc,sc){
              if(sc=="success" && sonuc=="guncellendi"){
                   $('#main_full_page').waitMe('hide');
              }
          });
           // console.log(order);
           // console.log($(this).attr("post_uri"));
        }       
});




// Fancybox
$('.fancybox').fancybox();

      /*
       *  Different effects
       */

      // Change title type, overlay closing speed
      $(".fancybox-effects-a").fancybox({
        helpers: {
          title : {
            type : 'outside'
          },
          overlay : {
            speedOut : 0
          }
        }
      });

      // Disable opening and closing animations, change title type
      $(".fancybox-effects-b").fancybox({
        openEffect  : 'none',
        closeEffect : 'none',

        helpers : {
          title : {
            type : 'over'
          }
        }
      });

      // Set custom style, close if clicked, change title type and overlay color
      $(".fancybox-effects-c").fancybox({
        wrapCSS    : 'fancybox-custom',
        closeClick : true,

        openEffect : 'none',

        helpers : {
          title : {
            type : 'inside'
          },
          overlay : {
            css : {
              'background' : 'rgba(238,238,238,0.85)'
            }
          }
        }
      });

      // Remove padding, set opening and closing animations, close if clicked and disable overlay
      $(".fancybox-effects-d").fancybox({
        padding: 0,

        openEffect : 'elastic',
        openSpeed  : 150,

        closeEffect : 'elastic',
        closeSpeed  : 150,

        closeClick : true,

        helpers : {
          overlay : null
        }
      });

      /*
       *  Button helper. Disable animations, hide close button, change title type and content
       */

      $('.fancybox-buttons').fancybox({
        openEffect  : 'none',
        closeEffect : 'none',

        prevEffect : 'none',
        nextEffect : 'none',

        closeBtn  : false,

        helpers : {
          title : {
            type : 'inside'
          },
          buttons : {}
        },

        afterLoad : function() {
          this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
        }
      });


      /*
       *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
       */

      $('.fancybox-thumbs').fancybox({
        prevEffect : 'none',
        nextEffect : 'none',

        closeBtn  : false,
        arrows    : false,
        nextClick : true,

        helpers : {
          thumbs : {
            width  : 50,
            height : 50
          }
        }
      });

      /*
       *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
      */
      $('.fancybox-media')
        .attr('rel', 'media-gallery')
        .fancybox({
          openEffect : 'none',
          closeEffect : 'none',
          prevEffect : 'none',
          nextEffect : 'none',

          arrows : false,
          helpers : {
            media : {},
            buttons : {}
          }
        });


// #Fancybox