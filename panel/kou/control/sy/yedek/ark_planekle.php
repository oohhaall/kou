<?php 
	require_once "../config/global_cont.php";
	extract($_POST);

if($sid==0 && (!isset($islem) || $islem != "sil")){
	$uzanti_f = pathinfo($_FILES["slider_resim"]["name"]);
	$uzanti = strtolower($uzanti_f["extension"]);

	$uzanti_f1 = pathinfo($_FILES["profil"]["name"]);
	$uzanti1 = strtolower($uzanti_f1["extension"]);
	if(($uzanti == "jpg" || $uzanti == "jpeg" || $uzanti == "png" || $uzanti == "gif") && ($uzanti1 == "jpg" || $uzanti1 == "jpeg" || $uzanti1 == "png" || $uzanti1 == "gif")){
		$isim_s = (substr(md5(rand()),0,10).".".$uzanti);
		$isim_s1 = (substr(md5(rand()),0,10).".".$uzanti1);
		@copy($_FILES["slider_resim"]["tmp_name"],$file_upload_path.$isim_s);
		@copy($_FILES["profil"]["tmp_name"],$file_upload_path.$isim_s1);
		$res_ekle = $db->prepare("INSERT INTO arkaplan(resim,sayfa,sira,profil,name,title_tr) values(:resim,:grup_id,:sira,:profil,:name,:title_tr)");
		$res_sira = $db->query("SELECT MAX(sira) FROM arkaplan")->fetch(); // Güncellenebilir veya birlestirilebilir bir sorgu
		//$res_ekle->bindValue(":baslik",$baslik);
		$res_ekle->bindValue(":resim",$isim_s);
		$res_ekle->bindValue(":grup_id",$tip);
		$res_ekle->bindValue(":profil",$isim_s1);
		$res_ekle->bindValue(":name",$name);
		$res_ekle->bindValue(":title_tr",$title_tr);

		/*
		$res_ekle->bindValue(":title_hu",$title_hu);
		$res_ekle->bindValue(":title_gr",$title_gr);*/
		$res_ekle->bindValue(":sira",($res_sira["MAX(sira)"]+1));
		$res_ekle->execute();

		if($res_ekle->rowCount() != 0){
			?>
    	  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Resim başarıyla eklendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
			<?php
		}else{
			?>
    		 <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   Resim eklenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
			<?php
		}




	}else{
						?>
		    		 <div class="alert alert-warning alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
		                   Lütfen jpg,jpeg,png ve gif Formatında bir resim yükleyiniz.
		                  </div>
					<?php
			}
}else if(isset($islem) && $islem=="sil"){
		$sor_sid = $db->query("SELECT * FROM arkaplan WHERE id='".$sid."'")->fetch();
		@unlink($file_upload_path.$sor_sid["resim"]);
		@unlink($file_upload_path.$sor_sid["profil"]);
		$db->query("UPDATE arkaplan SET sira=sira-1 WHERE sira>='".$sor_sid["sira"]."' AND sira>1");
		$sil_d = $db->prepare("DELETE FROM arkaplan WHERE id='".$sid."'");
		$sil_d->execute();

		if($sil_d->rowCount() > 0){
				?>
				      <div class="alert alert-success alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
		                    Resim başarıyla silindi listeden detaylı görüntüleme yapabilirsiniz.
		                  </div>
<?php 
		}else{
			?>
 						<div class="alert alert-warning alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
		                   Resim silinemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
		                  </div>
			<?php
		}

}else{
		$sor_sid = $db->query("SELECT * FROM arkaplan WHERE id='".$sid."'")->fetch();

	if(!empty($_FILES["slider_resim"]["name"]) && !empty($_FILES["profil"]["name"]) ){
			$uzanti_f = pathinfo($_FILES["slider_resim"]["name"]);
	$uzanti = strtolower($uzanti_f["extension"]);

	$uzanti_f1 = pathinfo($_FILES["profil"]["name"]);
	$uzanti1 = strtolower($uzanti_f1["extension"]);
	if(($uzanti == "jpg" || $uzanti == "jpeg" || $uzanti == "png" || $uzanti == "gif") && ($uzanti1 == "jpg" || $uzanti1 == "jpeg" || $uzanti1 == "png" || $uzanti1 == "gif")){
		$isim_s = (substr(md5(rand()),0,10).".".$uzanti);
		$isim_s1 = (substr(md5(rand()),0,10).".".$uzanti1);

		@unlink($file_upload_path.$sor_sid["resim"]);
		@unlink($file_upload_path.$sor_sid["profil"]);
		@copy($_FILES["slider_resim"]["tmp_name"],$file_upload_path.$isim_s);
		@copy($_FILES["profil"]["tmp_name"],$file_upload_path.$isim_s1);


	$res_ekle = $db->prepare("UPDATE arkaplan SET resim=:resim,profil=:profil,title_tr=:title_tr,name=:name  WHERE id=:id");
				//$res_ekle->bindValue(":baslik",$baslik);
				$res_ekle->bindValue(":resim",$isim_s);
				$res_ekle->bindValue(":title_tr",$title_tr);
				$res_ekle->bindValue(":profil",$isim_s1);
				$res_ekle->bindValue(":name",$name);
			//	$res_ekle->bindValue(":title_gr",$title_gr);
			//	$res_ekle->bindValue(":title_hu",$title_hu);
				$res_ekle->bindValue(":id",$sid);
				$res_ekle->execute();
			if($res_ekle->rowCount() != 0){
					?>
		      <div class="alert alert-success alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
		                    Resim başarıyla güncellendi listeden detaylı görüntüleme yapabilirsiniz.
		                  </div>
					<?php
				}else{
					?>
		    		 <div class="alert alert-warning alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
		                   Resim güncellenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
		                  </div>
					<?php
				}

			}else{
						?>
		    		 <div class="alert alert-warning alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
		                   Lütfen jpg,jpeg,png ve gif Formatında bir resim yükleyiniz.
		                  </div>
					<?php
			}
	}else if(!empty($_FILES["slider_resim"]["name"])){
			
	$uzanti_f = pathinfo($_FILES["slider_resim"]["name"]);
	$uzanti = strtolower($uzanti_f["extension"]);

	if(($uzanti == "jpg" || $uzanti == "jpeg" || $uzanti == "png" || $uzanti == "gif")){
		$isim_s = (substr(md5(rand()),0,10).".".$uzanti);

		@unlink($file_upload_path.$sor_sid["resim"]);
		@copy($_FILES["slider_resim"]["tmp_name"],$file_upload_path.$isim_s);


	$res_ekle = $db->prepare("UPDATE arkaplan SET resim=:resim,title_tr=:title_tr,name=:name  WHERE id=:id");
				//$res_ekle->bindValue(":baslik",$baslik);
				$res_ekle->bindValue(":resim",$isim_s);
				$res_ekle->bindValue(":title_tr",$title_tr);
			//	$res_ekle->bindValue(":profil",$isim_s1);
				$res_ekle->bindValue(":name",$name);
			//	$res_ekle->bindValue(":title_gr",$title_gr);
			//	$res_ekle->bindValue(":title_hu",$title_hu);
				$res_ekle->bindValue(":id",$sid);
				$res_ekle->execute();
			if($res_ekle->rowCount() != 0){
					?>
		      <div class="alert alert-success alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
		                    Resim başarıyla güncellendi listeden detaylı görüntüleme yapabilirsiniz.
		                  </div>
					<?php
				}else{
					?>
		    		 <div class="alert alert-warning alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
		                   Resim güncellenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
		                  </div>
					<?php
				}

			}else{
						?>
		    		 <div class="alert alert-warning alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
		                   Lütfen jpg,jpeg,png ve gif Formatında bir resim yükleyiniz.
		                  </div>
					<?php
			}

	}else if(!empty($_FILES["profil"]["name"])){


	$uzanti_f1 = pathinfo($_FILES["profil"]["name"]);
	$uzanti1 = strtolower($uzanti_f1["extension"]);
	if(($uzanti1 == "jpg" || $uzanti1 == "jpeg" || $uzanti1 == "png" || $uzanti1 == "gif")){
		$isim_s1 = (substr(md5(rand()),0,10).".".$uzanti1);

		@unlink($file_upload_path.$sor_sid["profil"]);
		@copy($_FILES["profil"]["tmp_name"],$file_upload_path.$isim_s1);


	$res_ekle = $db->prepare("UPDATE arkaplan SET profil=:profil,title_tr=:title_tr,name=:name  WHERE id=:id");
				//$res_ekle->bindValue(":baslik",$baslik);
			///	$res_ekle->bindValue(":resim",$isim_s);
				$res_ekle->bindValue(":title_tr",$title_tr);
				$res_ekle->bindValue(":profil",$isim_s1);
				$res_ekle->bindValue(":name",$name);
			//	$res_ekle->bindValue(":title_gr",$title_gr);
			//	$res_ekle->bindValue(":title_hu",$title_hu);
				$res_ekle->bindValue(":id",$sid);
				$res_ekle->execute();
			if($res_ekle->rowCount() != 0){
					?>
		      <div class="alert alert-success alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
		                    Resim başarıyla güncellendi listeden detaylı görüntüleme yapabilirsiniz.
		                  </div>
					<?php
				}else{
					?>
		    		 <div class="alert alert-warning alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
		                   Resim güncellenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
		                  </div>
					<?php
				}

			}else{
						?>
		    		 <div class="alert alert-warning alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
		                   Lütfen jpg,jpeg,png ve gif Formatında bir resim yükleyiniz.
		                  </div>
					<?php
			}
	}else{
			//$isim_s = (substr(md5(rand()),0,10).".".$uzanti);
			//	@unlink($file_upload_path.$sor_sid["resim"]);
			//	@copy($_FILES["slider_resim"]["tmp_name"],$file_upload_path.$isim_s);
				$res_ekle = $db->prepare("UPDATE arkaplan SET title_tr=:title_tr,name=:name  WHERE id=:id");
				//$res_ekle->bindValue(":baslik",$baslik);
				//$res_ekle->bindValue(":resim",$isim_s);
				$res_ekle->bindValue(":title_tr",$title_tr);
				$res_ekle->bindValue(":name",$name);
				/*
				$res_ekle->bindValue(":title_gr",$title_gr);
				$res_ekle->bindValue(":title_hu",$title_hu);*/
				$res_ekle->bindValue(":id",$sid);
				$res_ekle->execute();
			if($res_ekle->rowCount() != 0){
					?>
		      <div class="alert alert-success alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
		                    Başarıyla güncellendi listeden detaylı görüntüleme yapabilirsiniz.
		                  </div>
					<?php
				}else{
					?>	
		    		 <div class="alert alert-warning alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
		                   Güncellenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
		                  </div>
					<?php
		}
	}
}
?>