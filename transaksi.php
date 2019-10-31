<!-- <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjam Buku</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script type="text/javascript">
      function Add(){
        // set input action menjadi "insert"
        document.getElementById('action').value="insert";

        // kosongkan inputan form-datanya
        document.getElementById("id_pembeli").value="";
        document.getElementById("username").value="";
        document.getElementById("password").value="";
        document.getElementById("nama").value="";
        document.getElementById("alamat").value="";
      }

      function Edit(index){
        // set input action menjadi "update"
        document.getElementById('action').value="update";

        // set form-nya berdasarkan data table yang dipilih
        var table = document.getElementById("transaksi");
        // tampung data dari tabel
        var id_pembeli = table.rows[index].cells[0].innerHTML;
        var username = table.rows[index].cells[1].innerHTML;
        var password = table.rows[index].cells[2].innerHTML;
        var nama = table.rows[index].cells[3].innerHTML;
        var alamat = table.rows[index].cells[4].innerHTML;

        // keluarkan pada Form
        document.getElementById("id_barang").value = id_pembeli;
        document.getElementById("id_pembeli").value = nama;
        document.getElementById("id_pembeli").value = alamat;
        document.getElementById("id_transaksi").value = nama;
        document.getElementById("tanggal").value = nama;
      }
    </script>
  </head>
  <body>
    <div class="container">
      <div class="card col-sm-12">
        <div class="card-header">
          <h4>Daftar Transaksi</h4>
        </div>
        <div class="card-body">
          <?php
          $koneksi = mysqli_connect("localhost","root","","olshop");
          $sql = "select * from table_transaksi";
          $result = mysqli_query($koneksi,$sql);
          $count = mysqli_num_rows($result);
          ?>

          <?php if ($count == 0); ?>
          <div class="alert alert-info">
            Data belum tersedia
          </div>

        <?php else ?>
          <table class="table" id="table_transaksi">
            <thead>
              <tr>
                <th>kode_barang</th>
                <!-- <th>nis</th> -->
                <th>id_pembeli</th>
                <th>id_transaksi</th>
                <th>tgl</th>
                <!-- <th>tgl_kembali</th> -->
              </tr>
            </thead>
            <tbody>
              <?php foreach ($result as $hasil); ?>
                <tr>
                  <td><?php echo $hasil ["kode_barang"]; ?></td>
                  <td><?php echo $hasil ["id_pembeli"]; ?></td>
                  <td><?php echo $hasil ["id_transaksi"]; ?></td>
                  <td><?php echo $hasil ["tgl"]; ?></td>
                  <td>
                    <button type="button" class="btn btn-info"
                      data-toggle="modal" data-target="#modal"
                      onclick="Edit(this.parentElement.parentElement.rowIndex);">
                    </button>

                    <a href="db.php?hapus=table_transaksi&kode_barang=<?php echo $hasil['kode_barang']; ?>"
                      onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                      <button type="button" class="btn btn-danger">
                        Hapus
                      </button>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

        <?php endif; ?>
        </div>
        <div class="card-footer">
          <button type="button" class="btn btn-success"
            data-toggle="modal" data-target="#modal" onclick="Add()">
            Tambah
          </button>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form action="db.php" method="post">
            <div class="modal-header">
              <h4>Form Transaksi</h4>
              <span class="close" data-dismiss="modal">&times;</span>
            </div>
            <div class="modal-body">
              <input type="hidden" name="action" id="action">
              kode_barang
              <input type="text" name="kode_barang" id="kode_barang" class="form-control">
              <!-- nis
              <input type="text" name="nis" id="nis" class="form-control"> -->
              id_pembeli
              <input type="text" name="id_pembeli" id="id_pembeli" class="form-control">
              id_transaksi
              <input type="text" name="id_transaksi" id="id_transaksi" class="form-control">
              tgl
              <input type="text" name="tgl" id="tgl" class="form-control">
              <!-- tgl_kembali
              <input type="text" name="tgl_kembali" id="tgl_kembali" class="form-control"> -->
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">
                Simpan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html> -->
