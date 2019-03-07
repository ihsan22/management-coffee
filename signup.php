<?php
	include "koneksi.php";
	
	$email=$_POST['email'];
	$nama = $_POST['nama'];
	$password = $_POST['pwd'];
	$tgl = $_POST['birthday'];
	$gender = $_POST['gender'];
	
	$query="INSERT INTO karyawan  VALUES('$nama','$email','$password','$tgl','$gender','lock');";
	$result=$conn->query($query);
	
	if($result){
		echo"yes";
	}else{
		echo"gagal";
	}
?>