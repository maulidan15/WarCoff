<?php 
// koneksi database
include '../../../config.php';
 
// menangkap data id yang di kirim dari url
$id = $_GET['id'];
  
// menghapus data dari database
mysqli_query($conn,"delete from barang where id_barang='$id'");

// mengalihkan halaman kembali ke index.php?page=listbarang
header("location:../index.php?page=listbarang");

?>
