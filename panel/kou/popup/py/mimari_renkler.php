<?php 

require_once "../config/global_cont.php";
extract($_POST);
$dt_table = "koleksiyonparcalari";
//print_r($_POST);

?>
<div class="main_full_pop">
  <section class="content-header">
          <h1>
            <small>Renk Listesi</small>
          </h1>

        </section>
 <section class="content">
  <!-- TO DO List -->

              <div class="box box-primary" id="list_slayt">
                <div class="box-header">
                  <i class="fa fa-files-o"></i>
                  <h3 class="box-title">Renk Ekle</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <form role="form" id="slider_ekles" method="post" enctype="multipart/form-data" onsubmit="return dosya_ekle('slider_ekles','info_field_pop');">
                      <input type="hidden" name="tip" value="1">
                      <input type="hidden" name="sid" value="<?php echo $uid; ?>">
                      <input type="hidden" name="eid" value="0">
                  <div class="box-body">
        
                    <div class="form-group">
                      <label for="">Resim</label>
                      
                      <input type="file" name="resim" required="">
                      <img src="" class="on_" style="display: none;" width="150">
                    </div>
            
                    <div class="form-group">
                        <label>Renk</label>
                        <select class="form-control" name="renk" required="">
                          <option value="">Lütfen Renk Seçin</option>
                              <?php 
                                  $renk_list = $db->prepare("SELECT id, baslik_tr FROM renkler ORDER BY baslik_tr ASC");
                                  $renk_list->execute();
                                  foreach ($renk_list->fetchAll() as $key => $value) {
                                    ?>
                                        <option value="<?php echo $value["id"] ?>"><?php echo $value["baslik_tr"]; ?></option>
                                    <?php
                                  }
                              ?>
                        </select>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                   <button class="btn btn-danger">Ekle</button>
                  </div>
                </form>
                
     <div id="info_field_pop">
   


 </div>               
          
 <ul class="todo-list detay_popup" post_uri="mimari_cozum_ekle_pop" dt_table="<?php echo $dt_table; ?>">

                    <?php 

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
    $renk_ = $db->prepare("SELECT * FROM renkler WHERE id=:id");
    $renk_->bindValue(":id",$value["renk"]);
    $renk_->execute();

    $renk_bilg = $renk_->fetch();
?>

                   <li id="<?php echo "list_update_".$value["id"]; ?>" m_id='<?php echo $value["id"]; ?>'>
             <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <span class="text"  style="overflow:hidden; width: 80px; height: 80px;">

                         <img src="<?php echo $file_read_path.$value["resim"]; ?>" m_id='<?php echo $value["id"]; ?>' >

                        <span m_id="<?php echo $value["id"]; ?>"><?php echo $renk_bilg["baslik_tr"]; ?></span>
                        <renk m_id="<?php echo $value["id"]; ?>" style="display: none;"><?php echo $renk_bilg["id"]; ?></renk>
                      </span>
                     
                      <div class="tools">
                        <i class="fa fa-edit" onclick="dosya_duzenle('<?php echo $value["id"]; ?>','slider_ekles','info_field_pop')"></i>
                        <i class="fa fa-trash-o" onclick="dosya_sil('<?php echo $value["id"]; ?>','info_field_pop','slider_ekles')"></i>
                      </div>
                  
                    </li>
        <?php } } ?>
  </ul>

         <!-- <button class="btn btn-default btn-block daha_fazla" onclick="daha_fazla_goster('list_comp')">Daha Fazla Göster</button>       -->
              
                </div><!-- /.box-body -->
               <!-- <div class="box-footer clearfix no-border">
                  <button class="btn btn-default pull-right"  onclick="scroll_slow_slider('ana_slider_ekle','list_slayt','a_slider_ekle')"><i class="fa fa-plus"></i> Referans Ekle</button>
                </div>-->
              </div><!-- /.box -->



              </section>
            
              <script type="text/javascript" src="piston/js/global_kont.js"></script>
              <script type="text/javascript">
                var glob_page_uri = "<?php echo $page_uri; ?>";
              </script>
              <script type="text/javascript" src="piston/page_js/<?php echo $page_uri.".js"; ?>"></script>

              </div>