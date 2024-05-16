<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
                <h3 class="content-header-title">Dashboard</h3>
            </div>
            <div class="content-header-right col-md-8 col-12">
                <div class="breadcrumbs-top float-md-right">
                    <div class="breadcrumb-wrapper mr-1">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            <!-- <li class="breadcrumb-item active">Tables </li> -->
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body"><!-- Basic Tables start -->


            <!-- Table head options start -->
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <a href="index.php?page=listuser">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Pelanggan</h4>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <!-- data goes here... -->
                                    <div>
                                        <p>
                                            <?php
                                            // cara 1
                                            include '../../config.php';
                                            $query = mysqli_query($conn, "
                                                    SELECT * FROM user
                                                ");
                                            $data = mysqli_num_rows($query) - 1;
                                            echo $data;
                                            ?>
                                        </p>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-12">
                    <a href="index.php?page=listbarang">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Jenis Barang</h4>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <!-- data goes here... -->
                                    <div>
                                        <p>
                                            <?php
                                            // cara 1
                                            include '../../config.php';
                                            $query = mysqli_query($conn, "
                                                    SELECT * FROM barang
                                                ");
                                            $data = mysqli_num_rows($query);
                                            echo $data;
                                            ?>
                                        </p>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-12">
                    <a href="index.php?page=listtransaksi">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Pesanan</h4>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <!-- data goes here... -->
                                    <div>
                                        <p>
                                            <?php
                                            // cara 1
                                            include '../../config.php';
                                            $query = mysqli_query($conn, "
                                                    SELECT * FROM transaksi
                                                ");
                                            $data = mysqli_num_rows($query);
                                            echo $data;
                                            ?>
                                        </p>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-12">
                    <a href="index.php?page=listransaksi">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Transaksi Terkonfirmasi</h4>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <!-- data goes here... -->
                                    <div>
                                        <p>
                                            <?php
                                            // cara 1
                                            include '../../config.php';
                                            $query = mysqli_query($conn, "
                                                SELECT * 
                                                FROM transaksi 
                                                JOIN keranjang ON transaksi.id_transaksi = keranjang.id_transaksi  
                                                JOIN user ON keranjang.id_user = user.id_user  
                                                WHERE transaksi.status_transaksi = 'Sudah'
                                                GROUP BY transaksi.id_transaksi
                                                ");
                                            $data = mysqli_num_rows($query);
                                            echo $data;
                                            ?>
                                        </p>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- Table head options end -->
        </div>
    </div>
</div>