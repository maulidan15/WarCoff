<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
                <h3 class="content-header-title">Barang</h3>
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
                                <p>Tabel yang tersedia ini menyajikan kumpulan informasi yang berharga mengenai beragam barang.</p>
                                <a class="btn btn-primary" href="index.php?page=addbarang"><i
                                        class="la la-plus"></i>Add</a>
                                <br>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Barang</th>
                                            <th scope="col">Stok</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    include '../../config.php';
                                    $no = 1;
                                    $data = mysqli_query($conn, "SELECT * FROM barang");
                                    while ($d = mysqli_fetch_array($data)) {
                                        ?>
                                        <tbody>
                                            <tr>
                                                <th scope="row"><?php echo $no++; ?></th>
                                                <td><?php echo $d['nama_barang']; ?></td>
                                                <td><?php echo number_format($d['stok_barang'], 0, ",", "."); ?></td>
                                                <td><?php echo number_format($d['harga_barang'], 0, ",", "."); ?></td>
                                                <td>
                                                    <a class="btn btn-warning"
                                                        href="index.php?page=editbarang&id=<?php echo $d['id_barang']; ?>"><i
                                                            class="la la-pencil"></i> Edit</a>
                                                    <a class="btn btn-danger"
                                                        href="barang/delete.php?id=<?php echo $d['id_barang']; ?>"><i
                                                            class="la la-trash"></i> Delete</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <?php
                                    }
                                    ?>
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