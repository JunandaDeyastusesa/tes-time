<?php

require_once '../koneksi.php';
require_once 'controller.php';

$obj = new controller();

if (!$obj->ViewById($_GET['id_jadwal'])) {
    die("Error : id_jadwal Mahasiswa Tidak Ada");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($obj->DeleteById($obj->id_jadwal)) {
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
    <title>Delete</title>
</head>

<body>
    <div class="container">
        <section class="">
            <div class="overlay-edit"></div>
            <div class="HapusSiswaByNim">
                <h1 class="alert-del">Yakin Mau Hapus :</h1>
                <h1><?php echo $obj->id_jadwal; ?></h1>
                
                <div class="Delete" id="popup">
                    <form class="Del-In" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                        <button class="hapus-2" type="submit">Ya, Saya Yakin</button>
                        <a class="btn-back-delete" href="index_jadwal.php">Kembali</a>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>

</html>