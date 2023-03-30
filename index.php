<?php 

session_start();

if ( !isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}

require 'functions.php';

// pagination
// konfigurasi

// $jumlahDataPerHalaman = 11;
// $jumlahData = count(query("SELECT * FROM mahasiswa"));
// $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
// $halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
// $awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;
$mahasiswa = query("SELECT * FROM mahasiswa");
// ASC dari kecil ke besar || DESC DARI KECIL KE BESAR

// tombol cari ditekan
 if( isset($_POST["cari"]) ) {
	$mahasiswa = cari($_POST["keyword"]);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		.loader {
			width: 55px;
			position: flex;
			float: right;
			margin-right: -360px;
			margin-top: 0px;
			display: none;
			}
		.pencarian {
			position: flex;
			float: right;
			margin-right: 100px;
		}
		.wrapper {

		}
		.table-dark td{
			vertical-align: middle;
		}
	</style>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
	<title>Halaman Admin</title>
</head>
<body>
<div>
<a href="logout.php" style="position: flex; float: right; margin-top: 10px; margin-right: 20px;" class="btn btn-danger">Logout</a>
<a href="index.php"><h1>Daftar Mahasiswa</h1></a>
<br>
<form action="" method="post" class="pencarian">
<input type="text" name="keyword" size="35" autofocus placeholder="Masukkan keyword pencari.." autocomplete="off" id="keyword">
<button type="submit" name="cari" id="tombol-cari">Cari!</button>
</form>

<img src="img/loarder.gif" class="loader">

<a href="tambah.php">Tambah data mahasiswa</a>
</div>
<div class="wrapper">

<!-- <?php if($halamanAktif > 1) :?>
<a href="?halaman=<?= $halamanAktif - 1 ?>">&laquo;</a>
<?php endif; ?>

<?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
	<?php if( $i == $halamanAktif ) : ?>
		<a href="?halaman=<?= $i; ?>" style="font-weight: bold; color: white; background-color: black; margin-inline: 10px;"><?= $i ?></a>
	<?php else : ?>
		<a href="?halaman=<?= $i; ?>" style="margin-inline: 10px;"><?= $i ?></a>
	<?php endif; ?>
<?php endfor; ?>

<?php if($halamanAktif < $jumlahHalaman) :?>
<a href="?halaman=<?= $halamanAktif + 1 ?>">&raquo;</a>
<?php endif; ?> -->



<table border="1" cellpadding="30" cellspacing="" style="position: flex;" class="table table-striped table-dark table-hover">
		<tr>
			<th scope="col">No.</th>
			<th scope="col">Aksi</th>
			<th scope="col">Gambar</th>
			<th scope="col">NRP</th>
			<th scope="col">Nama</th>
			<th scope="col">Email</th>
			<th scope="col">Jurusan</th>
		</tr>
	<?php $i = 1; ?>
	<?php foreach ( $mahasiswa as $row ) :?>
	<tr>
		<td scope="row"><?= $i;  ?></td>
		<td>
			<a href="ubah.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin dek?');">ubah</a> |
			<a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');">hapus</a>
		</td>
		<td><img src="img/<?= $row["gambar"]; ?> " border-radius="50px" width="50px"></td>
		<td><?= $row["nrp"]; ?></td>
		<td><?= $row["nama"]; ?></td>
		<td><?= $row["email"]; ?></td>
		<td><?= $row["jurusan"]; ?></td>
	</tr>
	<?php $i++; ?>
	<?php endforeach; ?>

</table>
</div>
<script src="js/jquery.js"></script>
<script src="js/script1.js"></script>

</body>
</html>