<?php 
  require_once "../config/global_cont.php"; 
  extract($_POST);
?>
<div class="main_full_pop">

        <section class="content-header">
          <h1>
            Yüzeyler
            <small>Yüzey Listesi</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-files-o"></i>Yüzeyler</a></li>
            <li class="active">Yüzey Listesi</li>
          </ol>
        </section>
 <section class="content">
  <!-- TO DO List -->
              <div class="box box-primary" id="list_slayt">
                <div class="box-header">
                  <i class="fa fa-files-o"></i>
                  <h3 class="box-title">Yüzey Ekle</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                <form role="form" id="yuzey_ek_form" method="post" enctype="multipart/form-data" onsubmit="return yuzey_ekle('yuzey_ek_form','info_field_pop');">
                      <input type="hidden" name="tip" value="1">
                      <input type="hidden" name="sid" value="<?php echo $uid; ?>">
                      <input type="hidden" name="eid" value="0">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                            <li class="<?php echo $class; ?>"><a href="#yuzeybaslik_<?php echo $dil_key; ?>" data-toggle="tab"><?php echo $dil_val; ?></a></li>
                          <?php } ?>
                </ul>
                <div class="tab-content">
                     <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                             <div class="tab-pane <?php echo $class; ?>" id="yuzeybaslik_<?php echo $dil_key; ?>">
                                
                                 <input type="text" name="yuzeybaslik_<?php echo $dil_key; ?>" class="form-control" id="" placeholder="<?php echo $dil_val; ?>">
                     				

                             </div><!-- /.tab-pane -->
                     <?php } ?>

                </div><!-- /.tab-content -->
                    <div class="box-footer">
                   <button class="btn btn-danger">Ekle</button>
                  </div>
              </div><!-- nav-tabs-custom -->
			</form>

 <div id="info_field_pop">
   


 </div>              
          
 <ul class="todo-list kategori_list" post_uri="ref_kategori" dt_table="refkategori" goster_num="10">

                    <?php 

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