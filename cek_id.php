<?php
	session_start();
	if(!isset($_COOKIE['id_plg'])){
		echo"no";
	}else{
		echo"yes";
	}
	
?>