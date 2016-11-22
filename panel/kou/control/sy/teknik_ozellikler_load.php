<?php
require_once "../config/global_cont.php";
extract($_POST);
extract($_GET);


$dt_table = "fizikselozellikler";

	 $sor_slider = $db->prepare("SELECT * FROM $dt_table ORDER BY id DESC");
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

                        <a href="piston/control/download.php?file=<?php echo $f_file_path.$value["dosya"]; ?>" class="btn btn-primary"><i class="fa fa-download"></i> İndir</a>
                         <span class="head_b"><?php echo $value["baslik"]; ?></span>
                       
                      </span>
                     
                      <div class="tools">
                        <i class="fa fa-edit" onclick="dosya_duzenle('<?php echo $value["id"]; ?>','slider_ekles','info_field_pop')"></i>
                        <i class="fa fa-trash-o" onclick="dosya_sil('<?php echo $value["id"]; ?>','info_field_pop','slider_ekles')"></i>
                      </div>
                  
                    </li>
        <?php } } ?>


