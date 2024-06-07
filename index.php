<?php

session_start();
if(!isset($_SESSION['ssLogin'])){
    header("Location: auth/login.php");
    exit;
}

require_once "config.php";
$title = "Dashboard - SMK Pelita";
require_once "template/header.php";
require_once "template/navbar.php";
require_once "template/sidebar.php";

$querySiswa = mysqli_query($koneksi, "SELECT * FROM tbl_siswa");
$jmlSiswa = mysqli_num_rows($querySiswa);

$queryGuru = mysqli_query($koneksi, "SELECT * FROM tbl_guru");
$jmlGuru = mysqli_num_rows($queryGuru);

$lulusUjian = mysqli_query($koneksi, "SELECT * FROM tbl_ujian WHERE hasil_ujian = 'LULUS'");
$jmlLulus = mysqli_num_rows($lulusUjian);

$gagalUjian = mysqli_query($koneksi, "SELECT * FROM tbl_ujian WHERE hasil_ujian = 'GAGAL'");
$gglLulus = mysqli_num_rows($gagalUjian);

?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Home</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Jumlah Siswa</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?php $main_url ?>siswa/siswa.php"><?=$jmlSiswa .'Orang' ?></a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Jumlah Guru</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?php $main ?>guru/profile-guru.php"><?=$jmlGuru .'orang' ?></a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Jumlah Siswa Lulus Ujian</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#"><?=$jmlLulus .'orang' ?></a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Jumlah Siswa Gagal Ujian</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#"><?=$gglLulus . 'orang'?></a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Rangking Siswa
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart"height="70"></canvas></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                
<?php
require_once "template/footer.php"

?>