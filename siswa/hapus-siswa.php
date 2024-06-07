<?php
session_start();
if(!isset($_SESSION['ssLogin'])){
  header("location:../auth/login.php");
  exit();
}
require_once "../config.php";
$id  =$_GET['nis'];
$foto=$_GET['foto'];

mysqli_query($koneksi, "DELETE FROM tbl_siswa WHERE nis ='$id'");
if($foto != 'User.png'){
  unlink('../asset/image'.$foto);
}
echo "<script>
alert('Data Siswa berhasil dihapus..');
document.location.href='siswa.php';
</script>";
return;

?>