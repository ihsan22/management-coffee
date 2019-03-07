<?php 
	session_start();
	date_default_timezone_set("asia/jakarta");
	include'koneksi.php';
	
	$no_menu = $_POST['food'];
	$jumlah_pesan = $_POST['jumlah'];
	$nomeja = $_POST['nomeja'];
	$date = date("Y-m-d h:i:sa");
	
	if(!isset($_COOKIE['id_plg'])){
		$pelanggan = "INSERT INTO pelanggan (no_meja,waktu) VALUES ('$nomeja','$date')";
		$res = $conn->query($pelanggan);
		
		if($res){
			
			$jumlah="SELECT max(id_pelanggan) as jml FROM pelanggan";
			$result=$conn->query($jumlah);
			$rows = mysqli_fetch_array($result);
			$id = $rows['jml'];
			
			for($i=0; $i<count($no_menu); $i++){
				$insert_menu = "INSERT INTO pemesanan VALUES ('$id','$no_menu[$i]','$jumlah_pesan[$i]')";
				$conn->query($insert_menu);
			}
			
			setcookie("id_plg", $id, time() + (60 * 180));
			setcookie('nomeja', $nomeja, time() + (60 * 180));
			echo"yes";
			
		}else{
			echo"no";
		}
	}else{
		$id_plg=$_COOKIE['id_plg'];
		for($i=0; $i<count($no_menu); $i++){
			$insert_tambah = "INSERT INTO pemesanan VALUES ('$id_plg','$no_menu[$i]','$jumlah_pesan[$i]')";
			$conn->query($insert_tambah);
			echo'yes';
		}
	}
	
	
?>