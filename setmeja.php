<?php
	$nomeja=$_POST['nomeja'];
	include'koneksi.php';
	$sql="SELECT * FROM pemesanan join pelanggan on pemesanan.id_pelanggan=pelanggan.id_pelanggan WHERE no_meja='$nomeja'";
	$res=$conn->query($sql);
	if(mysqli_num_rows($res)>0){
		echo"no";
	}
?>