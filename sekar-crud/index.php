<?php  
session_start();

if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}
require 'functions.php';
$dokumen = query("SELECT * FROM dokumen");

// tombol cari ditekan
if (isset($_POST['cari'])) {
	$dokumen = cari($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="asset/style/style.css">
	<title>Halaman Admin</title>
</head>

<body>

	<div class="container">
		<div class="row">
			<div class="col">
				<h1>Daftar Dokumen</h1>
				
				<a href="tambah.php">Tambah Dokumen</a>
				<br><br>
				<nav class="navbar bg-light">
					<div class="container-fluid">
						
						<form action="" method="post" class="d-flex" role="search">
							<input type="text" name="keyword" class="form-control me-2">
							<button type="submit" name="cari"class="btn btn-outline-secondary" autofocus placeholder="masukkan keyword pencarian" autocomplete="off">Cari!</button>
						</form>
					</div>
				</nav>
				<br>
				<table class="table table-striped-columns">
					
					<tr>
						<th>No.</th>
						<th>Nama Dokumen</th>
						<th>File Dokumen</th>
						<th>Aksesbilitas</th>
						<th>Aksi</th>
					</tr>
					<?php $i = 1; ?> <?php foreach ($dokumen as $row) : ?> <tr>
							<td><?= $i ?></td>
							<td><?= $row["nama_doc"] ?></td>
							<td><?= $row["file_doc"]  ?></td>
							<td></td>
							<td>
								<a href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a> |
								<a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Apakah Anda Yakin?');">Hapus</a>
							</td>
						</tr>
						<?php $i++; ?>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</table>
		<div class="d-grid gap-2 d-md-block">
			<a href="logout.php"><button class="btn btn-primary" type="button">Logout</button></a>
		</div>
		
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>