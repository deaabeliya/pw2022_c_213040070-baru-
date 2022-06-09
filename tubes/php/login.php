<?php
session_start();
require 'functions.php';
// melakukan pengecekan apakah user sudah melakukan login jika sudah redirect ke halaman admin
if (isset($_SESSION['username'])) {
    header("Location: admin.php");
    exit;
}
// cek cookie
if (isset($_COOKIE['username']) && isset($_COOKIE['hash'])) {
    $username = $_COOKIE['username'];
    $hash = $_COOKIE['hash'];

    // ambil username berdasarkan id
    $result = mysqli_query(koneksi(), "SELECT * FROM user WHERE username = '$username'");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ($hash === hash('sha256', $row['id'], false)) {
        $_SESSION['username'] = $row['username'];
        header("Location: admin.php");
        exit;
    }
}


// Login
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cek_user = mysqli_query(koneksi(), "SELECT * FROM user WHERE username = '$username'");
    // mencocokan USERNAME dan PASSWORD
    if (mysqli_num_rows($cek_user) > 0) {
        $row = mysqli_fetch_assoc($cek_user);
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['hash'] = hash('sha256', $row['id'], false);

            // jika remember me dicentang
            if (isset($_POST['remember'])) {
                setcookie('username', $row['username'], time() + 60 * 60 * 24);
                $hash = hash('sha256', $row['id']);
                setcookie('hash', $hash, time() + 60 * 60 * 24);
            }

            if (hash('sha256', $row['id']) == $_SESSION['hash']) {
                header("Location: admin.php");
                die;
            }
            header("Location: ../index.php");
            die;
        }
    }
    $error = true;
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
        <h3 class="centered black-text">Halaman Login</h3>

        <form action="" method="post">
            <?php if (isset($error)) : ?>
                <p style="color: red; font-style: italic;">Username atau Password salah</p>
            <?php endif; ?>
            <table>
                <tr>
                    <td><label for="username" class="black-text">Username</label></td>
                    <td>:</td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td><label for="password" class="black-text">Password</label></td>
                    <td>:</td>
                    <td><input type="password" name="password"></td>
                </tr>
            </table>
            <button type="submit" name="submit" class="waves-effect waves-light btn-small green darken-2 white-text">Masuk</button>

            <div class="registrasi">
                <p>Belum punya akun ? Registrasi <a href="registrasi.php">Disini</a></p>
            </div>
        </form>
    </div>
</body>

</html>