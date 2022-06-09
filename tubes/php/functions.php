<?php
// fungsi untuk melakukan koneksi database
function koneksi()
{
    $conn = mysqli_connect("localhost", "root", "");
    mysqli_select_db($conn, "pw2022_tubes_c_213040070");

    return $conn;
}

// function untuk melakukan query dan memasukkannya ke dalam array
function query($sql)
{
    $conn = koneksi();
    $result = mysqli_query($conn, "$sql");
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function upload()
{

    $nama_file = $_FILES['Foto']['name'];
    $tipe_file = $_FILES['Foto']['type'];
    $ukuran_file = $_FILES['Foto']['size'];
    $error = $_FILES['Foto']['error'];
    $tmp_file = $_FILES['Foto']['tmp_name'];

    // ketika tidak ada gambar dipilih
    if ($error == 4) {
        // echo "<script>
        //         alert('pilih gambar terlebih dahulu!');
        //     </script>";
        return 'nophoto.jpg';
    }

    // cek ekstensi file
    $daftar_gambar = ['jpg', 'jpeg', 'png'];
    $ekstensi_file = explode('.', $nama_file);
    $ekstensi_file = strtolower(end($ekstensi_file));
    if (!in_array($ekstensi_file, $daftar_gambar)) {
        echo "<script>
                alert('yang anda pilih bukan gambar!');
            </script>";
        return false;
    }

    // cek type file
    if ($tipe_file != 'image/jpeg' && $tipe_file != 'image/png') {
        echo "<script>
                alert('yang anda pilih bukan gambar!');
            </script>";
        return false;
    }

    // cek ukuran file
    // maksimal 5Mb == 5000000
    if ($ukuran_file > 5000000) {
        echo "<script>
                alert('ukuran terlalu besar!');
            </script>";
        return false;
    }

    // lolos pengecekan
    // siap upload file
    // generate nama file baru
    $nama_file_baru = uniqid();
    $nama_file_baru .= '.';
    $nama_file_baru .= $ekstensi_file;
    move_uploaded_file($tmp_file, '../assets/imagee/' . $nama_file_baru);

    return $nama_file_baru;
}

// fungsi untuk menambahkan data didalam database
function tambah($barang)
{
    $conn = koneksi();

    $Nama = htmlspecialchars($barang['Nama']);
    $Spesifikasi = htmlspecialchars($barang['Spesifikasi']);
    $Warna = htmlspecialchars($barang['Warna']);
    $Harga = htmlspecialchars($barang['Harga']);
    $Stok = htmlspecialchars($barang['Stok']);
    // $Foto = htmlspecialchars($barang['Foto']);

    // upload gambar
    $Foto = upload();
    if (!$Foto) {
        return false;
    }

    $query = "INSERT INTO barang
                    VALUES
                    ('', '$Nama', '$Spesifikasi', '$Warna', '$Harga', '$Stok', '$Foto')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    $conn = koneksi();

    // menghapus Foto di folder imagee
    $brg = query("SELECT * FROM barang WHERE id = $id")[0];
    if ($brg['Foto'] != 'nophoto.jpg') {
        unlink('../assets/imagee/' . $brg['Foto']);
    }

    mysqli_query($conn, "DELETE FROM barang WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function ubah($barang)
{
    $conn = koneksi();

    $id = htmlspecialchars($barang['id']);
    $Nama = htmlspecialchars($barang['Nama']);
    $Spesifikasi = htmlspecialchars($barang['Spesifikasi']);
    $Warna = htmlspecialchars($barang['Warna']);
    $Harga = htmlspecialchars($barang['Harga']);
    $Stok = htmlspecialchars($barang['Stok']);
    $Foto_lama = htmlspecialchars($barang['Foto_lama']);

    $Foto = upload();
    if (!$Foto) {
        return false;
    }

    if ($Foto == 'nophoto.jpg') {
        $Foto = $Foto_lama;
    }

    $query = "UPDATE barang SET
    
            Nama = '$Nama',
            Spesifikasi = '$Spesifikasi',
            Warna = '$Warna',
            Harga = '$Harga',
            Stok = '$Stok',
            Foto = '$Foto'
            WHERE id = '$id'
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword)
{

    $conn = koneksi();

    $query = "SELECT * FROM barang WHERE
            Nama LIKE '%$keyword%' OR
            Spesifikasi LIKE '%$keyword%' OR
            Warna LIKE '%$keyword%' OR
            Harga LIKE '%$keyword%' OR
            Stok LIKE '%$keyword%'
            ";
    return query($query);

    $result = mysqli_query($conn, $query);

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function registrasi($data)
{
    $conn = koneksi();
    $username = strtolower(stripcslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username' ");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('username sudah digunakan');
            </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambah user baru
    $query_tambah = "INSERT INTO user VALUES('', '$username', '$password')";
    mysqli_query($conn, $query_tambah);

    return mysqli_affected_rows($conn);
}