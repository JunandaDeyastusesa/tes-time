<?php

require_once '../koneksi.php';
require_once 'controller.php';

$obj = new controller();
$data = $obj->View();

if ($data === false) {
    die("Error: " . $koneksi->error);
}
$no = 1;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_mentor = $_POST['id_mentor'];
    $nama_mentor = $_POST['nama_mentor'];
    $email = $_POST['email'];
    $telp = $_POST['telp'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    if ($obj->Add($id_mentor, $nama_mentor, $email, $telp, $tgl_lahir, $alamat)) {
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
    <link rel="icon" href="../../assets/ikon/Logo-MEC.png">
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
                    <li><a href="../member/member.php"> <img src="../../assets/ikon/Siswa.svg" alt=""> Siswa</a></li>
                    <li><a href="../peket_kelas/index.php"> <img src="../../assets/ikon/Pkt_kelas.svg" alt=""> Paket Kelas</a></li>
                    <li><a class="active" href="../mentor/index_mentor.php"> <img src="../../assets/ikon/active-mentor.svg" alt=""> Mentor</a></li>
                    <li><a href="../jadwal/index_jadwal.php"> <img src="../../assets/ikon/Jadwal.svg" alt=""> Jadwal</a></li>
                    <li><a href="../fasilitas/index.php"> <img src="../../assets/ikon/fasilitas.svg" alt=""> Fasilitas</a></li>
                    <li><a class="log-out-btn"> <img src="../../assets/ikon/logout.svg" alt=""> Logout</a></li>
                </ul>
            </div>
        </section>
        <section class="right">
            <div class="top">
                <h1>Data Mentor</h1>
                <div class="popup" id="myPopup">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <h2>Silahkan Tambahkan Data</h2>
                        <label for="id_mentor">ID Mentor:</label>
                        <input type="number" id="id_mentor" name="id_mentor" required><br><br>

                        <label for="nama_mentor">Nama Mentor:</label>
                        <input type="text" id="nama_mentor" name="nama_mentor" required><br><br>

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required><br><br>

                        <label for="telp">Telp:</label>
                        <input type="number" id="telp" name="telp" required><br><br>

                        <label for="tgl_lahir">Tanggal Lahir:</label>
                        <input type="date" id="tgl_lahir" name="tgl_lahir" required><br><br>

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
                <table>
                    <thead>
                        <tr>
                            <th>ID Member</th>
                            <th>nama_mentor Siswa</th>
                            <th>Email</th>
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
                                <td class="td-no"><?php echo $row['id_mentor']; ?></td>
                                <td class="nama_mentor"><?php echo $row['nama_mentor']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td class="td-no"><?php echo $row['telp']; ?></td>
                                <td class="td-no"><?php echo $row['tgl_lahir']; ?></td>
                                <td><?php echo $row['alamat']; ?></td>
                                <td class="btn-aksi td-no">
                                    <a class="btn-edit" onclick="showEditPopup(<?php echo $row['id_mentor']; ?>)">Edit</a>
                                    <a class="btn-hapus" onclick="showDelPopup(<?php echo $row['id_mentor']; ?>)">Del</a>
                                </td>
                            <?php $no += 1;
                        } ?>
                            </tr>
                    </tbody>
                </table>
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

        function showEditPopup(id_mentor) {
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

            // Kirim permintaan untuk member_edit.php dengan id_mentor yang dipilih
            xhr.open('GET', 'edit.php?id_mentor=' + id_mentor, true);
            xhr.send();
        }

        function showDelPopup(id_mentor) {
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

            // Kirim permintaan untuk member_edit.php dengan id_mentor yang dipilih
            xhr.open('GET', 'delete.php?id_mentor=' + id_mentor, true);
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