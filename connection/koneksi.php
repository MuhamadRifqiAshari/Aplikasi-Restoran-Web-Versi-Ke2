<?php
	$host = "localhost";
	$user = "root";
	$pass = "";
	
	$db = "db_restoran";
	$conn = mysqli_connect($host,$user,$pass,$db);
	mysqli_select_db ($conn, $db);
	
	if (!$conn) {
   		die('Maaf koneksi gagal: '. $connect->connect_error);
	}
	else{
		//echo 'Tahu';
		//echo $_SESSION['viewnya'];
	}	
?>