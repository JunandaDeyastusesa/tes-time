<?php

require_once '../koneksi.php';
require_once 'controller.php';

$obj = new controller();

if (!$obj->ViewById($_GET['id_siswa'])) {
    die("Error : id_siswa Mahasiswa Tidak Ada");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_siswa = $_POST['id_siswa'];
    $nama = $_POST['nama'];
    $siswa_no_telp = $_POST['siswa_no_telp'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $tgl_daftar = $_POST['tgl_daftar'];
    if ($obj->EditSiswa($id_siswa, $nama, $siswa_no_telp, $tanggal_lahir, $alamat, $tgl_daftar, $obj->id_siswa)) {
        echo '<div> SUKSES </div>';
        echo '<meta http-equiv="refresh" content="0">';
    } else {
        echo '<div> GAGAL </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/style.css">
    <title>Member</title>
</head>

<body>
    <div class="container">
        <section class="Out-Edit-Siswa">
            <div class="overlay-edit"></div>
            <div class="EditSiswa">
                <h2>Edit Siswa</h2>
                <div class="PopUpEdit" id="popupEdit">
                    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                        <label for="id_siswa">ID Siswa:</label>
                        <input type="text" id="id_siswa" name="id_siswa" value="<?php echo $obj->id_siswa; ?>" readonly><br><br>

                        <label for="tgl_daftar">Tanggal Daftar:</label>
                        <input type="date" id="tgl_daftar" name="tgl_daftar" value="<?php echo $obj->tgl_daftar; ?>"><br><br>

                        <label for="nama">Nama:</label>
                        <input type="text" id="nama" name="nama" value="<?php echo $obj->nama; ?>"><br><br>

                        <label for="siswa_no_telp">No Telp:</label>
                        <input type="number" id="siswa_no_telp" name="siswa_no_telp" value="<?php echo $obj->siswa_no_telp; ?>"><br><br>

                        <label for="tanggal_lahir">Tanggal Lahir:</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $obj->tanggal_lahir; ?>"><br><br>

                        <label for="alamat">Alamat:</label>
                        <textarea id="alamat" name="alamat" rows="4" cols="30"><?php echo $obj->alamat; ?></textarea><br><br>

                        <input type="submit" value="Submit">
                        <a class="btn-back-edit" href="./member.php">Kembali</a>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>

</html>