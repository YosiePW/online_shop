<script type="text/javascript">
  function Tambah(){

    document.getElementById("action").value = "insert";
    document.getElementById("id_barang").value = "";
    document.getElementById("nama").value = "";
    document.getElementById("stok").value = "";
    document.getElementById("harga").value = "";
    document.getElementById("deskripsi").value = "";


  }

  function Edit(index){
    document.getElementById("action").value = "update";
    var table = document.getElementById("table_barang");
    var id_barang = table.rows[index].cells[0].innerHTML;
    var nama = table.rows[index].cells[1].innerHTML;
    var stok = table.rows[index].cells[2].innerHTML;
    var harga = table.rows[index].cells[3].innerHTML;
    var deskripsi = table.rows[index].cells[4].innerHTML;


    document.getElementById("id_barang").value = id_barang;
    document.getElementById("nama").value = nama;
    document.getElementById("stok").value = stok;
    document.getElementById("harga").value = harga;
    document.getElementById("deskripsi").value = deskripsi;

  }

  </script>
<div class="card col-sm-12">
  <div class="card-header bg-primary text-white">
    <h4>Daftar  Barang</h4>
  </div>

  <div class="card-body">
    <?php if(isset($_SESSION["message"])): ?>
      <div class="alert alert-<?=($_SESSION["message"]["type"])?>">
        <?php echo $_SESSION["message"]["message"]; ?>
        <?php unset($_SESSION["message"]); ?>
        </div>
      <?php endif; ?>
    <?php
    $koneksi = mysqli_connect("localhost", "root", "", "online_shop");
    if (mysqli_connect_errno()) {
      echo mysqli_connect_error();
    }

    $sql = "select * from barang";
    $result = mysqli_query($koneksi, $sql);
    $count = mysqli_num_rows($result);

     ?>

     <?php if ($count == 0):  ?>
       <div class="alert alert-info">
         Data is empty
       </div>

     <?php else: ?>
       <table class="table" id="table_barang">
         <thead>
           <tr>
             <td>id_barang</td>
             <td>nama</td>
             <td>image</td>
             <td>stok</td>
             <td>harga</td>
             <td>deskripsi</td>
             <td>Opsi</td>

           </tr>
         </thead>

         <tbody>
           <?php foreach ($result as $hasil ) : ?>
             <tr>
               <td><?php echo $hasil["id_barang"] ?></td>
               <td><?php echo $hasil["nama"] ?></td>
               <td>
                  <img src="<?php echo "image_barang/".$hasil["image"]; ?>" id="<?php echo $hasil["id_barang"]; ?>" class="img" width="100">
               </td>
               <td><?php echo $hasil["stok"] ?></td>
               <td><?php echo $hasil["harga"] ?></td>
               <td><?php echo $hasil["deskripsi"] ?></td>

               <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target = "#modal" onclick="Edit(this.parentElement.parentElement.rowIndex)">Edit</button>
                <a href="db_barang.php?hapus=barang&id_barang=<?php echo $hasil["id_barang"];?>"
                  onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                  <button type="button" class="btn btn-danger" >Hapus</button>

                </a>

               </td>
             </tr>
           <?php endforeach; ?>
         </tbody>
       </table>
     <?php endif; ?>
  </div>

  <div class="card-footer">
    <button type="button" class="btn btn-success" data-toggle = "modal" data-target= "#modal" onclick="Tambah()">Tambah Data</button>
  </div>
</div>


<div class="modal fade" id="modal">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <form class="" action="db_barang.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
<h4>Form Barang</h4>
<span class="close" data-dismiss="modal">&times;</span>
</div>
<div class="modal-body">
<input type="hidden" name="action" id="action"/>
<!-- niki damel status edit/insert -->
Id_barang
<input type="text" name="id_barang" id="id_barang" class="form-control">
Nama
<input type="text" name="nama" id="nama" class="form-control">
Image
<input type="file" name="image" id="image" class="form-control">
Stok
<input type="number" name="stok" id="stok" class="form-control">
Harga
<input type="text" name="harga" id="harga" class="form-control">
Deskripsi
<input type="text" name="deskripsi" id="deskripsi" class="form-control">


</div>
<div class="modal-footer">
<button type="submit" class="btn btn-success">Simpan</button>
</div>
    </form>
  </div>
</div>
      </div>
