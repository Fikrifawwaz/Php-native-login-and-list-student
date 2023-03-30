<?php 

session_start();
require 'functions.php';

// cek cookie
if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	// ambil username berdasarkan id

	$result = mysqli_query($conn, "SELECT username FROM users WHERE id = '$id'");
	if ( mysqli_num_rows($result) === 1) {
		$row = mysqli_fetch_assoc($result);
	
	// cek cookie dan username
		if( $key === hash('md5', $row['username']) ) {
			$_SESSION['login'] = true;
		}
	}
}

if ( isset($_SESSION["login"])) {
	header("Location: index.php");
	exit;
}

if ( isset($_POST["login"]) ) {
	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

	// cek username
	if ( mysqli_num_rows($result) === 1) {

		// cek password
		$row = mysqli_fetch_assoc($result);
		if( password_verify($password, $row['password']) ) {

			// cek session
			$_SESSION["login"] = true;

			// cek remember me
			if( isset($_POST['remember']) ) {
				setcookie('id', $row['id'], time()+60 );
				setcookie('key', hash('md5', $row['username']),time()+60);
			}


			header("Location: index.php");
			exit;
		}
	}

	$error = true;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
	<style type="text/css">
		.form-signup {
			margin: 0 auto;
			max-width: 400px;
			margin-top: 150px;
		}
	</style>
</head>
<body>
<div class="container">
<form action="" method="post" class="form-signup">
<h1 style="margin-left: 20px;">Halaman Login</h1><br>
<?php if ( isset($error) ) : ?>
	<h2 style="color: red; font-style: bold;">username / password salah</h2>
<?php endif; ?>
			<div class="mb-3">
				<label for="username" class="form-label">Username :</label>
				<input type="text" name="username" id="username">
			</div>
			<div class="mb-3">
				<label for="password" class="form-label">Password :</label>
				<input type="password" name="password" id="password"><br>
			</div>
			<div class="form-check">
				<input type="checkbox" class="form-check-input" name="remember" id="remember">
				<label for="remember">Remember me</label><br><br>
			</div>

		<button type="submit" name="login" class="btn btn-primary">Login</button><br> <br>
		<a class="dropdown-item" href="registrasi.php">New around here? <b>Sign up</b></a>
</form>
</div>
</body>
</html>