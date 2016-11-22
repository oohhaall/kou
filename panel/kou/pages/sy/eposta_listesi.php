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
                        <th>E-Posta</th>
                        <th>Tarih / Saat</th>
                        <th>İşlem</th>
                      </tr>
                    </thead>
                    <tbody>

                    	<?php 

                    		$sor_satis_nokt = $db->prepare("SELECT *, DATE_FORMAT(tarih,'%d.%m.%Y / %H:%i:%s') as trh FROM ebulten ORDER BY id DESC");
                    		$sor_satis_nokt->execute();

                    		foreach ($sor_satis_nokt->fetchAll() as $key => $value) {

                    			?>
                    			     <tr class='<?php echo $value["id"]; ?>'>
				                        <td><?php echo $value["eposta"]; ?></td>
				                        <td><?php echo $value["trh"]; ?></td>
				                        <td style="text-align: center;">

		
                      <div class="tools" style="display: inline-block;">
                        <i class="fa fa-trash-o" onclick="slider_sil('ana_slider_ekle','<?php echo $value["id"]; ?>','list_slayt','a_slider_ekle','info_field')"></i>
                      </div>
				                        </td>
                             
				                      </tr>
                    			<?php
                    		}
                    	?>
               
                      
                    </tbody>
                    <tfoot>
                       <tr>
                         <th>E-Posta</th>
                        <th>Tarih / Saat</th>
                        <th>İşlem</th>
                      </tr>
                    </tfoot>
                  </table>
             




             </div>
       </div>


        <div id="info_field">
   


        </div>

  
</section>
