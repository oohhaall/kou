<?php

	require_once "inc/ust.php";
	extract($_POST);
	extract($_GET);
?>


	<div class="row haber_duyuru">
			


		<div class="col-lg-12 col-md-12 personel_blog">
		<?php

					switch ($uid) {
						case 2:
							?>
							<h3>Öğretim Elemanları</h3>
							<?php
						break;
						case 3:
							?>
							<h3>İdari Personel</h3>
							<?php
						break;
						default:
							?>
							<h3>Öğretim Üyeleri</h3>
							<?php	
						break;
					}
			 ?>
			
			<?php  $sor_duyuru_genel = $db->prepare("SELECT * FROM personel WHERE type=:type AND durum='1' ORDER BY sira DESC"); 
					$sor_duyuru_genel->bindValue(":type",$uid);
					$sor_duyuru_genel->execute();
					foreach ($sor_duyuru_genel->fetchAll() as $key => $value) {
					
						 $tarihler = explode("-",date("d-m-Y",strtotime($value["tarih"])));
						?>
							
							<div class="panel panel-default">
				            <div class="panel-heading"><?php echo $value["isim"]; ?></div>
				            <div class="panel-body">
				              <div class="col-md-4"> <img class="img-responsive" src="<?php echo $img_read.$value["resim"]; ?>" alt=""> </div>
				              <div class="col-md-4">
				                <ul class="personelBilgi">
				                  <li><a href="<?php echo $value["url"]; ?>" target="_blank" class="btn btn-success btn-large">Kişisel Web Sitesi</a></li>
				                  <li><span class="inf">E-posta: <a href="mailto:<?php echo $value["email"]; ?>"><?php echo $value["email"]; ?></a></span></li>
				                  <li><span class="inf">Oda No:</span> <?php echo $value["oda"]; ?></li>
				                  <li><span class="inf">Telefon:</span> <?php echo $value["telefon"]; ?></li>
				                  <?php if(!empty($value["anabilim_dali"])){ ?>
								  <li><span class="inf">Ana Bilim Dalı:</span> <?php echo $value["anabilim_dali"]; ?></li>
								  <?php } ?>
				                </ul>
				              </div>
				              <div class="col-md-4">
				                <ul class="personelBilgi">
				                  <li><div class="inf">Araştırma Alanları:</div><br> <?php echo $value["arastirma_alani_tr"]; ?></li>
				                </ul>
				              </div>
				            </div>
				          </div>
						<?php
					}
			?>
					
		
		</div>
		<div class="clear"></div>
</div>

<?php

	require_once "inc/alt.php";

?>