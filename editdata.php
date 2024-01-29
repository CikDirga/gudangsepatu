<?php
include "koneksi.php";

if (isset($_POST['bUbah'])) {
    $ubah = mysqli_query($koneksi, "UPDATE tb_stock SET
                                    nama_produk =   '$_POST[namaproduk]',
                                    jenis       =   '$_POST[jenisproduk]',
                                    ukuran      =   '$_POST[ukuranproduk]'
                                    WHERE id_produk   =   '$_POST[idproduk]'
                                    ");

    if ($ubah) {
        echo "<script>
        alert('Ubah data sukses');
        document.location='index.php';
        </script>";
    } else {
        echo "<script>
        alert('Ubah data gagal');
        document.location='index.php';
        </script>";
    }
}
?>
