<?php
session_start();
if(!isset($_SESSION['ssLogin'])){
  header("location:../auth/login.php");
  exit();
}
require_once "../config.php";
$id = $_GET['id'];
$pelajaran = $_GET['pelajaran'];
$jurusan= $_GET['jurusan'];
$guru = $_GET['guru'];

mysqli_query($koneksi, "DELETE FROM tbl_pelajaran WHERE id ='$id'");
if($foto != 'User.png'){
  unlink('../asset/image'.$foto);
}
echo "<script>
alert('Data Siswa berhasil dihapus..');
document.location.href='mapel.php';
</script>";
return;


?>