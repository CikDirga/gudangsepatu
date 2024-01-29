<?php
include "koneksi.php";

if (isset($_POST['bHapus'])) {
    $hapus = mysqli_query($koneksi, "DELETE FROM tb_stock
                                    WHERE id_produk=    '$_POST[idproduk]'");

    if ($hapus) {
        echo "<script>
        alert('Hapus data sukses');
        document.location='index.php';
        </script>";
    } else {
        echo "<script>
        alert('Hapus data gagal');
        document.location='index.php';
        </script>";
    }
}
?>
