<?php	
	    $nomor=$_POST['nomor'];
		include"koneksi.php";
		$sql="SELECT * FROM menu WHERE no_menu='$nomor'";
		$res = $conn->query($sql);
		while($row = mysqli_fetch_row($res)){
			$nomor=$row[0];
			$nama=$row[1];
			$harga=$row[3];
			$image=$row[4];
		}
		echo'<div class="form-group">
					<div class="form-group">
						<label for="nomenu">No Menu :</label>
						<input type="text" class="form-control" name="no_menu" id="nomenu" value="'.$nomor.'" readonly="true" />
					</div>
					<div class="form-group">
						<label for="namamenu">Nama Menu :</label>
						<input type="text" class="form-control" name="namamenu" id="namamenu" value="';echo $nama; echo'" required >
					</div>
					<div class="form-group">
						<label for="harga">Harga :</label>
						<input type="text" class="form-control" name="harga" id="harga" value="'.$harga.'" required />
					</div>
						<input type="submit" class="btn btn-primary btn-block" name="submit" value="UPDATE">
				</div>';
?>