<?php
session_start();

// Redirect jika tidak login
if (!isset($_SESSION['ssLogin'])) {
    header("location: ../auth/login.php");
    exit();
}


require_once "../config.php";


if (isset($_POST['simpan'])) {

    $noUjian = htmlspecialchars($_POST['noUjian']);
    $tgl = htmlspecialchars($_POST['tgl']);
    $nis = htmlspecialchars($_POST['nis']);
    $jurusan = htmlspecialchars($_POST['jurusan']);
    $sum = htmlspecialchars($_POST['sum']);
    $min = htmlspecialchars($_POST['min']);
    $max = htmlspecialchars($_POST['max']);
    $avg = htmlspecialchars($_POST['avg']);

    $hasilUjian = ($min < 50 || $avg < 60) ? "GAGAL" : "LULUS";
    
    $mapel = $_POST['mapel'];
    $jurus = $_POST['jurus'];
    $nilai = $_POST['nilai'];
    
    mysqli_query($koneksi, "INSERT INTO tbl_ujian VALUES ('$noUjian','$tgl','$nis','$jurusan',$sum, $min, $max, $avg, '$hasilUjian')");

    foreach ($mapel as $key => $mpl) {
      mysqli_query($koneksi,"INSERT INTO tbl_nilai_ujian VALUES(null, '$noUjian','$mpl','$jurus[$key]', $nilai[$key])");
    }
    header("location:nilai-ujian.php?msg=$hasilUjian&nis=$nis");
    return;
}
?>
