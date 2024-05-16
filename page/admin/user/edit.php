<?php
// Proses saat tombol "Update" ditekan
if (isset($_POST["update"])) {
    // Ambil nilai yang dikirimkan melalui form
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $id_user = $_POST["id_user"];

    // Query untuk mengupdate data user ke dalam database
    $query = "UPDATE user SET nama='$nama', email='$email' WHERE id_user='$id_user'";

    // Jalankan query
    if (mysqli_query($conn, $query)) {
        echo '<script>window.onload = function() { alert("Data user berhasil diperbarui."); }</script>';
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

// Jika ada parameter ID pada URL, maka ini adalah halaman edit
if (isset($_GET['id'])) {
    $id_user = $_GET['id'];
    // Query untuk mengambil data user berdasarkan ID
    $query = "SELECT * FROM user WHERE id_user = $id_user";
    $result = mysqli_query($conn, $query);

    // Periksa apakah query berhasil dieksekusi
    if ($result) {
        // Ambil data user dari hasil query
        $data_user = mysqli_fetch_assoc($result);
        // Tampilkan form edit user
        ?>
        <div class="app-content content">
            <div class="content-wrapper">
                <div class="content-wrapper-before"></div>
                <div class="content-header row">
                    <div class="content-header-left col-md-4 col-12 mb-2">
                        <h3 class="content-header-title">Tables</h3>
                    </div>
                    <div class="content-header-right col-md-8 col-12">
                        <div class="breadcrumbs-top float-md-right">
                            <div class="breadcrumb-wrapper mr-1">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Tables
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-body"><!-- Basic Tables start -->
                    <!-- Table head options start -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Tabel User</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <p>Tabel yang tersedia ini menyajikan kumpulan informasi yang berharga mengenai informasi User.</p>
                                    </div>
                                    <div class="table-responsive">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="row">
                                                        <input type="hidden" name="id_user"
                                                            value="<?php echo $data_user['id_user']; ?>">

                                                        <div class="col-md-6">
                                                            <h4 class="card-title">Nama</h4>
                                                            <fieldset class="form-group">
                                                                <input name="nama" value="<?php echo $data_user['nama']; ?>"
                                                                    type="text" class="form-control" required>
                                                            </fieldset>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h4 class="card-title">Email</h4>
                                                            <fieldset class="form-group">
                                                                <input name="email" value="<?php echo $data_user['email']; ?>"
                                                                    type="email" class="form-control" required>
                                                            </fieldset>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h4 class="card-title">Password</h4>
                                                            <fieldset class="form-group">
                                                                <input name="password"
                                                                    value="<?php echo $data_user['password']; ?>"
                                                                    type="password" class="form-control" required>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <fieldset class="form-group">
                                                        <input class="btn btn-info" type="submit" name="update" value="Update">
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Table head options end -->
                </div>
            </div>
        </div>
        <?php
    } else {
        // Jika query gagal dieksekusi, tampilkan pesan error
        echo "Error: " . mysqli_error($conn);
    }
}
?>