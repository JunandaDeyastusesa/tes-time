<?php

require_once '../koneksi.php';
require_once 'controller.php';

$obj = new controller();

if (!$obj->ViewById($_GET['id_jadwal'])) {
    die("Error : id_jadwal Mahasiswa Tidak Ada");
}

$_ViewKelas = $obj->ViewKelas();
$_ViewMentor = $obj->ViewMentor();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_jadwal = $_POST['id_jadwal'];
    $nama_mentor = $_POST['nama_mentor'];
    $nama_kelas = $_POST['nama_kelas'];
    $no_ruangan = $_POST['no_ruangan'];
    $hari = $_POST['hari'];
    $jam_kelas = $_POST['jam_kelas'];
    if ($obj->Edit($id_jadwal, $nama_kelas, $nama_mentor, $no_ruangan, $hari, $jam_kelas)) {
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
                        <label for="id_jadwal">ID Jadwal:</label>
                        <input type="text" id="id_jadwal" name="id_jadwal" value="<?php echo $obj->id_jadwal; ?>" readonly><br><br>

                        <label for="nama_mentor">Mentor:</label>
                        <select name="nama_mentor">
                            <?php
                            if ($_ViewMentor) {
                                while ($data_mentor = mysqli_fetch_array($_ViewMentor)) {
                                    $selected = ($obj->id_mentor == $data_mentor['id_mentor']) ? 'selected' : '';
                                    echo '<option value="' . $data_mentor['id_mentor'] . '" ' . $selected . '>' . $data_mentor['nama_mentor'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <br><br>

                        <label for="nama_kelas">Nama Kelas:</label>
                        <select name="nama_kelas">
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

                        <label for="no_ruangan">Ruangan:</label>
                        <input type="number" id="no_ruangan" name="no_ruangan" value="<?php echo $obj->no_ruang; ?>"><br><br>

                        <label for="hari">Hari:</label>
                        <input type="text" id="hari" name="hari" value="<?php echo $obj->hari; ?>"><br><br>

                        <label for="jam_kelas">Jam Kelas:</label>
                        <input type="time" id="jam_kelas" name="jam_kelas" value="<?php echo $obj->jam_kelas; ?>"><br><br>

                        <input type="submit" value="Submit">
                        <a class="btn-back-edit" href="index_jadwal.php">Kembali</a>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>

</html>