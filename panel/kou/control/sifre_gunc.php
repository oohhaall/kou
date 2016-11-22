<?php 
require_once "../config/global_cont.php";
extract($_POST);
	if($sifre!=$sifre_tekrar){
		?>
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Hata!</h4>
					Lütfen girilen şifrelerin aynı olduğundan emin olun.
				  </div>  
		<?php
	}else if(!isset($_SESSION["login"])){
		?>
			<script type="text/javascript">
			window.location='index.php';</script>
		<?php
	}else{

	$sifre_gunc = $db->prepare("UPDATE panel_user SET pass=:sifre WHERE id=:uid");
	$sifre_gunc->bindValue(":sifre",md5(md5($sifre)));
	$sifre_gunc->bindValue(":uid",$_SESSION["user_id"]);
	$sifre_gunc->execute();
	if($sifre_gunc->rowCount()>0){
		?>
 			<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4>  <i class="icon fa fa-check"></i> İşlem Tamamlandı!</h4>
                Şifre başarıyla güncellendi oturumunuz bu sayfadan çıktığınızda kapatılacaktır lütfen yeni şifrenizle giriş yapın.
            </div>
		<?php
		session_destroy();
	}else{
		?>
		  <div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Hata!</h4>
					Beklenmedik bir hata oluştu lütfen daha sonra tekrar deneyin ve sorunla ilgili yetkili ile iletişime geçin.
				  </div>  
		<?php
	}
}

?>