<?php
	require_once('koneksi.php');
	$email=$_SESSION['email'];
	$sql="SELECT * FROM karyawan WHERE email='$email'";
	$res=$conn->query($sql);
	while($row=mysqli_fetch_assoc($res)){
		$nama=$row['nama'];
		$password=$row['password'];
		$tgl=$row['tanggal_lahir'];
		$gender=$row['jenis_kelamin'];
	}
	
	echo'
		<ul class="list-unstyled" style="width:100%;">
			<li><a>Nama<a href="#" class="pull-right"><i class="fa fa-pencil"></i> Edit</a></a></li>
			<li><tr><td>Email</td><td><a href="#" class="pull-right"><i class="fa fa-pencil"></i> Edit</a></td></tr></li>
		</ul>
	';
?>