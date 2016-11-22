<?php 
	echo (isset($_SESSION["login"]) != "true")?"<script>window.location = 'index.php';</script>":"<script>window.location = 'panel.php';</script>";
?>