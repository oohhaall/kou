<?php
	require_once "../config/global_cont.php";
	extract($_POST);


	$sor_nufus = $db->query("SELECT COUNT(*) FROM genel_ayar")->fetch();



	if($sor_nufus["COUNT(*)"] != 0){
		$nufus_ekle = $db->prepare("UPDATE genel_ayar SET ekonomi_tablo=:ekonomi_tablo");
		foreach ($_POST as $key => $value) {
			$nufus_ekle->bindValue(":".$key,$value);
		}
		$nufus_ekle->execute();
		if($nufus_ekle->rowCount() != 0){
			?>
				 <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                   Ekonomi tablosu başarıyla güncellendi.
                  </div>
			<?php
		}else{
			?>
					<div class="alert alert-warning alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
		                   Ekonomi tablosu güncellenemiyor lütfen tam ve doğru bilgi girdiğinizden emin olunuz eğer sorun devam ederse yetkilileri konu ile ilgili bilgilendiriniz.
		                  </div>
			<?php
		}
	}else{
		$nufus_ekle = $db->prepare("INSERT INTO genel_ayar SET ekonomi_tablo=:ekonomi_tablo");
		foreach ($_POST as $key => $value) {
			$nufus_ekle->bindValue(":".$key,$value);
		}
		$nufus_ekle->execute();
		if($nufus_ekle->rowCount() != 0){
				?>
				 <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                   Ekonomi tablosu başarıyla eklendi.
                  </div>
			<?php
	}else{
		?>
				<div class="alert alert-warning alert-dismissable">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                    <h4><i class="icon fa fa-warning"></i> Hata!</h4>
		                   Ekonomi tablosu güncellenemiyor lütfen tam ve doğru bilgi girdiğinizden emin olunuz eğer sorun devam ederse yetkilileri konu ile ilgili bilgilendiriniz.
		                  </div>
		<?php
	}	
}

?>