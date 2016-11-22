        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Ana Panel
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-th"></i> Ana Panel</a></li>
            <li class="active">Ekonomi Tablo</li>
          </ol>
        </section>
 <section class="content">
        <div id="ekonomi_tablo_info">
              
            </div>
      <div class="box">

            <div class="box-header with-border">
              <h3 class="box-title">Ekonomi Tablo</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
      <?php 
        $sor_nufus_bilgileri = $db->query("SELECT * FROM genel_ayar")->fetch();
      ?>
            <form action="" method="POST" id="ekonomi_form" onsubmit="return ekonomi_tab('ekonomi_form','ekonomi_tablo','ekonomi_tablo_info');">
                    <textarea id="ck_editor_test" name="ekonomi_tablo" rows="3" class="form-control" required=""><?php echo $sor_nufus_bilgileri["ekonomi_tablo"]; ?></textarea>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" onclick="">Kaydet</button>
                  </div>
            </form>
          </div>
            
    </div>





 </section>