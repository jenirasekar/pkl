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
			<script>
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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="asset/style/style.css">
	<title>Ubah Data Dokumen</title>
</head>

<body>
	<div class="vh-100 d-flex justify-content-center align-items-center">
		<div class="col-md-4 p-5 shadow-sm border rounded-5 border-primary">
			<h1>Ubah Data Dokumen</h1>
			<form action="" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?= $dok['id']; ?>">
				<input type="hidden" name="file_doc" value="<?= $dok['doc']; ?>">
				<div class="mb-3">
					<label for="nama">Nama Dokumen :</label>
					<input type="text" name="nama_doc" id="nama" required value="<?= $dok['nama_doc'] ?>" class="form-control bg-info bg-opacity-10 border border-primary">
				</div>
				<div class="mb-3">
					<label for="file_doc">File Dokumen </label>
					<input type="text" name="file_doc" id="file_doc" required value="<?= $dok["file_doc"] ?>" class="form-control bg-info bg-opacity-10 border border-primary">
				</div>
				<div class="grid">
					<button type="submit" name="submit" class="btn btn-primary">Ubah Data!</button>
				</div>
				<div class="mb-3">
					<label for="access">Aksesbilitas :</label>
					<select name="access" id="access">
						<option value="pub" class="form-control bg-info bg-opacity-10 border border-primary">Public</option>
						<option value="priv" class="form-control bg-info bg-opacity-10 border border-primary">Private</option>
					</select>
				</div>
			</form>
		</div>
	</div>
</body>

</html>