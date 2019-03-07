<?php 
	include'koneksi.php';
	
	$sql="SELECT * FROM menu ORDER BY jenis_menu";
	
	$result = $conn->query($sql);
	echo'<table id="table-menu" class="table table-striped">
		<thead>
			<tr>
				<th>Nomor Menu</th>
				<th>Nama Menu</th>
				<th>Jenis Menu</th>
				<th>Harga</th>
				<th>Gambar</th>
				<th>Option</th>
			</tr>		
		</thead>
		<tbody>';
	while($row=mysqli_fetch_assoc($result)){
		echo'<tr>
				<td>'.$row['no_menu'].'</td>
				<td>'.$row['nama_menu'].'</td>
				<td>'.$row['jenis_menu'].'</td>
				<td>'.$row['harga'].'</td>
				<td>'.$row['gambar'].'</td>
				<td><a id="'.$row['no_menu'].'" href="#update" onclick="update(this.id)" data-toggle="modal"><i class="fa fa-edit"></i> Update</a>  |  <a id="'.$row['no_menu'].'" href="#" onclick="del(this.id)"><i class="fa fa-remove"></i>  Delete</a></td>
			</tr>';
	}
	echo"</tbody></table>";
?>