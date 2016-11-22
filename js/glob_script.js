  $(document).ready(function(){
  $('.popup_page').on("click", function (e) {
  	var uri = $(this).attr("d_h");
  	var item_id = $(this).attr("l_id");
    e.preventDefault(); // avoids calling preview.php
    $.ajax({
      type: "POST",
      cache: false,
      url: "popup_detay.php",
      data:{uid:item_id},
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

});
