function slider_ekle(dis_div,form_id,info_field,close_field){


     
       var formData = new FormData();
      formData.append("mail_adresi",$("#"+form_id+" input[name='mail_adresi']").val());

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
                //$(".list_comp").load("piston/control/"+glob_page_uri+"_load.php?load_max="+$(".list_comp").attr("goster_num"));
                $('#main_full_page').waitMe('hide');
              //  $("#"+dis_div+" .box-primary").slideToggle("slow");
               /// $("#"+form_id)[0].reset();
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