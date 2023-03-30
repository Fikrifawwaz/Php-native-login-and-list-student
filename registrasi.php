<?php

require 'functions.php';

if( isset($_POST["register"]) ) {

	if( registrasi($_POST) > 0) {
		echo "<script>
				alert('user baru berhasil ditambahkan!');
			</script>";
	}
	else {
		echo mysqli_error($conn);
	}

}






?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Halaman Registrasi</title>
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
		<h1>Halaman Registrasi</h1><br>
		<div class="form-group">
			<div class="row">
				<div class="form-group">
				<input type="username" class="form-control" name="username" id="username" placeholder="Username">
				</div>
				
				<div class="form-group">
				<input type="password" class="form-control" name="password" id="password" placeholder="Password">
				</div>
		<div class="form-group">
			<input type="password" class="form-control" name="password2" id="password2" placeholder="Confirm Password">
		</div>
	</div>
	<br>
			<button class="btn btn-primary" type="submit" name="register" id="register">Register</button>
		
</form>
</div>
</body>
</html>