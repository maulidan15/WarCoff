<?php
// Proses saat tombol "Submit" ditekan
if (isset($_POST["submit"])) {
    // Ambil nilai yang dikirimkan melalui form
    $kritik = $_POST["kritik"];
    $saran = $_POST["saran"];
    $id_user = $_POST["id_user"];
    ;
    // echo print_r($id_user);die();
    // Query untuk menambah data barang ke dalam database
    $query = "INSERT INTO saran (id_user, kritik, saran) VALUES ('$id_user', '$kritik', '$saran')";

    // Jalankan query
    include ("../../../config.php");

    if (mysqli_query($conn, $query)) {
        // Tampilkan pesan alert dan lakukan redirect setelah 2 detik
        echo '<script>
                setTimeout(function() {
                    alert("Terima kasih atas kritik dan saran yang telah anda berikan, hal ini akan sangat berarti untuk peningkatan layanan dari Warcoff :))");
                    window.location.href = "../../../index.php";
                }, 2000);
              </script>';
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

?>