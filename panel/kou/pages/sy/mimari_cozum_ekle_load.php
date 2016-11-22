
<?php
 require_once "../config/global_cont.php";
  extract($_GET);
  extract($_POST);
    $dt_table = "urunler";
    $sor_urun = $db->prepare("SELECT * FROM $dt_table WHERE id=:uid");
    $sor_urun->bindValue(":uid",$uid);
    $sor_urun->execute();


    if($sor_urun->rowCount()==0){
        ?>
          <script type="text/javascript">
            window.location = "panel.php";
          </script>
        <?php
      exit;
    }
    
    $oku_urun = $sor_urun->fetch();

    ?>



       <div class="box box-primary" style="display: block;">
                <div class="box-header with-border">
                  <h3 class="box-title">Mimari Çözümler Ekle</h3>
                    <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="a_slider_ekle" method="post" enctype="multipart/form-data" onsubmit="return slider_ekle('a_slider_ekle','info_field');">
                      <input type="hidden" name="tip" value="1">
                      <input type="hidden" name="sid" value="<?php echo $oku_urun["id"]; ?>">
                  <div class="box-body">
                   <!-- <div class="form-group">
                      <label for="exampleInputEmail1">Başlık</label>
                      <input type="text" name="baslik" class="form-control" id="exampleInputEmail1" placeholder="Başlık" required="">
                    </div>-->

 <div class="form-group">
                      <label for="menu_arkaplan">Menü arkaplan resmi</label>

              <!-- Custom Tabs -->
                      <input type="file" name="arka_plan" id="menu_arkaplan">
                      <p class="help-block">Genişlik(width) : 1660px, Yükseklik(height) : 146px olmalıdır.</p>
                      <?php 
                        $res_style = ($oku_urun["resim"]=="")?"display:none":"display:inline-block";
                      ?>
                      <img width="150" height="" src="<?php echo $file_read_path.$oku_urun["resim"]; ?>" style="<?php echo $res_style; ?>" alt="" class="margin">
                      <button type="button" onclick="" class="img-del" style="<?php echo $res_style; ?>"><i class="fa fa-remove"></i></button>

</div>


 <div class="form-group">
                      <label for="m_site_urun_resmi">Mobil Site Ürün Resmi</label>

              <!-- Custom Tabs -->
              <?php 
                    $res1_style = ($oku_urun["resim2"]=="")?"display:none":"display:inline-block";

              ?>
                      <input type="file" name="mobil_resim" id="m_site_urun_resmi">
                      <p class="help-block">Genişlik(width) : 150px, Yükseklik(height) : 110px olmalıdır.</p>
                      <img width="150" height="" src="<?php echo $file_read_path.$oku_urun["resim2"]; ?>" style="<?php echo $res1_style; ?>" alt="" class="margin">
                      <button type="button" onclick="" class="img-del" style="<?php echo $res1_style; ?>"><i class="fa fa-remove"></i></button>

</div>

 <div class="form-group">
                      <label for="exampleInputEmail1">Ürün Adı</label>

            <div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
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
                                 <input type="text" name="baslik_<?php echo $dil_key; ?>" value="<?php echo $oku_urun["urunAdi_".$dil_key]; ?>" class="form-control" id="exampleInputEmail1" placeholder="<?php echo $dil_val; ?>">
                             </div><!-- /.tab-pane -->
                     <?php } ?>
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
          </div> <!-- /.row -->
</div>


 <div class="form-group">
                      <label for="kutu_paket">Kutu Palet</label>

              <!-- Custom Tabs -->
                      <input type="file" name="kutu_palet" id="kutu_paket" >
                      <?php 
                          $pdf_style = ($oku_urun["kutuPaletPdf"]=="")?"display:none":"display:inline-block";
                      ?>
                      <a href="<?php echo "piston/control/download.php?file=".$f_pdf_read.$oku_urun["kutuPaletPdf"]; ?>" style="<?php echo $pdf_style; ?>" target="_blank"><img src="../images/pdf.png"> Katalog İndir</a>
                      <button type="button" class="img-del" style="<?php echo $pdf_style; ?>"><i class="fa fa-remove"></i></button>
</div>



 <div class="form-group">
                      <label for="aksesuar_op">Aksesuarlar</label>

              <!-- Custom Tabs -->
                    <?php 


                    ?>
                      <input type="file" name="aksesuar_doc" id="aksesuar_op" >
                      <?php
                          $aksesuar_style=($oku_urun["aksesuarDosya"]=="")?"display:none":"display:inline-block;";
                      ?>
                      <a href="<?php echo "piston/control/download.php?file=".$f_file_read.$oku_urun["aksesuarDosya"]; ?>" style="<?php echo $aksesuar_style; ?>" target="_blank"><span class="glyphicon glyphicon-save-file" style="font-size:20px;"></span> Aksesuar indir</a>
                      <button type="button" class="img-del" style="<?php echo $aksesuar_style; ?>"><i class="fa fa-remove"></i></button>
</div>


 <div class="form-group">
                      <label for="exampleInputEmail1">Detaylar</label>

            <div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                            <li class="<?php echo $class; ?>"><a href="#aciklama_<?php echo $dil_key; ?>" data-toggle="tab"><?php echo $dil_val; ?></a></li>
                          <?php } ?>
                </ul>
                <div class="tab-content">
                     <?php 
                       foreach ($dil_text as $dil_key => $dil_val) {
                          $class = ($dil_key=="tr")?"active":NULL;  ?>
                             <div class="tab-pane <?php echo $class; ?>" id="aciklama_<?php echo $dil_key; ?>">
                                 <textarea class="detay_ck" name="aciklama_<?php echo $dil_key; ?>"><?php echo $oku_urun["aciklama_".$dil_key]; ?></textarea>
                                
                         
                             </div><!-- /.tab-pane -->
                     <?php } ?>
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
          </div> <!-- /.row -->
</div>

                  <div class="box-footer">
                   <button class="btn btn-danger">Ekle</button>
                  </div>


                   <div class="progress">
                    <div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                    </div>
                  </div>
                    <div class="form-group border_bot">
                      <label>Detay Resimleri</label>
                        <div class="detay_resim_ic">
                           <a class="btn btn-app popup_page" data-fancybox-type="ajax" d_h="mimari_detay_resim" href="javascript:;"><i class="fa fa-edit"></i> Düzenle</a>
                           <div class="img_list">


                              <?php 
                                  $sor_detay_resim = $db->prepare("SELECT * FROM urundetayresim WHERE uid=:uid ORDER BY sra DESC");
                                  $sor_detay_resim->bindValue(":uid",$uid);
                                  $sor_detay_resim->execute();

                                  foreach ($sor_detay_resim->fetchAll() as $key => $value) {
                                    ?>
                                       <a href="<?php echo $file_read_path.$value["resim"]; ?>" data-fancybox-group="detay_resim" class="fancybox-thumbs"><img src="<?php echo $file_read_path.$value["resim"]; ?>"></a>
                                    <?php
                                  }

                              ?>
                                 
                                 

                           </div>
                        </div>
                    </div>
     


                    <div class="form-group border_bot">
                      <label>Slider</label>
                        <div class="slider_resim_ic">
                          <a class="btn btn-app popup_page" data-fancybox-type="ajax" d_h="mimari_slider" href="javascript:;"><i class="fa fa-edit"></i>Slider Düzenle</a>
                           <div class="img_list">
                             <?php
                                  $sor_detay_resim = $db->prepare("SELECT * FROM urunslayt WHERE uid=:uid ORDER BY sra DESC");
                                  $sor_detay_resim->bindValue(":uid",$uid);
                                  $sor_detay_resim->execute();

                                  foreach ($sor_detay_resim->fetchAll() as $key => $value) {
                                    ?>
                                       <a href="<?php echo $file_read_path.$value["resim"]; ?>" data-fancybox-group="detay_resim" class="fancybox-thumbs"><img src="<?php echo $file_read_path.$value["resim"]; ?>"></a>
                                    <?php
                                  }
                                  ?>
                           </div>
                        </div>
                    </div>


                    <!--
                    <div class="form-group border_bot">
                      <label>Modeller</label>
                        <div class="detay_resim_ic">
                           <a class="btn btn-app"><i class="fa fa-edit"></i>Modelleri Düzenle</a>
                        </div>
                    </div>
                    -->

                        <div class="form-group border_bot">
                      <label>Mevcut Yüzeyler</label>
                      <div class="yuzeyler_detay">
                         <a class="btn btn-app popup_page" data-fancybox-type="ajax" d_h="mimari_yuzeyler" href="javascript:;"><i class="fa fa-edit"></i>Mevcut Yüzeyler<br>Düzenle</a>
                         <?php 
                             $yuzey_sel = explode(",",$oku_urun["mevcutYuzeyler"]);
                         ?>
                         <div class="img_list">

                                   <select multiple='multiple' id='keep-order' class="form-control" dt_table='yuzeyler' up_dt='mevcutYuzeyler'  op_select="up_select">
                            <?php

                                $sor_page_list = $db->query("SELECT * FROM yuzeyler ORDER BY id DESC");
                                  foreach($sor_page_list->fetchAll() as $key => $value) {
                                    ?>
                                       <option value='<?php echo $value["id"]; ?>' <?php echo (in_array($value["id"], $yuzey_sel))?"selected":NULL; ?>><?php echo $value["baslik_tr"]; ?></option>
                                    <?php
                                  }
                             ?> 
                            </select>
                         </div>
                      </div>
                    </div>

                      <div class="form-group border_bot">
                      <label>Koleksiyonun Diğer Parçaları</label>
                        <div class="mimari_renk">
                           <a class="btn btn-app popup_page" data-fancybox-type="ajax" d_h="mimari_renkler" href="javascript:;"><i class="fa fa-edit"></i>Serinin Diğer<br>Renklerini Düzenle</a>

                           <div class="img_list">
                                  <?php
                                  $sor_koleksiyon = $db->prepare("SELECT * FROM koleksiyonparcalari WHERE uid=:uid ORDER BY sra DESC");
                                  $sor_koleksiyon->bindValue(":uid",$uid);
                                  $sor_koleksiyon->execute();

                                  foreach ($sor_koleksiyon->fetchAll() as $key => $value) {
                                        $renk_ = $db->prepare("SELECT * FROM renkler WHERE id=:id");
                                        $renk_->bindValue(":id",$value["renk"]);
                                        $renk_->execute();

                                        $renk_bilg = $renk_->fetch();
                                    ?>
                                       <a href="<?php echo $file_read_path.$value["resim"]; ?>" data-fancybox-group="diger_parcalar" class="fancybox-thumbs"><img src="<?php echo $file_read_path.$value["resim"]; ?>" data-toggle="tooltip" title="" data-original-title="<?php echo $renk_bilg["baslik_tr"]; ?>"></a>
                                    <?php
                                  }
                                  ?>
                           </div>
                        </div>
                    </div>


                       <div class="form-group border_bot">
                      <label>Teknik Özellikler</label>
                        <div class="teknik_ozellik_ic">
                           <a class="btn btn-app popup_page" data-fancybox-type="ajax" d_h="teknik_ozellikler" href="javascript:;"><i class="fa fa-edit"></i>Düzenle</a>
                            <div class="img_list">
                              
                              <select multiple='multiple' id='keep-order2' class="form-control" dt_table='fizikselozellikler' op_select='up_select' up_dt='fizikselOzellikler'>
                              <?php
                                    $teknik_ozl = explode(",", $oku_urun["fizikselOzellikler"]);
                                  $sor_page_list = $db->query("SELECT * FROM fizikselozellikler ORDER BY id DESC");
                                    foreach($sor_page_list->fetchAll() as $key => $value) {
                                      ?>
                                    <option value='<?php echo $value["id"]; ?>' <?php echo (in_array($value["id"], $teknik_ozl))?"selected":NULL; ?>><?php echo $value["baslik"]; ?></option>
                                      <?php
                                    }
                               ?> 
                              </select>


                            </div>
                        </div>
                    </div>



                       <div class="form-group border_bot">
                      <label>Tavsiye Edilen Ürün</label>
                        <div class="tavsiye_urun">
                             <select multiple='multiple' id='keep-order3' class="form-control" dt_table='yapigerecleri' op_select='up_select' up_dt='tavsiyeEdilenUrun'>
      <?php
          $tavsiye = explode(",", $oku_urun["tavsiyeEdilenUrun"]);
          $sor_page_list = $db->query("SELECT * FROM yapigerecleri ORDER BY id DESC");
            foreach($sor_page_list->fetchAll() as $key => $value) {
              ?>
            <option value='<?php echo $value["id"]; ?>' <?php echo (in_array($value["id"], $tavsiye))?"selected":NULL; ?>><?php echo $value["urunAdi_tr"]; ?></option>
              <?php
            }
       ?> 
                              </select>
                        </div>
                    </div>


                         <div class="form-group border_bot">
                      <label>Kullanıldığı Yerler - Referanslar</label>
                        <div class="ref_sec">
                              <select multiple='multiple' id='keep-order4' class="form-control" dt_table='referanslar' op_select='up_select' up_dt='kullanildigiYerler'>
      <?php
          $kullanildigi_yer = explode(",", $oku_urun["kullanildigiYerler"]);
          $sor_page_list = $db->query("SELECT * FROM referanslar ORDER BY id DESC");
            foreach($sor_page_list->fetchAll() as $key => $value) {
              ?>
            <option value='<?php echo $value["id"]; ?>' <?php echo (in_array($value["id"], $kullanildigi_yer))?"selected":NULL; ?>><?php echo $value["baslik_tr"]; ?></option>
              <?php
            }
       ?> 
                              </select>
                        </div>
                    </div>

                    



                          <div class="form-group border_bot">
                      <label>BOYUT (Tab)</label>
                        <div class="boyut_tp">
                           <a class="btn btn-app popup_page" data-fancybox-type="ajax" d_h="tab_boyut" href="javascript:;"><i class="fa fa-edit"></i> Düzenle</a>

                           <div style="clear:both;"></div>

                          <div class="img_list col-md-6">
                          <?php
                               $sor_slider = $db->prepare("SELECT * FROM tabboyut WHERE uid=:uid ORDER BY id DESC");
                      $sor_slider->bindValue(":uid",$uid);
                      $sor_slider->execute();

                      if($sor_slider->rowCount() > 0){

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


<?php } ?>
                          </div>
                        </div>
                           <div style="clear:both;"></div>

                    </div>


                          <div class="form-group border_bot">
                      <label>ÖZEL KESİMLER (Tab)</label>
                        <div class="ozel_kesim">
                           <a class="btn btn-app popup_page" data-fancybox-type="ajax" d_h="tab_ozel_kesim" href="javascript:;"><i class="fa fa-edit"></i> Düzenle</a>
                           <div class="img_list">

                           <select class="image-picker picker_hide" op_select='up_img' up_dt="ozelkesimler" dt_table="tabozelparcalar" multiple="multiple">
                                 <?php

    $sor_koleksiyon = $db->prepare("SELECT * FROM tabozelparcalar ORDER BY sra DESC");
    //$sor_koleksiyon->bindValue(":uid",$uid);
    $sor_koleksiyon->execute();
    $kesim_tab = explode(",",$oku_urun["ozelkesimler"]);
    foreach ($sor_koleksiyon->fetchAll() as $key => $value) {
      ?>
    <option data-img-src="<?php echo $file_read_path.$value["resim"]; ?>" data-img-alt="" value="<?php echo $value["id"]; ?>" <?php echo (in_array($value["id"], $kesim_tab))?"selected":NULL; ?>><?php echo $value["id"]; ?></option>
                                      
    <?php
      }
      ?>

    </select>
       </div>
    </div>
</div>



                    <div class="form-group border_bot">
                      <label>MOZAİK / DEKOR (Tab)</label>
                        <div class="mozaik_dekor">
                          <a class="btn btn-app popup_page" data-fancybox-type="ajax" d_h="tab_mozaik_dekor" href="javascript:;"><i class="fa fa-edit"></i> Mozaik Kesimleri<br>Düzenle</a>

                          <div class="img_list">

                           <select class="image-picker picker_hide2" op_select='up_img' up_dt="mozaikdekor" dt_table="tabmozaikdekor" multiple="multiple">
                                 <?php

    $sor_koleksiyon = $db->prepare("SELECT * FROM tabmozaikdekor ORDER BY sra DESC");
    //$sor_koleksiyon->bindValue(":uid",$uid);
    $sor_koleksiyon->execute();
    $kesim_tab = explode(",",$oku_urun["mozaikdekor"]);
    foreach ($sor_koleksiyon->fetchAll() as $key => $value) {
      ?>
    <option data-img-src="<?php echo $file_read_path.$value["resim"]; ?>" data-img-alt="" value="<?php echo $value["id"]; ?>" <?php echo (in_array($value["id"], $kesim_tab))?"selected":NULL; ?>><?php echo $value["id"]; ?></option>
                                      
    <?php
      }
      ?>

    </select>

                        </div>
                    </div>



                  </div><!-- /.box-body -->

</div>


                </form>
</div>



