<?php

require 'php/functions.php';

$barang = query("SELECT * FROM barang");

if (isset($_GET["cari"])) {
    $barang = cari($_GET["keyword"]);
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
    <link rel="stylesheet" href="css/style.css">
    <title>Z Store</title>
    <style>
        nav.background {
            background: linear-gradient(45deg, white);
        }

        body {
            background: white;
        }

        .brand-logo {
            font-family: Spectral;
            color: white;
        }

        .slider h3 {
            padding-top: 180px;
            text-shadow: 0px 0px 50px rgba(0, 0, 0, 1);
            font-family: Lobster;
        }

    </style>
</head>

<body id="beranda">
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!-- navbar -->
    <div class="navbar-fixed">
        <nav class="background">
            <div class="container">
                <div class="nav-wrapper">
                    <a href="#beranda" class="brand-logo">Z Store</a>
                    <a href="#" data-target="mobile-nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li>
                            <i class="large material-icons">search</i>
                        </li>
                        <li>
                            <form action="" method="GET">
                                <input type="text" name="keyword" size="30" autofocus placeholder="Cari..." autocomplete="off" class="keyword">
                                <button type="submit" name="cari" class="tombol-cari">Cari!</button>
                            </form>
                        </li>
                        <li><a href="#beranda">Beranda</a></li>
                        <li><a href="#produk">Produk</a></li>
                        <li><a href="#kontak">Kontak</a></li>
                        <li>
                            <div class="masuk">
                                <button type="submit" name="submit" class="btn  waves-effect waves-dark"><a href="php/login.php">MASUK</a></button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- sidenav -->
    <ul class="sidenav" id="mobile-nav">
        <li>
            <div class="masuk">
                <button type="submit" name="submit" class="btn  waves-effect waves-dark"><a href="php/login.php" style="color: white;">MASUK</a></button>
            </div>
        </li>
        <li>
            <form action="" method="GET">
                <input type="text" name="keyword" size="20" placeholder="Cari..." autocomplate="off" autofocus>
                <input type="hidden" name="cari">
            </form>
        </li>
        <li>
            <a href="#beranda">Beranda</a>
            <a href="#produk">Produk</a>
            <a href="#kontak">Kontak</a>
        </li>
    </ul>

    <!-- slider -->
    <div class="slider">
        <div class="cotainer">
            <ul class="slides">
                <li>
                    <img src="assets/slider/son.jpg">
                    <div class="caption center-align">
                    </div>
                </li>
                <li>
                    <img src="assets/slider/dan.jpg">
                    <div class="caption right-align">
                    </div>
                </li>
                <li>
                    <img src="assets/slider/3.png">
                    <div class="caption left-align">
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <!--produk-->
    <h3 class="center white-text text-lighten-3" id="produk">Produk</h3>

    <div class="container">
        <ul class="collection">
            <?php foreach ($barang as $brg) : ?>
                <li class="collection-item avatar">
                    <img src="assets/imagee/<?= $brg['Foto']; ?>" alt="<?= $brg['Nama']; ?>" class="circle">
                    <span class="title"></span>
                    <p class="nama">
                        <a href="php/detaill.php?id=<?= $brg['id']; ?>"><?= $brg['Nama']; ?></a>
                    </p>
                    <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>



    <!-- kontak -->
    <div class="container" id="kontak">
        <h3 class="center white-text text-lighten-3">KONTAK</h3>
        <br>
        <div class="row">
            <div class="col m12 s6">
                <div class="card-panel grey darken-3 center white-text">
                    <i class="material-icons"></i>
                    <h5>Kontak</h5>
                    <p>Jika Anda ingin menghubungi saya, di Media Sosial.</p>
                    <p>Instagram : @dblyaaa_</p>
                    <p>Facebook : Dea Abeliya</p>
                    <img src="../tubes/assets/img/ig.png " width="30px">
                    <img src="../tubes/assets/img/fb.png " width="30px">
                </div>
            </div>
        </div>
    </div>

    <!--footer-->
    <footer style="padding: 5px; height: 30px; color: white; text-align: center;">
        <p class="flow-text grey darken-3">&copy; 2022 Z Store</p>
    </footer>


    <body>
    <div class="container">
        <button class="hidden btn btn-danger mt-3" onclick="window.print">
        <i class="bi bi-journal-plus">Cetak PDF</i>
    </div>

    <script src="js/script.js"></script>


    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script>
        const sideNav = document.querySelectorAll('.sidenav');
        M.Sidenav.init(sideNav);
        const slider = document.querySelectorAll('.slider');
        M.Slider.init(slider, {
            indicators: false,
            height: 500,
            width: 300
        });
    </script>
</body>

</html>