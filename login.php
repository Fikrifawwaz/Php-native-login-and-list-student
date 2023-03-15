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
</head>
<body>
<h1>Halaman Login</h1>

<?php if ( isset($error) ) : ?>
	<h2 style="color: red; font-style: bold;">username / password salah</h2>
<?php endif; ?>

<ul>
<form action="" method="post">
	<li>
		<label for="username">Username :</label>
		<input type="text" name="username" id="username">
	</li>
	<li>
		<label for="password">Password :</label>
		<input type="password" name="password" id="password"><br>

		<input type="checkbox" name="remember" id="remember" style="margin-top: 15px; ">
		<label for="remember">Remember me</label><br><br>


		<button type="submit" name="login">Login</button>
	</li>
</form>
</ul>
</body>
</html>