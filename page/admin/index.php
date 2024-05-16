<?php
session_start();
include ("../../config.php");
// Check if user is not logged in, then redirect to login page
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../auth/login.php");// Redirect ke halaman login
    exit();
    // Check if role user is not admin or pegawai, then redirect to homepage
} elseif ($_SESSION["role"] != "admin") {
    header("Location: ../../index.php");// Redirect ke halaman homepage
}

include ("top.php"); //navbar
?>

<!-- fixed-top-->

<!-- nav -->
<?php
include ("navbar.php"); //navbar
?>
<!-- /nav -->


<!-- sidebar -->
<?php
include ("sidebar.php"); //sidebar
?>
<!-- /sidebar -->


<!-- content -->
<?php

if (isset($_GET['page'])) {
    $page = $_GET['page'];

    switch ($page) {
        case 'dashboard':
            include "dashboard/index.php";
            break;
        case 'listbarang':
            include "barang/index.php";
            break;
        case 'addbarang':
            include "barang/add.php";
            break;
        case 'editbarang':
            include "barang/edit.php";
            break;
        case 'listuser':
            include "user/index.php";
            break;
        case 'adduser':
            include "user/add.php";
            break;
        case 'edituser':
            include "user/edit.php";
            break;
        case 'listtransaksi':
            include "transaksi/index.php";
            break;
        case 'detailtransaksi':
            include "transaksi/detail.php";
            break;
        case 'konfirmasitransaksi':
            include "transaksi/konfirmasi.php";
            break;
        case 'listsaran':
            include "saran/index.php";
            break;
        case 'detailsaran':
            include "saran/detail.php";
            break;
        case 'logout':
            include "";
            break;
        default:
            echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
            break;
    }
} else {
    // include "index.php";
}
// ?>
<!-- /content -->


<!-- footer -->
<?php
include ("footer.php"); //sidebar
?>
<!-- /footer -->


<!-- bottom -->
<?php
include ("bottom.php"); //sidebar
?>