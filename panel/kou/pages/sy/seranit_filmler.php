<?php 

$dt_table = "televizyondaseranit";
//print_r($_POST);

?>
<div class="main_full_pop">
  <section class="content-header">
          <h1>
            <small>Film Listesi</small>
          </h1>

        </section>
 <section class="content">
  <!-- TO DO List -->

              <div class="box box-primary" id="list_slayt">
                <div class="box-header">
                  <i class="fa fa-files-o"></i>
                  <h3 class="box-title">Film Ekle</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <form role="form" id="slider_ekles" method="post" enctype="multipart/form-data" onsubmit="return dosya_ekle('slider_ekles','info_field_pop');">
                      <input type="hidden" name="tip" value="1">
                      <input type="hidden" name="sid" value="<?php echo $uid; ?>">
                      <input type="hidden" name="eid" value="0">
                  <div class="box-body">
        
                     <label for="">Başlık</label>

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
                </div>
                      <label for="">Video Kodu</label>

             <div class="nav-tabs-custom">
                           <ul class="nav nav-tabs">
                  <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                            <li class="<?php echo $class; ?>"><a href="#video_kodu_<?php echo $dil_key; ?>" data-toggle="tab"><?php echo $dil_val; ?></a></li>
                          <?php } ?>
                </ul>
                <div class="tab-content">
                     <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                             <div class="tab-pane <?php echo $class; ?>" id="video_kodu_<?php echo $dil_key; ?>">
                                
                                 <input type="text" name="video_kodu_<?php echo $dil_key; ?>" class="form-control" id="" placeholder="<?php echo $dil_val; ?>">
                     				

                             </div><!-- /.tab-pane -->
                     <?php } ?>

                </div><!-- /.tab-content -->
                </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                   <button class="btn btn-danger">Ekle</button>
                  </div>
                </form>
                
     <div id="info_field_pop">
   


 </div>               
          
 <ul class="todo-list list_comp" post_uri="tab_ozel_kesim" dt_table="<?php echo $dt_table; ?>">

                    <?php 

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
  </ul>

         <!-- <button class="btn btn-default btn-block daha_fazla" onclick="daha_fazla_goster('list_comp')">Daha Fazla Göster</button>       -->
              
                </div><!-- /.box-body -->
               <!-- <div class="box-footer clearfix no-border">
                  <button class="btn btn-default pull-right"  onclick="scroll_slow_slider('ana_slider_ekle','list_slayt','a_slider_ekle')"><i class="fa fa-plus"></i> Referans Ekle</button>
                </div>-->
              </div><!-- /.box -->



              </section>
            
           
              </div>