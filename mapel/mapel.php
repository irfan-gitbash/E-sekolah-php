<?php

session_start();
if(!isset($_SESSION['ssLogin'])){
  header("location:../auth/login.php");
  exit();
}
require_once "../config.php";
$title = "Mata Pelajaran - SMK PELITA";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

if(isset($_GET['msg'])){
  $msg = $_GET['msg'];
}else{
  $msg = "";
}
$alert = '';
if($msg == 'cancel'){
  $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <i class="fa-solid fa-xmark"></i> Tambah pelajaran gagal, mata pelajaran sudah ada..
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
if($msg == 'added'){
  $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <i class="fa-solid fa-circle-check"></i> Tambah Pelajaran Berhasil
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

if($msg == 'updated'){
  $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <i class="fa-solid fa-circle-check"></i> Pelajaran berhasil diperbarui..
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}


if($msg == 'cancelupdate'){
  $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <i class="fa-solid fa-xmark"></i> Update pelajaran gagal, Mata pelajaran sudah ada...
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

?>

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Mata Pelajaran</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                            <li class="breadcrumb-item active">Mata Pelajaran</li>
                        </ol>
                        <?php 
                        if($msg !== ''){
                          echo $alert;
                        }
                        ?>
                        <div class="row">
                          <div class="col-4">
                          <div class="card">
  <div class="card-header">
  <i class="fa-solid fa-plus"></i> Tambah Pelajaran
  </div>
  <div class="card-body">
    <form action="proses-pelajaran.php"method="POST">
    <div class="mb-3">
    <label for="pelajaran" class="form-label ps-1">pelajaran</label>
    <input type="text" class="form-control" id="pelajaran" name="pelajaran" placeholder="nama pelajaran" required>
  </div>
  <div class="mb-3">
    <label for="jurusan" class="form-label ps-1">Jurusan</label>
    <select name="jurusan" id="jurusan" class="form-select" required>
      <option value=""selected>-- Pilih Jurusan</option>
      <option value="Teknik Komputer jaringan">--Teknik Komputer Jaringan</option>
      <option value="Admin Perkantoran">--Admin Perkantoran</option>
      <option value="Akutansi Perkantoran">--Akutansi Perkantoran</option>
    </select>
  </div>
  <div class="mb-3">
    <label for="guru" class="form-label ps-1">Guru</label>
    <select name="guru" id="guru" class="form-select" required>
      <option value=""selected>-- Pilih Guru</option>
      <?php
      $queryGuru = mysqli_query($koneksi,"SELECT * FROM tbl_guru");
      while($dataGuru = mysqli_fetch_array($queryGuru)){ ?>
        <option value="<?=$dataGuru['nama']?>"><?=$dataGuru['nama']?></option>
          <?php
      }
      ?>
    </select>
  </div>
  <button type="submit"class="btn btn-primary" name="simpan"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
  <button type="reset"class="btn btn-danger" name="reset"><i class="fa-solid fa-xmark"></i> Reset</button>
    </form>
  </div>
</div>
                          </div>
                          <div class="col-8">
                            <div class="card">
                            <div class="card-header">
                            <i class="fa-solid fa-list"></i> Data Pelajaran
                            </div>
                            <div class="card-body">
                            <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col"><center>Mata Pelajaran</center></th>
      <th scope="col"><center>Jurusan</center></th>
      <th scope="col"><center>Guru</center></th>
      <th scope="col"><center>Operasi</center></th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    $queryPelajaran = mysqli_query($koneksi,"SELECT * FROM tbl_pelajaran");
    while($data = mysqli_fetch_array($queryPelajaran)){?>
    <tr>
      <th scope="row"><?=$no++ ?></th>
      <td><?=$data['pelajaran'] ?></td>
      <td><?=$data['jurusan']?></td>
      <td><?=$data['guru'] ?></td>
      <td align="center">
        <a href="edit-mapel.php?id=<?=$data['id']?>"class="btn btn-warning" title="update pelajaran"><i class="fa-solid fa-pen"></i></a>
        <a href="hapus-mapel.php?id=<?=$data['id']?>&jurusan<?=$data['jurusan']?>" class="btn btn-sm btn-danger" title="Hapus Mapel" onclick="return confirm('anda yakin mau menghapus data ini?')"><i class="fa-solid fa-trash"></i></a>
      </td> 
    </tr>
    <?php } ?>
  </tbody>
</table>
                            </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </main>


<?php 
require_once "../template/footer.php";
?>