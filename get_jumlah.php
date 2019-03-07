<?php
	date_default_timezone_set("Asia/Jakarta");
	include'koneksi.php';
	$id=$_GET['id'];
	$no_meja=$_GET['no_meja'];
	$sql="SELECT * FROM pemesanan p JOIN menu m ON p.no_menu=m.no_menu WHERE p.id_pelanggan='$id'";
	$result=$conn->query($sql);
	$jumlah=0;
	
	echo'<div class="well">
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6">
					<address>
						<strong>Transit Cafe</strong>
						<br>
						Jl. T. Nyak Arief
						<br>
						Lamnyong, Banda Aceh 90026
						<br>
						<abbr title="Phone">P:</abbr> (213) 484-6829
					</address>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 text-right">
					<p>
						<em>Date: '.date("j F Y , H:m").'</em>
					</p>
					<p>
						<em>ID Pelanggan : '.$id.'</em>
					</p>
					<p>
						<em>Meja : '.$no_meja.'</em>
					</p>
				</div>
			</div>
			<div class="row">
				<div class="text-center">
					<h1>Kuitansi</h1>
				</div>
				</span>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Product</th>
							<th>@</th>
							<th class="text-center">Harga</th>
							<th class="text-center">Jumlah (Rp)</th>
						</tr>
					</thead>
					<tbody>';
			while($row=mysqli_fetch_assoc($result)){
				$jml = ($row['harga'] * $row['jumlah_pesan']);
				$jumlah = $jumlah + $jml;
				
					
						echo'<tr>
							<td class="col-md-9"><em>'.$row['nama_menu'].'</em></h4></td>
							<td class="col-md-1" style="text-align: center"> '.$row['jumlah_pesan'].' </td>
							<td class="col-md-1 text-center">'.$row['harga'].'</td>
							<td class="col-md-1 text-center">'.$jml.'</td>
						</tr>';
			}
						$j = number_format($jumlah,0,".",".");
						echo'<tr>
							<td>   </td>
							<td>   </td>
							<td class="text-right">
							<p>
								<strong>Total: </strong>
							</p>
							<p>
								<strong>Nominal: </strong>
							</p></td>
							<td class="text-center">
							<p>
								<strong>'.$j.'</strong>
							</p>
							<p>
								<input type="number" min="0" id="input-bayar" onkeyup="hitung(this.value , '.$jumlah.')" name="pembayaran" style="background-color:transparent; border:0; border-bottom:1px solid grey; text-align:center;"/>
							</p></td>
						</tr>
						<tr>
							<td>   </td>
							<td>   </td>
							<td class="text-right"><h4><strong>Kembalian: </strong></h4></td>
							<td class="text-center text-danger"><h4><strong id="sisa">Rp.</strong></h4></td>
						</tr>';
			
					
					echo'</tbody>
				</table>
				<button type="button" onclick="rekap('.$id.')" class="btn btn-success btn-lg btn-block" disabled>
					Bayar <span class="glyphicon glyphicon-chevron-right"></span>
				</button></td>
			</div>';
?>