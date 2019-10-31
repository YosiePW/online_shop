<?php
session_start();
$koneksi = mysqli_connect("localhost", "root", "", "online_shop");
if (isset($_POST["action"])) {
  $id_barang = $_POST["id_barang"];
  $nama = $_POST["nama"];
  $stok = $_POST["stok"];
  $harga = $_POST["harga"];
  $deskripsi = $_POST["deskripsi"];

  if ($_POST["action"] == "insert") {
    // menentukan nama file
    $path = pathinfo($_FILES["image"]["name"]);
    $ekstensi = $path["extension"];
    // kita rangkai untuk penamaan file yang akan disimpan
    $filename = $id_barang."-".rand(1,1000).".".$ekstensi;

    // membuat query
    $sql = "insert into barang values ('$id_barang', '$nama', '$filename', '$stok', '$harga', '$deskripsi')";
if (mysqli_query($koneksi, $sql)) {
  // jika query berhasil
  move_uploaded_file($_FILES["image"]["tmp_name"], "image_barang/".$filename);
  // buat pesan sukses
  $_SESSION["message"] = array(
    "type" => "success",
    "message" => "Data has been intersed"
  );
} else {
  // jika query gagal
  $_SESSION["message"] = array(
    "type" => "danger",
    "message" => mysqli_error($koneksi)
  );
}
header("location:template.php?page=barang");

}elseif ($_POST["action"] == "update") {
  if (!empty($_FILES["image"]["name"])) {
    // jika gambarnya diedit
    $sql = "select * from barang where id_barang='$id_barang'";
    // eksekusi query
    $result = mysqli_query($koneksi, $sql);
    // tampung hasil query kedalam array
    $hasil = mysqli_fetch_array($result);
      if (file_exists("image_barang/".$hasil["image"])) {
      unlink("image_barang/".$hasil["image"]);
      // menghapus file gambar
      }
      $path = pathinfo($_FILES["image"]["name"]);
      $ekstensi = $path["extension"];
      // kita rangkai untuk penamaan file yang akan disimpan
      $filename = $id_barang."-".rand(1,1000).".".$ekstensi;

      $sql = "update barang set nama = '$nama', image='$filename' , stok='$stok', harga='$harga', deskripsi = '$deskripsi' where id_barang= '$id_barang'";
      if (mysqli_query($koneksi, $sql)) {
        // jika query berhasil
        move_uploaded_file($_FILES["image"]["tmp_name"], "image_barang/".$filename);
        $_SESSION["message"] = array(
          "type" => "success",
          "message" => "Data has been updated"
        );
      } else {
        // jika query gagal
        $_SESSION["message"] = array(
          "type" => "danger",
          "message" => mysqli_error($koneksi)
        );
      }

  } else {
    // jika gambarnya tidak diedit
    $sql = "update barang set nama = '$nama', stok='$stok', harga='$harga', deskripsi = '$deskripsi' where id_barang= '$id_barang'";
    if (mysqli_query($koneksi, $sql)) {
      // jika query berhasil
      $_SESSION["message"] = array(
        "type" => "success",
        "message" => "Data has been updated"
      );
    } else {
      // jika query gagal
      $_SESSION["message"] = array(
        "type" => "danger",
        "message" => mysqli_error($koneksi)
      );
    }
  }
  header("location:template.php?page=barang");
 }
}

if (isset($_GET["hapus"])) {
  $id_barang = $_GET["id_barang"];
  $sql = "select * from barang where id_barang='$id_barang'";
  $result = mysqli_query($koneksi, $sql);
  $hasil = mysqli_fetch_array($result);
  if (file_exists("image_barang/".$hasil["image"])) {
    // mengecek keberadaan file
    unlink("image_barang/".$hasil["image"]);
    // menghapus file
  }
    $sql = "delete from barang where id_barang ='$id_barang'";
    if (mysqli_query($koneksi, $sql)) {
      // jika query berhasil
      $_SESSION["message"] = array(
        "type" => "success",
        "message" => "Data has been deleted"
      );
    } else {
      // jika query gagal
      $_SESSION["message"] = array(
        "type" => "danger",
        "message" => mysqli_error($koneksi)
      );
    }
    header("location:template.php?page=barang");
}


 ?>
