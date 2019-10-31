<?php
session_start();
$koneksi = mysqli_connect("localhost","root","","online_shop");

if (isset($_POST["action"])) {
  $id_admin = $_POST["id_admin"];
  $nama = $_POST["nama"];
  $username = $_POST["username"];
  $password = md5($_POST["password"]);
  $action = $_POST["action"];

  if ($_POST["action"] == "insert") {
    // kita tampung deskripsi file gambarnya
    // $path = pathinfo($_FILES["image"]["name"]);
    // ambil ekstensi gambarnya
    // $extensi = $path["extension"];
    // rangkai nama file yang akan disimpan
    // $filename = $id_admin."-".rand(1,1000).".".$extensi;
    // rand = untuk mengambil nilai random antara 1 sampai 1000

    // simpan file gambar
    // move_uploaded_file($_FILES["image"]["tmp_name"],"img_pustakawan/$filename");
    $sql = "insert into admin values('$id_admin','$nama',
    '$username','$password')";

    if (mysqli_query($koneksi,$sql)) {
      // jika eksekusi berhasil
      $_SESSION["message"] = array (
        "type" => "success",
        "message" => "Insert data has been success"
      );
    }else {
      // jika eksekusi gagal
      $_SESSION["message"] = array(
        "type" => "danger",
        "message" => mysqli_error($koneksi)
      );
    }
    header("location:template.php?page=admin");

  } else if($_POST["action"] == "update") {
    // ambil data dari database
    $sql = "select * from where id_admin='$id_admin'";
    $result = mysqli_query($koneksi,$sql);
    $hasil = mysqli_fetch_array($result);
    // untuk mengkonversi menjadi array
    // if (isset($_FILES["image"])) {
    //   if (file_exists("img_pustakawan/".$hasil["image"])) {
    //     // jika file nya tersedia
    //     unlink("img_pustakawan/".$hasil["image"]);
        // menghapus file

      // ambil ekstensi gambarnya
      // $extensi = $path["extension"];
      // rangkai nama file yang akan disimpan
      // $filename = $nip."-".rand(1,1000).".".$extensi;
      // rand = untuk mengambil nilai random antara 1 sampai 1000

      // simpan file gambar
      $sql = "update admin set nama='$nama',
      username='$username',password='$password' where id_admin='$id_admin'";

      if (mysqli_query($koneksi,$sql)) {
        // jika query sukses
        $sql = "update admin set nama='$nama',
        username='$username',password='$password' where id_admin='$id_admin'";
        $_SESSION["message"] = array(
          "type" => "success",
          "message" => "Update data has been success"
        );
      } else {
        // jika query gagal
        $_SESSION["message"] = array(
          "type" => "danger",
          "message" => mysqli_error($koneksi)
        );
      }
      }else {
        // jika gambar tidak diedit
        $sql = "update admin set nama='$nama',
        username='$username',password='$password'
        where id_admin='$id_admin'";
        if (mysqli_query($koneksi,$sql)) {
          // jika query sukses
          $_SESSION["message"] = array(
            "type" => "success",
            "message" => "Update data has been success"
          );
        }else {
          // jika query gagal
          $_SESSION["message"] = array(
            "type" => "danger",
            "message" => mysqli_error($koneksi)
          );
        }
      }

  header("location:template.php?page=admin");
}

if (isset($_GET["hapus"])) {
  // jika yang dikirim adalah variabel GET hapus
  $id_admin = $_GET["id_admin"];
  $sql = "select * from admin where id_admin='$id_admin'";
  // eksekusi query
  $result = mysqli_query($koneksi,$sql);
  // konversi ke array
  $hasil = mysqli_fetch_array($result);

  $sql = "delete from admin where id_admin='$id_admin'";
  if (mysqli_query($koneksi,$sql)) {
    // jika query sukses
    $_SESSION["message"] = array(
      "type" => "success",
      "message" => "Delete data has been success"
    );
  }else {
    // jika query gagal
    $_SESSION["message"] = array(
      "type" => "danger",
      "message" => mysqli_error($koneksi)
    );
  }
  header("location:template.php?page=admin");
}
?>
