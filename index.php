<?php
	session_start();
	if(isset($_SESSION['email']))
		header('location:pageKaryawan.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Transit Cafe</title>
		<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="animate/css/animations.css" type="text/css">
		<link rel="stylesheet" href="alert/sweetalert2.min.css">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script type = "text/javascript"src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type = "text/javascript"src = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script src="alert/sweetalert2.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		
		<style>
			body{
				background-color:rgba(89, 81, 108, 1);
				margin:0;
			}
			.input-group span,.input-group input{
				border-radius:0;
			}
			
			.person {
				  border: 10px solid transparent;
				  margin-bottom: 25px;
				  opacity: 0.8;
			}
			.person:hover {
				border-color: #f1f1f1;
			}
			.cap{
				position:absolute; 
				width:35%;
				top:65% ; 
				left:5%; 
				z-index:1; 
				left:-520px;
				color:white;
				-webkit-animation: slide 1s forwards;
				-webkit-animation-delay: 20s;
				animation-delay: 20s;
				animation: slide 1s forwards;
				
			}

			@-webkit-keyframes slide{
				100% {left:50px;}
			}

			@keyframes slide{
				100% {left:50px;}
			}
			.box{
				padding:10px;
				height:250px;
				background-color:#3489e8;
				color:white;
				cursor:pointer;
				-webkit-box-shadow: 2px 2px 25px -4px rgba(0,0,0,0.75);
				-moz-box-shadow: 2px 2px 25px -4px rgba(0,0,0,0.75);
				box-shadow: 2px 2px 25px -4px rgba(0,0,0,0.75);
			}
			
			.box i{
				font-size:70px;
				color:white;
			}
			.box span{
				font-size:25px;
				font-family:Calibri;
			}
			.box p{
				margin-top:10px;
				font-size:18px;
				font-family:Calibri;
			}
			.box2{
				background-color:#f2af29;
			}
			.header-top{
				margin:0px; 
				padding:15px 25px; 
				background:url('image/header.jpg') no-repeat;
				background-size:cover;
				background-attachment;fixed;
			}
			.show{
				background:url('image/pattern1.png') repeat;
				position:absolute;
				left:0px;
				z-index:1;
				width:100%;
				height:100%;
			}
			.show1{
				background:url('image/pattern1.png') repeat;
				position:absolute;
				left:0px;
				z-index:0;
				width:100%;
				height:100%;
			}
			.head{
				border-bottom:3px solid #f7c31f;
				box-shadow: 2px 11px 7px -10px rgba(0,0,0,0.75);
				margin-bottom:7px;
				position:relative;
			}
			.scroll{
			    font-size:16px;
				position:fixed;
				bottom:10px;
				right:15px;
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
			
			#band{
				font-family:Arial-Bold;
				border:1px solid rgba(249,248,248,0.8);
				background-image: url(image/carry_code.jpg);
				background-size: cover;
				color:white;
				position:relative;
			}
			.person{
				opacity:1;
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

			.panel-body
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
			.bio{
				-webkit-box-shadow: 2px 2px 25px -4px rgba(0,0,0,0.75);
				-moz-box-shadow: 2px 2px 25px -4px rgba(0,0,0,0.75);
				box-shadow: 2px 2px 25px -4px rgba(0,0,0,0.75);
			}
			
			@media only screen and (max-width: 756px){
				.mb{
					margin-bottom:20px;
				}
			}

		</style>

		<script>
			$(document).ready(function(){
				$('.row').click(function(){
				$('[data-toggle="popover"]').popover('hide'); 
				});
				
				$('#signup').validator().on('submit', function (e) {
				  if (e.isDefaultPrevented()) {
					return false;
					//invalid form do something...
				  } else {
					$.ajax({
						type : 'POST',
						url : 'signup.php',
						data : $('#signup').serialize(),
						success : function(hasil){
							if(hasil=="yes"){
								swal({
								  text: 'Sedang di Proses...',
								  imageUrl: 'alihkan.gif',
								  imageWidth: 100,
								  imageHeight: 100,
								  showConfirmButton: false,
								  animation: false
								});
								
								function alihkan(){
									swal('Pendaftaran Berhasil Tunggu Konfirmasi Account');
								}
								setTimeout(alihkan,3000);
							}else{
								swal('Akun Sudah Ada!');
								return;
							}
						}
					});
				  }
				  return false;
				});
				
				
				$("#login").submit(function(){
					$.ajax({
						type : 'POST',
						url : 'login.php',
						data : $('#login').serialize(),
						success : function(hasil){
							if(hasil=="yes"){
								document.location="pageKaryawan.php";
							}else if(hasil=='lock'){
								swal('Akun anda belum terkomfirmasi!');
							}else if(hasil=='ok'){
								$('[data-toggle="popover"]').popover('show'); 
								$('#login input[type=password]').parent().addClass('has-feedback has-error');
							}else{
								swal('Akun anda Salah!');
							}
						}
					});
					return false;
				});
				
				$(".box").mousedown(function(){
					$(this).css("transform","scale(0.95)");
				});
				$(".box").mouseup(function(){
					$(this).css("transform","scale(1)");
				});
				$(".box-pesan button").click(function(){
					$(this).parent().parent().hide();
				});
				
				$('.scroll a').click(function(){
					var val = $(this).attr('href');
					if(val=="down"){
						$('html,body').animate({
							scrollTop: $("footer").offset().top},'slow');
						return false;
					}else{
						$('html,body').animate({
							scrollTop: $(".head").offset().top},'slow');
						return false;
					}
				});
				
				$('.msg_head').click(function(){
					$('.msg_wrap').slideToggle('slow');
				});
				
				$('.close').click(function(){
					$('.msg_box').hide();
				});
				
				$('#msg').click(function(){
					$.get('cek_id.php',function(hasil){
						if(hasil=='yes'){
							$('.msg_wrap').show();
							$('.msg_box').show();
							$('#msg_input').focus();
							$('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
						}else{
							swal('Anda harus melakukan order!');
						}
					});
				});
				
				$('#btn-chat').click(
					function(){
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
					xmlhttp.open('GET','kirimpesan.php?msg='+message,true);
					xmlhttp.send();
				}
				
				$.ajaxSetup({cache:false});
				function get_messages() {
					$('.msg_body .chat').load("ambil.php");
				}
				setInterval(get_messages,2000);
			});			
		</script>
		
	</head>
	<body>
		
		<div class="head">
			<div class="show1"></div>
			<div class="row header-top">
				<div class="pull-right">
					<form id="login" style="width:260px;">
						<div class="input-group" style="margin-bottom:1.5px;">
							<span class="input-group-addon" style="background-coor:#f58f15; color:wite;">
								<i class="glyphicon glyphicon-user"></i>
							</span>
							<input type="email" class="form-control" name="email" placeholder="Email" autocomplete="off">
						</div>
						<div class="input-group">
							<span class="input-group-addon" data-toggle="popover" data-trigger="focus" data-content="Password Salah!" data-placement="left" style="color:whie; ">
								<i class="glyphicon glyphicon-lock"></i>
							</span>
							<input type="password" class="form-control" name="pass" placeholder="Kata Sandi">
							<span class="input-group-btn">
								<button type="submit" name="submit" class="btn btn-info" style="border-radius:0;"><i class="fa  fa-sign-in" style="font-size:18px; color:white;"></i></button>
							</div>
						</div>
					</form>
				</div>
			</div>	
		</div>
			
		<div class="row" style="margin:0px; position:relative;">
			<div class="show"></div>
		  <div id="myCarousel" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
			  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			  <li data-target="#myCarousel" data-slide-to="1"></li>
			  <li data-target="#myCarousel" data-slide-to="2"></li>
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner">
			
				<div class="item active">
				<img src="image/back1.jpg" alt="Los Angeles" style="image-rendering: pixelated; width:100%; height:400px;">
				<div class="cap" style="animation-delay: 1.5s;">
					<div style="background-color:#f4bc42; font-size:20px;">
						White Coffee
					</div>
					<div style="margin-top:5px; text-align:justify; border-left:5px solid #f4bc42; padding:0px 5px; background-color:rgba(0, 0, 0, 0.5);">
						<p>White coffee sangat pas untuk dinikmati saat melakukan traveling atau sambil menikmati film favorite anda.
							Manfaat White Coffee bisa mencegah penyakit saraf, melindungi kulit dan gigi, tidak menyebabkan sakit maag, mencegah DM dan batu empedu.
						</p>
					</div>
				</div>
				</div>

				<div class="item">
				<img src="image/back6.jpg" alt="Chicago" style="image-rendering: pixelated; width:100%; height:400px;">
				<div class="cap" style="animation-delay: 1.5s;">
					<div style="background-color:#f4bc42; font-size:20px;">
						Kopi Espresso
					</div>
					<div style="margin-top:5px; text-align:justify; border-left:5px solid #f4bc42; padding:0px 5px; background-color:rgba(0, 0, 0, 0.5);">
						<p>Espresso yang bagus akan membuat banyak dampak kebaikan untuk tubuh Anda. Ada beberapa Manfaat dari kopi espresso seperti
							meningkatkan energi, rendah kalori, menurunkan resiko kanker mulut, tenggorokan, dan hati, menghentikan perkembangan diabetes.
						</p>
					</div>
				</div>
				</div>
				
				<div class="item">
				<img src="image/back5.jpg" alt="New York" style="image-rendering: pixelated; width:100%; height:400px;">
				<div class="cap" style="animation-delay: 1.5s;">
					<div style="background-color:#f4bc42; font-size:20px;">
						Kopi Latte
					</div>
					<div style="margin-top:5px; text-align:justify; border-left:5px solid #f4bc42; padding:0px 5px; background-color:rgba(0, 0, 0, 0.5);">
						<p>White coffee sangat pas untuk dinikmati saat melakukan traveling atau sambil menikmati film favorite anda.
							Manfaat White Coffee bisa mencegah penyakit saraf, melindungi kulit dan gigi, tidak menyebabkan sakit maag, mencegah DM dan batu empedu.
						</p>
					</div>
				</div>
				</div>
			</div>

			<!-- Left and right controls -->
			
			<a class="left carousel-control" href="#myCarousel" data-slide="prev" style="z-index:9999">
			  <span class="glyphicon glyphicon-chevron-left"></span>
			  <span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#myCarousel" data-slide="next" style="z-index:9999">
			  <span class="glyphicon glyphicon-chevron-right"></span>
			  <span class="sr-only">Next</span>
			</a>
		  </div>
		  
		</div>
		
		
		<div style="overflow:hidden;">
			<div class="row" style="padding:20px 20px; margin:0px; width:100%;" >
				
				<div class='animatedParent'>
					<div class=" row animated bounceInUp padded" style="padding:10px 15px; margin:0px; margin-bottom:15px; background-color:#f4f3ef">
						<div class="pull-left">
						<span style="font-size:16px;"><strong>Penting!</Strong></span><br/>
						<span>Silahkan klik tombol di samping untuk melakukan pemesanan terlebih dahulu.</span>
						</div>
						<a id="let" href="pagePelanggan.php" class="btn btn-info pull-right" style="margin-top:5px;">Mulai Memesan</a>
					</div>
				</div>
				
				<div class="col-sm-8 fitur" style=" padding:0px;">
					<div class="col-md-5" id="msg" style="padding:0px;">
						<div class="box">
							<i class="fa  fa-comments"></i>
							<br><span>Obrolan</span>
							<p class="text">Menu ini digunakan untuk obrolan pengunjung dengan pelayan Transit Cafe.</p>
							<i class="fa fa-arrow-circle-o-right pull-right" style="font-size:30px; "></i>
						</div>
						<div class="mb" style="margin-top:20px; height:130px; background-image:url(g1.jpg); background-size:cover;">
						</div>
					</div>
					<div class="col-md-5 col-md-offset-1" style="padding:0px;" data-target="#help" data-toggle="modal" data-keyboard="false" data-backdrop="static">
						<div class="box box2" >
							<i class="fa  fa-question-circle-o"></i>
							<br><span>Bantuan</span>
							<p class="text">Menu Bantuan digunakan untuk memberi petunjuk kepada pengunjung Transit Cafe.</p>
							<i class="fa fa-arrow-circle-o-right pull-right" style="font-size:30px;"></i>
						</div>
						<div class="mb" style="margin-top:20px; height:130px; background-image:url(g2.jpg); background-color:#f2af29;">
						</div>
					</div>
				</div>
				
				
				<div class="bio col-md-4" style="padding:0px; background:#E8F0f0;">
					<div style="height:60px; overflow:hidden; width:100%; padding:0px 0px 0px 25px; background:#f58f15">
						<h3 style="color:white;"><i class="fa fa-address-book"></i> Daftar</h3> 
					</div>
						<form id="signup" data-toggle="validator" role="form" class="form-horizontal" style="margin:10px; padding:15px; background:white;">
						  <div class="form-group has-feedback">
							<label class="control-label col-sm-2" for="nama">Nama</label>
							<div class="col-sm-offset-1 col-sm-9">
							  <input type="text" class="form-control" pattern="^[_A-z]{4,}$" id="nama" name="nama" placeholder="Masukkan Nama" required>
							  <span class="glyphicon form-control-feedback"></span>
							</div>
						  </div>
						  <div class="form-group has-feedback">
							<label class="control-label col-sm-2" for="email">Email</label>
							<div class="col-sm-offset-1 col-sm-9"> 
							  <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email" required>
							  <span class="glyphicon form-control-feedback"></span>
							</div>
						  </div>
						  <div class="form-group has-feedback"> 
							<label class="control-label col-sm-2">&nbspKata&nbsp;Sandi</label>
							<div class="col-sm-offset-1 col-sm-9">
							  <input type="password" class="form-control" data-minlength="6" name="pwd" id="pwd" placeholder="Kata Sandi" required>
							  <span class="glyphicon form-control-feedback"></span>
							</div>
						  </div>
						  <div class="form-group has-feedback"> 
							<label class="control-label col-sm-2">&nbspTanggal&nbsp;Lahir</label>
							<div class="col-sm-offset-1 col-sm-9">
							  <input type="date" class="form-control" name="birthday" id="birthday" required>
							  <span class="glyphicon form-control-feedback"></span>
							</div>
						  </div>
						  <div class="form-group has-feedback"> 
							<label class="control-label col-sm-2">&nbspJenis&nbsp;Kelamin</label>
							<div class="col-sm-offset-1 col-sm-9" style="padding-top:7px;">
								<input type="radio" name="gender" value="Perempuan" required>Perempuan
								<input type="radio" name="gender" value="Laki-laki" required>Laki-laki
							</div>
						  </div>
						  <div class="form-group"> 
							<div class="col-sm-offset-3 col-sm-9">
							  <button type="submit" class="btn" style="background:#1aa570; color:white;"><i class="fa fa-check-circle"></i> Daftar</button>
							</div>
						  </div>
						</form>

				</div>
			</div>
			
			<div id="band" class=" text-center">
				<div class="show1"></div>
				<div class='animatedParent'>
					<h2 class='animated growIn' style="letter-spacing:5px;">Kontak Kami</h2>
				</div>
					
			  <br>
			  
			  <div class="row" style="width:100%; margin-left:-3px;">
				
				<div class="col-sm-4">
				  <p class="text-center"><strong>Maksalmina</strong></p><br>
				  <a href="#demo" data-toggle="collapse">
					<img src="https://scontent.fcgk1-1.fna.fbcdn.net/v/t1.0-9/13263745_562681700579105_1354797464789980284_n.jpg?oh=933b86eedde1d031e34e53c76b1392a1&oe=598B7EBE" class="img-circle person" alt="Random Name"  width="170" height="170">
				  </a>
				  <div id="demo" class="collapse">
					<p>Pemilik Transit Cafe</p>
					<p>Jomblo</p>
					<p>+62822-4250-5463</p>
				  </div>
				</div>
				<div class="col-sm-4">
				  <p class="text-center"><strong>Safrul Huda</strong></p><br>
				  <a href="#demo2" data-toggle="collapse">
					<img src="back1.png" class="img-circle person" alt="Random Name" width="170" height="170">
				  </a>
				  <div id="demo2" class="collapse">
					<p>Manager Transit Cafe</p>
					<p>Suka Drakor</p>
					<p>+62853-6472-7240</p>
				  </div>
				</div>
				<div class="col-sm-4">
				  <p class="text-center"><strong>Rifki Maulana</strong></p><br>
				  <a href="#demo3" data-toggle="collapse">
					<img src="https://hairstyleonpoint.com/wp-content/uploads/2014/10/tumblr_mtyowjf1Qt1s42kygo1_500.jpg" class="img-circle person" alt="Random Name" width="170" height="170">
				  </a>
				  <div id="demo3" class="collapse">
					<p>Kepala Pelayan</p>
					<p>Jomblo</p>
					<p>+62823-6295-4274</p>
				  </div>
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
                        <?php include'ambil.php'?>
                        
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
		
		<div class="modal fade" id="help" role="dialog">
			<div class="modal-dialog modal-lg">
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Bantuan</h4>
				</div>
				<div class="modal-body">
					<h4>Pelanggan</h4>
					<ul>
						<li><strong>Menu Let's Order</strong></li> 
							adalah menu yang disediakan untuk memesan makanan atau minuman.
						<li><strong>Menu Chatting</strong></li>
							adalah menu yang disediakan untuk mengobrol antara pelanggan dengan pelayan.
					</ul>
					<h4>Karyawan</h4>
					<ul>
						<li><strong>Form Signup</strong></li>
							Digunakan untuk mendaftar karyawan.
						<li><strong>Form Login</strong></li>
							Digunakan untuk masuk ke halaman manajemen cafe.
					</ul>
					<h4><strong>PERHATIAN</strong><h4>
						<p>Form sign up dan login hanya digunakan oleh karyawan caffe.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
			  </div>
			</div>
		  </div>
		
		<footer class="navbar-default text-center" style=" background-color:#E9F0F0; margin-top:px;padding-top:20px; height:60px; overflow:hidden;">
			 copyright <i class="fa fa-copyright"></i> 2017 all right reserved
		</footer>
	</body>
</html>
<script src='animate/js/css3-animate-it.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>