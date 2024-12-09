<?php

require_once '../koneksi.php';
require_once 'controller.php';

$obj = new controller();

if (!$obj->ViewById($_GET['id_fasilitas'])) {
    die("Error : id_fasilitas Mahasiswa Tidak Ada");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_fasilitas = $_POST['id_fasilitas'];
    $nama_fasilitas = $_POST['nama_fasilitas'];
    $jumlah = $_POST['jumlah'];
    $status_fasilitas = $_POST['status_fasilitas'];

    if ($obj->Edit($id_fasilitas, $nama_fasilitas, $jumlah, $status_fasilitas, $obj->id_fasilitas)) {
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
                        <label for="id_fasilitas">ID Fasilitas:</label>
                        <input type="text" id="id_fasilitas" name="id_fasilitas" value="<?php echo $obj->id_fasilitas; ?>" readonly><br><br>

                        <label for="nama_fasilitas">Nama Fasilitas:</label>
                        <input type="text" id="nama_fasilitas" name="nama_fasilitas" value="<?php echo $obj->nama_fasilitas; ?>"><br><br>

                        <label for="jumlah">jumlah:</label>
                        <input type="number" id="jumlah" name="jumlah" value="<?php echo $obj->jumlah; ?>"><br><br>

                        <label for="status_fasilitas">Status Fasilitas:</label>
                        <select id="status_fasilitas" name="status_fasilitas">
                            <option value="Lengkap" <?php if ($obj->status_fasilitas == 'Lengkap') {
                                                        echo 'selected';
                                                    } else {
                                                        echo "";
                                                    }; ?>>Lengkap</option>
                            <option value="Tidak Lengkap" <?php if ($obj->status_fasilitas == 'Tidak Lengkap') echo 'selected'; ?>>Tidak Lengkap</option>
                        </select><br><br>


                        <input type="submit" value="Submit">
                        <a class="btn-back-edit" href="index.php">Kembali</a>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>

</html>