<?php
	include'koneksi.php';
	$nama_file=$_FILES['image']['name'];
	$tmp_file=$_FILES['image']['tmp_name'];
	$path= "image/".$nama_file;
	$nomenu=$_POST['no_menu']; 
	$namamenu=$_POST['namamenu'];
	$jenis_menu=$_POST['jenis_menu'];
	$harga=$_POST['harga'];
	
	$sql="INSERT INTO menu VALUES('$nomenu','$namamenu','$jenis_menu','$harga','$nama_file')";
		
		if(move_uploaded_file($tmp_file,$path)) {
			$res=$conn->query($sql);
			if($res){
				echo'<tr>
						<td>'.$nomenu.'</td>
						<td>'.$namamenu.'</td>
						<td>'.$jenis_menu.'</td>
						<td>'.$harga.'</td>
						<td>'.$nama_file.'</td>
						<td><a id="'.$nomenu.'" href="#update" class="" onclick ="update(this.id)" data-toggle="modal"><i class="fa fa-edit"></i> Update</a>  |  <a id="'.$nomenu.'" href="#" onclick="del(this.id)"><i class="fa fa-remove"></i>  Delete</a></td>
					</tr>';
			}else{
				echo"gagal";
			}
		}
?>