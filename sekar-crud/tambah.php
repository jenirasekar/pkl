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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="asset/style/style.css">
	<title>Tambah Data Dokumen</title>
</head>

<body>
	<div class="vh-100 d-flex justify-content-center align-items-center">
		<div class="col-md-4 p-5 shadow-sm border rounded-5 border-primary">
			<h1>Tambah Data Dokumen</h1>
			<form action="" method="post" enctype="multipart/form-data">
				<div class="mb-3">
					<label for="nama_doc">Nama Dokumen:</label>
					<input type="text" name="nama_doc" id="nama_doc" class="form-control bg-info bg-opacity-10 border border-primary">
				</div>
				<div class="mb-3">
					<label for="doc">File Dokumen:</label>
					<input type="file" name="doc" id="doc" class="form-control bg-info bg-opacity-10 border border-primary">
				</div>
				<div class="mb-3">
					<label for="access">Aksesbilitas:</label>
					<select name="access" id="access">
						<option value="public" class="form-control bg-info bg-opacity-10 border border-primary">Public</option>
						<option value="private" class="form-control bg-info bg-opacity-10 border border-primary">Private</option>
					</select>
				</div>
				<button type="submit" name="submit" class="btn btn-primary">Tambah Data!</button>
			</form>
		</div>
	</div>

</body>

</html>
