<?php
	include'koneksi.php';
	$plgn ="SELECT DISTINCT pemesanan.id_pelanggan,no_meja,waktu FROM pemesanan join pelanggan on pemesanan.id_pelanggan = pelanggan.id_pelanggan";
	$res = $conn->query($plgn);				
	
	while($row = mysqli_fetch_row($res)){
		echo'<div class="panel panel-default" style="margin:5px; display:inline-block; overflow:hidden;">
				<div class="panel-heading">
					<strong>Meja '. $row[1].'</strong>
				</div>
				<div class="panel-body">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Id Menu</th>
								<th>Nama Menu</th>
								<th>Jumlah Pesanan</th>
							</tr>
						</thead>
						<tbody>';
						
						$sql = "SELECT menu.no_menu,nama_menu,jumlah_pesan FROM (pelanggan JOIN pemesanan on pelanggan.id_pelanggan = pemesanan.id_pelanggan) JOIN menu on pemesanan.no_menu=menu.no_menu WHERE pelanggan.id_pelanggan=$row[0]";
						$result = $conn->query($sql);
						
						while($r = mysqli_fetch_row($result)){
							echo'<tr><td>'. $r[0] .'</td>
									<td>'. $r[1] .'</td>
									<td>'. $r[2] .'</td>
								</tr>';		
						}
						
						echo'</tbody>
					</table>
					<p style="margin-top:-20px;">Pelanggan id : <strong>'.$row[0].'<br></strong> '.$row[2].'</p>
					<a href="#bayar" id="'.$row[0].'" onclick="viewJumlah(this.id,'.$row[1].')" class="btn btn-primary" data-toggle="modal" data-keyboard="false" data-backdrop="static"><i class="fa fa-check-circle"></i> Bayar</a>
				</div>
			</div>';
	}		
?>