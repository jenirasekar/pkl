<?php   
session_start();

if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}
require 'functions.php';

// ambil data di url
$id = $_GET['id'];
//  query data dokumen berdasarkan id
$dok = query("SELECT * FROM dokumen WHERE id = $id")[0];

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST['submit'])) {
	
	
	// cek apakah data berhasil diubah atau tidak
	if (ubah($_POST) > 0) {
		echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			script>
				alert('data gagal diubah!');
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
	<title>Ubah Data Dokumen</title>
</head>
<body>
	<h1>Ubah Data Dokumen</h1>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?= $dok['id']; ?>">
		<input type="hidden" name="file_doc" value="<?= $dok['doc']; ?>">
		<ul>
			<li>
				<label for="nama">Nama Dokumen :</label>
				<input type="text" name="nama" id="nama" required value="<?= $dok['nama_doc'] ?>">
			</li>
			<li>
				<label for="file_doc">File Dokumen </label>
				<input type="text" name="file_doc" id="file_doc" required value="<?= $dok["file_doc"] ?>">
			</li>
			<li>
				<button type="submit" name="submit">Ubah Data!</button>
			</li>
		</ul>
	</form>
</body>
</html>