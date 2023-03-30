<?php  
usleep(700000);

require '../functions.php';

$keyword = $_GET["keyword"];

$query = "SELECT * FROM mahasiswa WHERE 
			nama LIKE '%$keyword%' OR 
			nrp LIKE '%$keyword%' OR 
			email LIKE '%$keyword%' OR 
			jurusan LIKE '%$keyword%' OR 
			gambar LIKE'%$keyword%' 
			";
$mahasiswa = query($query);
?>
<table border="1" cellpadding="30" cellspacing="" style="position: flex;" class="table table-dark">
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
		<th scope="row"><?= $i;  ?></th>
		<td>
			<a href="ubah.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin dek?');">ubah</a> |
			<a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');">hapus</a>
		</td>
		<td><img src="img/<?= $row["gambar"]; ?> " width="50px"></td>
		<td><?= $row["nrp"]; ?></td>
		<td><?= $row["nama"]; ?></td>
		<td><?= $row["email"]; ?></td>
		<td><?= $row["jurusan"]; ?></td>
	</tr>
	<?php $i++; ?>
	<?php endforeach; ?>

</table>