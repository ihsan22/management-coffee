<?php
	include'koneksi.php';
	$nomor=$_POST['nomor'];
	$sql="SELECT nama_menu,harga FROM menu WHERE no_menu='$nomor'";
	$res=$conn->query($sql);
	while($row=mysqli_fetch_assoc($res)){
		$nama = $row['nama_menu'];
		$harga = $row['harga'];
	}
	
	echo'<tr id="'.$nomor.'">
			<td>'.$nama.'</td>
			<td>'.$harga.'</td>
			<td><input id="'.$nomor.'" type="number" class="text-center" name="jumlah[]" value=1 style="width:115px;" onChange="hitung(this.value,this.id)" onkeyup="hitung(this.value,this.id)"></td>
			<td><input type="text" name="jml[]" value="'.$harga.'" style="border:0px; padding-left:5px; color:blue; width:130px;" readonly></td>
		</tr>';
?>