<?php
session_start();
if(!isset($_SESSION['ssLogin'])){
  header("location:../auth/login.php");
  exit();
}
require_once "../config.php";
$id  =$_GET['nip'];
$foto=$_GET['foto'];

mysqli_query($koneksi, "DELETE FROM tbl_guru WHERE nip ='$id'");
if($foto != 'User.png'){
  unlink('../asset/image'.$foto);
}
echo "<script>
alert('Data Siswa berhasil dihapus..');
document.location.href='profile-guru.php';
</script>";
return;

?>