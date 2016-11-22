<?php
	require_once "../config/global_cont.php";

	extract($_POST);
  	extract($_GET);
 
		$toplam_id = count($list_update);

		switch ($gunc_page) {
	/*	case 'mimari_cozumler_list':
				$sor_sira = $db->query("SELECT * FROM ".$dt." WHERE kid=0 ORDER BY sira DESC LIMIT 0,".$toplam_id)->fetch();

				$max_id = $sor_sira["sira"];
				
				foreach ($list_update as $key => $value) {
					$db->query("UPDATE ".$dt." SET sira='".$max_id."' WHERE kid=0 AND id='".$value."'");
					$max_id--;
				}
		break;
		case "urun_list_koleksiyon":
				$sor_sira = $db->query("SELECT MAX(sira) FROM ".$dt." WHERE kid='".$g_id."' ORDER BY sira DESC")->fetch();

				$max_id = $sor_sira["MAX(sira)"];
			
				foreach ($list_update as $key => $value) {
					$db->query("UPDATE ".$dt." SET sira='".$max_id."' WHERE id='".$value."'");
					$max_id--;
				}
		break;
		case "tab_ozel_kesim":
			$sor_sira = $db->query("SELECT MAX(sira) FROM ".$dt." ORDER BY sira DESC")->fetch();

				foreach ($list_update as $key => $value) {
					$db->query("UPDATE ".$dt." SET sira='".$max_id."' WHERE id='".$value."'");
					$max_id--;
				}
		break;
		case "mimari_cozum_ekle_pop":
				$sor_sira = $db->query("SELECT MAX(sira) FROM ".$dt." WHERE uid=".$g_id)->fetch();

				$max_id = $sor_sira["MAX(sira)"];
			
				foreach ($list_update as $key => $value) {
					$db->query("UPDATE ".$dt." SET sira='".$max_id."' WHERE id='".$value."'");
					$max_id--;
				}
		break;
		*/
		default:
			$sor_sira = $db->query("SELECT * FROM ".$dt." ORDER BY sira DESC LIMIT 0,".$toplam_id)->fetch();

			$max_id = $sor_sira["sira"];
			
			foreach ($list_update as $key => $value) {
				$db->query("UPDATE ".$dt." SET sira='".$max_id."' WHERE id='".$value."'");
				$max_id--;
			}
		break;
		
		}



	
		  echo "guncellendi";


 ?>