<?php 

    $db_tab       = "satissehir";
    $db_tab_ust   = "satisulke";
    $db_tab_page  = "satisilce";
    $db_up_page   = "satis_sehir_up";

?>
        <section class="content-header">
          <h1>
            Satış noktaları İlçe
            <small>İlçe Listesi</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-files-o"></i>Satış noktaları İlçe</a></li>
            <li class="active">İlçe Listesi</li>
          </ol>
        </section>
 <section class="content">
  <!-- TO DO List -->
              <div class="box box-primary" id="list_slayt">
                <div class="box-header">
                  <i class="fa fa-files-o"></i>
                  <h3 class="box-title">İlçe Ekle</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                <form role="form" id="a_slider_ekle" method="post" enctype="multipart/form-data" onsubmit="return slider_ekle('ana_slider_ekle','a_slider_ekle','info_field','ana_slider_ekle');">
                      <input type="hidden" name="tip" value="1">
                      <input type="hidden" name="sid" value="0">
                    <div class="form-group">  
                        <select class="form-control" name="ulke" id="ref_ulk">
                          <?php 
                              $birinci_s_id = 0;
                              $sor_ulk = $db->prepare("SELECT * FROM $db_tab_ust ORDER BY baslik_tr ASC");
                              $sor_ulk->execute();

                              foreach ($sor_ulk->fetchAll() as $key => $value) {
                                  $sor_varmi_ilce = $db->prepare("SELECT * FROM $db_tab WHERE uid=:uid");
                                  $sor_varmi_ilce->bindValue(":uid",$value["id"]);
                                  $sor_varmi_ilce->execute();
                                  if($sor_varmi_ilce->rowCount()==0)
                                      continue;

                                    $birinci_s_id = ($birinci_s_id!=0)?$birinci_s_id:$value["id"];
                                ?>
                                    <option value="<?php echo $value["id"]; ?>"><?php echo $value["baslik_tr"]; ?></option>
                                <?php
                              }

                          ?>
                      </select>
                    </div>
                       <div class="form-group">  
                        <select class="form-control" name="sehir" id="sehir_select">
                          <?php 
                              $sor_ulk = $db->prepare("SELECT * FROM $db_tab WHERE uid=:uid ORDER BY baslik ASC");
                              $sor_ulk->bindValue(":uid",$birinci_s_id);
                              $sor_ulk->execute();
                                $ikinci_s_id = 0;
                              foreach ($sor_ulk->fetchAll() as $key => $value) {


                                    $ikinci_s_id = ($ikinci_s_id!=0)?$ikinci_s_id:$value["id"];

                                ?>
                                    <option value="<?php echo $value["id"]; ?>"><?php echo $value["baslik"]; ?></option>
                                <?php
                              }

                          ?>
                      </select>
                    </div>
              <div class="form-group">            
                                 <input type="text" name="baslik" class="form-control" id="" required="" placeholder="İlçe">
                </div><!-- /.tab-content -->
                    <div class="box-footer">
                   <button class="btn btn-danger">Ekle</button>
                  </div>
      </form>
     <div id="info_field">
   


 </div>               
          
 <ul class="todo-list kategori_list" post_uri="<?php echo $db_up_page; ?>" dt_table="<?php echo $db_tab_page; ?>" goster_num="10">

                    <?php 
                     $sor_slider = $db->prepare("SELECT * FROM $db_tab_page WHERE uid=:uid AND sid=:sid ORDER BY baslik ASC");
                     $sor_slider->bindValue(":uid",$birinci_s_id);
                     $sor_slider->bindValue(":sid",$ikinci_s_id);
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

                          
                         <g type="" m_id='<?php echo $value["id"]; ?>'><?php echo $value["baslik"]; ?></g>
                                  

                      
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

 </section>
