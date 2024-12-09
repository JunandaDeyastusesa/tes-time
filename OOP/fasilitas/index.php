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
    $id_fasilitas = $_POST['id_fasilitas'];
    $nama_fasilitas = $_POST['nama_fasilitas'];
    $jumlah = $_POST['jumlah'];
    $status_fasilitas = $_POST['status_fasilitas'];
    if ($obj->Add($id_fasilitas, $nama_fasilitas, $jumlah, $status_fasilitas)) {
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
    <title>Fasilitas</title>
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
                    <li><a href="../mentor/index.php"> <img src="../../assets/ikon/Mentor.svg" alt=""> Mentor</a></li>
                    <li><a href="../jadwal/index_jadwal.php"> <img src="../../assets/ikon/Jadwal.svg" alt=""> Jadwal</a></li>
                    <li><a class="active" href="../fasilitas/index.php"> <img src="../../assets/ikon/active-fasilitas.svg" alt=""> Fasilitas</a></li>
                    <li><a class="log-out-btn"> <img src="../../assets/ikon/logout.svg" alt=""> Logout</a></li>
                </ul>
            </div>
        </section>
        <section class="right">
            <div class="top">
                <h1>Data Fasilitas</h1>
                <div class="popup" id="myPopup">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <h2>Silahkan Tambahkan Data</h2>
                        <label for="id_fasilitas">ID Fasilitas:</label>
                        <input type="number" id="id_fasilitas" name="id_fasilitas" required><br><br>

                        <label for="nama_fasilitas">Nama Fasilitas:</label>
                        <input type="text" id="nama_fasilitas" name="nama_fasilitas" required><br><br>

                        <label for="jumlah">Jumlah:</label>
                        <input type="number" id="jumlah" name="jumlah" required><br><br>

                        <label for="status_fasilitas">Status Fasilitas:</label>
                        <select id="status_fasilitas" name="status_fasilitas" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Lengkap">Lengkap</option>
                            <option value="Tidak Lengkap">Tidak Lengkap</option>
                        </select><br><br>


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
                            <th>ID Fasilitas</th>
                            <th>Nama Fasilitas</th>
                            <th>Jumlah</th>
                            <th>Stats</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $data->fetch_assoc()) {
                        ?>
                            <tr>
                                <td class="td-no"><?php echo $no; ?></td>
                                <td class="td-no"><?php echo $row['id_fasilitas']; ?></td>
                                <td><?php echo $row['nama_fasilitas']; ?></td>
                                <td class="td-no"><?php echo $row['jumlah']; ?></td>
                                <td><?php echo $row['status_fasilitas']; ?></td>
                                <td class="btn-aksi td-no">
                                    <a class="btn-edit" onclick="showEditPopup(<?php echo $row['id_fasilitas']; ?>)">Edit</a>
                                    <a class="btn-hapus" onclick="showDelPopup(<?php echo $row['id_fasilitas']; ?>)">Del</a>
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

        function showEditPopup(id_fasilitas) {
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

            // Kirim permintaan untuk member_edit.php dengan id_fasilitas yang dipilih
            xhr.open('GET', 'edit.php?id_fasilitas=' + id_fasilitas, true);
            xhr.send();
        }

        function showDelPopup(id_fasilitas) {
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

            // Kirim permintaan untuk member_edit.php dengan id_fasilitas yang dipilih
            xhr.open('GET', 'delete.php?id_fasilitas=' + id_fasilitas, true);
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