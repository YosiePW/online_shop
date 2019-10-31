<?php
session_start();
$username = $_POST["username"];
$password = md5($_POST["password"]);

// koneksi database
$koneksi = mysqli_connect("localhost","root","","online_shop");
$sql = "select * from admin where username='$username' and password='$password'";
$result = mysqli_query($koneksi,$sql);
$jumlah = mysqli_num_rows($result);

if ($jumlah == 0) {
  $_SESSION["message"] = array(
    "type" => "danger",
    "message" => "Username/Password Salah"
  );
  // jika jumlah datanya = 0 berarti username/password salah
  header("location:login.php");
} else {
  // buat variabel session
  $_SESSION["session_admin"] = mysqli_fetch_array($result);
  header("location:template.php?page=barang");
}

if (isset($_GET["logout"])) {
  // hapus session-nya
  session_destroy();
  header("location:login.php");
}
?>
