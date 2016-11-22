<?php

	require_once "inc/ust.php";

?>

<div class="slider">
	
	    <div class="swiper-container">
        <div class="swiper-wrapper">
        		<?php
        				$sor_slider = $db->query("SELECT * FROM slider WHERE durum='1' ORDER BY sira DESC");
        				foreach ($sor_slider->fetchAll() as $key => $value) {
        					?>


        					<div class="swiper-slide" style="background:url(<?php echo $img_read.$value["resim_tr"]; ?>) no-repeat; background-size: cover;">
            		

        						<?php if(!empty($value["baslik_tr"])){ ?>
            		<div class="band_text">
            		<?php echo $value["baslik_tr"]; ?>
            		</div>
            		<?php 
            				}
            		?>
            </div>

        			<?php		
        				}
        		 ?>
            	
        </div>
        <!-- Add Pagination -->
        <div class="swiper-button-next"><span class="glyphicon glyphicon-chevron-right"></span></div>
        <div class="swiper-button-prev"><span class="glyphicon glyphicon-chevron-left"></span></div>
        <div class="swiper-pagination pagina"></div>

    </div>
</div>

<div class="row haber_duyuru">
		

		<div class="col-md-4 col-lg-4 genel_sutun">
			<h3>Genel Duyurular</h3>
			<span class="tarih"><?php echo $aylar[date("m")]; ?></span>
			<ul>
				<?php $sor_duyuru_genel = $db->query("SELECT * FROM duyurular WHERE type='1' AND durum='1' ORDER BY tarih DESC");
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
			
			<a class="button_blue" href="genel_duyurular.php?uid=1">GENEL DUYURULAR</a>
		</div>
		<div class="col-md-4 col-lg-4 genel_sutun">
			<h3>Bölüm Duyuruları</h3>
			<span class="tarih"><?php echo $aylar[date("m")]; ?></span>
			<ul>
				<?php $sor_duyuru_genel = $db->query("SELECT * FROM duyurular WHERE type='2' AND durum='1' ORDER BY tarih DESC");
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
			
			<a class="button_blue" href="genel_duyurular.php?uid=2">BÖLÜM DUYURULARI</a>
		</div>
		<div class="col-md-4 col-lg-4 genel_sutun">
			<h3>Haber ve Etkinlikler</h3>
			<span class="tarih"><?php echo $aylar[date("m")]; ?></span>
			<ul>
					<?php $sor_duyuru_genel = $db->query("SELECT * FROM duyurular WHERE type='3' AND durum='1' ORDER BY tarih DESC");
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
			
			<a class="button_blue" href="genel_duyurular.php?uid=3">TÜM HABER Ve ETKİNLİKLER</a>
		</div>

		
		<div class="clear"></div>
</div>

<?php 

	require_once "inc/alt.php";

?>