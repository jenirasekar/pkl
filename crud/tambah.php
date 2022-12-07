<?php  
session_start();

if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}
require 'functions.php';

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST['submit'])) {


	// cek apakah data berhasil ditambahkan atau tidak
	if (tambah($_POST) > 0) {
		echo "
			<script>
				alert('data berhasil ditambahkan!');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal ditambahkan!');
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
	<title>Tambah Data Dokumen</title>
</head>

<body>
	<h1>Tambah Data Dokumen</h1>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?= $dokumen["id"]; ?>">
		<input type="hidden" name="gambarLama" value="<?= $dokumen["doc"]; ?>">
		<ul>
			<li>
				<label for="nama_doc">Nama Dokumen :</label>
				<input type="text" name="nama_doc" id="nama_doc">
			</li>
			<li>
				<label for="doc">NRP :</label>
				<input type="file" name="doc" id="doc">
			</li>
			<button type="submit" name="submit">Tambah Data!</button>
			</li>
		</ul>
	</form>
</body>

</html>