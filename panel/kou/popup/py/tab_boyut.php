<?php 
  require_once "../config/global_cont.php";
 extract($_POST);
  extract($_GET);
	 /*
			tabBoyut.php
	*/
			$dt_table = "tabboyut";

?>



<div class="main_full_pop" id="mm_scroll">

 <section class="content-header">
          <h1>
            <small>Tablo Listesi</small>
          </h1>
   
        </section>
 <section class="content">
  <!-- TO DO List -->
              <div class="box box-primary" id="tab_boyut_list">
              
                <div class="box-body">
<div class="up_top">

        <?php 

                      $sor_slider = $db->prepare("SELECT * FROM $dt_table WHERE uid=:uid ORDER BY id DESC");
                      $sor_slider->bindValue(":uid",$uid);
                      $sor_slider->execute();

                      if($sor_slider->rowCount() == 0){
                    ?>

                 <div class="callout callout-info">
                    <h4>Listede hiç içerik bulunamadı</h4>
                    <p>Lütfen içerik ekleyin</p>
                  </div>
<?php }else{  ?>



<table class="table table-bordered text-center">
      <thead>
        <tr>
          <th>Boyut</th>
          <th>Kaymazlık / V</th>
          <th>Kenar</th>
          <th>Kalınlık</th>
          <th style="width:10%;"">İşlem</th>
         
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
        <td>
          

                      <div class="tools">
                        <i class="fa fa-edit" onclick="tab_boyut_duzenle('tab_boyut_ekle','<?php echo $value["id"]; ?>','tab_boyut_list','tab_form_ek')"></i>
                        <i class="fa fa-trash-o" onclick="tab_boyut_sil('tab_boyut_ekle','<?php echo $value["id"]; ?>','tab_boyut_list','tab_form_ek','info_field_pop')"></i>
                      </div>
        </td>
          </tr>
                 
        <?php } } ?>
       </tbody>
</table>



</div>


        <!--  <button class="btn btn-default btn-block daha_fazla" onclick="daha_fazla_goster('list_comp')">Daha Fazla Göster</button>        -->
              
                </div><!-- /.box-body -->
                

                <div class="box-footer clearfix no-border">
                  <button class="btn btn-default pull-right"  onclick="scroll_slow_tab_boyut('tab_boyut_ekle','tab_boyut_list','tab_form_ek')"><i class="fa fa-plus"></i> Veri Ekle</button>
                </div>
              </div><!-- /.box -->

 <div id="info_field_pop">
   


 </div>

              <div class="ekle_slayt" id="tab_boyut_ekle">
                <div class="box box-primary" style="display: none;">
                <div class="box-header with-border">
                  <h3 class="box-title">Veri Ekle</h3>
                    <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="tab_form_ek" method="post" enctype="multipart/form-data" onsubmit="return tab_ekle('tab_boyut_ekle','tab_form_ek','info_field_pop','tab_boyut_ekle');">
                      <input type="hidden" name="tip" value="1">
                      <input type="hidden" name="sid" value="0">
                      <input type="hidden" name="eid" value="0">
										                  <div class="box-body">
										                         <div class="form-group">
										                      <label for="byt">Boyut</label>
										                       
										                  
										                      <input type="text" name="boyut" class="form-control" id="byt" required="" placeholder="Boyut">

										                  
										                    </div>


										                           <div class="form-group">
										                      <label for="kymz">Kaymazlık / Version</label>
										                       
										                  
										                      <input type="text" name="kaymazlik" class="form-control" id="kymz" required="" placeholder="Kaymazlık">

										                  
										                    </div>

            


 <div class="form-group">
            <label for="kenar__">Kenar</label>

            <div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                            <li class="<?php echo $class; ?>"><a href="#kenar_<?php echo $dil_key; ?>" data-toggle="tab"><?php echo $dil_val; ?></a></li>
                          <?php } ?>
                </ul>
                <div class="tab-content">
                     <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                             <div class="tab-pane <?php echo $class; ?>" id="kenar_<?php echo $dil_key; ?>">
                                 <input type="text" name="kenar_<?php echo $dil_key; ?>" class="form-control" id="kenar__" placeholder="<?php echo $dil_val; ?>">
                             </div><!-- /.tab-pane -->
                     <?php } ?>
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
          </div> <!-- /.row -->
</div>

										      				 <div class="form-group">
										                      <label for="kln">Kalınlık</label>
										                       
										                  
										                      <input type="text" name="kalinlik" class="form-control" id="kln" required="" placeholder="Kalınlık">

										                  
										                    </div>
                  </div><!-- /.box-body -->




                  <div class="box-footer">
                   <button class="btn btn-danger">Ekle</button>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </section>

              <script type="text/javascript" src="piston/js/global_kont.js"></script>
              <script type="text/javascript">
                var glob_page_uri = "<?php echo $page_uri; ?>";
                var sid = "<?php  echo $uid; ?>";
              </script>
              <script type="text/javascript" src="piston/page_js/<?php echo $page_uri.".js"; ?>"></script>



  </div>
