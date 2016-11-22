<?php 

	require_once "db_connect.php";
	session_start();
	$file_upload_path 	= "../../../resim/";
	$file_read_path 	= "../resim/";
	$img_read = "resim/";

	$f_file_path = "../../../files/";
	$f_file_read = "../files/";
	
	$katalog_path 	   = "../../../katalog/";
	$katalog_path_read = "../katalog/";
	
	$f_pdf_path = "../../../pdf/";
	$f_pdf_read = "../pdf/";
/*
,"de"=>"German","es"=>"Spanish","fr"=>"French","ru"=>"Russian","it"=>"Italian"
*/
	$dil_text =array("tr"=>"Türkçe","en"=>"English");
	$aylar = array(1=>"Ocak",2=>"Şubat",3=>"Mart",4=>"Nisan",5=>"Mayıs",6=>"Haziran",7=>"Temmuz",8=>"Ağustos",9=>"Eylül",10=>"Ekim",11=>"Kasım",12=>"Aralık");
	
date_default_timezone_set('Europe/Istanbul');

	function format_kontrol_resim($file){
				switch(mime_content_type($file)){
					case "image/png":
					case "image/jpeg":
					case "image/gif":
					case "image/bmp":
						return true;
					break;
					default:
						return false;
					break;
				}
	}

	function format_kontrol_zip($file){
			switch(mime_content_type($file)){
					case "application/zip, application/octet-stream":
					case "application/x-rar-compressed, application/octet-stream":
						return true;
					break;
					default:
						return false;
					break;
				}
	}
	function format_kontrol_office($file){
			switch(mime_content_type($file)){
					case "application/pdf":
					case "application/msword":
					case "application/vnd.ms-excel":
					case "application/vnd.ms-powerpoint":
					case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
					case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
					case "application/vnd.openxmlformats-officedocument.presentationml.presentation":
						return true;
					break;
					default:
						return false;
					break;
				}
	}


	function karakter_temizle($str){

	}

?>