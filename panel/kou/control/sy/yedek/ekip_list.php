<?php 
	require_once "../config/global_cont.php";
	extract($_POST);

if(@$tip==0 && (!isset($islem) || $islem != "sil")){
		$uzanti_f = pathinfo($_FILES["icerik_resim"]["name"]);
		$uzanti = strtolower($uzanti_f["extension"]);
		$isim_s = (substr(md5(rand()),0,10).".".$uzanti);
		@copy($_FILES["icerik_resim"]["tmp_name"],$file_upload_path.$isim_s);
		$res_ekle = $db->prepare("INSERT INTO ekip(baslik,sira,resim,icerik,unvan,facebook,twitter,linkedin,web,mail) values(:baslik,:sira,:resim,:icerik,:unvan,:facebook,:twitter,:linkedin,:web,:mail)");
		$res_sira = $db->query("SELECT MAX(sira) FROM ekip")->fetch();
		$res_ekle->bindValue(":baslik",$baslik);
		$res_ekle->bindValue(":unvan",$unvan);

		$res_ekle->bindValue(":facebook",$facebook);
		$res_ekle->bindValue(":twitter",$twitter);
		$res_ekle->bindValue(":linkedin",$linkedin);
		$res_ekle->bindValue(":web",$web);
		$res_ekle->bindValue(":mail",$mail);

		$res_ekle->bindValue(":icerik",$icerik);
		$res_ekle->bindValue(":resim",$isim_s);
		$res_ekle->bindValue(":sira",($res_sira["MAX(sira)"]+1));
		$res_ekle->execute();

		if($res_ekle->rowCount() != 0){
			?>
      <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Ekip başarıyla eklendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
			<?php
		}else{
			?>
    		 <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   Ekip eklenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
			<?php
		}


}else if(@$tip==1 && (!isset($islem) || $islem != "sil")){

		$uzanti_f = pathinfo($_FILES["icerik_resim"]["name"]);
		$uzanti = strtolower($uzanti_f["extension"]);
		$isim_s = (substr(md5(rand()),0,10).".".$uzanti);
		//@unlink($file_upload_path.$sor_sid["resim"]);
		@copy($_FILES["icerik_resim"]["tmp_name"],$file_upload_path.$isim_s);
	
		$res_ekle = $db->prepare("INSERT INTO ekip(baslik,sira,resim,icerik,tur,ust_kt,unvan,facebook,twitter,linkedin,web,mail) values(:baslik,:sira,:resim,:icerik,:tur,:alt_kt,:unvan,:facebook,:twitter,:linkedin,:web,:mail)");
		$res_sira = $db->query("SELECT MAX(sira) FROM ekip WHERE ust_kt='$alt_kt'")->fetch();
		$res_ekle->bindValue(":baslik",$baslik);
		$res_ekle->bindValue(":icerik",$icerik);
		$res_ekle->bindValue(":unvan",$unvan);

		$res_ekle->bindValue(":facebook",$facebook);
		$res_ekle->bindValue(":twitter",$twitter);
		$res_ekle->bindValue(":linkedin",$linkedin);
		$res_ekle->bindValue(":web",$web);
		$res_ekle->bindValue(":mail",$mail);

		$res_ekle->bindValue(":resim",$isim_s);
		$res_ekle->bindValue(":tur",2);
		$res_ekle->bindValue(":alt_kt",$alt_kt);
		$res_ekle->bindValue(":sira",($res_sira["MAX(sira)"]+1));
		$res_ekle->execute();

		if($res_ekle->rowCount() != 0){
			?>
      <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Ekip başarıyla eklendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
			<?php
		}else{
			?>
    		 <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   Ekip eklenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
			<?php
		}

}else if(isset($islem) && $islem=="sil"){ /// Silerken grubun altındaki tüm resimleride silmek gerekiyor
		
		$sor_sid = $db->query("SELECT * FROM ekip WHERE id='".$sid."'")->fetch();

		if($sor_sid["ust_kt"] == 0){
			@unlink($file_upload_path.$sor_sid["resim"]);

			$sor_ana_sid = $db->query("SELECT * FROM ekip WHERE ust_kt='".$sid."'");
			foreach ($sor_ana_sid->fetchAll() as $key => $value) {
				@unlink($file_upload_path.$value["resim"]);
			}
			$sil_d = $db->prepare("DELETE FROM ekip WHERE id='".$sid."' OR ust_kt='".$sid."'");		
			$sil_d->execute();
			if($sil_d->rowCount() > 0){
				?>
				      <div class="alert alert-success alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
		                    Ekip silindi listeden detaylı görüntüleme yapabilirsiniz.
		                  </div>
					<?php 
				}else{
					?>
		 						<div class="alert alert-warning alert-dismissable">
				                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
				                   Ekip silinemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
				                  </div>
					<?php
				}
		}else{
			@unlink($file_upload_path.$sor_sid["resim"]);
				$sil_d = $db->prepare("DELETE FROM ekip WHERE id='".$sid."'");		
				$sil_d->execute();
			if($sil_d->rowCount() > 0){
				?>
				      <div class="alert alert-success alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
		                   Ekip başarıyla silindi listeden detaylı görüntüleme yapabilirsiniz.
		                  </div>
					<?php 
				}else{
					?>
		 						<div class="alert alert-warning alert-dismissable">
				                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
				                   Ekip silinemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
				                  </div>
					<?php
				}
		}

		/*foreach ($sor_sid->fetchAll() as $key => $value) {
			@unlink($file_upload_path.$value["resim"]);
		}*/



}else{

				if(!empty($_FILES["icerik_resim"]["name"])){
					$sor_sid = $db->query("SELECT * FROM ekip WHERE id='".$sid."'")->fetch();
						@unlink($file_upload_path.$sor_sid["resim"]);
						$uzanti_f = pathinfo($_FILES["icerik_resim"]["name"]);
						$uzanti = strtolower($uzanti_f["extension"]);
						$isim_s = (substr(md5(rand()),0,10).".".$uzanti);
						@copy($_FILES["icerik_resim"]["tmp_name"],$file_upload_path.$isim_s);
						$res_ekle = $db->prepare("UPDATE ekip SET baslik=:grup_name,icerik=:icerik,resim=:res,unvan=:unvan,facebook=:facebook,twitter=:twitter,linkedin=:linkedin,web=:web,mail=:mail  WHERE id=:id");
						$res_ekle->bindValue(":grup_name",$baslik);
						$res_ekle->bindValue(":unvan",$unvan);

						$res_ekle->bindValue(":facebook",$facebook);
						$res_ekle->bindValue(":twitter",$twitter);
						$res_ekle->bindValue(":linkedin",$linkedin);
						$res_ekle->bindValue(":web",$web);
						$res_ekle->bindValue(":mail",$mail);

						$res_ekle->bindValue(":icerik",$icerik);
						$res_ekle->bindValue(":res",$isim_s);
						$res_ekle->bindValue(":id",$sid);
						$res_ekle->execute();

				}else{
						$res_ekle = $db->prepare("UPDATE ekip SET baslik=:grup_name,icerik=:icerik,unvan=:unvan,facebook=:facebook,twitter=:twitter,linkedin=:linkedin,web=:web,mail=:mail  WHERE id=:id");
						$res_ekle->bindValue(":grup_name",$baslik);
						$res_ekle->bindValue(":icerik",$icerik);
						$res_ekle->bindValue(":unvan",$unvan);


						$res_ekle->bindValue(":facebook",$facebook);
						$res_ekle->bindValue(":twitter",$twitter);
						$res_ekle->bindValue(":linkedin",$linkedin);
						$res_ekle->bindValue(":web",$web);
						$res_ekle->bindValue(":mail",$mail);

						//$res_ekle->bindValue(":res",$isim_s);
						$res_ekle->bindValue(":id",$sid);
						$res_ekle->execute();
				}


				if($res_ekle->rowCount() != 0){
					?>
		      <div class="alert alert-success alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
		                    Ekip başarıyla güncellendi listeden detaylı görüntüleme yapabilirsiniz.
		                  </div>
					<?php
				}else{
					?>
		    		 <div class="alert alert-warning alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
		                   Ekip güncellenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
		                  </div>
					<?php
				}
	
}
?>