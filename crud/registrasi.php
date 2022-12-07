<?php
require 'functions.php';
if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
                alert('User baru berhasil ditambahkan!')
            </script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>
<html>

<head>
    <title>Halaman Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <style>
        label {
            display: block;
        }
    </style>
</head>

<body>
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="col-md-4 p-5 shadow-sm border rounded-5 border-primary">
            <h1>Register</h1>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="username">Username :</label>
                    <input type="text" name="username" id="username">
                </div>
                <div class="mb-3">
                    <label for="password">Password :</label>
                    <input type="password" name="password" id="password">
                </div>
                <div class="mb-3">
                    <label for="password2">Konfirmasi password :</label>
                    <input type="password" name="password2" id="password2">
                </div>
                <div class="grid">
                    <button type="submit" name="register" class="btn btn-primary">Register</button>
                </div>
            </form>
            <div class="mt-3">
                <p class="mb-0  text-center">Already have an account? <a href="login.php" class="text-primary fw-bold">Sign
                        In</a></p>
            </div>
        </div>
    </div>
</body>

</html>