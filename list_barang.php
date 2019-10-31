<?php
$koneksi = mysqli_connect("localhost","root","","online_shop");
$sql = "select * from barang";
$result = mysqli_query($koneksi,$sql);
?>

<div class="row">
  <?php foreach ($result as $hasil): ?>
    <div class="card col-sm-4">
      <div class="card-body">
        <img src="image_barang/<?php echo $hasil["image"]; ?>" class="img" width="100%" height="auto">
      </div>
      <div class="card-footer">
         <h5 class="text-center"><?php echo $hasil["nama"]; ?></h5>
         <h6 class="text-center">Stok: <?php echo $hasil["stok-1"]; ?></h6>
         <h6 class="text-center">Rp. <?php echo $hasil["harga"]; ?></h6>
         <h6 class="text-center"><?php echo $hasil["deskripsi"]; ?></h6>
         <a href="db_transaksi.php?transaksi=true&id_barang=<?php echo $hasil["id_barang"]; ?>">
           <button type="button" class="btn btn-info btn-block">
             Beli
           </button>
         </a>
      </div>
    </div>
  <?php endforeach; ?>
</div>
