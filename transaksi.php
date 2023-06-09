<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Transaksi</title>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
  <link rel="stylesheet" href="css/menuadmin.css" />
  <link rel="icon" type="image/png" href="img/logokopi.png">
</head>

<body>
  <?php
  require_once 'koneksi.php';
  $result = mysqli_query($conn, "SELECT * FROM transaksi");
  session_start();
  $order = isset($_GET['order']) ? $_GET['order'] : 'asc';
  $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id_transaksi';
  $result = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY $sort $order");

  // Query untuk mengambil data transaksi
  $order = isset($_GET['order']) ? $_GET['order'] : 'asc';
  $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id_transaksi';
  $result = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY $sort $order");

  // Query untuk menghitung total transaksi
  $totalResult = mysqli_query($conn, "SELECT SUM(Harga) AS Total FROM transaksi");
  $totalRow = mysqli_fetch_assoc($totalResult);
  $totalTransaksi = $totalRow['Total'];

  ?>
  <main>
    <input type="checkbox" id="check" />
    <label for="check">
      <i class="fas fa-bars" id="btn"></i>
      <i class="fa fa-arrow-right" id="open"></i>
    </label>
    <div class="sidebar">
      <div class="top">CAFE CASH</div>
      <ul>
        <li>
          <a href="homeadmin.php"><i class="fa fa-home"></i><span class="text nav-text">Dashboard</span></a>
        </li>
        <li>
          <a href="barang.php"><i class="fas fa-dolly-flatbed icon"></i>
            <span class="text nav-text">Barang</span></a>
        </li>
        <li>
          <a href="supplier.php"><i class="fas fa-truck icon"></i><span class="text nav-text">Supplier</span></a>
        </li>
        <li>
          <a style="background: #ffffff; color: rgb(0, 0, 0)" href="transaksi.php"><i class="fas fa-donate icon"></i><span class="text nav-text">Transaksi</span></a>
        </li>
        <li>
          <a href="tambah.php"><i class="fas fa-plus icon"></i><span class="text nav-text">Tambah</span></a>
        </li>
        <li class="bot">
          <a style="background-color: #916be1" href="admin.php"><i class="fas fa-sign-out-alt icon"></i><span class="text nav-text">Logout</span></a>
        </li>
      </ul>
    </div>
    <section>
      <h1>Data Transaksi</h1>
      <div class="table-container">
        <table style="width:80%; text-align:center">
          <thead>
            <tr>
              <th>No</th>
              <th><a href="?sort=id_transaksi&order=<?php echo ($order == 'asc' && $sort == 'id_transaksi') ? 'desc' : 'asc'; ?>">ID Transaksi</a></th>
              <th><a href="?sort=nama_barang&order=<?php echo ($order == 'asc' && $sort == 'nama_barang') ? 'desc' : 'asc'; ?>">Nama Barang</a></th>
              <th><a href="?sort=harga&order=<?php echo ($order == 'asc' && $sort == 'harga') ? 'desc' : 'asc'; ?>">Harga</a></th>
              <th>Edit</th>
            </tr>
          </thead>
          <?php $i = 1; ?>
          <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr class="q">
              <td><?php echo $i; ?></td>
              <td><?php echo $row['ID_Transaksi'] ?></td>
              <td><?php echo $row['Nama_Barang'] ?></td>
              <td><?php echo number_format((string)$row['Harga'], 0, ",", ".") ?></td>
              <td>
                <a href="edit_transaksi.php?ID_Transaksi=<?php echo $row['ID_Transaksi'] ?>"><i style="color: #70C762;" class="fas fa-pen" id="open"></i></a> ||
                <a href="hapus_transaksi.php?ID_Transaksi=<?php echo $row['ID_Transaksi'] ?>"><i style="color: #F65E5E;" class="fas fa-trash" id="open"></i></a>
              </td>
            </tr>
            <?php $i++; ?>
          <?php endwhile; ?>
        </table>
      </div>
      <p>Total Transaksi: <?php echo number_format((string)$totalTransaksi, 0, ",", ".") ?></p>
    </section>
  </main>
</body>

</html>