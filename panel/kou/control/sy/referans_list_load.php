<?php 
  
  require_once "../config/global_cont.php";
		
	extract($_GET);
	extract($_POST);

                      $sor_slider = $db->prepare("SELECT * FROM referanslar ORDER BY sra DESC LIMIT 0,$load_max");
                      $sor_slider->execute();

                      if($sor_slider->rowCount() == 0){
                    ?>

                 <div class="callout callout-info">
                    <h4>Listede hiç slayt bulunamadı</h4>
                    <p>Lütfen slayt ekleyin</p>
                  </div>
<?php }else{  ?>
<?php
  foreach ($sor_slider->fetchAll() as $key => $value) {
?>
    <tr  id="<?php echo "list_update_".$value["id"]; ?>" sira='<?php echo $value["sra"]; ?>' m_id='<?php echo $value["id"]; ?>'>
        <td>
           <span class="handle">
               <i class="fa fa-ellipsis-v"></i>
               <i class="fa fa-ellipsis-v"></i>
            </span>
        </td>
        <td>
                <span class="text">
                          <a href="#">
                              <img width="80" height="80" m_id='<?php echo $value["id"]; ?>' src="<?php echo ($value["resim"]!="")?$file_read_path.$value["resim"]:""; ?>">
                          </a> 



                            <?php
                                foreach ($dil_text as $dil_key => $dil_val) {
                                    $style = ($dil_key=="tr")?"style='display:inline-block;'":"style='display:none;'";
                                  ?>
                                  <g type="<?php echo $dil_key; ?>" m_id='<?php echo $value["id"]; ?>' <?php echo $style; ?>><?php echo $value["baslik_".$dil_key]; ?></g>
                                  <?php
                                }
                            ?>

                         
                              <kt m_id='<?php echo $value["id"]; ?>' style="display: none;"><?php echo $value["kid"]; ?></kt>
                            <ulk m_id='<?php echo $value["id"]; ?>' style="display: none;"><?php echo $value["uid"]; ?></ulk>
                            <sid m_id='<?php echo $value["id"]; ?>' style="display: none;"><?php echo $value["sid"]; ?></sid>



                      </span>
                      <small class="label label-danger"><i class="fa fa-clock-o"></i><?php echo $value["tarih"]; ?></small>

        </td>
        <td><?php 
              $sor_kategori = $db->prepare("SELECT * FROM refkategori WHERE id=:kid");
              $sor_kategori->bindValue(":kid",$value["kid"]);
              $sor_kategori->execute();
              $oku_kategori = $sor_kategori->fetch();
              echo $oku_kategori["baslik_tr"];
        ?></td>
        <td><?php 
              $sor_ulke = $db->prepare("SELECT * FROM refulke WHERE id=:uid");
              $sor_ulke->bindValue(":uid",$value["uid"]);
              $sor_ulke->execute();
              $oku_ulke = $sor_ulke->fetch();
              echo $oku_ulke["baslik_tr"];
        ?></td>
        <td><?php 
              $sor_sehir = $db->prepare("SELECT * FROM refsehir WHERE id=:sid");
              $sor_sehir->bindValue(":sid",$value["sid"]);
              $sor_sehir->execute();
              $oku_sehir = $sor_sehir->fetch();
              echo $oku_sehir["baslik"];
        ?></td>
        <td>
          
  <div class="list_active_control">
                      <div class="slider-track <?php echo ($value["drm"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="ana_slider" dt_table="slayt">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools">
                        <i class="fa fa-edit" onclick="slider_duzenle('ana_slider_ekle','<?php echo $value["id"]; ?>','list_slayt','a_slider_ekle')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('ana_slider_ekle','<?php echo $value["id"]; ?>','list_slayt','a_slider_ekle','info_field')"></i>
                      </div>
        </td>
          </tr>
                 
        <?php } } ?>