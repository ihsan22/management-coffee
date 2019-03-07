<?php
	$servername = "localhost";
	$username = "tafrul";
	$password = "informatika";
	$dbname = "tafrul";
	
	//buat koneksi
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	if($conn->connect_error){
		die("Connection failed".$conn->connect_error);
	}
?>