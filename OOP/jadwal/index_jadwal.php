<?php

require_once '../koneksi.php';
require_once 'controller.php';

$obj = new controller();
$data = $obj->ViewRelasi();

$_ViewKelas = $obj->ViewKelas();
$_ViewMentor = $obj->ViewMentor();

if ($data === false) {
    die("Error: " . $koneksi->error);
}
$no = 1;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_jadwal = $_POST['id_jadwal'];
    $nama_mentor = $_POST['nama_mentor'];
    $nama_kelas = $_POST['nama_kelas'];
    $no_ruangan = $_POST['no_ruangan'];
    $hari = $_POST['hari'];
    $jam_kelas = $_POST['jam_kelas'];
    if ($obj->AddJadwal($id_jadwal, $nama_kelas, $nama_mentor, $no_ruangan, $hari, $jam_kelas)) {
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
                    <li><a href="../../index.php"> <img src="../../assets/ikon/Dashboard.svg" alt=""> Dashboard</a></li>
                    <li><a href="../pembayaran/index.php"> <img src="../../assets/ikon/payment.svg" alt=""> Pembayaran</a></li>
                    <li><a href="../member/member.php"> <img src="../../assets/ikon/Siswa.svg" alt=""> Siswa</a></li>
                    <li><a href="../peket_kelas/index.php"> <img src="../../assets/ikon/Pkt_kelas.svg" alt=""> Paket Kelas</a></li>
                    <li><a href="../mentor/index.php"> <img src="../../assets/ikon/Mentor.svg" alt=""> Mentor</a></li>
                    <li><a class="active" href="../jadwal/index_jadwal.php"> <img src="../../assets/ikon/active-jadwal.svg" alt=""> Jadwal</a></li>
                    <li><a href="../fasilitas/index.php"> <img src="../../assets/ikon/fasilitas.svg" alt=""> Fasilitas</a></li>
                    <li><a class="log-out-btn"> <img src="../../assets/ikon/logout.svg" alt=""> Logout</a></li>
                </ul>
            </div>
        </section>
        <section class="right">
            <div class="top">
                <h1>Jadwal</h1>
                <div class="popup" id="myPopup">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <h2>Silahkan Tambahkan Data</h2>
                        <label for="id_jadwal">ID Jadwal:</label>
                        <input type="number" id="id_jadwal" name="id_jadwal" required><br><br>

                        <label for="nama_mentor">Mentor:</label>
                        <select name="nama_mentor" required>
                            <option value="">-- Pilih Mentor --</option>
                            <?php
                            if ($_ViewMentor) {
                                while ($data_mentor = mysqli_fetch_array($_ViewMentor)) {
                                    echo '<option value="' . $data_mentor['id_mentor'] . '">' . $data_mentor['nama_mentor'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <br><br>

                        <label for="nama_kelas">Nama Kelas:</label>
                        <select name="nama_kelas" required>
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

                        <label for="no_ruangan">Ruangan:</label>
                        <input type="number" id="no_ruangan" name="no_ruangan" required><br><br>

                        <label for="hari">Hari:</label>
                        <select name="hari" required>
                            <option value="">-- Pilih Hari --</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select><br><br>
                        <!-- <input type="text" id="hari" name="hari" required><br><br> -->

                        <label for="jam_kelas">Jam Kelas:</label>
                        <input type="time" id="jam_kelas" name="jam_kelas" required><br><br>

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
                            <th>ID Jadwal</th>
                            <th>Nama Kelas</th>
                            <th>No Ruangan</th>
                            <th>Mentor</th>
                            <th>Hari</th>
                            <th>Jam Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        while ($row = $data->fetch_assoc()) {
                        ?>
                            <tr>
                                <td class="td-no"><?php echo $no; ?></td>
                                <td class="td-no"><?php echo $row['id_jadwal']; ?></td>
                                <td><?php echo $row['nama_kelas']; ?></td>
                                <td class="td-no"><?php echo $row['no_ruang']; ?></td>
                                <td><?php echo $row['nama_mentor']; ?></td>
                                <td><?php echo $row['hari'], ' '; ?></td>
                                <td class="td-no">
                                    <?php
                                    $jam_kelas = $row['jam_kelas'];
                                    $jam_mulai = date('H:i -', strtotime($jam_kelas));
                                    echo $jam_mulai;

                                    $waktu_tambahan = strtotime($jam_kelas) + (6000); // detik (100 Menit)
                                    $jam_selesai = date(' H:i', $waktu_tambahan);
                                    echo $jam_selesai;
                                    ?>
                                </td>
                                <td class="btn-aksi td-no">
                                    <a class="btn-edit" onclick="showEditPopup(<?php echo $row['id_jadwal']; ?>)">Edit</a>
                                    <a class="btn-hapus" onclick="showDelPopup(<?php echo $row['id_jadwal']; ?>)">Del</a>
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

        function showEditPopup(id_jadwal) {
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

            // Kirim permintaan untuk member_edit.php dengan id_jadwal yang dipilih
            xhr.open('GET', 'edit.php?id_jadwal=' + id_jadwal, true);
            xhr.send();
        }

        function showDelPopup(id_jadwal) {
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

            // Kirim permintaan untuk member_edit.php dengan id_jadwal yang dipilih
            xhr.open('GET', 'delete.php?id_jadwal=' + id_jadwal, true);
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