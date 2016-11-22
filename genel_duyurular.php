<?php

	require_once "inc/ust.php";
	extract($_POST);
	extract($_GET);
?>
<div class="row haber_duyuru">
			


		<div class="col-lg-12 col-md-12 genel_sutun">
		<?php

					switch ($uid) {
						case 2:
							?>
							<h3>Bölüm Duyuruları</h3>
							<?php
						break;
						case 3:
							?>
							<h3>Haber ve Etkinlikler</h3>
							<?php
						break;
						default:
							?>
							<h3>Genel Duyurular</h3>
							<?php	
						break;
					}
			 ?>
			<ul>
			<?php  $sor_duyuru_genel = $db->prepare("SELECT * FROM duyurular WHERE type=:type ORDER BY tarih DESC"); 
					$sor_duyuru_genel->bindValue(":type",$uid);
					$sor_duyuru_genel->execute();
					foreach ($sor_duyuru_genel->fetchAll() as $key => $value) {
					
						 $tarihler = explode("-",date("d-m-Y",strtotime($value["tarih"])));
						?>
							<li>
					<div class="sol_tarih"><span class="ay"><?php echo $aylar[$tarihler[1]]; ?></span><span class="gun"><?php echo $tarihler["0"]; ?></span><span class="yil"><?php echo $tarihler["2"]; ?></span></div><div class="sag_icerik popup_page" l_id="<?php echo $value["id"]; ?>"><p><?php echo $value["baslik_tr"]; ?></p><span class="yazar"><?php echo $value["yazar"]; ?></span></div>
				</li>
						<?php
					}
			?>
					
			</ul>
		</div>
		<div class="clear"></div>
</div>

<?php 

	require_once "inc/alt.php";

?>