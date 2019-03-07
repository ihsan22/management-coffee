<?php
	session_start();
	include'koneksi.php';
	$email = $_SESSION['email'];
	
	$sql = "DELETE FROM karyawan WHERE email='$email'";
	$result = $conn->query($sql);
	
	if($result){
		header('location:logout.php');
	}else{
		echo "no";
	}
	
?>