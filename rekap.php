<?php
	include'koneksi.php';
	
	$id=$_POST['id'];
	$sql="DELETE FROM pemesanan WHERE id_pelanggan='$id'";
	$res=$conn->query($sql);
	if($res){
		echo"yes";
	}else{
		echo"no";
	}
?>