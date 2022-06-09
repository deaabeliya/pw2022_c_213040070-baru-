<?php
// mengecek apakah ada id yang dikirimkan
// jika tidak maka akan dikembalikan ke halaman index.php
if (!isset($_GET['id'])) {
    header("Location: ../index.php");
    exit;
}
require '../php/functions.php';

// mengambil id dari url 
$id = $_GET['id'];


//melakukan query dengan parameter id yang diambil dari url
$brg = query("SELECT * FROM barang WHERE id = $id")[0];

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
    <link rel="stylesheet" href="css/style.css">
    <title>Z Store</title>
    <style>
        .container {
            background-color: #FFE4E1;
            width: 700px;
            height: 300px;
            margin: 100px 0 0 350px;
            padding: 20px;
            text-align: center;
            font-family: courier;
            font-size: medium;
        }

        img {
            width: 300px;
            height: 300px;
            float: left;
        }

        body {
            background: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="gambar">
            <img src="../assets/imagee/<?= $brg["Foto"]; ?>" alt="">
        </div>
        <div class="keterangan">
            <p><?= $brg["Nama"]; ?></p>
            <p><?= $brg["Spesifikasi"]; ?></p>
            <p><?= $brg["Warna"]; ?></p>
            <p><?= $brg["Harga"]; ?></p>
            <p><?= $brg["Stok"]; ?></p>
        </div>
        <button class="tombol-kembali"><a href="../index.php">Kembali</a></button>
    </div>
</body>

</html>