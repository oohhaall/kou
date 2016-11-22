<?php 
		require_once "../config/global_cont.php";
		extract($_POST);

		$dt_table = "urunslayt";


	if($_POST){
			if($eid==0){

			$isim_s = "";
					if(!empty($_FILES["docs"]["name"])){
							if(format_kontrol_resim($_FILES["docs"]["tmp_name"])){
							$uzanti_f = pathinfo($_FILES["docs"]["name"]);
							$uzanti = strtolower($uzanti_f["extension"]);
							$isim_s = (substr(md5(rand()),0,10).".".$uzanti);
							@copy($_FILES["docs"]["tmp_name"],$file_upload_path.$isim_s);
						}else{
							?>

				<div class="ajax-file-upload-progress"><div class="ajax-file-upload-bar" style="width: 100%; background:#df2a00;"></div></div><span class="glyphicon glyphicon-remove" style="display:inline-block;top:-10px; color:#df2a00;"></span><p>Yüklenmedi lütfen resim dosyası seçtiğinizden emin olun</p></div></div>
							<?php
							exit;
						}
						}else{
							$isim_s = "";
						}

		$ekle_detay = $db->prepare("INSERT INTO $dt_table(uid,sra,resim) SELECT :uid as uid,(MAX(sra)+1) as sra,:resim as resim FROM $dt_table WHERE uid=:uid");
		$ekle_detay->bindValue(":uid",$sid);
		$ekle_detay->bindValue(":resim",$isim_s);
		$ekle_detay->execute();

				if($ekle_detay->rowCount()!=0){
					?>
				  <div class="ajax-file-upload-progress"><div class="ajax-file-upload-bar" style="width: 100%; background:#208900;"></div></div><span class="glyphicon glyphicon-ok" style="display:inline-block;top:-10px; color:#30cb00;"></span></div></div>

							<?php

					}else{
						?>
							<div class="ajax-file-upload-progress"><div class="ajax-file-upload-bar" style="width: 100%; background:#df2a00;"></div></div><span class="glyphicon glyphicon-remove" style="display:inline-block;top:-10px; color:#df2a00;"></span><p>İşlem gerçekleştirilemiyor daha sonra tekrar deneyiniz</p></div></div>
						<?php
					}
				}else{
					$sor_varmi = $db->prepare("SELECT * FROM $dt_table WHERE id=:uid");
					$sor_varmi->bindValue(":uid",$eid);
					$sor_varmi->execute();
					$oku_v = $sor_varmi->fetch();

					@unlink($file_upload_path.$oku_v["resim"]);

						$sil_res = $db->prepare("DELETE FROM $dt_table WHERE id=:uid");
						$sil_res->bindValue(":uid",$eid);
						$sil_res->execute();
				   $upd = $db->prepare("UPDATE $dt_table SET sra=sra-1 WHERE sra>=:sra AND sra>1 AND uid=:uid");
					$upd->bindValue(":sra",$oku_v["sra"]);
					$upd->bindValue(":uid",$oku_v["uid"]);
					$upd->execute();
							if($sil_res->rowCount() != 0){
									echo "ok";
							}
				}
	}
		

?>