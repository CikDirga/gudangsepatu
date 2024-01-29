<?php
include "koneksi.php"; // Pastikan file "koneksi.php" ada dan sesuai dengan konfigurasi koneksi Anda.

if (isset($_POST['bSimpan'])) {
    $simpan = mysqli_query($koneksi, "INSERT INTO tb_stock (id_produk, nama_produk, jenis, ukuran) 
                                    VALUES ('$_POST[idproduk]', 
                                            '$_POST[namaproduk]',
                                            '$_POST[jenisproduk]',
                                            '$_POST[ukuranproduk]')");

    if ($simpan) {
        echo "<script>
        alert('Simpan data sukses');
        document.location='index.php';
        </script>";
    } else {
        echo "<script>
        alert('Simpan data gagal');
        document.location='index.php';
        </script>";
    }
}
?>
