function login(log){
	var current_effect = $('#waitMe_ex_effect').val();
	run_waitMe_login(current_effect);
	 $.post("kou/control/login_func.php",$(log).serialize(),function(sonuc,sc){
	 		if(sc=="success" && sonuc=="oks"){
	 			$('body').waitMe('hide');
        window.location = "panel.php";
	 		}else{
        $('body').waitMe('hide');
        alert("Kullanıcı Adı veya Şifre Hatalı");
      }
	 });
	return false;
}
  function run_waitMe_login(effect){
    $('body').waitMe({
      effect: "img",
      bg: 'rgba(255,255,255,0.6)',
      color: '#000',
      maxSize: '',
      source: 'kou/images/gif.gif',
      onClose: function() {}
    });
  }
 