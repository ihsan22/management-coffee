<?php
	session_start();
	include'koneksi.php';
	
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	
	$sql = "SELECT password,status FROM karyawan WHERE email='$email'";
	$result = $conn->query($sql);
	
	if(mysqli_num_rows($result)>0){
		$row = mysqli_fetch_assoc($result);
		
		if($row['password']!=$pass){
			echo "ok";
		}else{
			if($row['status']=='lock'){
				echo"lock";
			}else{
				$_SESSION['email']=$email;
				echo "yes";
			}
		}
	}else{
		echo "no";
	}
?>