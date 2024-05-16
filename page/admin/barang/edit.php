<?php
// Proses saat tombol "Update" ditekan
if (isset($_POST["update"])) {
    // Ambil nilai yang dikirimkan melalui form
    $nama_barang = $_POST["nama_barang"];
    $stok_barang = $_POST["stok_barang"];
    $harga_barang = $_POST["harga_barang"];
    $id_barang = $_POST["id_barang"];


    // Periksa apakah ada file gambar yang diunggah
    if (!empty($_FILES["gambar_barang"]["name"])) {
        $gambar_barang = $_FILES["gambar_barang"]["name"];
        $temp_file = $_FILES["gambar_barang"]["tmp_name"];

        // Folder tujuan penyimpanan gambar
        $target_directory = "../../assets/admin/barang/";
        // Tentukan path lengkap file yang akan disimpan
        $target_file = $target_directory . basename($gambar_barang);

        // Pindahkan file sementara ke folder tujuan
        if (move_uploaded_file($temp_file, $target_file)) {
            // Query untuk mengupdate data barang ke dalam database
            $query = "UPDATE barang SET nama_barang='$nama_barang', stok_barang='$stok_barang', harga_barang='$harga_barang', gambar_barang='$gambar_barang' WHERE id_barang='$id_barang'";
        } else {
            echo '<script>window.onload = function() { alert("Maaf, terjadi kesalahan saat mengunggah gambar."); }</script>';
        }
    } else {
        // Query untuk mengupdate data barang ke dalam database
        $query = "UPDATE barang SET nama_barang='$nama_barang', harga_barang='$harga_barang', stok_barang='$stok_barang' WHERE id_barang='$id_barang'";
    }
    // Jalankan query
    if (mysqli_query($conn, $query)) {
        echo '<script>window.onload = function() { alert("Data barang berhasil diperbarui."); }</script>';
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

// Jika ada parameter ID pada URL, maka ini adalah halaman edit
if (isset($_GET['id'])) {
    $id_barang = $_GET['id'];
    // Query untuk mengambil data barang berdasarkan ID
    $query = "SELECT * FROM barang WHERE id_barang = $id_barang";
    $result = mysqli_query($conn, $query);

    // Periksa apakah query berhasil dieksekusi
    if ($result) {
        // Ambil data barang dari hasil query
        $data_barang = mysqli_fetch_assoc($result);
        // Tampilkan form edit barang
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
                                    <h4 class="card-title">Tabel Barang</h4>
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
                                        <p>Tabel yang tersedia ini menyajikan kumpulan informasi yang berharga mengenai edit barang.</p>
                                    </div>
                                    <div class="table-responsive">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="row">
                                                        <input type="hidden" name="id_barang"
                                                            value="<?php echo $data_barang['id_barang']; ?>">

                                                        <div class="col-md-6">
                                                            <h4 class="card-title">Nama Barang</h4>
                                                            <fieldset class="form-group">
                                                                <input name="nama_barang"
                                                                    value="<?php echo $data_barang['nama_barang']; ?>"
                                                                    type="text" class="form-control" required>
                                                            </fieldset>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h4 class="card-title">Stok</h4>
                                                            <fieldset class="form-group">
                                                                <input name="stok_barang"
                                                                    value="<?php echo $data_barang['stok_barang']; ?>"
                                                                    type="number" class="form-control" required>
                                                            </fieldset>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h4 class="card-title">Harga Barang</h4>
                                                            <fieldset class="form-group">
                                                                <input name="harga_barang"
                                                                    value="<?php echo $data_barang['harga_barang']; ?>"
                                                                    type="number" class="form-control" required>
                                                            </fieldset>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <h4 class="card-title">Gambar</h4>
                                                            <fieldset class="form-group">
                                                                <input name="gambar_barang"
                                                                    value="<?php echo $data_barang['gambar_barang']; ?>"
                                                                    type="file" class="form-control">
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