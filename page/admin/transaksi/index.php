<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
                <h3 class="content-header-title">Transaksi</h3>
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
                            <h4 class="card-title">Tabel Transaksi</h4>
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
                                <p>Tabel yang tersedia ini menyajikan kumpulan informasi yang berharga mengenai beragam Transaksi dan Pencatatan Keuangan.</p>

                                <br>

                                <h2>
                                    <?php
                                    $no = 1;
                                    $pendapatan = 0;

                                    include '../../config.php';

                                    $data = mysqli_query($conn, "SELECT transaksi.total 
                                                                FROM transaksi 
                                                                JOIN keranjang ON transaksi.id_transaksi = keranjang.id_transaksi  
                                                                JOIN user ON keranjang.id_user = user.id_user  
                                                                WHERE transaksi.status_transaksi = 'Sudah'
                                                                GROUP BY transaksi.id_transaksi;
                                                                ");
                                    while ($d = mysqli_fetch_array($data)) {
                                        $pendapatan += $d['total'];
                                    }
                                    ?>
                                    Pendapatan : <?php echo number_format($pendapatan, 0, ",", ".") ?>
                                </h2>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Kode Transaksi</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    include '../../config.php';

                                    $data = mysqli_query($conn, "SELECT * 
                                                                FROM transaksi 
                                                                JOIN keranjang ON transaksi.id_transaksi = keranjang.id_transaksi  
                                                                JOIN user ON keranjang.id_user = user.id_user  
                                                                GROUP BY transaksi.id_transaksi;
                                                                ");
                                    while ($d = mysqli_fetch_array($data)) {
                                        $pendapatan += $d['total'];

                                        ?>
                                        <tbody>
                                            <tr>
                                                <th scope="row"><?php echo $no++; ?></th>
                                                <td><?php echo $d['id_transaksi']; ?></td>
                                                <td><?php echo $d['nama']; ?></td>
                                                <td><?php echo number_format($d['total'], 0, ",", "."); ?></td>
                                                <td>
                                                    <?php if ($d['status_transaksi'] == "Sudah") { ?>
                                                        Transaksi Terkonfirmasi
                                                    <?php } else { ?>
                                                        <a class="btn btn-success"
                                                            href="transaksi/konfirmasi.php?id=<?php echo $d['id_transaksi']; ?>"><i
                                                                class="la la-check"></i> Konfirmasi</a>
                                                    <?php } ?>
                                                    <a class="btn btn-info"
                                                        href="index.php?page=detailtransaksi&id=<?php echo $d['id_transaksi']; ?>"><i
                                                            class="la la-eye"></i> Detail</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table head options end -->
        </div>
    </div>
</div>