<?php
	include"koneksi.php";
	$pesan = htmlentities($_REQUEST['msg'],  ENT_NOQUOTES);
	$id=$_COOKIE['id_plg']; 
	
	$sql="INSERT INTO chatting(from_us,pesan,sent_on) VALUES ('$id','$pesan',CURRENT_TIMESTAMP())";
	
	$res = $conn->query($sql);
	
	if($res){
		include'ambil.php';
	}
?>