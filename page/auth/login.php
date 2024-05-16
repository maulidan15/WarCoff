<?php
session_start();

// Sisipkan file konfigurasi database
require_once '../../config.php';

// Jika formulir login dikirim
if (isset($_POST['login'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	// Periksa kecocokan email dan password dalam database
	$sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) == 1) {
		// Jika data ditemukan, ambil data pengguna dan simpan dalam session
		$row = mysqli_fetch_assoc($result);
		$_SESSION['loggedin'] = true;
		$_SESSION['id_user'] = $row['id_user'];
		$_SESSION['email'] = $email;
		$_SESSION['nama'] = $row['nama']; // Simpan nama pengguna dalam session
		$_SESSION['role'] = $row['role']; // Simpan role pengguna dalam session
		// Tambahan data lainnya bisa dimasukkan ke dalam session sesuai kebutuhan

		if ($row["role"] == "admin") {
			header("Location: ../admin/index.php?page=dashboard");// Redirect ke halaman dashboard
		} else {
			header("Location: ../../index.php");// Redirect ke halaman dashboard
		}
		exit();
	} else {
		// Jika data tidak ditemukan, tampilkan pesan error
		echo "Email atau password salah!";
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Login WarCoff</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../../assets/login/css/my-login.css">
</head>

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<!-- logo -->
						<img src="../../assets/login/img/logo.png" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Login WarCoff</h4>
							<form action="" method="POST" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="email">Email</label>
									<input id="email" type="email" class="form-control" name="email" value="" required
										autofocus>
									<div class="invalid-feedback">
										Email harus di isi
									</div>
								</div>

								<div class="form-group">
									<label for="password">Password
										<a href="forgot.html" class="float-right">
											Lupa Password?
										</a>
									</label>
									<input id="password" type="password" class="form-control" name="password" required
										data-eye>
									<div class="invalid-feedback">
										Password harus di isi
									</div>
								</div>

								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="remember" id="remember"
											class="custom-control-input">
										<label for="remember" class="custom-control-label">Ingat Saya</label>
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" name="login" class="btn btn-primary btn-block">
										Masuk
									</button>
								</div>
								<div class="mt-4 text-center">
									Belum memiliki akun? <a href="register.php">Buat akun</a>
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

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
		crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
		integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
		crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
		integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
		crossorigin="anonymous"></script>
	<script src="../../assets/login/js/my-login.js"></script>
</body>

</html>