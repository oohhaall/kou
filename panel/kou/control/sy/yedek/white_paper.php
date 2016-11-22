<?php 
	require_once "../config/global_cont.php";
	extract($_POST);
	

if($sid==0 && (!isset($islem) || $islem != "sil")){
	$uzanti_f = pathinfo($_FILES["dosya"]["name"]);
	$uzanti = strtolower($uzanti_f["extension"]);
	if($uzanti != "php" || $uzanti != "asp" || $uzanti != "aspx" || $uzanti != "html"){
		$isim_s = $uzanti_f["filename"]."_".(substr(md5(rand()),0,5).".".$uzanti);
		@copy($_FILES["dosya"]["tmp_name"],$f_file_path.$isim_s);
		$res_ekle = $db->prepare("INSERT INTO slider(resim,sira,baslik,tip) values(:resim,:sira,:baslik,:tip)");
		$res_sira = $db->query("SELECT MAX(sira) FROM slider WHERE tip='".$tip."'")->fetch(); // Güncellenebilir veya birlestirilebilir bir sorgu
		//$res_ekle->bindValue(":baslik",$baslik);
		$res_ekle->bindValue(":resim",$isim_s);
		$res_ekle->bindValue(":baslik",$baslik);
		$res_ekle->bindValue(":sira",($res_sira["MAX(sira)"]+1));
		$res_ekle->bindValue(":tip",$tip);
		$res_ekle->execute();

		if($res_ekle->rowCount() != 0){
			?>
      <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    Slider başarıyla eklendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
			<?php
		}else{
			echo $res_ekle->errorCode();
			?>
    		 <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   Slider eklenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
			<?php
		}




	}else{
						?>
		    		 <div class="alert alert-warning alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
		                   Lütfen uygun formatta bir dosya yükleyiniz bir resim yükleyiniz.
		                  </div>
					<?php
			}
}else if(isset($islem) && $islem=="sil"){
		$sor_sid = $db->query("SELECT * FROM slider WHERE id='".$sid."'")->fetch();
		@unlink($f_file_path.$sor_sid["resim"]);
		$db->query("UPDATE slider SET sira=sira-1 WHERE sira>='".$sor_sid["sira"]."' AND sira>1");
		$sil_d = $db->prepare("DELETE FROM slider WHERE id='".$sid."'");
		$sil_d->execute();

		if($sil_d->rowCount() > 0){
				?>
				      <div class="alert alert-success alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
		                    Slider başarıyla silindi listeden detaylı görüntüleme yapabilirsiniz.
		                  </div>
<?php 
		}else{
			?>
 						<div class="alert alert-warning alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
		                   Slider silinemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
		                  </div>
			<?php
		}

}else{
		$sor_sid = $db->query("SELECT * FROM slider WHERE id='".$sid."'")->fetch();

	if(!empty($_FILES["dosya"]["name"])){
			$uzanti_f = pathinfo($_FILES["dosya"]["name"]);
			$uzanti = strtolower($uzanti_f["extension"]);
			if($uzanti != "php" || $uzanti != "asp" || $uzanti != "aspx" || $uzanti != "html"){
				$isim_s = (substr(md5(rand()),0,10).".".$uzanti);
				@unlink($f_file_path.$sor_sid["resim"]);
				@copy($_FILES["dosya"]["tmp_name"],$f_file_path.$isim_s);
				$res_ekle = $db->prepare("UPDATE slider SET baslik=:baslik,resim=:resim  WHERE id=:id");
				//$res_ekle->bindValue(":baslik",$baslik);
				$res_ekle->bindValue(":resim",$isim_s);
				$res_ekle->bindValue(":baslik",$baslik);
				$res_ekle->bindValue(":id",$sid);
				$res_ekle->execute();
				if($res_ekle->rowCount() != 0){
					?>
		      <div class="alert alert-success alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
		                    Slider başarıyla güncellendi listeden detaylı görüntüleme yapabilirsiniz.
		                  </div>
					<?php
				}else{
					?>
		    		 <div class="alert alert-warning alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
		                   Slider güncellenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
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

				$res_ekle = $db->prepare("UPDATE slider SET baslik=:baslik  WHERE id=:id");
				///$res_ekle->bindValue(":baslik",$baslik);
				$res_ekle->bindValue(":baslik",$baslik);
				$res_ekle->bindValue(":id",$sid);
				$res_ekle->execute();
				if($res_ekle->rowCount() != 0){
					?>
		      <div class="alert alert-success alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
		                    Slider başarıyla güncellendi listeden detaylı görüntüleme yapabilirsiniz.
		                  </div>
					<?php
				}else{
					?>
		    		 <div class="alert alert-warning alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
		                   Slider güncellenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
		                  </div>
					<?php
				}
	}
}
?>