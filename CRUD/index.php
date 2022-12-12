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
	<!-- navbar -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow p-3 fixed-top">
		<div class="container">
			<a class="navbar-brand" href="#">Halaman Admin</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="#home">Home</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- akhir navbar -->

	<div class="container">
		<div class="row">		
			<div class="col">

				<section class="jumbotron text-center">
					<h1>Daftar Dokumen</h1>
				</section>
					<marquee direction="right">Selamat Datang Di Halaman Tampilan</marquee>

					<a href="tambah.php">Tambah Dokumen</a>
					<br><br>
					<nav class="navbar bg-light">
						<div class="container-fluid">

							<form action="" method="post" class="d-flex" role="search">
								<input type="text" name="keyword" class="form-control me-2">
								<button type="submit" name="cari" class="btn btn-outline-secondary" autofocus placeholder="masukkan keyword pencarian" autocomplete="off">Cari!</button>
							</form>
			</section>
		</div>
		</nav>
		<br>
		<table class="table table-striped-columns">

			<tr>
				<th>No.</th>
				<th>Nama Dokumen</th>
				<th>File Dokumen</th>
				<th>Aksebilitas</th>
				<th>Created By</th>
				<th>Aksi</th>
			</tr>
			<?php $i = 1; ?> <?php foreach ($dokumen as $row) : ?> <tr>
					<td><?= $i ?></td>
					<td><?= $row["nama_doc"] ?></td>
					<td><?= $row["file_doc"]  ?></td>
					<td class="access"><?= $row['access'] ?></td>
					<!-- tampilin user yang nambahin docnya -->
					<td><?= $row["created_by"] ?></td>
					<td>
						<a href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a> |
						<a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Apakah Anda Yakin?');">Hapus</a>
					</td>
				</tr>
				<?php $i++; ?>
			<?php endforeach; ?>
		</table>
	</div>
	</div>
	<a href="logout.php"><button class="btn btn-danger" type="button">Logout</button></a>
	</div>
	<div class="d-grid gap-2 d-md-block">
	</div>

	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="wave">
		<path fill="#f3f4f5" fill-opacity="1" d="M0,32L24,42.7C48,53,96,75,144,122.7C192,171,240,245,288,245.3C336,245,384,171,432,160C480,149,528,203,576,192C624,181,672,107,720,85.3C768,64,816,96,864,128C912,160,960,192,1008,176C1056,160,1104,96,1152,80C1200,64,1248,96,1296,90.7C1344,85,1392,43,1416,21.3L1440,0L1440,320L1416,320C1392,320,1344,320,1296,320C1248,320,1200,320,1152,320C1104,320,1056,320,1008,320C960,320,912,320,864,320C816,320,768,320,720,320C672,320,624,320,576,320C528,320,480,320,432,320C384,320,336,320,288,320C240,320,192,320,144,320C96,320,48,320,24,320L0,320Z"></path>
	</svg>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

	<script src="asset/js/script.js"></script>
</body>

</html>