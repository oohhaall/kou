<?php

	require_once "../config/global_cont.php";
		
	extract($_GET);
	extract($_POST);
	$db_tab = "satissehir";
	$db_tb_2 = "satisilce";
if($sid == 0 && @$islem!="sil"){
				
			
			$ekle_veri = $db->prepare("INSERT INTO $db_tab(baslik,uid) VALUES (:baslik,:uid)");

					
						$ekle_veri->bindValue(":baslik",$baslik);
						$ekle_veri->bindValue(":uid",$uid);



					$ekle_veri->execute();

					if($ekle_veri->rowCount()>0){
							?>

				  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    İçerik başarıyla eklendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
							<?php

					}else{
						?>
							<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   İçerik eklenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
						<?php
					}

		}else if($sid != 0 && @$islem != "sil"){
			$sor_ref = $db->prepare("SELECT * FROM $db_tab WHERE id=:sid");
			$sor_ref->bindValue(":sid",$sid);
			$sor_ref->execute();

				$ref_bilgi = $sor_ref->fetch();

				$ekle_veri = $db->prepare("UPDATE $db_tab SET baslik=:baslik WHERE id=:id");
					$ekle_veri->bindValue(":id",$sid);
					
					$ekle_veri->bindValue(":baslik",$baslik);
					
					$ekle_veri->execute();
					if($ekle_veri->rowCount()>0){
							?>

				  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    İçerik başarıyla düzenlendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
							<?php

					}else{
						?>
							<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   İçerik düzenlenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
						<?php
					}
		}else{  
				$sor_ref = $db->prepare("SELECT * FROM $db_tb_2 WHERE sid=:sid");
				$sor_ref->bindValue(":sid",$sid);
				$sor_ref->execute();
	
				

					if($sor_ref->rowCount()>0){
						$sil_full_ilc = $db->prepare("DELETE FROM $db_tb_2 WHERE sid=:sid");
						$sil_full_ilc->bindValue(":sid",$sid);
						$sil_full_ilc->execute();
					}

					$sil = $db->prepare("DELETE FROM $db_tab WHERE id=:id");
					$sil->bindValue(":id",$sid);
					$sil->execute();


				?>
					 <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    İçerik başarıyla slindi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
				<?php


		}


		?>