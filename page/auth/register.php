<?php
// Sisipkan file konfigurasi database
require_once '../../config.php';
// Proses saat tombol "Update" ditekan
if (isset($_POST["daftar"])) {
    // Ambil nilai yang dikirimkan melalui form
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Query untuk mengupdate data user ke dalam database
	$query = "INSERT INTO user (nama, email, password, role) VALUES ('$nama', '$email', '$password', 'user')";

    // Jalankan query
    if (mysqli_query($conn, $query)) {
        echo '<script>window.onload = function() { alert("Pendaftaran akun berhasil dibuat."); }</script>';
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Daftar WarCoff</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../../assets/login/css/my-login.css">
</head>
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="../../assets/login/img/logo.png" alt="bootstrap 4 login page">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Daftar WarCoff</h4>
							<form method="POST" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="nama">Nama</label>
									<input id="nama" type="text" class="form-control" name="nama" required autofocus>
									<div class="invalid-feedback">
										Nama harus di isi
									</div>
								</div>

								<div class="form-group">
									<label for="email">Email</label>
									<input id="email" type="email" class="form-control" name="email" required>
									<div class="invalid-feedback">
										Email harus di isi
									</div>
								</div>

								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
									<div class="invalid-feedback">
										Password harus di isi
									</div>
								</div>

								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="agree" id="agree" class="custom-control-input" required="">
										<label for="agree" class="custom-control-label">I agree to the <a href="#">Terms and Conditions</a></label>
										<div class="invalid-feedback">
											You must agree with our Terms and Conditions
										</div>
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" name="daftar" class="btn btn-primary btn-block">
										Daftar
									</button>
								</div>
								<div class="mt-4 text-center">
									Sudah memiliki akun? <a href="login.php">Login</a>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2024 &mdash; WarCoff 
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="../../assets/login/js/my-login.js"></script>
</body>
</html>