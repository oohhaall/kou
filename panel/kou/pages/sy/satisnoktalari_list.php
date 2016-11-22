 <section class="content-header">
          <h1>
            Satış noktaları
            <small>Satış noktaları Listesi</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-files-o"></i>Satış noktaları</a></li>
            <li class="active">Satış noktaları Listesi</li>
          </ol>
        </section>
 <section class="content">
  <!-- TO DO List -->
              <div class="box box-primary" id="list_slayt">
                <div class="box-header">
                  <i class="fa fa-files-o"></i>
                  <h3 class="box-title">Satış Noktaları Listesi</h3>
                </div><!-- /.box-header -->
                <div class="box-body" id="ex">



                			    
                
             
                  <table id="data_table" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Firma Ünvanı</th>
                        <th>Ülke</th>
                        <th>Şehir</th>
                        <th>İlçe</th>
                        <th>Seçenekler</th>
                      </tr>
                    </thead>
                    <tbody>

                    	<?php 

                    		$sor_satis_nokt = $db->prepare("SELECT * FROM satisnoktalari");
                    		$sor_satis_nokt->execute();

                    		foreach ($sor_satis_nokt->fetchAll() as $key => $value) {

                    				$sor_ulke = $db->query("SELECT * FROM satisulke WHERE id=".$value["ulke"])->fetch();
                    				$sor_sehir = $db->query("SELECT * FROM satissehir WHERE id=".$value["sehir"])->fetch();
                    				$sor_ilce = $db->query("SELECT * FROM satisilce WHERE id=".$value["ilce"])->fetch();

                    			?>
                    			     <tr m_id='<?php echo $value["id"]; ?>'>
				                        <td data_name="firma"><?php echo $value["firma"]; ?></td>
				                        <td><?php echo $sor_ulke["baslik_tr"]; ?></td>
				                        <td><?php echo $sor_sehir["baslik"]; ?></td>
				                        <td><?php echo $sor_ilce["baslik"]; ?></td>
				                        <td>

				      <div class="list_active_control">
                      <div class="slider-track <?php echo ($value["drm"]==1)?"acik_on":NULL; ?>" onclick='gunc_durum("<?php echo $value["id"]; ?>")' item_id="<?php echo $value["id"]; ?>" post_type="ana_slider" dt_table="satisnoktalari">
                          <div class="slider-handle"></div>
                        </div>
                        </div>
                      <div class="tools" style="display: inline-block;">
                        <i class="fa fa-edit" onclick="slider_duzenle('ana_slider_ekle','<?php echo $value["id"]; ?>','list_slayt','a_slider_ekle')"></i>
                        <i class="fa fa-trash-o" onclick="slider_sil('ana_slider_ekle','<?php echo $value["id"]; ?>','list_slayt','a_slider_ekle','info_field')"></i>
                      </div>
				                        </td>
                                <bilgi m_id='<?php echo $value["id"]; ?>' style="display: none;">
                                      <tel><?php echo $value["tel"]; ?></tel>
                                      <fax><?php echo $value["fax"]; ?></fax>
                                      <mail><?php echo $value["email"]; ?></mail>
                                      <adres><?php echo $value["adres"]; ?></adres>
                                      <harita><?php echo $value["harita"]; ?></harita>
                                      <ulke><?php echo $value["ulke"]; ?></ulke>
                                      <sehir><?php echo $value["sehir"]; ?></sehir>
                                      <ilce><?php echo $value["ilce"]; ?></ilce>
                                  </bilgi>
				                      </tr>
                    			<?php
                    		}
                    	?>
               
                      
                    </tbody>
                    <tfoot>
                       <tr>
                        <th>Firma Ünvanı</th>
                        <th>Ülke</th>
                        <th>Şehir</th>
                        <th>İlçe</th>
                        <th>Seçenekler</th>
                      </tr>
                    </tfoot>
                  </table>
             


                <div class="box-footer clearfix no-border">
                  <button class="btn btn-default pull-right"  onclick="scroll_slow_slider('ana_slider_ekle','list_slayt','a_slider_ekle')"><i class="fa fa-plus"></i> Satış Noktası Ekle</button>
                </div>



             </div>
       </div>


        <div id="info_field">
   


 </div>

              <div class="ekle_slayt" id="ana_slider_ekle">
                <div class="box box-primary" style="display: none;">
                <div class="box-header with-border">
                  <h3 class="box-title">Satış Noktası Ekle</h3>
                    <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="a_slider_ekle" method="post" enctype="multipart/form-data" onsubmit="return slider_ekle('ana_slider_ekle','a_slider_ekle','info_field','ana_slider_ekle');">
                      <input type="hidden" name="tip" value="1">
                      <input type="hidden" name="sid" value="0">
                  <div class="box-body">
               			
                  	<div class="form-group">  
                        <select class="form-control" name="ulke" id="ref_ulk">
                          <?php 
                              $sor_ulk = $db->prepare("SELECT * FROM satisulke ORDER BY baslik_tr ASC");
                              $sor_ulk->execute();
                              $birinci_s_id = 0;
                              foreach ($sor_ulk->fetchAll() as $key => $value) {

                              		$sor_varmi_seh = $db->prepare("SELECT * FROM satissehir WHERE uid=:uid ORDER BY baslik ASC");
                              		$sor_varmi_seh->bindValue(":uid",$value["id"]);
                              		$sor_varmi_seh->execute();

                              		$sor_varmi_ilc = $db->prepare("SELECT * FROM satisilce WHERE uid=:uid ORDER BY baslik ASC");
                              		$sor_varmi_ilc->bindValue(":uid",$value["id"]);
                              		$sor_varmi_ilc->execute();

                              		if($sor_varmi_ilc->rowCount() == 0 || $sor_varmi_seh->rowCount() == 0)
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
                              $sor_ulk = $db->prepare("SELECT * FROM satissehir WHERE uid=:uid ORDER BY baslik ASC");
                              $sor_ulk->bindValue(":uid",$birinci_s_id);
                              $sor_ulk->execute();
                                $ikinci_s_id = 0;

                              foreach ($sor_ulk->fetchAll() as $key => $value) {


                              		$sor_varmi_ilc = $db->prepare("SELECT * FROM satisilce WHERE sid=:sid ORDER BY baslik ASC");
                              		$sor_varmi_ilc->bindValue(":sid",$value["id"]);
                              		$sor_varmi_ilc->execute();

                              		if($sor_varmi_ilc->rowCount()==0)
                              				continue;

                              	  $ikinci_s_id = ($ikinci_s_id!=0)?$ikinci_s_id:$value["id"];
                                ?>
                                    <option value="<?php echo $value["id"]; ?>"><?php echo $value["baslik"]; ?></option>
                                <?php
                              }

                          ?>
                      </select>
                      </div>


                        <div class="form-group">  
                        <select class="form-control" name="ilce" id="ilce_select">
                          <?php 
                              $sor_ulk = $db->prepare("SELECT * FROM satisilce WHERE uid=:uid AND sid=:sid ORDER BY baslik ASC");
                              $sor_ulk->bindValue(":uid",$birinci_s_id);
                              $sor_ulk->bindValue(":sid",$ikinci_s_id);
                              $sor_ulk->execute();
                              foreach ($sor_ulk->fetchAll() as $key => $value) {
                                ?>
                                    <option value="<?php echo $value["id"]; ?>"><?php echo $value["baslik"]; ?></option>
                                <?php
                              }

                          ?>
                      </select>
                    </div>




                    <div class="form-group">
                      <label for="unvan">Firma Ünvanı</label>
                      <input type="text" name="unvan" class="form-control" id="unvan" placeholder="Firma Ünvanı" required="">
                    </div>			

                    <div class="form-group">
                      <label for="tel">Telefon</label>
                      <input type="tel" name="tel" class="form-control" id="tel" placeholder="Telefon" required="">
                    </div>

                    <div class="form-group">
                      <label for="fax">Fax</label>
                      <input type="tel" name="fax" class="form-control" id="fax" placeholder="Fax">
                    </div>
 					

 					 <div class="form-group">
                      <label for="fax">E Mail</label>
                      <input type="email" name="email" class="form-control" id="fax" placeholder="E Mail">
                    </div>


                     <div class="form-group">
                      <label for="adres">Adres</label>
                      <input type="text" name="adres" class="form-control" id="adres" placeholder="Adres" required="">
                    </div>


                     <div class="form-group">
                      <label for="maps">Harita Bilgisi</label>
                      <input type="text" name="maps" class="form-control" id="maps" placeholder="41.063029, 28.997389" required="">
                        <p class="help-block">Örnek : 41.063029, 28.997389</p>
                    </div>


                  </div><!-- /.box-body -->




                  <div class="box-footer">
                   <button class="btn btn-danger">Ekle</button>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
</section>
