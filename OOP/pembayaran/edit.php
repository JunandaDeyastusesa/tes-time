<?php

require_once '../koneksi.php';
require_once 'controller.php';

$obj = new controller();

if (!$obj->ViewById($_GET['id_bayar'])) {
    die("Error : id_bayar Mahasiswa Tidak Ada");
}

$_ViewKelas = $obj->ViewKelas();
$_ViewSiswa = $obj->ViewSiswa();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_bayar = $_POST['id_bayar'];
    $tanggal = $_POST['tanggal'];
    $id_siswa = $_POST['id_siswa'];
    $id_kelas = $_POST['id_kelas'];
    if ($obj->Edit($id_bayar, $tanggal, $id_siswa, $id_kelas)) {
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
                        <label for="id_bayar">ID Bayar:</label>
                        <input type="text" id="id_bayar" name="id_bayar" value="<?php echo $obj->id_bayar; ?>" readonly><br><br>

                        <label for="tanggal">Tanggal:</label>
                        <input type="date" id="tanggal" name="tanggal" value="<?php echo $obj->tanggal; ?>" required><br><br>

                        <label for="id_siswa">Siswa:</label>
                        <select name="id_siswa">
                            <?php
                            if ($_ViewSiswa) {
                                while ($data_mentor = mysqli_fetch_array($_ViewSiswa)) {
                                    $selected = ($obj->id_siswa == $data_mentor['id_siswa']) ? 'selected' : '';
                                    echo '<option value="' . $data_mentor['id_siswa'] . '" ' . $selected . '>' . $data_mentor['nama'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <br><br>

                        <label for="id_kelas">Nama Kelas:</label>
                        <select name="id_kelas">
                            <?php
                            if ($_ViewKelas) {
                                while ($data_mentor = mysqli_fetch_array($_ViewKelas)) {
                                    $selected = ($obj->id_kelas == $data_mentor['id_kelas']) ? 'selected' : '';
                                    echo '<option value="' . $data_mentor['id_kelas'] . '" ' . $selected . '>' . $data_mentor['nama_kelas'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <br><br>

                        <input type="submit" value="Submit">
                        <a class="btn-back-edit" href="index.php">Kembali</a>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>

</html>