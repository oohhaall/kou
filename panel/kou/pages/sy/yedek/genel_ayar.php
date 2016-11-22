        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Ana Panel
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-th"></i> Ana Panel</a></li>
            <li class="active">Genel Ayarlar</li>
          </ol>
        </section>
 <section class="content">
        <div id="genel_ayar_info">
              
            </div>
      <div class="box">

            <div class="box-header with-border">
              <h3 class="box-title">Genel Ayarlar</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
      <?php 
        $sor_nufus_bilgileri = $db->query("SELECT * FROM genel_ayar")->fetch();
      ?>
            <form action="" method="POST" id="genel_ayar" onsubmit="return nufus_gir('genel_ayar','genel_ayar','genel_ayar_info')">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nüfus Yılı</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" value='<?php echo $sor_nufus_bilgileri["nufus_yil"]; ?>' name='nufus_yil' placeholder="Nüfus Yılı" required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nüfus</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" value='<?php echo $sor_nufus_bilgileri["nufus_sayisi"]; ?>' name='nufus_sayisi' placeholder="Nüfus" required="">
                    </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                  </div>
            </form>
          </div>
            
    </div>





 </section>