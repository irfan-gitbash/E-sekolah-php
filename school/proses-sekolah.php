<?php

session_start();
if(!isset($_SESSION['ssLogin'])){
  header("location:../auth/login.php");
  exit;
}
require_once "../config.php";

// Jika tombol simpan ditekan
if(isset($_POST['simpan'])){
   $id = $_POST['id'];
   $nama = trim(htmlspecialchars($_POST['nama']));
   $email = trim(htmlspecialchars($_POST['email']));
   $status = $_POST['status'];
   $akreditasi = $_POST['akreditasi'];
   $alamat = trim(htmlspecialchars($_POST['alamat']));
   $visimisi = trim(htmlspecialchars($_POST['visimisi']));
   $gbr = trim(htmlspecialchars($_POST['gbrLama']));

   // cek apakah gambar user
   if($_FILES['image']['error'] === 4){
      $gbrSekolah = $gbr;
   } else {
      $url = 'profile-sekolah.php';
      $gbrSekolah = uploadimg($url);
      @unlink('../asset/image' . $gbr);
   }

   // update data
   $query = "UPDATE tbl_sekolah SET nama = ?, email = ?, status = ?, akreditasi = ?, alamat = ?, visimisi = ?, gambar = ? WHERE id = ?";
   $stmt = mysqli_prepare($koneksi, $query);
   mysqli_stmt_bind_param($stmt, 'sssssssi', $nama, $email, $status, $akreditasi, $alamat, $visimisi, $gbrSekolah, $id);

   if(mysqli_stmt_execute($stmt)){
      header("location: profile-sekolah.php?msg=updated");
   } else {
      echo "Error: " . mysqli_error($koneksi);
   }

   return;
}
?>