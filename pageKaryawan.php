<?php
	session_start();
	if(empty($_SESSION['email'])){
		header('location:index.php');
	}
		?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Karyawan</title>
		<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script type = "text/javascript"src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type = "text/javascript"src = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		
		<script type = "text/javascript" language = "javascript">	
			$(document).ready(function() {
				
				$("#men").click(function(){
				   $("#side").toggle( "slide", { direction: "left"  }, 1000 );
				});
				
				$(".list-group .list-group-item").click(function(){
					$(this).addClass('aktif-menu');
					$(this).siblings().removeClass('aktif-menu');
				
					target = $(this).attr('href');
					$('#main-menu > div').not(target).hide();
					$(target).fadeIn(800);
					
					return false;
				});
				
				$('[data-toggle="tooltip"]').tooltip();
				
				$('#menu-setting').popover({
					html: true,
					content: '<a id="pop" href="logout.php" style="background-color:white;"><i class="fa  fa-sign-out"></i> Log Out</a>',
					container: '#side',
					trigger: 'focus'
				});
				
				$('.msg_head').click(function(){
					$('.msg_wrap').slideToggle('slow');
				});
				
				$('.close').click(function(){
					$('.msg_box').hide();
				});
				
				$('#menu-pesan').click(function(){
					$('.msg_wrap').show();
					$('.msg_box').show();
					$('#msg_input').focus();
					$('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
				});
				
				$('#btn-chat').click(function(){
						var msg = $('#msg_input').val();
							
							if(msg!=''){
								send_message(msg);
							}		
					
				});
				
				$('#msg_input').keypress(
					function(e){
						if(e.keyCode == 13){
							var msg = $('#msg_input').val();
							
							if(msg!=''){
								send_message(msg);
							}		
						}
					
				});
				
				function send_message(message) {
					var xmlhttp = new XMLHttpRequest();
				
					xmlhttp.onreadystatechange = function(){
						if(xmlhttp.readyState==4&&xmlhttp.status==200){
							document.getElementById('msg_input').value="";
							document.getElementById('logs-msg').innerHTML = xmlhttp.responseText;
							$('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
						}
					}
					xmlhttp.open('GET','pesan_k.php?msg='+message,true);
					xmlhttp.send();
				}
				
				$.ajaxSetup({cache:false});
				function get_messages() {
					$('.msg_body .chat').load("get_msg.php");
				}
				setInterval(get_messages,2000);
				
					
				$("#tambah").validator().on('submit', function (e) {
					if (e.isDefaultPrevented()) {
						return false;
						//invalid form do something...
					} else {
						var formData = new FormData(this);
						
						$.ajax({
							type: 'POST',
							url: 'add_menu.php',
							data: formData,
							cache:false,
							contentType: false,
							processData: false,
							success: function(data){
								if(data!="gagal"){
								$('#myModal').modal('hide');
								$("#table-menu").append(data);
								}else{
									alert('Nomor menu sudah ada!');
								}
							}
						});
					}
					return false;
				});
				
				$("#body").submit(function(e){
					e.preventDefault();
					var data = new FormData(this);
					
					$.ajax({
						type: 'POST',
						url: 'update_menu.php',
						data: data,
						cache:false,
						contentType: false,
						processData: false,
						success: function(hasil){
							if(hasil="yes"){
								$('#update').modal('hide');
							}
							setTimeout(function() {
								// Do something after 5 seconds
								$("#viewmenu").load('view_menu.php');
							}, 500);
						}
					});
					
					return false;
				}); 
				
				
				$('.scroll a').click(function(){
					var val = $(this).attr('href');
					if(val=="down"){
						$('html,body').animate({
							scrollTop: $("footer").offset().top},'slow');
						return false;
					}else{
						$('html,body').animate({
							scrollTop: $(".nav-top").offset().top},'slow');
						return false;
					}
				});	
			});
			
			function update(nomor){
				$.post("show_update.php", {nomor : nomor}, function(result){
					$("#body").html(result);
				});
			}
			function del(nomor){
				$.post("delete_menu.php", {nomor : nomor}, function(result){
					if(result=="yes"){
						$("#"+nomor).parent().parent().remove();
					}else{
						alert(result);
					}
				});
			}
			function check(){
				return confirm('Apakah ingin menghapus akun ?');
			}
			function rekap(id){
				
				if($('#input-bayar').val()!=''){
					$.post('rekap.php',{id : id}, function(result){
						if(result!='no'){
							$('#bayar').modal('hide');
							function load(){
								$("#load").load('vieworder.php');
							}
							setTimeout(load,500);		
						}
					}); 
				}
				
				return false;
			}
			function viewJumlah(id,no_meja){
				$('#bayar :submit').attr('id',id);
				
				$.get('get_jumlah.php',{id:id , no_meja:no_meja},function(result){
					$('#bayar .modal-body').html(result);
				});
				
			}
			function hitung(bayar,jumlah){
				var sisa = bayar - jumlah;
				var output = (sisa/1000).toFixed(3);
				$('#sisa').text('Rp. '+output);
				if(bayar>jumlah){
					$('.well button').removeAttr('disabled');
				}else{
					$('.well button').attr('disabled','true');
				}
			}
		</script>
		
		<style>
			body{
				background-image:url(bg_dotted.png);
				height:100%;
			}
			#side{
				float:left;
				width:271px;
				background-color:black;
			}
			.menu-utama{
				font-size:20px;
				text-align:center;
				padding:15px 0px;
				color:white;
				background:black;
			  }
			  .f li{
				  float:none;
				  display:inline-block;
			  }
			  .list-group-item,.nav-tabs{
				  background:black;
				  border:0;
				  border-radius:0;
			  }
			  .list-group-item,.nav-tabs li a:hover{
				  border-radius:0;
			  }
			  footer{
				  height:60px;
			  }
			  .aktif-menu{
				  background-color:rgba(255, 255, 255, 0.2);
				  border-left:7px solid lightblue;
				  border-radius:0;
			  }
			  .aktif{
				  background-color:rgba(255,255,255,0.2);
				  border:0;
				  border-radius:0;
			  }
			  .list-group .list-group-item:focus{
				  border-left:7px solid lightblue;
				  background:rgba(255,255,255,0.2);
				  border-radius:0;
			  }
			  .list-group .list-group-item:hover{
				  background:rgba(255,255,255,0.6);
				  border-radius:0;
			  }
			  ul.nav-tabs li a:hover{
				  background:rgba(255,255,255,0.6);
				  border:0;
				  border-radius:0;
			  }
			  ul.nav-tabs li a:focus,.nav-tabs li a:active{
				  background:rgba(255,255,255,0.2);
				  border:0;
				  border-radius:0;
			  }
			  .navbar-order{
				  padding:12px;
				  overflow:hidden;
				  height:50px;
				  background-color:#27dbd3;
				  color:white;
				  font-size:20px;
			  }
			  .scroll{
				  font-size:16px;
				  position:fixed;
				  bottom:35px;
				  right:25px;
			  }
			  .table a{
				  font-size:12px;
			  }
			  .popover .popover-title{
				  background:blue;
				  color:white;
			  }
			  .msg_box{
				position:fixed;
				bottom:0px;
				left:20px;
				right:20px;
				z-index:9999;
				background:white;
				border-radius:5px 5px 0px 0px;
				padding:0px;
			}
			
			.chat
			{
				list-style: none;
				margin: 0;
				padding: 0;
			}

			.chat li
			{
				margin-bottom: 10px;
				padding-bottom: 5px;
				border-bottom: 1px dotted #B3A9A9;
			}

			.chat li.left .chat-body
			{
				margin-left: 60px;
			}

			.chat li.right .chat-body
			{
				margin-right: 60px;
			}


			.chat li .chat-body p
			{
				margin: 0;
				color: #777777;
			}

			.panel .slidedown .glyphicon, .chat .glyphicon
			{
				margin-right: 5px;
			}

			.msg_body
			{
				overflow-y: scroll;
				height: 250px;
			}

			::-webkit-scrollbar-track
			{
				-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
				background-color: #F5F5F5;
			}

			::-webkit-scrollbar
			{
				width: 12px;
				background-color: #F5F5F5;
			}

			::-webkit-scrollbar-thumb
			{
				-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
				background-color: #555;
			}
			.table-hover input:focus{
				outline:none;
			}
		</style>
	</head>
	<body id="mm">
		
		<nav class="navbar navbar-default nav-top">
			<div class="container-fluid">
				<div class="navbar-header" style="width:208px;">
					<a class="navbar-brand"  href="index.php"><i class="fa fa-coffee"></i>  Beranda</a>
				</div>
				<ul class="nav navbar-nav" style="">
					<li><a href="#" class="" id="men" style="background:black; color:white;"><i class="fa fa-bars" style="font-size:20px;"></i></a></li>
				</ul>
				<?php
					if(isset($_SESSION['email'])){
						echo '<div class="btn btn-default pull-right" style="margin-top:8px;">'.$_SESSION['email'].'</div>';
					}
				?>
			</div>
		</nav>
		
		<div class="container-fluid" style=" margin-top:-20px;">
			<div class="row" style="height:100%;">
				<div id="side" style="height:100%;">
					<div class="menu-utama">
						<strong>Menu Utama</strong>
					</div>
					<div class="">
						<div class="list-group">
							<a href="#beranda" class="list-group-item aktif-menu" style="color:white; border-radius:0;"><i class="fa fa-home" style="font-size:20px;"></i>  DASBOR</a>
							<a href="#pemesanan" class="list-group-item" style="color:white;"><i class="fa fa-list" style="font-size:20px;"></i>  PEMESANAN</a>
							<a href="#tambah-menu" class="list-group-item" style="color:white; border-radius:0;"><i class="fa fa-edit" style="font-size:20px;"></i> TAMBAH MENU</a>
						</div>
					</div>
					<div style="margin-top:363px;">
						<ul class="nav nav-tabs nav-justified text-center">
							<li><!--<span class="badge pull-right">3--></span><a id="menu-pesan" href="#pesan" style="color:white;"><i class="fa fa-envelope-o" style="font-size:20px;"></i><br/>Pesan</a></li>
							<li><a href="#" style="color:white;"><i class="fa fa-book" style="font-size:20px;" ></i><br/>Request</a></li>
							<li><a id="menu-setting" href="#" style="color:white;" title="Account" data-toggle="popover" data-trigger="focus" data-placement="top" ><i class="fa fa-user" style="font-size:20px;"></i><br/>Karyawan</a></li>
						</ul>
					</div>
				</div>
				
				<div id="manok" style="position:absolute; z-index:1; ">
					
					</div>
				
				<div id="main-menu" style="position:relative; overflow:hidden; height:100%;">
					
					<div id="beranda" style="overflow:hidden;">
						<nav class="navbar-order text-center">
							<i class="fa fa-address-book" ></i> Profil
						</nav><br/>
						<div id="profil" class="col-md-8 col-md-offset-2">
							<?php include'profil.php';?>
						</div>
					</div>
					
					<div id="tambah-menu" style="padding:30px; overflow:hidden; display:none;">
						<nav class="navbar-order">
							<i class="fa fa-file" ></i> Tambah Menu
						</nav>
						<div class="container-fluid" id="viewmenu">
								<?php include"view_menu.php";?>	
						</div>
						<div class="container-fluid text-center">
							<a href="#myModal" class="btn btn-primary" data-toggle="modal">Tambah Menu</a>
						</div>
					
					</div>
					
					<div id="pemesanan" class="text-center" style="display:none;">
						<nav class="navbar-order">
							<i class="fa fa-shopping-cart" ></i> Pemesanan
						</nav>
						<div id="load">
							<?php include'vieworder.php';?>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<!--MODAL TAMBAH MENU-->
					<div class="modal fade" id="myModal">
							<div class="modal-dialog modal-md">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h3>Tambah Menu</h3>
									</div>
									<div class="modal-body">
										<form id="tambah" enctype="multipart/form-data" data-toggle="validator" role="form">
											<div class="form-group">
												<div class="form-group has-feedback">
													<label class="control-label" for="nomenu">No Menu :</label>
													<input type="text" class="form-control" pattern="^[_A-z0-9]{4}$" name="no_menu" id="nomenu" placeholder="Nomor Menu" required />
													<span class="glyphicon form-control-feedback"></span>
												</div>
												<div class="form-group has-feedback">
													<label class="control-label" for="namamenu">Nama Menu :</label>
													<input type="text" class="form-control" pattern="^[_A-z ]{1,}$" name="namamenu" id="namamenu" placeholder="Nama Menu" required />
													<span class="glyphicon form-control-feedback"></span>
												</div>
												<div class="form-group">
													<label for="jenis">Jenis Menu :</label>
													<select name="jenis_menu" class="form-control" id="jenis" required>
														<option value="0" disabled>Jenis Menu</option>
														<option value="Makanan">Makanan</option>
														<option value="Minuman">Minuman</option>
													</select>
												</div>
												<div class="form-group has-feedback">
													<label class="control-label" for="harga">Harga :</label>
													<input type="text" class="form-control" pattern="^[_0-9]{4,}$" name="harga" id="harga" placeholder="Harga" required />
													<span class="glyphicon form-control-feedback"></span>
												</div>
												<div class="form-group has-feedback">
													<label class="control-label" for="gambar">Gambar Menu :</label>
													<input type="file"  id="image" accept="image/" name="image" required />
												</div>
													<input type="submit" class="btn btn-primary btn-block" name="submit" value="TAMBAH">
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					  <!-- /.modal-dialog -->
					</div>
					
				<!--MODAL Update Menu-->
					<div id="update" class="modal fade" role="dialog">
						<div class="modal-dialog modal-">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h3>Update Menu</h3>
								</div>
								<div class="modal-body">
									<form id="body">
									</form>
								</div>
							</div>
						</div>
					</div>
					
					<div class="scroll">
						<a href="up"><i class="fa fa-chevron-circle-up"></i></a><br>
						<a href="down"><i class="fa fa-chevron-circle-down"></i></a>
					</div>
			
		<div class="col-md-5 msg_box" style="display:none">
            <div class="panel panel-primary " style="margin:0px;">
                <div class="panel-heading msg_head" style="cursor:pointer">
                    <span class="glyphicon glyphicon-comment"></span> Chat Room
                    <div class="btn-group pull-right" style="color:white">
                        <div class="close" style="color:white"><i class="fa fa-close" style="color:white"></i></div>
                    </div>
                </div>
				<div class="msg_wrap">
                <div class="panel-body msg_body">
                    <ul class="chat" id="logs-msg">
                        <?php include'get_msg.php'?>
                        
                    </ul>
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input id="msg_input" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                        <span class="input-group-btn">
                            <button class="btn btn-warning btn-sm" id="btn-chat">Send</button>
                        </span>
                    </div>
                </div>
				</div>
            </div>
        </div>

			
		<footer class="navbar-default text-center" style="padding-top:20px; width:100%;">
			 copyright <i class="fa fa-copyright"></i> 2017 all right reserved
		</footer>
		
		<div class="modal fade" id="bayar">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4>Pembayaran</h4>
					</div>
					<div class="modal-body">
						
						
					</div>
				</div>
			</div>
		</div>	
		
	</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
