<?php

session_start();
if(!isset($_SESSION['ssLogin'])){
  header("location:../auth/login.php");
  exit();
}
require_once("../config.php");
$title = "GURU - SMK PELITA";
require_once("../template/header.php");
require_once("../template/navbar.php");
require_once("../template/sidebar.php");

?>


<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Tambah Guru</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                            <li class="breadcrumb-item active">Tambah Guru</li>
                        </ol>
                        <div class="card">
  <div class="card-header">
    <span class="h5 my-2"><i class="fa-solid fa-list"></i> Guru</span>
    <a href="<?= $main_url ?>guru/add-guru.php"class="btn btn-sm btn-primary float-end"><i class="fa-solid fa-plus"></i> Tambah Guru</a>
  </div>
  <div class="card-body">
  <table class="table table-hover"id="datatablesSimple">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col"><center>Foto</center></th>
      <th scope="col"><center>NIP</center></th>
      <th scope="col"><center>Nama</center></th>
      <th scope="col"><center>Alamat</center></th>
      <th scope="col"><center>Telepon</center></th>
      <th scope="col"><center>agama</center></th>
      <th scope="col"><center>Operasi</center></th>
    </tr>
  </thead>
  <tbody>
    <?php
$no = 1;
$queryGuru = mysqli_query($koneksi, "SELECT * FROM tbl_guru");
while($data = mysqli_fetch_array($queryGuru)){   ?>
    <tr>
      <th scope="row"><?= $no++ ?></th>
      <td align="center"<img src="../asset/image/<?= $data['foto']?>"
      class="rounded-circle"width="60px;" alt=""></td>
      <td><?= $data['nip']?></td>
      <td><?=$data['nama']?></td>
      <td><?=$data['alamat']?></td>
      <td><?=$data['telepon']?></td>
      <td><?=$data['agama'] ?></td>
      <td align="center">
        <a href="edit-guru.php?id=<?=$data['id']?>" class="btn btn-sm btn-warning"title="Update Guru"><i class="fa-solid fa-pen"></i></a>
        <a href="hapus-guru.php?nip=<?=$data['nip']?>&foto<?=$data['foto']?>" class="btn btn-sm btn-danger" title="Hapus Guru" onclick="return confirm('anda yakin mau menghapus data ini?')"><i class="fa-solid fa-trash"></i></a>
      </td>
    </tr>
<?php } ?>
  </tbody>
</table>
  </div>
</div>
                    </div>
                </main>


<?php
require_once("../template/footer.php");
?>
