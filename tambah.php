<?php  

session_start();

if ( !isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}

require 'functions.php';

if( isset($_POST["submit"])) {

	// cek apakah data berhasil di tambahkan atau tidak
	if (tambah($_POST) > 0) {
		echo "
			<script>
				alert('data berhasil ditambahkan');
				document.location.href = 'index.php';
			</script>
			";
	} else {
		echo "
			<script>
				alert('data gagal ditambahkan');
				document.location.href = 'index.php';
			</script>
			";
	}
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
	<title>Tambah data mahasiswa</title>
	<style>
	</style>
</head>
<body>
	<div class="container">
	<h1>Tambah data mahasiswa</h1>
	<form action="" method="post" enctype="multipart/form-data" class="form-signup">
			<div class="form-group">
				<input type="text" class="form-control" name="nama" id="nama" placeholder="nama">
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="nrp" id="nrp" placeholder="nrp">
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="email" id="email" placeholder="email">
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="jurusan" id="jurusan" placeholder="jurusan">
			</div>
				<input type="file" class="form-control" name="gambar" id="gambar" placeholder="gambar">
				<br>
				<button type="submit" name="submit" class="btn btn-primary">Submit</button>
			</li>
			<br><br>
			<a href="index.php">Back To Home</a>
		</ul>
	</form>
</div>
</body>
</html>