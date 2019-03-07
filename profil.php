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
	
	echo'<div class="panel panel-default col-xs-8 col-xs-offset-2" style="padding:0px;">
			<div class="panel-heading">
				<h3 class="panel-title">Profil</h3>
			</div>
			<div class="panel-body" style="overflow:visible">
				<div class="row">
					<div class="col-md-3 col-lg-3 " align="center"> 
						<img alt="User Pic" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLlSIpjmgsR7dbQk8UGns3745kk-5RDiIHmVMZ1f1gCkCBYYud" class="img-circle img-responsive"> 
					</div>
					<div class=" col-md-9 col-lg-9 "> 
						<table class="table">
							<tbody>
								<tr>
									<td>Nama</td>
									<td>'.$nama.'</td>
								</tr>
								<tr>
									<td>Email</td>
									<td><a href="mailto:info@support.com">'.$email.'</a></td>
								</tr>
								<tr>
									<td>Tanggal Lahir</td>
									<td>'.$tgl.'</td>
								</tr>	
								<tr>
									<td>Jenis Kelamin</td>
									<td>'.$gender.'</td>
								</tr>
								<tr>
									<td>No. HP</td>
									<td>082362959867</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<span class="pull-right">
					<a data-original-title="Hapus Akun" href="proses_hapus.php" onclick="return check()" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
				</span>
				<br clear="both">
			</div>
		</div>';
	

?>