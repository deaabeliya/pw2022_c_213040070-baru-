<?php
require 'functions.php';

if (isset($_POST["register"])) {

    if (registrasi($_POST) > 0) {
        echo "<script>
                alert('Registrasi Berhasil');
                document.location.href = 'login.php';
            </script>";
    } else {
        echo "<script>
                alert('Registrasi Gagal');
            </script>";
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
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
    <!-- css style -->
    <link rel="stylesheet" href="../css/style.css">
    <title>Z Store</title>
    <style>
        body {
            background-image: url(../assets/img/niel.jpg);
        }
    </style>
</head>

<body>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <div class="container">
        <h3 class="centered black-text">Form Registrasi</h3>

        <form action="" method="post">
            <div>
                <tr>
                    <td><label style="color: black;" for="username">Username</label></td>
                    <td>:</td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td><label style="color: black;" for="password">Password</label></td>
                    <td>:</td>
                    <td><input type="password" name="password"></td>
                </tr>
            </div>
            <button type="submit" name=" register" class="waves-effect waves-light btn-small green darken-2">REGISTER</button>
            <a href="login.php" class="waves-effect waves-light btn-small red darken-2">Kembali</a>
        </form>

    </div>
</body>

</html>