<?php 


	require_once "../config/global_cont.php";
		
	extract($_GET);
	extract($_POST);
	$db_tab = "satisilce";

                     $sor_slider = $db->prepare("SELECT * FROM $db_tab WHERE uid=:uid AND sid=:sid ORDER BY baslik ASC");
                     $sor_slider->bindValue(":uid",$u_id);
                     $sor_slider->bindValue(":sid",$s_id);
                     $sor_slider->execute();

                      if($sor_slider->rowCount() == 0){
                    ?>

                 <div class="callout callout-info">
                    <h4>Listede hiç içerik bulunamadı</h4>
                    <p>Lütfen içerik ekleyin</p>
                  </div>
<?php }else{  ?>
<?php
  foreach ($sor_slider->fetchAll() as $key => $value) {
?>

                   <li id="<?php echo "list_update_".$value["id"]; ?>" m_id='<?php echo $value["id"]; ?>'>
        
                      <span class="text">

                          
                         <g type="" m_id='<?php echo $value["id"]; ?>'><?php echo $value["baslik"]; ?></g>
                                  

                      
                      </span>
                     
                      <div class="tools">
                        <i class="fa fa-edit" onclick="slider_duzenle('ana_slider_ekle','<?php echo $value["id"]; ?>','list_slayt','a_slider_ekle')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('ana_slider_ekle','<?php echo $value["id"]; ?>','list_slayt','a_slider_ekle','info_field')"></i>
                      </div>
                  
                    </li>
        <?php } } ?>