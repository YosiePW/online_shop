<script type="text/javascript">
  function Print(){
    var printDocument = document.getElementById("report").innerHTML;
    var originalDocument = document.body.innerHTML;
    document.body.innerHTML = printDocument;
    document.getElementById("print").style.display="none";
    window.print();
    document.body.innerHTML = originalDocument;
  }
</script>
<div id="report" class="card col-sm-12">
  <div class="card-header">
    <h3>Daftar Transaksi</h3>
  </div>
  <div class="card-body">
    <?php
    $koneksi = mysqli_connect("localhost","root","","online_shop");
    //menghubungkan antara tabel transaksi dengan tabel pembeli
    $sql = "select t.*, p.nama
    from transaksi t inner join pembeli p
    on t.id_pembeli = p.id_pembeli";
    $result = mysqli_query($koneksi,$sql);
    ?>
    <table class="table">
      <thead>
        <tr>
          <th>Tanggal Transaksi</th>
          <th>Id Transaksi</th>
          <th>Nama Pembeli</th>
          <th>Option</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($result as $hasil): ?>
          <tr>
            <td><?php echo $hasil["tanggal"]; ?></td>
            <td><?php echo $hasil["id_transaksi"]; ?></td>
            <td><?php echo $hasil["nama"]; ?></td>
            <td>
              <a href="template.php?page=nota&id_transaksi=<?php echo $hasil["id_transaksi"];?>">
                <button type="button" class="btn btn-info">
                  Detail
                </button>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <button id="print" onclick="Print()" type="button" class="btn btn-success">
      Print
    </button>
  </div>
</div>
