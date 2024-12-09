<?php

require_once '../koneksi.php';
require_once 'controller.php';

$obj = new controller();
$data = $obj->ViewSiswa();

if ($data === false) {
    die("Error: " . $koneksi->error);
}
$no = 1;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_siswa = $_POST['id_siswa'];
    $nama = $_POST['nama'];
    $siswa_no_telp = $_POST['siswa_no_telp'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $tgl_daftar = $_POST['tgl_daftar'];
    if ($obj->AddSiswa($id_siswa, $nama, $siswa_no_telp, $tanggal_lahir, $alamat, $tgl_daftar)) {
        echo '<meta http-equiv="refresh" content="0">';
    } else {
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
    <title>Member</title>
</head>

<body>
    <div class="container">
        <section class="left">
            <div class="top">
                <img class="logo" src="../../assets/ikon/Logo-MEC.png" alt="">
                <!-- <h1>Logo</h1> -->
            </div>
            <div class="sidebar-menu">
                <ul>
                    <li><a href="../../index.php"> <img src="../../assets/ikon/Dashboard.svg" alt=""> Dashboard</a></li>
                    <li><a href="../pembayaran/index.php"> <img src="../../assets/ikon/payment.svg" alt=""> Pembayaran</a></li>
                    <li><a class="active" href=""> <img src="../../assets/ikon/active-siswa.svg" alt=""> Siswa</a></li>
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
                <h1>Data Siswa</h1>
                <div class="popup" id="myPopup">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <h2>Silahkan Tambahkan Data</h2>
                        <label for="id_siswa">ID Siswa:</label>
                        <input type="number" id="id_siswa" name="id_siswa" required><br><br>

                        <label for="tgl_daftar">Tanggal daftar:</label>
                        <input type="date" id="tgl_daftar" name="tgl_daftar" required><br><br>

                        <label for="nama">Nama:</label>
                        <input type="text" id="nama" name="nama" required><br><br>

                        <label for="siswa_no_telp">No Telp:</label>
                        <input type="number" id="siswa_no_telp" name="siswa_no_telp" maxlength="13" required><br><br>

                        <label for="tanggal_lahir">Tanggal Lahir:</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" required><br><br>

                        <label for="alamat">Alamat:</label>
                        <textarea id="alamat" name="alamat" rows="4" cols="30" required></textarea><br><br>

                        <input class="btn-add-submit" type="submit" value="Submit">
                        <button onclick="togglePopup()">Tutup Popup</button>
                    </form>
                </div>
                <div class="overlay" id="overlay"></div>
            </div>
            <div class="content">
                <a class="btn-add" onclick="togglePopup()">Tambah</a>
                <div class="operplow">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Member</th>
                                <th>Tgl Daftar</th>
                                <th>Nama Siswa</th>
                                <th>No Telp</th>
                                <th>Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            while ($row = $data->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td class="td-no"><?php echo $no; ?></td>
                                    <td class="td-no"><?php echo $row['id_siswa']; ?></td>
                                    <td class="td-no"><?php echo $row['tgl_daftar']; ?></td>
                                    <td class="nama"><?php echo $row['nama']; ?></td>
                                    <td class="td-no"><?php echo $row['siswa_no_telp']; ?></td>
                                    <td class="td-no"><?php echo $row['tanggal_lahir']; ?></td>
                                    <td><?php echo $row['alamat']; ?></td>
                                    <td class="btn-aksi td-no">
                                        <a class="btn-edit" onclick="showEditPopup(<?php echo $row['id_siswa']; ?>)">Edit</a>
                                        <a class="btn-hapus" onclick="showDelPopup(<?php echo $row['id_siswa']; ?>)">Del</a>
                                    </td>
                                <?php $no += 1;
                            } ?>
                                </tr>
                        </tbody>
                    </table>
                </div>
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
        </section>
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

        function showEditPopup(id_siswa) {
            var popupContent = document.querySelector('.popup-content');

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        popupContent.innerHTML = xhr.responseText;
                        document.getElementById('editPopup').style.display = 'block';
                    } else {
                        console.error('Error: ' + xhr.status);
                    }
                }
            };
            xhr.open('GET', 'member_edit.php?id_siswa=' + id_siswa, true);
            xhr.send();
        }

        function showDelPopup(id_siswa) {
            var popupContentDel = document.querySelector('.popup-content-del');

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        popupContentDel.innerHTML = xhr.responseText;
                        document.getElementById('editPopup').style.display = 'block';
                    } else {
                        console.error('Error: ' + xhr.status);
                    }
                }
            };
            xhr.open('GET', 'delete.php?id_siswa=' + id_siswa, true);
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