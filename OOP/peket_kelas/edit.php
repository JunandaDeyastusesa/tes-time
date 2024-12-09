<?php

require_once '../koneksi.php';
require_once 'controller.php';

$obj = new controller();

if (!$obj->ViewById($_GET['id_kelas'])) {
    die("Error : id_kelas Mahasiswa Tidak Ada");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_kelas = $_POST['id_kelas'];
    $nama_kelas = $_POST['nama_kelas'];
    $kapasitas_kelas = $_POST['kapasitas_kelas'];
    $harga = $_POST['harga'];

    if ($obj->Edit($id_kelas, $nama_kelas, $kapasitas_kelas, $harga, $obj->id_kelas)) {
        // echo '<div> SUKSES </div>';
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
                        <label for="id_kelas">ID Kelas:</label>
                        <input type="text" id="id_kelas" name="id_kelas" value="<?php echo $obj->id_kelas; ?>" readonly><br><br>

                        <label for="nama_kelas">Nama Kelas:</label>
                        <input type="text" id="nama_kelas" name="nama_kelas" value="<?php echo $obj->nama_kelas; ?>"><br><br>

                        <label for="kapasitas_kelas">Kapasitas Kelas:</label>
                        <input type="number" id="kapasitas_kelas" name="kapasitas_kelas" value="<?php echo $obj->kapasitas_kelas; ?>"><br><br>

                        <label for="harga">Harga Kelas:</label>
                        <input type="number" id="harga" name="harga" value="<?php echo $obj->harga; ?>"><br><br>

                        <input type="submit" value="Submit">
                        <a class="btn-back-edit" href="index.php">Kembali</a>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>

</html>