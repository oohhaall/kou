<?php 
		require_once "../config/global_cont.php";
		extract($_POST);
		extract($_GET);

                          $sor_detay_resim = $db->prepare("SELECT * FROM koleksiyonparcalari WHERE uid=:uid ORDER BY sra DESC");
                                  $sor_detay_resim->bindValue(":uid",$uid);
                                  $sor_detay_resim->execute();

                                  foreach ($sor_detay_resim->fetchAll() as $key => $value) {
                                    ?>
                                        <a href="<?php echo $file_read_path.$value["resim"]; ?>" data-fancybox-group="diger_parcalar" class="fancybox-thumbs"><img src="<?php echo $file_read_path.$value["resim"]; ?>"></a>
                                    <?php
                                  }

                             

?>