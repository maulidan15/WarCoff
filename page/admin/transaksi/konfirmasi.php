<?php
if (isset($_GET['id'])) {
    include '../../../config.php';

    $id_transaksi = $_GET['id'];

    // Query untuk mengupdate data user ke dalam database
    $query = "UPDATE transaksi SET status_transaksi='Sudah' WHERE id_transaksi='$id_transaksi'";

    // Jalankan query
    if (mysqli_query($conn, $query)) {
        // echo '<script>window.onload = function() { alert("Transaksi berhasil dikonfirmasi."); }</script>';
        // // mengalihkan halaman kembali ke index.php?page=listtransaksi
        // header("location:../index.php?page=listtransaksi");

        $detail_transaksi_query = "SELECT id_barang, jumlah FROM keranjang WHERE id_transaksi='$id_transaksi'";
        $detail_result = mysqli_query($conn, $detail_transaksi_query);

        // Kurangi stok barang untuk setiap barang yang dibeli
        while ($row = mysqli_fetch_assoc($detail_result)) {
            $id_barang = $row['id_barang'];
            $jumlah = $row['jumlah'];

            // Ambil stok barang saat ini
            $stok_query = "SELECT stok_barang FROM barang WHERE id_barang='$id_barang'";
            $stok_result = mysqli_query($conn, $stok_query);
            $stok_row = mysqli_fetch_assoc($stok_result);
            $stok_sekarang = $stok_row['stok_barang'];

            // Kurangi stok sesuai dengan jumlah yang dibeli
            $stok_baru = $stok_sekarang - $jumlah;

            // Update stok barang di database
            $update_stok_query = "UPDATE barang SET stok_barang='$stok_baru' WHERE id_barang='$id_barang'";
            mysqli_query($conn, $update_stok_query);
        }

        // Mengalihkan halaman kembali ke index.php?page=listtransaksi setelah transaksi berhasil dikonfirmasi
        header("location:../index.php?page=listtransaksi");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>