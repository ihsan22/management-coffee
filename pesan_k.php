<?php
	session_start();
	include"koneksi.php";
	$pesan = htmlentities($_REQUEST['msg'],  ENT_NOQUOTES);
	$id=$_SESSION['email']; 
	
	$sql="INSERT INTO chatting(from_us,pesan,sent_on) VALUES ('$id','$pesan',CURRENT_TIMESTAMP())";
	
	$res = $conn->query($sql);
	
	if($res){
		include'get_msg.php';
	}
?>