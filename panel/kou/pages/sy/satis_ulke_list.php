<?php 
  $table = "satisulke";
  $page_list = "satis_ulke_list";
?>
        <section class="content-header">
          <h1>
            Satış Noktaları Ülke
            <small>Ülke Listesi</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-files-o"></i>Satış Noktaları Ülke</a></li>
            <li class="active">Ülke Listesi</li>
          </ol>
        </section>
 <section class="content">
  <!-- TO DO List -->
              <div class="box box-primary" id="list_slayt">
                <div class="box-header">
                  <i class="fa fa-files-o"></i>
                  <h3 class="box-title">Ülke Ekle</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                <form role="form" id="a_slider_ekle" method="post" enctype="multipart/form-data" onsubmit="return slider_ekle('ana_slider_ekle','a_slider_ekle','info_field','ana_slider_ekle');">
                      <input type="hidden" name="tip" value="1">
                      <input type="hidden" name="sid" value="0">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                            <li class="<?php echo $class; ?>"><a href="#baslik_<?php echo $dil_key; ?>" data-toggle="tab"><?php echo $dil_val; ?></a></li>
                          <?php } ?>
                </ul>
                <div class="tab-content">
                     <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                             <div class="tab-pane <?php echo $class; ?>" id="baslik_<?php echo $dil_key; ?>">
                                
                                 <input type="text" name="baslik_<?php echo $dil_key; ?>" class="form-control" id="" placeholder="<?php echo $dil_val; ?>">
                     				

                             </div><!-- /.tab-pane -->
                     <?php } ?>

                </div><!-- /.tab-content -->
                    <div class="box-footer">
                   <button class="btn btn-danger">Ekle</button>
                  </div>
              </div><!-- nav-tabs-custom -->
			</form>
     <div id="info_field">
   


 </div>               
          
 <ul class="todo-list kategori_list" post_uri="<?php echo $page_list; ?>" dt_table="<?php echo $table; ?>" goster_num="10">

                    <?php 

                      $sor_slider = $db->prepare("SELECT * FROM $table ORDER BY baslik_tr ASC");
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
                        <i class="fa fa-edit" onclick="slider_duzenle('ana_slider_ekle','<?php echo $value["id"]; ?>','list_slayt','a_slider_ekle')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('ana_slider_ekle','<?php echo $value["id"]; ?>','list_slayt','a_slider_ekle','info_field')"></i>
                      </div>
                  
                    </li>
        <?php } } ?>
  </ul>

              
                </div><!-- /.box-body -->
          
              </div><!-- /.box -->

 <div id="info_field">
   


 </div>

            
              </section>