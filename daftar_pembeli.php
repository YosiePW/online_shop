<div class="card col-sm-12">
  <div class="card-header">
    <h3>Daftar Transaksi</h3>
  </div>
  <div class="card-body">
    <?php
    $koneksi = mysqli_connect("localhost","root","","online_shop");
    $sql = "select transaksi.*,pembeli.nama
    from transaksi inner join pembeli
    on transaksi.id_pembeli = pembeli.id_pembeli";
    $result = mysqli_query($koneksi,$sql);
    ?>

    <ul class="list-group">
      <?php foreach ($result as $hasil): ?>
        <li class="list-group-item">
          <h5>Pembeli: <?php echo $hasil["nama"]; ?>/<?php echo $hasil["$id_transaksi"]; ?></h5>
          <h5>Daftar Transaksi:</h5>
          <?php
          $sql2 = "select
          from detail_transaksi inner join barang
          on detail_transaksi.id_barang = barang.id_barang
          where detail_transaksi.id_transaksi = '".$hasil["id_transaksi"]."'";
          $result2 = mysqli_query($koneksi,$sql2);
          ?>
          <ul>
            <?php foreach ($result2 as $hasil2): ?>
              <li><?php echo $hasil2["id_barang"]."/".$hasil2["nama"]; ?></li>
            <?php endforeach; ?>
          </ul>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
