<?php
session_start();
$koneksi = mysqli_connect("localhost","root","","online_shop");
if (isset($_GET["transaksi"])) {
  $id_barang = $_GET["id_barang"];
  $sql = "select * from barang where id_barang = '$id_barang'";
  $result = mysqli_query($koneksi,$sql);
  $hasil = mysqli_fetch_array($result);

  // masukkan ke keranjang
  if (!in_array($hasil, $_SESSION["session_transaksi"])) {
    array_push($_SESSION["session_transaksi"],$hasil);
  }
  header("location:template_pembeli.php?page=list_barang");
}
if (isset($_GET["checkout"])) {
  $id_transaksi = rand(1,1000).date("dmY");
  $id_pembeli = $_SESSION["session_pembeli"]["id_pembeli"];
  $tanggal = date("Y-m-d");
  $sql = "insert into transaksi values('$id_transaksi','$id_pembeli','$tanggal')";
  if (mysqli_query($koneksi,$sql)) {
    foreach ($_SESSION["session_transaksi"] as $hasil) {
      $id_barang = $hasil["id_barang"];
      $jumlah = $_POST['jumlah'.$hasil["id_barang"]];
      $harga_beli = $hasil["harga_beli"];
      $sql = "insert into detail_transaksi values('$id_transaksi','$id_barang','$jumlah','$harga_beli')";
      mysqli_query($koneksi,$sql);
    }
    // kosongkan Keranjang
    $_SESSION["session_transaksi"] = array();
    header("location: template_pembeli.php?page=nota&id_transaksi=$id_transaksi");
  }
}

if (isset($_GET["hapus"])) {
  $id_barang = $_GET["id_barang"];
  $index = array_search($kode_barang,array_column($_SESSION["session_transaksi"],"id_barang"));
  array_splice($_SESSION["session_transaksi"],$index,1);
  header("location:template_pembeli.php?page=list_transaksi");
}
 ?>
