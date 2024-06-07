<?php
session_start();
if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit();
}

require_once "../config.php";

if(isset($_POST['simpan'])){
  $id = $_POST['id'];
  $pelajaran = htmlspecialchars($_POST['pelajaran']);
  $jurusan = $_POST['jurusan'];
  $guru = $_POST['guru'];

  $cekPelajaran = mysqli_query($koneksi,"SELECT * FROM tbl_pelajaran WHERE pelajaran = '$pelajaran'");
  if(mysqli_num_rows($cekPelajaran) > 0){
    header("location:mapel.php?msg=cancel");
    return;
  }
  mysqli_query($koneksi, "INSERT INTO tbl_pelajaran VALUES (null,'$pelajaran','$jurusan','$guru')");
  header("location:mapel.php?msg=added");
}

if(isset($_POST['update'])){
  $id = $_POST['id'];
  $pelajaran = htmlspecialchars($_POST['pelajaran']);
  $jurusan = $_POST['jurusan'];
  $guru = $_POST['guru'];

  $queryPelajaran = mysqli_query($koneksi,"SELECT * FROM tbl_pelajaran WHERE id = $id");
  $data = mysqli_fetch_array($queryPelajaran);
  $curPelajaran = $data['pelajaran'];

  $cekPelajaran = mysqli_query($koneksi,"SELECT * FROM tbl_pelajaran WHERE pelajaran = '$pelajaran'");
  if($pelajaran !== $curPelajaran){
    if(mysqli_num_rows($cekPelajaran) > 0){
      header("location:mapel.php?msg=updated");
      return;
    }
  }
mysqli_query($koneksi, "UPDATE tbl_pelajaran SET pelajaran = '$pelajaran',
jurusan = '$jurusan', guru = '$guru' WHERE id = $id");  
header("location:mapel.php?msg=updated");
}

?>