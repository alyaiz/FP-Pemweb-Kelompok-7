<?php
session_start();
include('koneksi.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/menu.css" />
  <link rel="icon" type="image/png" href="img/logokopi.png">
  <title>CAFE CASH</title>
</head>

<body>
  <section>
    <?php
    if (isset($_SESSION['pesan'])) {
      echo '<div class="alert" role="alert">
                  ' . $_SESSION['pesan'] . '
                </div>';

      unset($_SESSION['pesan']);
    }
    ?>
  </section>

  <section class="navbar-top">
    <?php
    $sql = mysqli_query($conn, 'SELECT * FROM transaksi_penjualan');
    $id = 2000;
    while ($data = mysqli_fetch_array($sql)) {
      $id = $data['ID_Transaksi'];
    }
    $id++;
    ?>
    <div class="header">
      <div class="left">
        <h3 id="1">Order</h3>
        <h1>#<?php echo $id ?></h1>
      </div>
      <div class="mid">
        <h1>Menu</h1>
      </div>
      <div class="right">
        <p>
          <?php date_default_timezone_set("Asia/Jakarta");
          echo date("l, d M Y")  ?>
        </p>
        <div>
          <a class="cancel" href="logoutkasir.php">
            Logout
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" class="logout">
              <rect width="256" height="256" fill="none" />
              <polyline fill="#none" stroke="#ec4646" stroke-linecap="round" stroke-linejoin="round" stroke-width="24" points="174.011 86 216 128 174.011 170" />
              <line x1="104" x2="215.971" y1="128" y2="128" fill="none" stroke="#ec4646" stroke-linecap="round" stroke-linejoin="round" stroke-width="24" />
              <path fill="none" stroke="#ec4646" stroke-linecap="round" stroke-linejoin="round" stroke-width="24" d="M104,216H48a8,8,0,0,1-8-8V48a8,8,0,0,1,8-8h56" />
            </svg>
          </a>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="navbar">
      <a href="#coffe">Coffee</a>
      <a href="#non-coffe">Non-Coffee</a>
      <a href="#side-dish">Side Dish</a>
      <a href="#makanan">Makanan</a>
    </div>
    <div class="containerBig">
      <div class="container">
        <div class="cards">
          <?php
          $query = mysqli_query($conn, 'SELECT * FROM menu');
          while ($data = mysqli_fetch_array($query)) {
            if ($data['id_menu'] == 1) {
              $id_menu = "coffe";
            } else if ($data['id_menu'] == 13) {
              $id_menu = "non-coffe";
            } else if ($data['id_menu'] == 20) {
              $id_menu = "side-dish";
            } else if ($data['id_menu'] == 26) {
              $id_menu = "makanan";
            }
          ?>

            <div id="<?php echo $id_menu ?>" class="card">
              <?php echo "<img src='img/" . $data['gambar'] . "'style='width:100%;  height:45%; object-fit: cover; object-position: 100% 20%'>" ?>
              <div class="anu1">
                <h2><b> <?php echo $data['nama'] ?> </b></h2>
                <div class="anu">
                  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" id_menu="id_produk" name="id_produk" value="<?php echo $data['id_menu'] ?>"></input>
                    <input class="jumlah" placeholder="0" type="number" id_menu="pembelian" name="pembelian" value="0" min="0" max="<?php echo $data['stok'] ?>">
                    <input class="submit" name="submit" type="submit">
                  </form>
                  <div>
                    <p>Harga</p>
                    <p class="num">Rp <?php echo number_format((string)$data['harga'], 0, ".", ".") ?></p>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </section>

  <section>
    <?php $total_bayar = 0;
    include('keranjang.php'); ?>

    <div class="footer">
      <div class="buttons">
        <a href="lihatPesan.php">Lihat Pesanan</a>
        <a href="checkout.php">Konfirmasi Pesanan
        </a>
      </div>
      <div class="tomkan">
        <a href="laporan.php"><button class="btn btn-danger">Lihat Laporan</button></a>
        <div class="tampil">
          <h3>Total Pembayaran</h3>
          <h2>
            Rp <?php echo number_format((string)($total_bayar), 0, ".", "."); ?>
          </h2>
        </div>
      </div>
    </div>
  </section>

  <script src="javascript/script.js"></script>
</body>

</html>