<?php 
	require_once "../config/global_cont.php";
	extract($_GET);
	extract($_POST);

?>

                  <table id="data_table" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Firma Ünvanı</th>
                        <th>Ülke</th>
                        <th>Şehir</th>
                        <th>İlçe</th>
                        <th>Seçenekler</th>
                      </tr>
                    </thead>
                    <tbody>

                    	<?php 

                    		$sor_satis_nokt = $db->prepare("SELECT * FROM satisnoktalari");
                    		$sor_satis_nokt->execute();

                    		foreach ($sor_satis_nokt->fetchAll() as $key => $value) {

                    				$sor_ulke = $db->query("SELECT * FROM satisulke WHERE id=".$value["ulke"])->fetch();
                    				$sor_sehir = $db->query("SELECT * FROM satissehir WHERE id=".$value["sehir"])->fetch();
                    				$sor_ilce = $db->query("SELECT * FROM satisilce WHERE id=".$value["ilce"])->fetch();

                    			?>
                    			     <tr m_id='<?php echo $value["id"]; ?>'>
				                        <td data_name="firma"><?php echo $value["firma"]; ?></td>
				                        <td><?php echo $sor_ulke["baslik_tr"]; ?></td>
				                        <td><?php echo $sor_sehir["baslik"]; ?></td>
				                        <td><?php echo $sor_ilce["baslik"]; ?></td>
				                        <td>

				      <div class="list_active_control">
                      <div class="slider-track <?php echo ($value["drm"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="ana_slider" dt_table="satisnoktalari">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools" style="display: inline-block;">
                        <i class="fa fa-edit" onclick="slider_duzenle('ana_slider_ekle','<?php echo $value["id"]; ?>','list_slayt','a_slider_ekle')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('ana_slider_ekle','<?php echo $value["id"]; ?>','list_slayt','a_slider_ekle','info_field')"></i>
                      </div>
				                        </td>
                                <bilgi m_id='<?php echo $value["id"]; ?>' style="display: none;">
                                      <tel><?php echo $value["tel"]; ?></tel>
                                      <fax><?php echo $value["fax"]; ?></fax>
                                      <mail><?php echo $value["email"]; ?></mail>
                                      <adres><?php echo $value["adres"]; ?></adres>
                                      <harita><?php echo $value["harita"]; ?></harita>
                                      <ulke><?php echo $value["ulke"]; ?></ulke>
                                      <sehir><?php echo $value["sehir"]; ?></sehir>
                                      <ilce><?php echo $value["ilce"]; ?></ilce>
                                  </bilgi>
				                      </tr>
                    			<?php
                    		}
                    	?>
               
                      
                    </tbody>
                    <tfoot>
                       <tr>
                        <th>Firma Ünvanı</th>
                        <th>Ülke</th>
                        <th>Şehir</th>
                        <th>İlçe</th>
                        <th>Seçenekler</th>
                      </tr>
                    </tfoot>
                  </table>
             


                <div class="box-footer clearfix no-border">
                  <button class="btn btn-default pull-right"  onclick="scroll_slow_slider('ana_slider_ekle','list_slayt','a_slider_ekle')"><i class="fa fa-plus"></i> Satış Noktası Ekle</button>
                </div>


                <script type="text/javascript">
                	$(function () {
   var dt_table = $("#data_table").DataTable({
            "language": {
                "url": "plugins/datatables/turkish.json"
            }
        });

});

                </script>