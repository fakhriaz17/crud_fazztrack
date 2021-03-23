<?php
$server = "localhost";
$user = "root";
$pass = "";
$database = "fazztrack";

$koneksi = mysqli_connect($server, $user, $pass, $database) or die(mysqli_error($koneksi));

if (isset($_POST['simpan'])) {


  // Pengujian data akan di edit atau di simpan
  if ($_GET['hal'] == "edit") {
    $edit = mysqli_query($koneksi,  "UPDATE tb_produk set
                                      nama_produk = '$_POST[tnama]',
                                      keterangan_produk = '$_POST[tketerangan]',
                                      harga_produk = '$_POST[tharga]',
                                      jumlah_produk = '$_POST[tjumlah]'
                                      WHERE id_produk = '$_GET[id]'
                                            ");
    if ($edit) {
      echo "<script>
    alert('Berhasil Update Produk !');
    document.location = 'index.php';
    </script>";
    } else {
      echo "<script>
    alert('Gagal Edit Produk !');
    document.location = 'index.php';
    </script>";
    }
  } else {
    $simpan = mysqli_query($koneksi, "INSERT INTO tb_produk (nama_produk, keterangan_produk, harga_produk, jumlah_produk) 
                                    VALUES  ('$_POST[tnama]',
                                            '$_POST[tketerangan]',
                                            '$_POST[tharga]',
                                            '$_POST[tjumlah]')
                                            ");
    if ($simpan) {
      echo "<script>
    alert('Berhasil Menambahkan Produk !');
    document.location = 'index.php';
    </script>";
    } else {
      echo "<script>
    alert('Gagal Menambahkan Produk !');
    document.location = 'index.php';
    </script>";
    }
  }
}

if (isset($_GET['hal'])) {
  if ($_GET['hal'] == "edit") {
    $tampil = mysqli_query($koneksi, "SELECT * FROM tb_produK WHERE id_produk = '$_GET[id]' ");
    $data = mysqli_fetch_array($tampil);
    if ($data) {
      $vnama = $data['nama_produk'];
      $vketerangan = $data['keterangan_produk'];
      $vharga = $data['harga_produk'];
      $vjumlah = $data['jumlah_produk'];
    }
  } else if ($_GET['hal'] == "hapus") {
    $hapus = mysqli_query($koneksi, "DELETE FROM tb_produk WHERE id_produk = '$_GET[id]'");
    if ($hapus) {
      echo "<script>
      alert('Berhasil Menghapus Produk !');
      document.location = 'index.php';
      </script>";
    }
  }
}

?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <title>Fazztrack CRUD</title>
</head>

<body>

  <div class="container">
    <div class="card mt-3">
      <div class="card-header bg-primary text-white">
        Input Produk
      </div>
      <div class="card-body">
        <form method="post">
          <div class="mb-3">
            <label for="" class="form-label">Nama Produk</label>
            <input name="tnama" value="<?= @$vnama ?>" type="text" class="form-control" id="" placeholder="Input Nama Produk" required>
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Keterangan</label>
            <textarea name="tketerangan" class="form-control" placeholder="Input Keterangan" id="floatingTextarea" required><?= @$vketerangan ?></textarea>
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Harga</label>
            <input name="tharga" type="number" value="<?= @$vharga ?>" class="form-control" id="" placeholder="Input Harga" required>
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Jumlah</label>
            <input name="tjumlah" value="<?= @$vjumlah ?>" type="number" class="form-control" id="" placeholder="Input Jumlah" required>
          </div>
          <button name="simpan" type="submit" class="btn btn-primary">Submit</button>

        </form>
      </div>
    </div>


    <div class="card mt-3">
      <div class="card-header bg-success text-white">
        Tabel Produk
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped">
          <tr>
            <th>NO</th>
            <th>Nama Produk</th>
            <th>Keterangan</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Action</th>
          </tr>
          <?php
          $no = 1;
          $tampil = mysqli_query($koneksi, "SELECT * FROM tb_produk order by id_produk desc");
          while ($data = mysqli_fetch_array($tampil)) :
          ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $data['nama_produk'] ?></td>
              <td><?= $data['keterangan_produk'] ?></td>
              <td><?= $data['harga_produk'] ?></td>
              <td><?= $data['jumlah_produk'] ?></td>
              <td>
                <a href="index.php?hal=edit&id=<?= $data['id_produk'] ?>" class="btn btn-warning">Edit</a>
                <a href="index.php?hal=hapus&id=<?= $data['id_produk'] ?>" onclick="return confirm('Apakah yakin ingin menghapus produk ini?')" class="btn btn-danger">Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </table>

      </div>
    </div>
  </div>

  <src="https: //cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </src>
</body>

</html>