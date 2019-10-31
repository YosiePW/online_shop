<?php
session_start();
$username = $_POST["username"];
$password = md5($_POST["password"]);

// koneksi database
$koneksi = mysqli_connect("localhost","root","","online_shop");
$sql = "select * from pembeli where username='$username' and password='$password'";
$result = mysqli_query($koneksi,$sql);
$jumlah = mysqli_num_rows($result);

if ($jumlah == 0) {
  $_SESSION["message"] = array (
    "type" => "danger",
    "message" => "Username / Password Salah"
  );
  // jika jumlah datanya = 0 berarti username/password salah
  header("location:login_pembeli.php");
} else {
  // login berhasil
  // buat variabel session
  $_SESSION["session_pembeli"] = mysqli_fetch_array($result);
  $_SESSION["session_transaksi"] = array();
  // ini buat tempat menampung data buku yang dipinjam
  // ala ala cart (keranjang belanja)
  header("location:template_pembeli.php?page=list_barang");
}

if (isset($_GET["logout"])) {
  // hapus session-nya
  session_destroy();
  header("location:login_pembeli.php");
}
?>
