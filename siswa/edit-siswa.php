<?php
session_start();
if(!isset($_SESSION['ssLogin'])){
  header("location:../auth/login.php");
  exit();
}

require_once "../config.php";
$title = "Update Siswa - SMK PELITA";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

$nis = $_GET['nis'];
$querySiswa = mysqli_query($koneksi, "SELECT * FROM tbl_siswa WHERE nis = '$nis'");
$data = mysqli_fetch_array($querySiswa);

if ($data) {
    $nis = $data['nis']?? '';
    $nama = $data['nama'] ?? '';
    $kelas = $data['kelas'] ?? '';
    $jurusan = $data['jurusan'] ?? '';
    $alamat = $data['alamat'] ?? '';
    $foto = $data['foto'] ?? 'User.png';
} else {
    $nis = '';
    $nama = '';
    $kelas = '';
    $jurusan = '';
    $alamat = '';
    $foto = 'User.png';
}

?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Update Siswa</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="add-siswa.php">Siswa</a></li>
                <li class="breadcrumb-item active">Update Siswa</li>
            </ol>
            <form action="proses-siswa.php" method="POST" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <span class="h5 my-2"><i class="fa-solid fa-pen-to-square"></i> Update Siswa</span>
                        <button type="submit" name="update" class="btn btn-primary float-end"><i class="fa-solid fa-floppy-disk"></i> Update</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                                    <label for="nis" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left:-50px;">
                                        <input type="text" name="nis" readonly class="form-control-plaintext border-bottom ps-2" id="nis" value="<?=$nis?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <label for="nama" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left:-50px;">
                                        <input type="text" name="nama" required class="form-control border-0 border-bottom ps-2" id="nama" value="<?=$data['nama']?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                                    <label for="kelas" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left:-50px;">
                                        <input type="text" name="kelas" required class="form-control border-0 border-bottom ps-2" id="kelas" value="<?=$kelas?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                                    <label for="jurusan" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left:-50px;">
                                        <input type="text" name="jurusan" required class="form-control border-0 border-bottom ps-2" id="jurusan" value="<?=$jurusan?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <label for="alamat" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left:-50px;">
                                        <textarea name="alamat" id="alamat" cols="30" rows="3" placeholder="alamat Guru" class="form-control" required><?= $alamat?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-center px-5">
                                <input type="hidden" name="fotoLama" value="<?=$foto ?>">
                                <img src="../asset/image/User.png<?=$foto ?>" alt="foto siswa" class="mb-3 rounded-circle" width="40%">
                                <input type="file" name="image" class="form-control form-control-sm">
                                <small class="text-secondary">Pilih Foto PNG, JPG atau JPEG dengan ukuran maksimal 1MB</small>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

<?php
require_once("../template/footer.php");
?>
