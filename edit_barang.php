<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Barang</title>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link rel="stylesheet" href="css/menuadmin.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
  <link rel="icon" type="image/png" href="img/logokopi.png">
</head>

<body>
  <?php
  include 'koneksi.php';
  $edit_data = mysqli_query($conn, "SELECT * FROM barang WHERE ID_Barang = '" . $_GET['ID_Barang'] . "'");
  $result = mysqli_fetch_array($edit_data);
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
          <a style="background-color: #1dff1d" href="barang.php"><i class="fas fa-dolly-flatbed"></i> Barang</a>
        </li>
        <li>
          <a href="supplier.php"><i class="fas fa-truck"></i> Supplier</a>
        </li>
        <li>
          <a href="transaksi.php"><i class="fas fa-donate"></i> Transaksi</a>
        </li>
        <li>
          <a href="tambah.php"><i class="fas fa-edit"></i> Tambah</a>
        </li>
        <li>
          <a style="background-color: #916be1" href="admin.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
      </ul>
    </div>
    <section>
      <h1>Edit data barang</h1>
      <form action="" method="POST">
        <table>
          <tr>
            <td>Nama Barang</td>
            <td>:</td>
            <td><input type="text" name="Nama_Barang" placeholder="Nama Barang" value="<?php echo $result['Nama_Barang'] ?>" required></td>
          </tr>
          <tr>
            <td>Jumlah Barang</td>
            <td>:</td>
            <td><input type="text" name="Jumlah_Barang" placeholder="Jumlah Barang" value="<?php echo $result['Jumlah_Barang'] ?>" required></td>
          </tr>
          <tr>
            <td>Harga Barang</td>
            <td>:</td>
            <td><input type="text" name="Harga_Barang" placeholder="Harga Barang" value="<?php echo $result['Harga_Barang'] ?>" required></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td><input type="submit" name="simpan" value="simpan"></td>

          </tr>
        </table>
      </form>
      <p><?php if (isset($_POST['simpan'])) {
            $update = mysqli_query($conn, "UPDATE barang SET Nama_Barang = '" . $_POST['Nama_Barang'] . "',
            Jumlah_Barang = '" . $_POST['Jumlah_Barang'] . "',
            Harga_Barang = '" . $_POST['Harga_Barang'] . "' WHERE ID_Barang = '" . $_GET['ID_Barang'] . "'");
            if ($update) {
              echo 'Data berhasil di edit! silahkan lihat di data barang';
            } else {
              echo 'Data gagal di edit!';
            }
          }
          ?>
      </p>
    </section>
  </main>
</body>

</html>