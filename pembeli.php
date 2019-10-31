<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Tabel Pembeli</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      function Tambah(){
        document.getElementById("action").value = "insert";

        document.getElementById("id_pembeli").value = "";
        document.getElementById("username").value = "";
        document.getElementById("password").value = "";
        document.getElementById("nama").value = "";
        document.getElementById("alamat").value = "";

      }

      function Edit(index){
        document.getElementById("action").value = "update";

        var table = document.getElementById("pembeli");
        var id_pembeli = table.rows[index].cells[0].innerHTML;
        var username = table.rows[index].cells[1].innerHTML;
        var password = table.rows[index].cells[2].innerHTML;
        var nama = table.rows[index].cells[3].innerHTML;
        var alamat = table.rows[index].cells[4].innerHTML;


        document.getElementById("id_pembeli").value = id_pembeli;
        document.getElementById("username").value = username;
        document.getElementById("password").value = password;
        document.getElementById("nama").value = nama;
        document.getElementById("alamat").value = alamat;

      }
    </script>
  </head>
  <body>
    <div class="container">
      <div class="card col-sm-12">
        <div class="card-header bg-primary text-white">
          <h4>Data Pembeli</h4>
        </div>

        <div class="card-body">
          <?php if (isset($_SESSION["message"])): ?>
            <div class="alert alert-<?=($_SESSION["message"]["type"])?>">
              <?php echo $_SESSION["message"]["message"]; ?>
              <?php unset($_SESSION["message"]); ?>
            </div>
          <?php endif; ?>
          <?php
          $koneksi = mysqli_connect("localhost","root","","online_shop");
          if(mysqli_connect_errno()){
            echo mysqli_connect_error();
          }

          $sql = "select * from pembeli";
          $result = mysqli_query($koneksi,$sql);
          // eksekusi sintak sql
          $count = mysqli_num_rows($result);
           ?>

           <?php if($count == 0): ?>
             <!-- menawi data tdk ada, ada info dari alert -->
             <div class="alert alert-info">
               Data is empty
             </div>

           <?php else : ?>
             <!-- apabila ada, maka ditampilkan di tabel -->
             <table class="table" id="pembeli">
               <thead>
               <tr>
                 <td>Id Pembeli</td>
                 <td>Username</td>
                 <td>Password</td>
                 <td>Nama</td>
                 <td>Alamat</td>
                 <td>Opsi</td>
               </tr>
                </thead>
                <tbody>
                  <?php foreach ($result as $hasil ): ?>
                    <tr>
                      <td><?php echo $hasil["id_pembeli"] ;?></td>
                      <td><?php echo $hasil["username"] ;?></td>
                      <td><?php echo $hasil["password"] ;?></td>
                      <td><?php echo $hasil["nama"] ;?></td>
                      <td><?php echo $hasil["alamat"]; ?></td>
                      <td>
                        <button type="button"  class="btn btn-warning text-white"
                        data-toggle="modal" data-target="#modal"
                        onclick="Edit(this.parentElement.parentElement.rowIndex)">
                        Edit
                      </button>
                      <a href="db_pembeli.php?hapus=pembeli&id_pembeli=<?php echo $hasil["id_pembeli"]; ?>"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini ? ')">
                        <button type="button" class="btn btn-danger">
                          Hapus
                        </button>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
                  </tbody>
                </table>
              <?php endif;?>
            </div>

            <div class="card-footer">
              <button type="button" class="btn btn-primary text-white"
              data-toggle="modal" data-target="#modal"
              onclick="Tambah()">
              Tambah Data
              </button>
            </div>
      </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="modal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
           <form action="db_pembeli.php" method="post" enctype="multipart/form-data">
            <div class="modal-header">
              <h4>Data Pembeli</h4>
              <span class="close" data-dismiss="modal">&times;</span>
            </div>

            <div class="modal-body">
              <input type="hidden" name="action" id="action"/>
              Id Pembeli
              <input type="text" name="id_pembeli" id="id_pembeli" class="form-control" >
              Username
              <input type="text" name="username" id="username" class="form-control">
              Password
              <input type="password" name="password" id="password" class="form-control">
              Nama
              <input type="text" name="nama" id="nama" class="form-control">
              Alamat
              <input type="text" name="alamat" id="alamat" class="form-control">
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
</html>
