<?php 

require_once "../config/global_cont.php";
extract($_POST);
$dt_table = "fizikselozellikler";
//print_r($_POST);
//f_file_path
?>
<div class="main_full_pop">
  <section class="content-header">
          <h1>
            <small>Teknik özellik Listesi</small>
          </h1>

        </section>
 <section class="content">
  <!-- TO DO List -->

              <div class="box box-primary" id="list_slayt">
                <div class="box-header">
                  <i class="fa fa-files-o"></i>
                  <h3 class="box-title">Teknik özellik Ekle</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <form role="form" id="slider_ekles" method="post" enctype="multipart/form-data" onsubmit="return dosya_ekle('slider_ekles','info_field_pop');">
                      <input type="hidden" name="tip" value="1">
                      <input type="hidden" name="sid" value="<?php echo $uid; ?>">
                      <input type="hidden" name="eid" value="0">
                  <div class="box-body">
        
                    <div class="form-group">
                      <label for="">Dosya</label>
                      
                      <input type="file" name="dosya" required="">
                      <img src="" class="on_" style="display: none;" width="150">
                    </div>
            
                    <div class="form-group">
                        <label>Teknik Grup</label>
                        <input type="text" name="teknik_grup" class="form-control" required="">
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                   <button class="btn btn-danger">Ekle</button>
                  </div>
                </form>
                
     <div id="info_field_pop">
   


 </div>               
          
 <ul class="todo-list teknik_ozellik" post_uri="mimari_cozum_ekle_pop" dt_table="<?php echo $dt_table; ?>">

                    <?php 

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
  </ul>

        
              
                </div><!-- /.box-body -->
   
              </div><!-- /.box -->



              </section>
            
              <script type="text/javascript" src="piston/js/global_kont.js"></script>
              <script type="text/javascript">
                var glob_page_uri = "<?php echo $page_uri; ?>";
              </script>
              <script type="text/javascript" src="piston/page_js/<?php echo $page_uri.".js"; ?>"></script>

              </div>