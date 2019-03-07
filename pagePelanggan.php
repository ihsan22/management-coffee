<!DOCTYPE html>
<html>
    <head>
        <title>Pemesanan</title>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Pelanggan</title>
		<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		
		<script type = "text/javascript"src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type = "text/javascript"src = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
		<link rel="stylesheet" href="alert/sweetalert2.min.css">
		<script src="alert/sweetalert2.min.js"></script>
		
		
    <script type = "text/javascript" language = "javascript">
		
		$(document).ready(function(){
			<?php 
			if(!isset($_COOKIE['nomeja']))
			{	
				belum();
			}else{
				echo"$('#isi-meja').removeAttr('href');";
				echo"$('#meja #no').val(2);";
			}
			function belum(){
			?>
				$('#myModal').modal('show');
				$('#isi-meja').removeAttr('readonly');
			<?php }?>
			
			$('.men ul li a').on('click', function () {
				target = $(this).attr('href');
				$('#box-men > div').not(target).hide();
				$(target).fadeIn(800);
				return false;
			});
			
			$("#menu input:checkbox").on('change', function(e){
				e.preventDefault();
				var nomor = $(this).val();
				
				if($(this).is(":checked")){
					$.post('pilih.php',{nomor : nomor},function(result){
						$("#tr1").after(result);
						total();
					});
				}else{
					$('#'+nomor).remove();
					total();
				}
			});
					
			$("#menu").bind("keypress", function(e) {
				if (e.keyCode == 13) {
					return false;
				}
			});
			
			$("#menu").submit(function(){
				var meja = $('#nomor-meja').text();
				if(meja!=""){
					if(!($("form input:checkbox").is(":checked"))){
						swal('isi menu dulu!');
						return false;
					}else{
						var val;
						$('input[name^="jumlah"]').each(function() {
							if($(this).val()==0 || $(this).val()==""){
								val='salah';
							}
						});
						if(val=='salah'){
							swal('jumlah belum diisi!');
							return false;
						}else{
							$.ajax({
								type: 'POST',
								url: 'sendorder.php',
								data: $('#menu').serialize()+'&nomeja='+meja,
								success:function(result){
									if(result=="yes"){
										swal({
										  title : 'Selamat Menikmati!',
										  type : 'success',
										  confirmButtonColor: '#3085d6',
										  confirmButtonText: 'OK!',
										}).then(function () {
											document.location="index.php"
										});
									}else{
										alert(result);
									}
								}
							});
						}
					}
				}else{
					swal("Isi Nomor Meja Dulu!");
					return false;
				}
				return false;
			});
			
			$("#meja").submit(function(){
				var nomeja = $("#no").val();
				if(nomeja!=null){
					$.post('setmeja.php',{nomeja:nomeja},function(hasil){
						if(hasil=='no'){
							swal('Meja sudah dipesan!');
						}else{
							$("#nomor-meja").text(nomeja);
							$('#myModal').modal('hide');
						}
					});
				}
				return false;
			});
			
		});	
				
		function hitung(jumlah,id){
			var harga =$('td #'+id).parent().prev().text();
			var jml = harga * jumlah;
			
			$('td #'+id).parent().next().children().val(jml);
			total();
		}
		function total(){
			var total=0;
			$('input[name^="jml"]').each(function() {
				total = total + parseInt($(this).val());
			});
			$('#totalbayar').val(total);
		}
			
    </script>
		
    <style>
		body{
			background-image:url(bg_dotted.png);
		}
		.daftar-menu,.rincian{
			margin:0;
			padding:0;
		}
		.rincian ul li{
			background-color:rgb(238, 238, 238);
		}
		.rincian ul li a:hover{
			color:rgb(51, 122, 183);
		}
		.box-food,.box-drink{
			margin:0px;
			padding:5px;
			overflow:hidden;
		}
		.box-food .box{
			margin-bottom:4px;
			margin-right:3px;
			display:inline-block; 
			padding:5px 25px;
			background-color:rgba(245,245,245,0.3);
		}
		.navbar-rincian{
			padding:11px 0px;
			background-color:#fa8500;
			color:white;
		}
		.navbar-default, .nav-justified li{
			border-radius:0px;
		}
    </style>
</head>
   <body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header" style="width:100%;">
					<a href="index.php" class="navbar-brand"><i class="fa fa-coffee"></i> Transit Cafe</a>
					<a href="#myModal" id="isi-meja" class="btn btn-info pull-right" data-toggle="modal"  style="margin-top:8px;"><i class="fa fa-map-marker"></i> Masukkan Nomor Meja</a>
				</div>

			</div>
		</nav>
		
		<div class="row" style="margin:0px; margin-top:-20px;">
		
			<form method="post" id="menu">
				<div class="daftar-menu col-md-7">
					<nav class="men">
						<ul class="nav nav-tabs nav-justified" style="background-color:white;">
							<li><a href="#makanan"><i class="fa fa-spoon"></i> Makanan</a></li>
							<li><a href="#minuman"><i class="fa fa-glass"></i> Minuman</a></li>
						</ul>
					</nav>
					
					<div id="box-men">
						<div class="makanan" id="makanan" style="border:0px solid gray;">
							<div class="box-food">
									<?php include'load_menu_makanan.php';?>
							</div>
						</div>
						
						<div class="minuman" id="minuman" style="border:px solid grey; display:none;">
							<div class="box-food">
									<?php include'load_menu_minuman.php';?>
							</div>
						</div>
					</div>
				</div>
				
				<div class="rincian col-md-5">
					<nav class="nav nav-tabs navbar-rincian text-center">
						<i class="fa fa-list"></i> Rincian
					</nav>
					
					<div class="text-center" style="padding-top:0px;">
						<h4>Nomor Meja : <span>
							<?php
								if(isset($_COOKIE["nomeja"]) ) {
									echo '<span id="nomor-meja">'.$_COOKIE["nomeja"].'</span>';
								}elseif(isset($_POST["nomeja"])){
									echo '<span id="nomor-meja">'.$_POST["nomeja"].'</span>';
								}else{
									echo '<span id="nomor-meja"></span>';
								}
							?>
						</span></h4>
						
						<div class="menu" style="display:inline-block;">
							<table border="1" class="table table-bordered" id="tabeldetail" style="background-color:white;">
								<thead>
									<tr id="tr1">
										<th>Food/Drink</th>
										<th>Harga(@)</th>
										<th>Jumlah Pesanan</th>
										<th>Jumlah Harga</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td colspan=3 align="right">JUMLAH TOTAL</td>
										<td><center><input type="text" id="totalbayar" value=0 style="border:0px; padding-left:5px; width:130px;" name="total" readonly></center></td>
									</tr>
								</tbody>
							</table>
						</div><br/>
						<button type="submit" class="submit btn btn-primary" name="submit"><i class="fa fa-send"></i> Pesan</button>
					</div>
				</div>
			</form>
		</div>
		
		<div class="modal fade" id="myModal">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3>Isi Nomor Meja</h3>
					</div>
					<div class="modal-body">
						<form id="meja">
							<div class="form-group text-center">
								<label for="nomenu">Meja</label>
								<select id="no" name="nomeja" class="form-control">
									<option value=null disabled selected>Nomor Meja</option>
									<?php
										for($i=1;$i<=30;$i++){
											echo'<option value="'.$i.'">'.$i.'</option>';
										}
									?>
								</select>
							</div>
							<div class="form-group text-center">
								<button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-map-marker"></i> Set</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>	
   </body>
</html>