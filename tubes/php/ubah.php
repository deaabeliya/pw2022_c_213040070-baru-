<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

$id = $_GET['id'];
$brg = query("SELECT * FROM barang WHERE id = $id")[0];

if (isset($_POST['ubah'])) {
    if (ubah($_POST) > 0) {
        echo "<script>
                    alert('Data Berhasil diubah!');
                    document.location.href = 'admin.php';
                </script>";
    } else {
        echo "<script>
                    alert('Data Gagal diubah!');
                    document.location.href = 'admin.php';
                </script";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
    <!-- css style -->
    <link rel="stylesheet" href="../css/style.css">
    <title>D3 Store</title>
    <style>
        body {
            background-image: url(../assets/img/niel.jpg);
        }
    </style>
</head>

<body>
    <script type="text/javascript" src="..js/materialize.min.js"></script>
    <div class="container">
        <h3>Form Ubah Data</h3>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id" value="<?= $brg['id']; ?>">
            <ul>
                <li>
                    <label for="Nama">Nama Barang :</label><br>
                    <input type="text" name="Nama" id="Nama" required value="<?= $brg['Nama']; ?>">
                </li>
                <li>
                    <label for="Spesifikasi">Spesifikasi :</label><br>
                    <input type="text" name="Spesifikasi" id="Spesifikasi" required value="<?= $brg['Spesifikasi']; ?>">
                </li>
                <li>
                    <label for="Warna">Warna :</label><br>
                    <input type="text" name="Warna" id="Warna" required value="<?= $brg['Warna']; ?>">
                </li>
                <li>
                    <label for="Harga">Harga :</label><br>
                    <input type="text" name="Harga" id="Harga" required value="<?= $brg['Harga']; ?>">
                </li>
                <li>
                    <label for="Stok">Stok Barang :</label><br>
                    <input type="text" name="Stok" id="Stok" required value="<?= $brg['Stok']; ?>">
                </li>
                <li>
                    <input type="hidden" name="Foto_lama" value="<?= $brg['Foto']; ?>">
                    <label for="Foto">Foto :</label><br>
                    <input type="file" name="Foto" id="Foto" class="Foto" onchange="previewImage()"><br><br>
                    <img src="../assets/imagee/<?= $brg['Foto']; ?>" width="120" class="img-preview">
                </li>
                <br>
                <button type="submit" name="ubah" class="waves-effect waves-light red lighten-2 btn small">Ubah Data</button>
                <button type="submit">
                    <a href="admin.php" class="waves-effect waves-light red lighten-2 btn small">Kembali</a>
                </button>
            </ul>
        </form>
    </div>

    <script src="../js/script.js"></script>
</body>

</html>