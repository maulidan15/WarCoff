<?php
// Proses saat tombol "Submit" ditekan
if (isset($_POST["submit"])) {
    // Ambil nilai yang dikirimkan melalui form
    $nama_barang = $_POST["nama_barang"];
    $stok_barang = $_POST["stok_barang"];
    $gambar_barang = $_FILES["gambar_barang"]["name"];
    $temp_file = $_FILES["gambar_barang"]["tmp_name"];

    // Folder tujuan penyimpanan gambar
    $target_directory = "../../assets/admin/barang/";
    // Tentukan path lengkap file yang akan disimpan
    $target_file = $target_directory . basename($gambar_barang);

    // Pindahkan file sementara ke folder tujuan
    if (move_uploaded_file($temp_file, $target_file)) {
        // Query untuk menambah data barang ke dalam database
        $query = "INSERT INTO barang (nama_barang, stok_barang, gambar_barang) VALUES ('$nama_barang', '$stok_barang', '$gambar_barang')";

        // Jalankan query
        if (mysqli_query($conn, $query)) {
            echo '<script>window.onload = function() { alert("Data barang berhasil ditambahkan."); }</script>';
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo '<script>window.onload = function() { alert("Maaf, terjadi kesalahan saat mengunggah gambar."); }</script>';
    }
}
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
                            <h4 class="card-title">Table head options</h4>
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
                                <p>Similar to default and inverse tables, use one of two modifier classes <code
                                        class="highlighter-rouge">.thead-default</code> or <code
                                        class="highlighter-rouge">.thead-inverse</code> to make <code
                                        class="highlighter-rouge">&lt;thead&gt;</code>s appear light or dark gray.
                                </p>
                            </div>
                            <div class="table-responsive">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4 class="card-title">Nama Barang</h4>
                                                    <fieldset class="form-group">
                                                        <input name="nama_barang" type="text" class="form-control" required>
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-6">
                                                    <h4 class="card-title">Stok</h4>
                                                    <fieldset class="form-group">
                                                        <input name="stok_barang" type="number" class="form-control" required>
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-12">
                                                    <h4 class="card-title">Gambar</h4>
                                                    <fieldset class="form-group">
                                                        <input name="gambar_barang" type="file" class="form-control">
                                                    </fieldset>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <fieldset class="form-group">
                                                <input class="btn btn-info" type="submit" name="submit" value="Submit">
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
<!-- ////////////////////////////////////////////////////////////////////////////-->