<?php
	include"koneksi.php";
	$nomor = $_POST['no_menu']; 
	$namamenu=$_POST['namamenu'];
	$harga=$_POST['harga'];
	
	$sql="UPDATE menu SET nama_menu='$namamenu',harga='$harga' WHERE no_menu='$nomor'";
	
	$res=$conn->query($sql);
		if($res){
			echo"yes";
		}else{
			echo"gagal";
		}
?>