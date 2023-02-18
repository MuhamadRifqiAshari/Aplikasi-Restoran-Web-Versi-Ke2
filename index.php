<!DOCTYPE html>
<?php
	include "connection/koneksi.php";
	session_start();
	if(isset ($_SESSION['username'])){
		header('location: beranda.php');
	} else {
?>
<html lang="en">
<head>
	<title>Masuk || Restaurant</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->

	<link rel="icon" type="image/png" href="template/masuk/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template/masuk/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template/masuk/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template/masuk/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template/masuk/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="template/masuk/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template/masuk/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template/masuk/css/util.css">
	<link rel="stylesheet" type="text/css" href="template/masuk/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('template/masuk/images/pizza-baked-chesse-spicy.jpg');">
			<div class="wrap-login100 p-t-120 p-b-30">
				<form action="" method="post" class="login100-form validate-form">
					<?php 
						if(isset($_SESSION['eror'])){
					?>
						<div class='container'>	
							<div class = 'alert alert-danger'>
								<span>
									<center>Mungkin Akun Anda Salah Atau Belum Divalidasi</center>
								</span>
							</div> 
						</div>
					<?php 
						unset($_SESSION['eror']);
						}
					?>
					<div class="login100-form-avatar">
						<img src="template/masuk/images/logo1.png" alt="AVATAR">
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
						RESTAURANT
					</span>
					<div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>

					<div class="container-login100-form-btn p-t-10">
						<button type="submit" name="login" class="login100-form-btn">
							Login
						</button>
					</div>
					<?php 
						if(isset($_SESSION['username'])){
					?>
					<div class="text-center w-full">
						<a class="txt1" href="logout.php">
							Log Out
							<i class="fa fa-long-arrow-right"></i>						
						</a>
					</div>
					<?php
						} else {
					?>
					<br><br><br><br><br>
					<div class="text-center w-full">
						<a class="txt1" href="daftar.php">
							Create new account
							<i class="fa fa-long-arrow-right"></i>						
						</a>
					</div>
					<?php
						}
					?>
				</form>
			</div>
		</div>
	</div>

	<?php
		if(isset ($_REQUEST['login'])){
			$arr_level = array();
			$c_level = mysqli_query($conn, "select * from tb_level");

			while($r = mysqli_fetch_array($c_level)){
				array_push($arr_level, $r['nama_level']);
			}
			foreach ($arr_level as $kontens) {
				//echo $kontens." || ";
			}
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];

			$akun = mysqli_query($conn, "select * from tb_user natural join tb_level");
			echo mysqli_error($conn);
			while($r = mysqli_fetch_array($akun)){
				if($r['username'] == $username and $r['password'] == $password and $r['status'] == 'aktif'){
					$_SESSION['username'] = $username;
					$_SESSION['id_user'] = $r['id_user'];
					$_SESSION['level'] = $r['id_level'];
					if(isset($_SESSION['eror'])){
						unset($_SESSION['eror']);
					}
					header('location: beranda.php');
					//echo "<br>";
					//echo $r['username'] . " || " . $r['password'] . " || " . $r['id_level'] . " || " . $r['nama_level'];
					//echo "<br></br>";
					break;
				} else {
					$_SESSION['eror'] = 'salah';
					header('location: index.php');
				}
			} 
		} 
	?>
	
	

	
<!--===============================================================================================-->	
	<script src="template/masuk/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="template/masuk/vendor/bootstrap/js/popper.js"></script> 
	<script src="template/masuk/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="template/masuk/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="template/masuk/js/main.js"></script>

</body>
</html>
<?php
	}
?>