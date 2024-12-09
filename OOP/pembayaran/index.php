<?php

require_once '../koneksi.php';
require_once 'controller.php';

$obj = new controller();
$data = $obj->ViewRelasiBayar();

$_ViewKelas = $obj->ViewKelas();
$_ViewSiswa = $obj->ViewSiswa();

if ($data === false) {
    die("Error: " . $koneksi->error);
}
$no = 1;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_bayar = $_POST['id_bayar'];
    $tanggal = $_POST['tanggal'];
    $id_siswa = $_POST['id_siswa'];
    $id_kelas = $_POST['id_kelas'];
    if ($obj->AddBayar($id_bayar, $tanggal, $id_siswa, $id_kelas)) {
        // echo '<div> SUKSES </div>';
        echo '<meta http-equiv="refresh" content="0">';
    } else {
        // echo '<div> GAGAL </div>';
        echo '<meta http-equiv="refresh" content="0">';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/style.css">
    <title>Mentor</title>
</head>

<body>
    <div class="container">
        <section class="left">
            <div class="top">
                <!-- <img class="logo" src="../assets/ikon/Logo-MEC.png" alt=""> -->
                <img class="logo" src="../../assets/ikon/Logo-MEC.png" alt="">
                <!-- <h1>Logo</h1> -->
            </div>
            <div class="sidebar-menu">
                <ul>
                    <li><a href="../../index.php"> <img src="../../assets/ikon/dashboard.svg" alt=""> Dashboard</a></li>
                    <li><a class="active" href="../pembayaran/index.php"> <img src="../../assets/ikon/active-payment.svg" alt=""> Pembayaran</a></li>
                    <li><a href="../member/member.php"> <img src="../../assets/ikon/Siswa.svg" alt=""> Siswa</a></li>
                    <li><a href="../peket_kelas/index.php"> <img src="../../assets/ikon/Pkt_kelas.svg" alt=""> Paket Kelas</a></li>
                    <li><a href="../mentor/index.php"> <img src="../../assets/ikon/Mentor.svg" alt=""> Mentor</a></li>
                    <li><a href="../jadwal/index_jadwal.php"> <img src="../../assets/ikon/Jadwal.svg" alt=""> Jadwal</a></li>
                    <li><a href="../fasilitas/index.php"> <img src="../../assets/ikon/fasilitas.svg" alt=""> Fasilitas</a></li>
                    <li><a class="log-out-btn"> <img src="../../assets/ikon/logout.svg" alt=""> Logout</a></li>
                </ul>
            </div>
        </section>
        <section class="right">
            <div class="top">
                <h1>Pembayaran</h1>
                <div class="popup" id="myPopup">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <h2>Silahkan Tambahkan Data</h2>
                        <label for="id_bayar">ID Bayar:</label>
                        <input type="number" id="id_bayar" name="id_bayar" required><br><br>

                        <label for="tanggal">Tanggal:</label>
                        <input type="date" id="tanggal" name="tanggal" required><br><br>

                        <label for="id_siswa">Siswa:</label>
                        <select name="id_siswa" required>
                            <option value="">-- Pilih Siswa --</option>
                            <?php
                            if ($_ViewSiswa) {
                                while ($data_siswa = mysqli_fetch_array($_ViewSiswa)) {
                                    echo '<option value="' . $data_siswa['id_siswa'] . '">' . $data_siswa['nama'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <br><br>

                        <label for="id_kelas">Nama Kelas:</label>
                        <select name="id_kelas" required>
                            <option value="">-- Pilih Kelas --</option>
                            <?php
                            if ($_ViewKelas) {
                                while ($data_kelas = mysqli_fetch_array($_ViewKelas)) {
                                    echo '<option value="' . $data_kelas['id_kelas'] . '">' . $data_kelas['nama_kelas'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <br><br>

                        <input class="btn-add-submit" type="submit" value="Submit">
                        <button onclick="togglePopup()">Tutup Popup</button>
                    </form>
                </div>
                <div class="overlay" id="overlay"></div>
            </div>
            <div class="content">
                <a class="btn-add" onclick="togglePopup()">Tambah</a>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Bayar</th>
                            <th>Tanggal</th>
                            <th>Nama Siswa</th>
                            <th>Nama Kelas</th>
                            <th>No Telp</th>
                            <th>Jumlah Bayar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        while ($row = $data->fetch_assoc()) {
                        ?>
                            <tr>
                                <td class="td-no"><?php echo $no; ?></td>
                                <td class="td-no"><?php echo $row['id_bayar']; ?></td>
                                <td class="td-no"><?php echo $row['tanggal']; ?></td>
                                <td><?php echo $row['nama']; ?></td>
                                <td><?php echo $row['nama_kelas']; ?></td>
                                <td class="td-no"><?php echo $row['siswa_no_telp']; ?></td>
                                <td class="td-no"><?php echo 'Rp. ' . number_format($row['harga'], 0, ',', '.'); ?></td>

                                <td class="btn-aksi td-no">
                                    <a class="btn-edit" onclick="showEditPopup(<?php echo $row['id_bayar']; ?>)">Edit</a>
                                    <a class="btn-hapus" onclick="showDelPopup(<?php echo $row['id_bayar']; ?>)">Del</a>
                                </td>
                            <?php $no += 1;
                        } ?>
                            </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <div class="myPopupEdit" id="EditSiswa">
        <div class="Edit" id="popup">
            <div class="popup-content">
            </div>
        </div>
    </div>

    <div class="myPopupDel" id="DelSiswa">
        <div class="Del" id="popup">
            <div class="popup-content-del">
            </div>
        </div>
    </div>

    <script>
        function togglePopup() {
            var popup = document.getElementById("myPopup");
            var overlay = document.getElementById("overlay");
            if (popup.style.display === "block") {
                popup.style.display = "none";
                overlay.style.display = "none";
            } else {
                popup.style.display = "block";
                overlay.style.display = "block";
            }
        }

        function showEditPopup(id_bayar) {
            // Mendapatkan elemen div yang digunakan untuk menampilkan konten popup
            var popupContent = document.querySelector('.popup-content');

            // Buat XMLHttpRequest untuk memuat konten dari member_edit.php
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Isi konten dari member_edit.php ke dalam popup
                        popupContent.innerHTML = xhr.responseText;
                        // Tampilkan popup
                        document.getElementById('editPopup').style.display = 'block';
                    } else {
                        console.error('Error: ' + xhr.status);
                    }
                }
            };

            // Kirim permintaan untuk member_edit.php dengan id_bayar yang dipilih
            xhr.open('GET', 'edit.php?id_bayar=' + id_bayar, true);
            xhr.send();
        }

        function showDelPopup(id_bayar) {
            // Mendapatkan elemen div yang digunakan untuk menampilkan konten popup
            var popupContentDel = document.querySelector('.popup-content-del');

            // Buat XMLHttpRequest untuk memuat konten dari member_edit.php
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Isi konten dari member_edit.php ke dalam popup
                        popupContentDel.innerHTML = xhr.responseText;
                        // Tampilkan popup
                        document.getElementById('editPopup').style.display = 'block';
                    } else {
                        console.error('Error: ' + xhr.status);
                    }
                }
            };

            // Kirim permintaan untuk member_edit.php dengan id_bayar yang dipilih
            xhr.open('GET', 'delete.php?id_bayar=' + id_bayar, true);
            xhr.send();
        }

        //KONFIRMASI LOGOUT
        const logoutButton = document.querySelector('.log-out-btn');

        logoutButton.addEventListener('click', function(event) {
            event.preventDefault();
            const confirmation = confirm('Apakah Anda yakin untuk keluar?');
            if (confirmation) {
                window.location.href = '../logout.php';
            }
        });
    </script>


</body>

</html>