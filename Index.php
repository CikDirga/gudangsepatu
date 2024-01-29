<?php

  include "koneksi.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cik Dirga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>

    <h1 class="mb-5"> DATA GUDANG TOKO CIK DIRGA </h1>

  <div class="card">
    <div class="card-header bg-primary text-white">
      Data Produk
    </div>
    <div class="card-body">

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modaltambah">
      Tambah Produk
    </button>
    <!-- Akhir trigger modal -->

    <!-- Pencarian -->
    <div class="card-body">
    <div class="col-md-6 mx-auto">
        <form method="POST">
            <div class="input-group mb-3">
                <input type="text" name="tcari" value="<?= isset($_POST['tcari']) ? $_POST['tcari'] : '' ?>" class="form-control" placeholder="Masukkan Nama Produk!">
                <button class="btn btn-primary" name="bcari" type="submit">Cari</button>
                <button class="btn btn-danger" name="breset" type="submit">Reset</button>
            </div>
        </form>
    </div>
    </div>
    <!-- Akhir Pencarian -->

    <table class="table table-bordered table-striped table-hover">
        <tr class="text-center">
          <th>No</th>
          <th>ID</th>
          <th>Nama Produk</th>
          <th>Jenis</th>
          <th>Ukuran</th>
          <th colspan=2>Aksi</th>
        </tr>

      <?php
          $no=1;

          //untuk pencarian data
          //jika tombol
          if(isset($_POST['bcari'])){
            //tampilkan data yang dicari
            $keyword = $_POST['tcari'];
            $q ="SELECT * FROM tb_stock WHERE nama_produk like'%$keyword%' or jenis like '%$keyword%' order by id_produk desc";
          }else
          {
            $q = "SELECT * FROM tb_stock ORDER BY id_produk DESC";
          }


          $tampil=mysqli_query($koneksi,$q);
          while($data=mysqli_fetch_array($tampil)):
      ?>

        <tr>
          <td><?= $no++ ?></td>
          <td><?= $data ["id_produk"] ?></td>
          <td><?= $data ["nama_produk"] ?></td>
          <td><?= $data ["jenis"] ?></td>
          <td><?= $data ["ukuran"] ?></td>
          <td> 
              <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalubah<?= $no; ?>">Ubah</a>
              <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalhapus<?= $no; ?>">Hapus</a>
          </td>
        </tr>

      <!-- Awal Modal Edit -->
      <div class="modal fade" id="modalubah<?= $no; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <form method="POST" action="editdata.php">
                    <div class="mb-3">
                    <label class="form-label">ID</label>
                    <input type="text" class="form-control" name="idproduk" placeholder="" value="<?php echo $data ["id_produk"] ?>" autofocus required>
                    </div>
                    <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" name="namaproduk" placeholder="" value="<?php echo $data ["nama_produk"] ?>" autofocus required>
                    </div>
                    <div class="mb-3">
                    <label class="form-label">Jenis</label>
                    <input type="text" class="form-control" name="jenisproduk" placeholder="" value="<?php echo $data ["jenis"] ?>" autofocus required>
                    </div>
                    <div class="mb-3">
                    <label class="form-label">Ukuran</label>
                    <input type="text" class="form-control" name="ukuranproduk" placeholder="" value="<?php echo $data ["ukuran"] ?>" autofocus required>
                    </div>

            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="bUbah" onclick="return confirm ('Apakah yakin ingin mengubah data?')">Ubah</button>
              <button type="button" class="btn btn-danger" >Batal</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Akhir Modal -->


        <!-- Awal Modal hapus-->
            <div class="modal fade" id="modalhapus<?= $no; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <form method="POST" action="hapusdata.php">
                    <input type="text" class="form-control" name="idproduk" placeholder="" value="<?php echo $data ["id_produk"] ?>">
                    <h5 class="text-center">Yakin hapus produk ini?
                        <br>
                        <span class="text-danger"><?=$data['id_produk'] ?> - <?= $data ['nama_produk'] ?> </spain> </h5>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="bHapus">Hapus</button>
              <button type="button" class="btn btn-danger">Batal</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Akhir Modal -->
      
        <?php endwhile ?>
      </table>

    <!-- Awal Modal tambah -->
    <div class="modal fade" id="modaltambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Produk Baru</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
                  <form method="POST" action="tambah.php">
                  <div class="mb-3">
                  <label class="form-label">ID</label>
                  <input type="text" class="form-control" name="idproduk" placeholder="">
                  </div>
                  <div class="mb-3">
                  <label class="form-label">Nama Produk</label>
                  <input type="text" class="form-control" name="namaproduk" placeholder="">
                  </div>
                  <div class="mb-3">
                  <label class="form-label">Jenis</label>
                  <input type="text" class="form-control" name="jenisproduk" placeholder="">
                  </div>
                  <div class="mb-3">
                  <label class="form-label">Ukuran</label>
                  <input type="text" class="form-control" name="ukuranproduk" placeholder="">
                  </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="bSimpan">Simpan</button>
            <button type="button" class="btn btn-danger">Batal</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Akhir Modal -->

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>