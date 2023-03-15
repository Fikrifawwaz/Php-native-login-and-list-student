<?php 

$conn = mysqli_connect("localhost", "root", "", "phpdasar");
	
function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);

	// check button telah di klik atau belum
	if (!$result) {
	echo mysqli_error($conn);
	}

	// mengubah $row menjadi array assosciative
	$rows = [];
	while ( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

	// fungsi data tambah untuk menginput
function tambah($data) {
	global $conn;
	$nama = htmlspecialchars($data["nama"]);
	$nrp = htmlspecialchars($data["nrp"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$gambar = upload();
	if(!$gambar) {
		return false;
	}

	// query data to database
	$query = "INSERT INTO mahasiswa VALUES ('', '$nama', '$nrp', '$email', '$jurusan', '$gambar')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}

function upload(){

	// mengecheck sudah/belum mengupload data
	$namafile = $_FILES['gambar']['name'];
	$ukuranfile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	if( $error === 4) {
		echo "<script>
			alert('pilih gambar terlebih dahulu');
		</script>";
		return false;
	}

	// mengecheck tipe data atau mengupload yang buka data
	$eksteksiGambarValid = ['jpg', 'jpeg', 'png'];
	$eksteksiGambar = explode('.', $namafile);
	$eksteksiGambar = strtolower(end($eksteksiGambar));
	if( !in_array($eksteksiGambar, $eksteksiGambarValid)) {
		echo "<script>
			alert('yang anda upload bukan gambar');
		</script>";
		return false;
	}

	// cek ukuran file jika terlalu besar
	if ($ukuranfile > 2000000 ) {
		echo "<script>
			alert('ukuran gambar terlalu besar');
		</script>";
		return false;
	}

	// lolos di cek, gambar siap di upload

	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $eksteksiGambar;

	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

	return $namaFileBaru;
}

	// fungsi data hapus
function hapus($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
	return mysqli_affected_rows($conn);
}

	// fungsi mengubah data
function ubah($data) {
	global $conn;

	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$nrp = htmlspecialchars($data["nrp"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);

	// cek apakah user mengganti gambar atau tidak
	if($_FILES['gambar']['error'] === 4) {
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}

	$query = "UPDATE mahasiswa SET nama = '$nama', nrp = '$nrp', email = '$email', jurusan = '$jurusan', gambar = '$gambar' WHERE id = $id ";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
	// fungsi untuk mencari


function cari($keyword) {
	$query = "SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%' OR nrp LIKE '%$keyword%' OR email LIKE '%$keyword%' OR jurusan LIKE '%$keyword%' OR gambar LIKE'%$keyword%' "; 
	return query($query);



}

function registrasi($data) {
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

	// cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
	if( mysqli_fetch_assoc($result)) {
		echo" <script>
				alert('username sudah terdaftar!')
		</script>";
		return false;
	}

	// cek konfirmasi password
	if ( $password !== $password2) {
		echo "<script>
			alert('Password yang kamu tulis tidak sama')
			</script>";
		return false;
	}

	// enskripsi password
	 $password = password_hash($password, PASSWORD_DEFAULT);

	// // tambahkan userbaru ke database
	 mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$password')");

	 return mysqli_affected_rows($conn);

}

?>