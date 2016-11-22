<?php 
  require_once "../config/global_cont.php"; 
  extract($_POST);

  $sor_page_list = $db->query("SELECT * FROM yuzeyler ORDER BY id DESC");
                      $sor_page_list->execute();

                      if($sor_page_list->rowCount() == 0){
                    ?>

                 <div class="callout callout-info">
                    <h4>Listede hiç katalog bulunamadı</h4>
                    <p>Lütfen katalog ekleyin</p>
                  </div>
<?php }else{  ?>
<?php
  foreach ($sor_page_list->fetchAll() as $key => $value) {
?>

                   <li id="<?php echo "list_update_".$value["id"]; ?>" m_id='<?php echo $value["id"]; ?>'>
        
                      <span class="text">

                            <?php
                                foreach ($dil_text as $dil_key => $dil_val) {
                                    $style = ($dil_key=="tr")?"style='display:inline-block;'":"style='display:none;'";
                                  ?>
                                  <g type="<?php echo $dil_key; ?>" m_id='<?php echo $value["id"]; ?>' <?php echo $style; ?>><?php echo $value["baslik_".$dil_key]; ?></g>
                                  <?php
                                }
                            ?>

                      
                      </span>
                     
                      <div class="tools">
                        <i class="fa fa-edit" onclick="yuzey_duzenle('yuzey_ek_form','<?php echo $value["id"]; ?>','info_field_pop')"></i>
                        <i class="fa fa-trash-o" onclick="yuzey_sil('yuzey_ek_form','<?php echo $value["id"]; ?>','info_field_pop')"></i>
                      </div>
                  
                    </li>
        <?php } } ?>