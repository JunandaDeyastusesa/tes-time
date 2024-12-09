<?php

require_once '../koneksi.php';
require_once 'controller.php';

$obj = new controller();

if (!$obj->ViewById($_GET['id_mentor'])) {
    die("Error : id_mentor Mahasiswa Tidak Ada");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_mentor = $_POST['id_mentor'];
    $nama_mentor = $_POST['nama_mentor'];
    $email = $_POST['email'];
    $telp = $_POST['telp'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];

    if ($obj->Edit($id_mentor, $nama_mentor, $email, $telp, $tgl_lahir, $alamat, $obj->id_mentor)) {
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
                        <label for="id_mentor">ID Mentor:</label>
                        <input type="text" id="id_mentor" name="id_mentor" value="<?php echo $obj->id_mentor; ?>" readonly><br><br>

                        <label for="nama_mentor">Nama Mentor:</label>
                        <input type="text" id="nama_mentor" name="nama_mentor" value="<?php echo $obj->nama_mentor; ?>"><br><br>

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo $obj->email; ?>"><br><br>

                        <label for="telp">No Telp:</label>
                        <input type="number" id="telp" name="telp" value="<?php echo $obj->telp; ?>"><br><br>

                        <label for="tgl_lahir">Tanggal Lahir:</label>
                        <input type="date" id="tgl_lahir" name="tgl_lahir" value="<?php echo $obj->tgl_lahir; ?>"><br><br>

                        <label for="alamat">Alamat:</label>
                        <textarea id="alamat" name="alamat" rows="4" cols="30"><?php echo $obj->alamat; ?></textarea><br><br>

                        <input type="submit" value="Submit">
                        <a class="btn-back-edit" href="./index.php">Kembali</a>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>

</html>