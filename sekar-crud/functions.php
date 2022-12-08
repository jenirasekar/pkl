<?php  
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "s_daftar_doc");

// ambil data dari tabel dokumen / query dokumen
$result = mysqli_query($conn, "SELECT * FROM dokumen");

function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah($data) {
	global $conn;
	// ambil data dari tiap elemen dalam form
	$nama_doc = htmlspecialchars($data["nama_doc"]);
	$access = htmlspecialchars($data["access"]);
	// di input namenya kamu cuma doc bukan file_doc
	// trus untuk ngambil nama file pakek $_FILES
	$file_doc = htmlspecialchars($_FILES["doc"]['name']);
	// usernamenya ngambil dari sesi user yang sedang login, ga perlu input baru di tambah.php
	$created_by = $_SESSION['username'];
	
	// upload file
	$doc = upload();
	if (!$doc) {
		return false;
	}

	// query insert data
	// di dalam values datanya harus urut, id, nama_doc, file_doc
	// tapi di database urutan kolomnya beda, id di belakang, jadi di databasenya diubah urutannya
	$query = "INSERT INTO dokumen
				VALUES
				('', '$nama_doc', '$file_doc', '$access', '$created_by')
				";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}

function upload() {

	$namaFile = $_FILES['doc']['name'];
	$ukuranFile = $_FILES['doc']['size'];
	$error = $_FILES['doc']['error'];
	$tmpName = $_FILES['doc']['tmp_name'];

	// cek apakah tidak ada doc yang diupload
	if ($error === 4) {
		echo "<script>
				alert('pilih dokumen terlebih dahulu')
				</script>";
		return false;
	}

	// cek apakah yang diupload adalah gambar
	$ekstensiFileValid= ['docx', 'pdf', 'txt'];
	$ekstensiFile = explode('.', $namaFile);
	$ekstensiFile = strtolower(end($ekstensiFile));
	if (!in_array($ekstensiFile, $ekstensiFileValid)) {
		echo "<script>
				alert('yang anda upload bukan dokumen')
			</script>";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if ($ukuranFile > 10000000) {
		echo "<script>
				alert('ukuran dokumen terlalu besar')
				</script>";
		return false;
	}

	// lolos pengecekan file siap diupload
	// generate nama file baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiFile;
	// file udah berhasil keupload tapi namanya ngaco, di kodingan php dasarmu errornya juga gini
	// gara gara kurang slash sama folder doc harus dibuat dulu di dalem asset
	move_uploaded_file($tmpName, 'asset/doc/' . $namaFileBaru);

	return $namaFileBaru;
}

function hapus($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM dokumen WHERE id = $id");
	return mysqli_affected_rows($conn);
}

function ubah($data) {
	global $conn;
	$id = $data["id"];
	$nama_doc = $data["nama_doc"];
	$file_doc = $data["file_doc"];
	$access = $data["access"];
	
	// query insert data 
	// sebelum where gausah koma, enakan dibikin satu baris biar keliatan
	$query = "UPDATE dokumen SET nama_doc = '$nama_doc', file_doc = '$file_doc', access = '$access' WHERE id = $id ";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}

function cari($keyword) {
	$query = query("SELECT * FROM dokumen WHERE
				nama_doc LIKE '%$keyword%' OR
				file_doc LIKE '%$keyword%'
				");
	return $query;
}

function registrasi($data) {
	global $conn;
	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

	// cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username' ");
	if (mysqli_fetch_assoc($result)) {
		echo "<script>
				alert('Username sudah terdaftar')
			</script>";

	}
	//cek konfirmasi password
	if ($password !== $password2) {
		echo "<script>
				alert('Konfirmasi password tidak sesuai!')
			</script>";
		return false;
	}

	// enkripsi password
	// note : pake PASSWORD_BCRYPT
	$password = password_hash($password, PASSWORD_BCRYPT);

	// tambahkan user baru ke database
	/* note : pas nambah gagal gara-gara kolom id ga dikasih auto increment,
	jadi nilainya 0 terus..., pesannya duplicate error deh
	*/
	mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");
	return mysqli_affected_rows($conn);
}
