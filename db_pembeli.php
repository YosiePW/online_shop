<?php
session_start();
$koneksi = mysqli_connect("localhost","root","","online_shop");

if(isset ($_POST["action"])){
  $id_pembeli = $_POST["id_pembeli"];
  $username = $_POST["username"];
  $password = md5($_POST["password"]);
  $nama = $_POST["nama"];
  $alamat = $_POST["alamat"];


  if($_POST["action"] == "insert"){
    $sql ="insert into pembeli values('$id_pembeli','$username','$password','$nama','$alamat')";
    if(mysqli_query($koneksi,$sql)){
      // jika query berhasil

       // buat pesan sukses
       $_SESSION["message"] = array(
         "type" => "success",
         "message" => "Data has been inserted"
       );
    }else{
      // jika query gagal
      $_SESSION["message"] = array(
        "type" => "danger",
        "message" => mysqli_error($koneksi)
      );
    }
    header("location:template.php?page=pembeli") ;
  }
  else if ($_POST["action"] == "update"){
    $sql = "select * from pembeli where id_pembeli ='$id_pembeli'";
    $result = mysqli_query($koneksi,$sql);
    // tampung hasil query ke dalam array
    $hasil = mysqli_fetch_array($result);

   $sql = "update pembeli set username='$username',password='$password', nama='$nama',alamat='$alamat' where id_pembeli='$id_pembeli'";
   if(mysqli_query($koneksi,$sql)){
     // jika query berhasil
      $_SESSION["message"]= array(
        "type" => "success",
        "message" => " Data has been updated"
      );
   }else {
     // jika query gagal
     $_SESSION["message"] = array(
       "type" => "danger",
       "message" => mysqli_error($koneksi)
     );
   }
   header("location:template.php?page=pembeli");
  }
}
if(isset($_GET["hapus"])){
 $id_pembeli = $_GET["id_pembeli"];
 $sql = "select * from pembeli where id_pembeli='$id_pembeli'";
 $result = mysqli_query($koneksi,$sql);
 $hasil = mysqli_fetch_array($result);

 $sql = "delete from pembeli where id_pembeli='$id_pembeli'";
 if (mysqli_query($koneksi,$sql)) {
   // jika query sukses
   $_SESSION["message"]= array(
     "type" => "success",
     "message" => "Data has been deleted"
   );

 }else{
   $_SESSION["message"]= array(
     "type" => "danger",
     "message" => mysqli_error($koneksi)
   );

 }
 header("location:template.php?page=pembeli");
}

 ?>
