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
                                <p>Tabel yang tersedia ini menyajikan kumpulan informasi yang berharga mengenai detail Transaksi.</p>
                                
                                <br>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Barang</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    include '../../config.php';
                                    $id_transaksi = $_GET['id'];

                                    $no = 1;
                                    $total = 0; //
                                    
                                    $data = mysqli_query($conn, "SELECT * 
                                                                FROM keranjang 
                                                                JOIN transaksi ON keranjang.id_transaksi = transaksi.id_transaksi  
                                                                JOIN user ON keranjang.id_user = user.id_user
                                                                JOIN barang ON keranjang.id_barang = barang.id_barang
                                                                WHERE keranjang.id_transaksi = '$id_transaksi'
                                                                ");
                                    while ($d = mysqli_fetch_array($data)) {
                                        $subtotal = $d['harga_barang'] * $d['jumlah'];
                                        $total += $subtotal;
                                        ?>
                                        <tbody>
                                            <tr>
                                                <th scope="row"><?php echo $no++; ?></th>
                                                <td><?php echo $d['nama_barang']; ?></td>
                                                <td><?php echo $d['jumlah']; ?></td>
                                                <td><?php echo number_format($subtotal, 0, ",", "."); ?></td>
                                            </tr>
                                        </tbody>
                                        <?php
                                    }
                                    ?>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" align="right"><b>Total</b></td>
                                            <td><b><?php echo number_format($total, 0, ",", "."); ?></b></td>
                                        </tr>
                                    </tfoot>
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