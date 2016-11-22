<?php 
	require_once "../config/global_cont.php";
	extract($_POST);

if($sid==0 && (!isset($islem) || $islem != "sil")){
	$uzanti_f = pathinfo($_FILES["slider_resim"]["name"]);
	$uzanti = strtolower($uzanti_f["extension"]);
	if($uzanti == "jpg" || $uzanti == "jpeg" || $uzanti == "png" || $uzanti == "gif"){
		$isim_s = (substr(md5(rand()),0,10).".".$uzanti);
		@copy($_FILES["slider_resim"]["tmp_name"],$file_upload_path.$isim_s);
		$res_ekle = $db->prepare("INSERT INTO galeri(resim,grup_id,sira) values(:resim,:grup_id,:sira)");
		$res_sira = $db->query("SELECT MAX(sira) FROM galeri")->fetch(); // Güncellenebilir veya birlestirilebilir bir sorgu
		//$res_ekle->bindValue(":baslik",$baslik);
		$res_ekle->bindValue(":resim",$isim_s);
		$res_ekle->bindValue(":grup_id",$tip);
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
		$sor_sid = $db->query("SELECT * FROM galeri WHERE id='".$sid."'")->fetch();
		@unlink($file_upload_path.$sor_sid["resim"]);
		$db->query("UPDATE galeri SET sira=sira-1 WHERE sira>='".$sor_sid["sira"]."' AND sira>1");
		$sil_d = $db->prepare("DELETE FROM galeri WHERE id='".$sid."'");
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
		$sor_sid = $db->query("SELECT * FROM galeri WHERE id='".$sid."'")->fetch();

	if(!empty($_FILES["slider_resim"]["name"])){
			$uzanti_f = pathinfo($_FILES["slider_resim"]["name"]);
			$uzanti = strtolower($uzanti_f["extension"]);
			if($uzanti == "jpg" || $uzanti == "jpeg" || $uzanti == "png" || $uzanti == "gif"){
				$isim_s = (substr(md5(rand()),0,10).".".$uzanti);
				@unlink($file_upload_path.$sor_sid["resim"]);
				@copy($_FILES["slider_resim"]["tmp_name"],$file_upload_path.$isim_s);
				$res_ekle = $db->prepare("UPDATE galeri SET resim=:resim  WHERE id=:id");
				//$res_ekle->bindValue(":baslik",$baslik);
				$res_ekle->bindValue(":resim",$isim_s);
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
	}
}
?>