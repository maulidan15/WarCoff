<?php
session_start();

// Inisialisasi sesi jika belum diset
if (!isset($_SESSION['loggedin'])) {
  $_SESSION['loggedin'] = false;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

  <!-- sweetalert2 css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.2/sweetalert2.min.css">

  <!-- my css -->
  <link rel="stylesheet" href="assets/homepage/css/style.css">
  <title>Website Kedai Kopi</title>
</head>

<body>

  <!-- navbar start -->
  <nav class="navbar">
    <a href="#" class="navbar-logo">War<span>Coff</span></a>
    <div class="navbar-list-group">
      <a href="#home" class="navbar-list">Home</a>
      <a href="#about" class="navbar-list">Tentang Kami</a>
      <a href="#product" class="navbar-list">Produk</a>
      <a href="#contact" class="navbar-list">Help</a>
    </div>
    <div class="navbar-icon" style="
    display: flex;
    flex-direction: row;
    align-items: flex-end;">

      <?php
      include 'config.php';
      $total_barang = 0;

      if (isset($_SESSION['id_user'])) {
      $id_user = $_SESSION['id_user'];
      $query = "SELECT keranjang.id_keranjang, keranjang.id_user, SUM(keranjang.jumlah)AS total_barang 
      FROM keranjang 
      JOIN barang ON keranjang.id_barang = barang.id_barang 
      WHERE keranjang.id_transaksi = 0 AND
      keranjang.id_user = '$id_user'
      ";

      $result = mysqli_query($conn, $query);
      // Tampilkan daftar barang di keranjang
      while ($d = mysqli_fetch_assoc($result)) {
        $total_barang = $d['total_barang'];
      }
    }
      

      

      ?>
      <a href=" keranjang.php"><i data-feather="shopping-cart" class="icon btn-modal" id="shopping-cart"></i></a>
      <span class="icon"><?php echo $total_barang ?></>
        <?php
        if ($_SESSION['loggedin'] == true) {
          echo '<a href="page/auth/logout.php" class="button" style="padding: 4px 15px;background: #dc3545;">Logout</a>';
        } else {
          echo '<a href="page/auth/login.php" class="button" style="padding: 4px 15px;">Login</a>';
        }
        ?>
        <i data-feather="menu" class="icon" id="hamburger"></i>
    </div>
  </nav>
  <!-- navbar end -->

  <!-- section hero start -->
  <section class="hero" id="home">
    <div class="content">
      <h1>War<span>Coff</span></h1>
      <p>Mari nikamati secangkir kopi dapat menghilangkan penat.</p>
      <a href="#product" class="button">Beli Sekarang</a>
    </div>
  </section>
  <!-- section hero end -->

  <!-- section about start -->
  <section class="about" id="about">
    <h2>Tentang <span>Kami</span></h2>
    <div class="row">
      <div class="image-wrapper">
        <img src="assets/homepage/images/about.jpg" width="100" alt="tentang kami" class="image">
      </div>
      <div class="content">
        <h3>Kenapa Memilih Kami</h3>
        <p>Kami memilih dan memastikan biji kopi pilihan yang kami jual kepada anda selalu dalam keadaan baik agar anda
          tetap senang saat membeli produk kami.</p>
        <p>Kami akan terus mengembangkan produk dan kinerja kami dalam menjual kopi.</p>
      </div>
    </div>
  </section>
  <!-- section about end -->

  <!-- section menu start -->
  <section class="product" id="product">
    <div class="header">
      <h2>Produk <span>Kami</span></h2>
      <p>Berikut adalah beberapa produk kami yang kami jual kepada anda.</p>
    </div>

    <div class="card-container">
      <?php
      include 'config.php';
      $no = 1;
      $data = mysqli_query($conn, "SELECT * FROM barang");
      while ($d = mysqli_fetch_array($data)) {
        ?>
        <div class="card">
          <img style="max-width: 400px; max-height: 300px;" src="assets/admin/barang/<?php echo $d['gambar_barang']; ?>"
            alt="produk kami" class="card-image gambar-produk">
          <h4 class="nama-produk"><?php echo $d['nama_barang']; ?></h4>
          <h5 class="harga-produk"><?php echo $d['harga_barang']; ?></h5>
          <p><?php echo substr($d['deskripsi_barang'], 0, 100) . "...";// Memotong deskripsi hingga 100 karakter ?></p>
          <form method='post' action='keranjang.php'>
            <input type='hidden' name='id_barang' value=" <?php echo $d['id_barang'] ?>">
            <input type='submit' class="button button-cart" name='add_to_cart' value='Add to Cart'>
          </form>
        </div>
      <?php } ?>

    </div>
  </section>
  <!-- section menu end -->

  <!-- section contact start -->
  <section class="contact" id="contact">
    <div class="header">
      <h2>Kritik<span> dan </span>Saran</h2>
      <p>Hubungi kami untuk melakukan kritik dan saran secara personal agar kami bisa memperbaiki kinerja kami.</p>
    </div>
    <div class="row">
      <div class="image-wrapper">
        <img src="assets/homepage/images/contact.jpg" alt="kontak kami" class="image">
      </div>
      <div class="form-wrapper">
        <form action="page/admin/saran/add.php" method="post" class="form">
          <div class="form-group">
            <label for="nama" class="label">Nama lengkap</label>
            <?php
            if (isset($_SESSION['nama'])) {
            $nama = $_SESSION['nama'];
            echo '<input type="number" value="'.$_SESSION['id_user'].'" name="id_user" hidden>';
          }
            ?>
            <input type="text" id="nama" class="input input-name" placeholder="Nama lengkap" <?php if (isset($nama)) { ?>
                value="<?php echo $nama; ?>" <?php 
                echo 'readonly';
                } ?> >
              </div>
            <div class="form-group">
              <label for="kritik" class="label">Kritik</label>
              <input name="kritik" type="text" id="kritik" class="input input-kritik" placeholder="Kritik">
            </div>
            <div class="form-group">
              <label for="saran" class="label">Saran</label>
              <input name="saran" type="text" id="saran" class="input input-saran" placeholder="Saran">
            </div>
            <button type="submit" name="submit" class="button btn-submit">Submit</button>
        </form>
      </div>
    </div>
  </section>
  <!-- section contact end -->

  <!-- footer start -->
  <footer class="footer">
    <div class="wrapper">
      <a href="https://instagram.com/candradwicahyo18" target="_blank"><i data-feather="instagram"></i></a>
      <a href="https://facebook.com/candradwicahyo18" target="_blank"><i data-feather="facebook"></i></a>
      <a href="https://github.com/candradwicahyo" target="_blank"><i data-feather="github"></i></a>
    </div>
    <div class="wrapper">
      <a href="#home">Home</a>
      <a href="#about">Tentang Kami</a>
      <a href="#product">Produk Kami</a>
      <a href="#contact">Kontak</a>
    </div>
    <!-- <span>created by <a href="https://github.com/candradwicahyo" target="_blank">candra dwi cahyo</a> | © 2023</span> -->
    <span>created by Our Team | © 2024</span>
  </footer>
  <!-- footer end -->


  <!-- feather icon -->
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  <script src="assets/homepage/js/icon.js"></script>

  <!-- sweetalert2 js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.2/sweetalert2.min.js"></script>

  <!-- my javascript -->
  <script src="assets/homepage/js/script.js"></script>
</body>

</html>