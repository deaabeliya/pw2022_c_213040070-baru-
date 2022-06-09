<?php
require '../php/functions.php';
$barang = cari($_GET['keyword']);

?>


    <table class="centered highlight - black-text white darken-3">
        <tr class="z-depth-5 blue-grey darken-2 white-text">
            <th>No</th>
            <th>Nama Barang</th>
            <th>Spesifikasi</th>
            <th>Warna</th>
            <th>Harga</th>
            <th>Stok Barang</th>
            <th>Foto</th>
            <th>Detail</th>
            <th>Opsi</th>
        </tr>
        <?php if (empty($barang)) : ?>
            <tr>
                <td colspan="7">
                    <h1>Data tidak ditemukan</h1>
                </td>
            </tr>
        <?php else : ?>
            <?php $i = 1 ?>
            <?php foreach ($barang as $brg) : ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $brg["Nama"]; ?></td>
                    <td><?= $brg["Spesifikasi"]; ?></td>
                    <td><?= $brg["Warna"]; ?></td>
                    <td><?= $brg["Harga"]; ?></td>
                    <td><?= $brg["Stok"]; ?></td>
                    <td><img src="../assets/imagee/<?= $brg["Foto"]; ?>" alt=""></td>
                    <td>
                        <p class="Nama">
                            <a href="../php/detailll.php?id=<?= $brg['id']; ?>">
                                <?= $brg["Nama"]; ?>
                    </td>
                    <td>
                        <div class="update"><a href="ubah.php?id=<?= $brg['id']; ?>" class="waves-effect waves-light green lighten-2 btn-small">Ubah</a></div>
                        <div class="delete"><a href="hapus.php?id=<?= $brg['id']; ?>" class="waves-effect waves-light pink darken-3 btn-small" onclick="return confirm('Hapus Data??')">Hapus</a></div>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>