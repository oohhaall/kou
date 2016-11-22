<?php 
	require_once "panel/kou/config/global_cont.php";
	extract($_POST);

	$sor_bilgi = $db->prepare("SELECT * FROM duyurular WHERE durum='1' AND id=:id");
	$sor_bilgi->bindValue(":id",$uid);
	$sor_bilgi->execute();
	$oku_bil = $sor_bilgi->fetch();
?>

	<div class="ic_pop">
			<p><?php echo $oku_bil["aciklama_tr"]; ?></p>
			<br>
			<span class="yazar">Ek : </span><a href="download.php?file=<?php echo $oku_bil["ek_tr"]; ?>">İndir</a>
			<br>
			<br>
			<span class="yazar"><?php echo $oku_bil["yazar"]; ?></span>
	</div>