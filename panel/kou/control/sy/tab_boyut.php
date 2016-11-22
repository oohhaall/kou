<?php 
  require_once "../config/global_cont.php";
  extract($_POST);
  extract($_GET);

	$dt_table = "tabboyut";

  if($eid==0){

  			$tab_kayit = $db->prepare("INSERT INTO $dt_table(uid, boyut, kaymaDirenci, finish_tr, finish_en, finish_de, finish_es, finish_fr, finish_ru, finish_it, kalinlik) VALUES (:uid,:boyut,:kaymaDirenci,:finish_tr,:finish_en,:finish_de, :finish_es, :finish_fr,:finish_ru, :finish_it, :kalinlik)");

  			$tab_kayit->bindValue(":uid",$sid);
  			$tab_kayit->bindValue(":boyut",$boyut);
  			$tab_kayit->bindValue(":kaymaDirenci",$kaymazlik);
  			$tab_kayit->bindValue(":kalinlik",$kalinlik);

    		foreach ($dil_text as $dil_key => $dil_value) {
  				$tab_kayit->bindValue(":finish_".$dil_key,$_POST["kenar_".$dil_key]);
			}

			$tab_kayit->execute();


			if($tab_kayit->rowCount()>0){
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

  }else if($eid != 0 && @$islem != "sil"){
  		/*
				UPDATE $dt_table SET boyut=:boyut, kaymaDirenci=:kaymaDirenci, finish_tr=:finish_tr, finish_en=:finish_en, finish_de=:finish_de, finish_es=:finish_es, finish_fr=:finish_fr, finish_ru=:finish_ru, finish_it=:finish_it, kalinlik=:kalinlik WHERE id=:uid
  		*/
  		$tab_kayit = $db->prepare("UPDATE $dt_table SET boyut=:boyut, kaymaDirenci=:kaymaDirenci, finish_tr=:finish_tr, finish_en=:finish_en, finish_de=:finish_de, finish_es=:finish_es, finish_fr=:finish_fr, finish_ru=:finish_ru, finish_it=:finish_it, kalinlik=:kalinlik WHERE id=:uid");

  			$tab_kayit->bindValue(":uid",$eid);
  			$tab_kayit->bindValue(":boyut",$boyut);
  			$tab_kayit->bindValue(":kaymaDirenci",$kaymazlik);
  			$tab_kayit->bindValue(":kalinlik",$kalinlik);

    		foreach ($dil_text as $dil_key => $dil_value) {
  				$tab_kayit->bindValue(":finish_".$dil_key,$_POST["kenar_".$dil_key]);
			}

			$tab_kayit->execute();


			if($tab_kayit->rowCount()>0){
				?>
				 <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    İçerik başarıyla güncellendi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
				<?php
			}else{
				?>
				<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
                   İçerik güncellenemiyor lütfen yetkililere sorun hakkında bilgilendirme yapınız.
                  </div>
				<?php
			}
  }else{
  				/*$sor_slider_bilgileri = $db->prepare("SELECT * FROM $db_tab WHERE id=:id");
				$sor_slider_bilgileri->bindValue(":id",$sid);
				$sor_slider_bilgileri->execute();

				$slider_bilgi = $sor_slider_bilgileri->fetch();*/
					/*		$sor_refsehir = $db->prepare("SELECT * FROM refsehir WHERE uid=:uid");
							$sor_refsehir->bindValue(":uid",$sid);
							$sor_refsehir->execute();
						foreach ($sor_refsehir->fetchAll() as $key => $value) {
								$db->exec("DELETE FROM refsehir WHERE id='".$value["id"]."'");
						}
*/
					$sil = $db->prepare("DELETE FROM $dt_table WHERE id=:id");
					$sil->bindValue(":id",$eid);
					$sil->execute();


				?>
					 <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    İçerik başarıyla slindi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
				<?php


  }
/*
[eid] => 64 
[kenar_tr] => tttttttttttttttt 
[kenar_en] => eeeeee 
[kenar_de] => ggggggggg 
[kenar_es] => sssss 
[kenar_fr] => fffff 
[kenar_ru] => rrrrr 
[kenar_it] => iiiiii 
[boyut] => test 
[kaymazlik] => tt 
[kalinlik] => kal 
*/

?>