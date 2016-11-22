<?php
  require_once "../config/global_cont.php";
 extract($_POST);
  extract($_GET);

            $dt_table = "tabboyut";
                      $sor_slider = $db->prepare("SELECT * FROM $dt_table WHERE uid=:uid ORDER BY id DESC");
                      $sor_slider->bindValue(":uid",$uid);
                      $sor_slider->execute();

                      if($sor_slider->rowCount() == 0){
                    ?>

                 <div class="callout callout-info">
                    <h4>Listede hiç içerik bulunamadı</h4>
                    <p>Lütfen içerik ekleyin</p>
                  </div>
<?php }else{  

    ?>
<table class="table table-bordered text-center">
      <thead>
        <tr>
          <th>Boyut</th>
          <th>Kaymazlık / V</th>
          <th>Kenar</th>
          <th>Kalınlık</th>
         
        </tr>
      </thead>
      <tbody class="todo-list tab_byt" post_uri="referans_list" dt_table="<?php echo $dt_table; ?>">
    <?php
 foreach ($sor_slider->fetchAll() as $key => $value) {
?>
    <tr  id="<?php echo "list_update_".$value["id"]; ?>" m_id='<?php echo $value["id"]; ?>'>
        
        <td style="text-align: left;" class="boyut">
               <?php echo $value["boyut"]; ?>

        </td>
        <td class="kaymazlik"><?php 
            echo $value["kaymaDirenci"];
        ?></td>
        <td class="kenar"><?php 
            foreach ($dil_text as $dil_key => $dil_value) {
                    $style = ($dil_key=="tr")?"style='display:block;'":"style='display:none'";
                ?>
                    <span dil_type="<?php echo $dil_key; ?>" <?php echo $style; ?>><?php echo $value["finish_".$dil_key] ?></span>
                <?php
            }
        
        ?></td>
        <td class="kalinlik"><?php 
             echo $value["kalinlik"];
        ?></td>
    
          </tr>
                 
        <?php } 
            ?>

              </tbody>
</table>
            <?php
        } ?>