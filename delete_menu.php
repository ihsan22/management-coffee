<?php
	include'koneksi.php';
	$nomor=$_POST['nomor'];
	$sql="DELETE FROM menu WHERE no_menu='$nomor'";
	$res = $conn->query($sql);
	if($res){
		echo"yes";
	}else{
		echo"gagal";
	}
?>