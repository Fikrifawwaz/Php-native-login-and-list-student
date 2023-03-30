<?php  
require 'functions.php';

// ambil data di URL
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

if( isset($_POST["submit"])) {



	// cek apakah data berhasil di tambahkan atau tidak
	if ( ubah($_POST) > 0) {
		echo "
			<script>
				alert('data berhasil diubah');
				document.location.href = 'index.php';
			</script>";
			// return false;
	} else {
		echo "
			<script>
				alert('data gagal diubah');
				document.location.href = 'index.php';
			</script>";
			// return false;
	}
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Update data mahasiswa</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>
<body>
	<div class="container">
	<h1>Update data mahasiswa</h1>

	<form action="" method="post" enctype="multipart/form-data" class="form-signup">
		<input type="hidden" name="id" value="<?= $mhs["id"]; ?> ">
		<input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
				<div class="form-group">
				<input type="text" class="form-control" name="nama" id="nama" placeholder="nama" required value="<?= $mhs['nama'];?>" >
				</div>
			
				<div class="form-group">
				<input type="text" class="form-control" name="nrp" id="nrp" placeholder="nrp" required value="<?= $mhs['nrp'];?>" >
				</div>
			
				<div class="form-group">
				<input type="text" class="form-control" name="email" id="email" placeholder="email" required value="<?= $mhs['email'];?>" >
				</div>
				
				<div class="form-group">
				<input type="text" class="form-control" name="jurusan" id="jurusan" placeholder="jurusan" required value="<?= $mhs['jurusan'];?>" >
				</div>
			
				<div class="form-group">
				<input type="file" class="form-control" name="gambar" id="gambar" placeholder="gambar" required value="<?= $mhs['gambar'];?>" >
				</div>
				<br>
				<img src="img/<?= $mhs['gambar']; ?>" width="50px"><br><br>


				<button type="submit" name="submit" class="btn btn-primary">Ubah Data!</button>
			<br><br>
			<a href="index.php">Back To Home</a>
		</ul>
	</form>
</div>
</body>
</html>