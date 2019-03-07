<?php
	if(!isset($_SESSION)){
		session_start();
	}
	include"koneksi.php";
	$id=$_SESSION['email']; 
	
	$sql="SELECT DATE_FORMAT(sent_on,'%H:%i:%s') time,from_us,pesan FROM chatting ";
	$res = $conn->query($sql);
	
	while($row = mysqli_fetch_array($res)){
		$nama=$row['from_us'];
		if($nama==$id){
			$nama="Me";
		}
		else {
			$nama='PTC - '.$nama.'';
		}
		echo'<li class="left clearfix"><span class="chat-img pull-left">
				<img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
			</span>
				<div class="chat-body clearfix">
					<div class="header">
						<strong class="primary-font">'.$nama.'</strong> <small class="pull-right text-muted">
							<span class="glyphicon glyphicon-time"></span>'.$row['time'].'</small>
					</div>
					<p>
						'.$row['pesan'].'
					</p>
				</div>
			</li>';
	}
?>