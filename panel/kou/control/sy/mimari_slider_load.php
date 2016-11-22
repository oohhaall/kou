<?php 
    require_once "../config/global_cont.php";
    extract($_POST);
    extract($_GET);

    $dt_table = "urunslayt";
                      $sor_slider = $db->prepare("SELECT * FROM $dt_table WHERE uid=:uid ORDER BY sra DESC");
                      $sor_slider->bindValue(":uid",$uid);
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
             <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <span class="text">

                         <img src="<?php echo $file_read_path.$value["resim"]; ?>" width="150">

                      
                      </span>
                     
                      <div class="tools">
                        <i class="fa fa-trash-o" onclick="dosya_sil('<?php echo $value["id"]; ?>','info_field_pop')"></i>
                      </div>
                  
                    </li>
        <?php } } ?>