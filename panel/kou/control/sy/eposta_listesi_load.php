<?php 
require_once "../config/global_cont.php";

$table = "ebulten";


extract($_POST);
extract($_GET);
?>

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


                  <script type="text/javascript">
                  	$(function () {
   var dt_table = $("#data_table").DataTable({
            "language": {
                "url": "plugins/datatables/turkish.json"
            }
        });

});
                  </script>