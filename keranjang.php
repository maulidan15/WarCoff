<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    // Show alert message
    echo '<script>alert("Silahkan Login terlebih dahulu.");</script>';
    // Redirect to login page after alert is closed
    echo '<script>window.location.href = "page/auth/login.php";</script>';
    exit;
}
// If user is logged in, proceed to the rest of the page
?>
<!DOCTYPE html>
<html>

<head>
    <title>Keranjang Belanja</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .quantity-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        @media print {

            /* Atur tata letak untuk cetak */
            body {
                font-size: 12pt;
            }

            /* Sembunyikan elemen yang tidak ingin dicetak */
            .no-print {
                display: none;
            }
        }
    </style>
    <script>
        function confirmDelete() {
            return confirm("Anda yakin ingin menghapus item dari keranjang?");
        }
    </script>
</head>

<body>
    <h2>Keranjang Belanja <a href="index.php">Kembali ke Menu</a></h2>
    <form method="post" action="keranjang.php">
        <table>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
            </tr>
            <?php
            // Sambungkan ke database
            $koneksi = mysqli_connect("localhost", "root", "", "warcoff");

            // Periksa koneksi
            if (mysqli_connect_errno()) {
                echo "Koneksi database gagal: " . mysqli_connect_error();
                exit();
            }
            $id_user = $_SESSION['id_user'];

            // Jika tombol "Add to Cart" ditekan
            if (isset($_POST['add_to_cart'])) {
                $id_barang = $_POST['id_barang'];

                // Cek apakah barang sudah ada di keranjang
                $check_query = "SELECT keranjang.id_keranjang, keranjang.id_user, barang.nama_barang, barang.harga_barang, keranjang.jumlah 
                FROM keranjang 
                JOIN barang ON keranjang.id_barang = barang.id_barang 
                WHERE keranjang.id_barang = '$id_barang' AND
                      keranjang.id_transaksi = 0 AND
                      keranjang.id_user = '$id_user'
                      ";

                $check_result = mysqli_query($koneksi, $check_query);

                if (mysqli_num_rows($check_result) > 0) {
                    // Jika barang sudah ada di keranjang, tambahkan jumlahnya
                    $update_query = "UPDATE keranjang SET jumlah = jumlah + 1 WHERE id_barang = '$id_barang'";
                    if (mysqli_query($koneksi, $update_query)) {
                        echo "<p>Jumlah barang berhasil diperbarui.</p>";
                    } else {
                        echo "Error: " . $update_query . "<br>" . mysqli_error($koneksi);
                    }
                } else {
                    // Jika barang belum ada di keranjang, tambahkan barang baru
                    $insert_query = "INSERT INTO keranjang (id_barang, jumlah, id_user) VALUES ('$id_barang', 1, '$id_user')";
                    if (mysqli_query($koneksi, $insert_query)) {
                        echo "<p>Produk berhasil ditambahkan ke keranjang.</p>";
                    } else {
                        echo "Error: " . $insert_query . "<br>" . mysqli_error($koneksi);
                    }
                }
            }

            // Jika tombol "Kurangi" ditekan
            if (isset($_POST['kurangi'])) {
                $id_keranjang = $_POST['id_keranjang'];

                // Kurangi jumlah barang dalam keranjang
                $update_query = "UPDATE keranjang SET jumlah = jumlah - 1 WHERE id_keranjang = '$id_keranjang'";
                if (mysqli_query($koneksi, $update_query)) {
                    echo "<p>Jumlah barang berhasil dikurangi.</p>";
                } else {
                    echo "Error: " . $update_query . "<br>" . mysqli_error($koneksi);
                }
            }

            // Jika tombol "Tambah" ditekan
            if (isset($_POST['tambah'])) {
                $id_keranjang = $_POST['id_keranjang'];

                // Tambah jumlah barang dalam keranjang
                $update_query = "UPDATE keranjang SET jumlah = jumlah + 1 WHERE id_keranjang = '$id_keranjang'";
                if (mysqli_query($koneksi, $update_query)) {
                    echo "<p>Jumlah barang berhasil ditambahkan.</p>";
                } else {
                    echo "Error: " . $update_query . "<br>" . mysqli_error($koneksi);
                }
            }

            // Jika tombol "Hapus" ditekan
            if (isset($_POST['hapus'])) {
                $id_keranjang = $_POST['id_keranjang'];

                // Hapus item dari keranjang
                $delete_query = "DELETE FROM keranjang WHERE id_keranjang = '$id_keranjang'";
                if (mysqli_query($koneksi, $delete_query)) {
                    echo "<p>Item berhasil dihapus dari keranjang.</p>";
                } else {
                    echo "Error: " . $delete_query . "<br>" . mysqli_error($koneksi);
                }
            }

            // Jika tombol "Cetak" ditekan
            if (isset($_POST['cetak'])) {
                // Buat data transaksi baru di tabel transaksi
                $total = 0;
                // Query untuk mendapatkan daftar barang di keranjang yang id_transaksi belum diisi
                $query = "SELECT keranjang.id_keranjang, keranjang.id_user, barang.nama_barang, barang.harga_barang, keranjang.jumlah 
                FROM keranjang 
                JOIN barang ON keranjang.id_barang = barang.id_barang 
                WHERE keranjang.id_transaksi = 0 AND
                keranjang.id_user = '$id_user'
                ";

                $result = mysqli_query($koneksi, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $total += $row['jumlah'] * $row['harga_barang'];
                }
                $date = date("Y-m-d");
                $insert_transaksi_query = "INSERT INTO transaksi (tgl_transaksi, total) VALUES ('$date', '$total')";
                if (mysqli_query($koneksi, $insert_transaksi_query)) {
                    echo "<p>Transaksi berhasil ditambahkan.</p>";
                    // Ambil ID transaksi baru
                    $id_transaksi = mysqli_insert_id($koneksi);
                    // Update kode_transaksi pada tabel keranjang dengan ID transaksi baru
                    $update_keranjang_query = "UPDATE keranjang SET id_transaksi = '$id_transaksi' WHERE id_user = '$id_user' AND id_transaksi = 0";
                    if (mysqli_query($koneksi, $update_keranjang_query)) {
                        echo "<p>Kode transaksi berhasil diupdate pada keranjang.</p>";
                    } else {
                        echo "Error: " . $update_keranjang_query . "<br>" . mysqli_error($koneksi);
                    }
                } else {
                    echo "Error: " . $insert_transaksi_query . "<br>" . mysqli_error($koneksi);
                }
            }

            // Query untuk mendapatkan daftar barang di keranjang
            // Query untuk mendapatkan daftar barang di keranjang yang id_transaksi belum diisi
            $query = "SELECT keranjang.id_keranjang, keranjang.id_user, barang.nama_barang, barang.harga_barang, keranjang.jumlah 
                      FROM keranjang 
                      JOIN barang ON keranjang.id_barang = barang.id_barang 
                      WHERE keranjang.id_transaksi = 0 AND
                      keranjang.id_user = '$id_user'
                      ";


            $result = mysqli_query($koneksi, $query);

            $no = 1;
            $total = 0;

            // Tampilkan daftar barang di keranjang
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $row['nama_barang'] . "</td>";
                echo "<td>Rp " . number_format($row['harga_barang'], 0, ",", ".") . "</td>";
                echo "<td>";
                echo "<form method='post'>";
                echo "<input type='hidden' name='id_keranjang' value='" . $row['id_keranjang'] . "'>";
                if ($row['jumlah'] > 1) {
                    echo "<button type='submit' class='quantity-btn' name='kurangi'>-</button>";
                } else {
                    echo "<button type='submit' class='quantity-btn' name='hapus' onclick='return confirmDelete();'>-</button>";
                }
                echo "&nbsp;" . $row['jumlah'] . "&nbsp;";
                echo "<button type='submit' class='quantity-btn' name='tambah'>+</button>";
                echo "</form>";
                echo "</td>";
                $total += $row['harga_barang'] * $row['jumlah'];
                echo "</tr>";
            }

            // Tutup koneksi
            mysqli_close($koneksi);
            ?>
            <tr>
                <td colspan="3" align="right"><b>Total</b></td>
                <td><b>Rp <?php echo number_format($total, 0, ",", "."); ?></b></td>
            </tr>
        </table>
        <button onclick="window.print()" type="submit" name="cetak">Cetak</button>
    </form>
</body>

</html>