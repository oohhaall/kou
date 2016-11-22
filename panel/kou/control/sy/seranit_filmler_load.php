 <?php 
 require_once "../config/global_cont.php";
		extract($_POST);
		extract($_GET);
$dt_table = "televizyondaseranit";

                      $sor_slider = $db->prepare("SELECT * FROM $dt_table ORDER BY sra DESC");
                      //$sor_slider->bindValue(":uid",$uid);
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
    /*$renk_ = $db->prepare("SELECT * FROM renkler WHERE id=:id");
    $renk_->bindValue(":id",$value["renk"]);
    $renk_->execute();

    $renk_bilg = $renk_->fetch();*/
?>

                   <li id="<?php echo "list_update_".$value["id"]; ?>" m_id='<?php echo $value["id"]; ?>'>
             <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <span class="text">

                         <img src="http://img.youtube.com/vi/<?php echo $value["video_tr"]; ?>/0.jpg" m_id='<?php echo $value["id"]; ?>' width="150" >

                       <?php
                                foreach ($dil_text as $dil_key => $dil_val) {
                                    $style = ($dil_key=="tr")?"style='display:inline-block;'":"style='display:none;'";
                                  ?>
                                  <g type="<?php echo $dil_key; ?>" m_id='<?php echo $value["id"]; ?>' <?php echo $style; ?>><?php echo $value["baslik_".$dil_key]; ?></g>
                                  <vid  type="<?php echo $dil_key; ?>" m_id='<?php echo $value["id"]; ?>' style="display:none"><?php echo $value["video_".$dil_key]; ?></vid>
                                  <?php
                                }
                            ?>

                      </span>
                     
                      <div class="tools">
                        <i class="fa fa-edit" onclick="dosya_duzenle('<?php echo $value["id"]; ?>','slider_ekles','info_field_pop')"></i>
                        <i class="fa fa-trash-o" onclick="dosya_sil('<?php echo $value["id"]; ?>','info_field_pop','slider_ekles')"></i>
                      </div>
                  
                    </li>
        <?php } } ?>