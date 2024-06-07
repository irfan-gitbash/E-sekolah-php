<?php
session_start();
if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit();
}

require_once "../config.php";

if (isset($_POST['simpan'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $nama = htmlspecialchars($_POST['nama']);
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    $alamat = htmlspecialchars($_POST['alamat']);
    $foto = htmlspecialchars($_FILES['image']['name']);

    if ($foto != null) {
        $url = "add-siswa.php";
        $foto = uploadimg($url);
    } else {
        $foto = 'User.png';
    }

    $query = "INSERT INTO tbl_siswa (nis, nama, alamat, kelas, jurusan, foto) VALUES ('$nis', '$nama', '$alamat', '$kelas', '$jurusan', '$foto')";
    mysqli_query($koneksi, $query);

    if (mysqli_error($koneksi)) {
        echo "Error: " . mysqli_error($koneksi);
    } else {
        echo "<script>
        alert('Data siswa berhasil disimpan');
        document.location.href='add-siswa.php';
        </script>";
    }
    return;
} elseif (isset($_POST['update'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $nama = htmlspecialchars($_POST['nama']);
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    $alamat = htmlspecialchars($_POST['alamat']);
    $foto = htmlspecialchars($_POST['fotoLama']);

    $sqlSiswa = mysqli_query($koneksi, "SELECT * FROM  tbl_siswa WHERE nis = '$nis'");
    $data = mysqli_fetch_array($sqlSiswa);
    $curNIS = $data['nis'];

    $newNIS = mysqli_query($koneksi, "SELECT nis FROM tbl_siswa WHERE nis = '$nis'");
    if($nis !== $curNIS){
      if(mysqli_num_rows($newNIS) > 0){
        header("location:profile-guru.php?msg=cancel");
        return;
      }
    }
    

    if ($_FILES['image']['error'] === 4) {
        $fotoSiswa = $foto;
    } else {
        $url = 'siswa.php';
        $fotoSiswa = uploadimg($url);
        if ($foto != 'User.png') {
            @unlink('../asset/image/' . $foto);
        }
    }

    mysqli_query($koneksi, "UPDATE tbl_siswa SET
    nis = '$nis',
    nama = '$nama',
    kelas = '$kelas',
    jurusan = '$jurusan',
    alamat = '$alamat',
    foto = '$fotoSiswa'
    WHERE nis = '$nis'
");

header("location:siswa.php?msg=updated");
return;
}

?>
