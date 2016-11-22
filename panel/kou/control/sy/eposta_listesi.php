<?php 
require_once "../config/global_cont.php";

$table = "ebulten";


extract($_POST);
extract($_GET);

if($_POST && isset($sid)){

				$sil = $db->prepare("DELETE FROM $table WHERE id=:id");
				$sil->bindValue(":id",$sid);
				$sil->execute();

					
						?>
					 <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Başarılı!</h4>
                    İçerik başarıyla slindi listeden detaylı görüntüleme yapabilirsiniz.
                  </div>
						<?php
}


?>