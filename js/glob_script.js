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
          minWidth:300
        }); // fancybox
      } // success
    }); // ajax
  }); // on

$('.fancybox').fancybox({fitToView: false,
          autoSize: true});
});


  ;(function($, window, document, undefined){
  
//$.fn.mobileMenu = function(){
//version 1.0.5 -рефакторинг, изменение стилей, сброс ненужных классов ul, li, a
//vars block
    var buttonNextLevelHtml = '<span class="arrow js-arrow">&rsaquo;</span>',
      buttonPrevLevelHtml = '<li class="back js-back">Üst Menü</li>',
      toggle = $('.js-toggle'),
      overlay = $('.overlay'),
      body = $('body'),
      menu = $('.multilevelMenu'),
      link = menu.find('a'),
      menuList = menu.find('li').find('ul');

    //create animate-menu function
    function openMenu() {
      body.toggleClass('fixed');
      setTimeout(function() { $('.close-list').removeClass('close-list') }, 400);
    };
    
    //animate menu function Call
    toggle.add(overlay).on("click", function(){
        openMenu();
    });
    //the end animate menu function Call

    //add switch-button for children ul
    link.append(function(indx, val){
        var out = '';
        if($(this).parent('li').find('ul').length != 0) {
          out = buttonNextLevelHtml;
        } 
        return out
      });

    //add back-button
    menuList.prepend(buttonPrevLevelHtml)

    //var block-two
    var buttonNextLevel = $('.js-arrow'),
        buttonPrevLevel = $('.js-back');

    //view next level menu
    $(link).on("click", "span", function(e){
      e.preventDefault();
      e.stopPropagation();
      $(this).parents('ul').addClass('close-list');
      $(this).closest('li').children('ul').addClass('active-menu');
    });

    //view prev level menu to click "back" 
    buttonPrevLevel.on("click", function(){
      $(this).closest('ul.close-list').removeClass('close-list');
      var that = this;
      setTimeout(function() {
        $(that).closest('ul').removeClass('active-menu')
      }, 400);
    });

  
//};
  
})(jQuery, window, document);