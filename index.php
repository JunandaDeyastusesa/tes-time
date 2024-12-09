<?php

session_start();

// Cek apakah pengguna sudah login, jika tidak, redirect ke halaman login
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ./OOP/login.php");
    exit;
}

require_once './OOP/koneksi.php';
require_once './OOP/controller.php';

$obj = new controller();

$_ViewMentor = $obj->ViewMentor();
$_ViewChart = $obj->CountRegistrationsByMonth();
$_ViewJadwal = $obj->ViewRelasiJadwal();

$jumlahMentor = $obj->JumlahMentor();
$jumlahKelas = $obj->JumlahKelas();
$jumlahSiswa = $obj->JumlahSiswa();

$no = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Member</title>
</head>

<body>
    <div class="container">
        <section class="left">
            <div class="top">
                <img class="logo" src="./assets/ikon/Logo-MEC.png" alt="">
                <!-- <h1>Logo</h1> -->
            </div>
            <div class="sidebar-menu">
                <ul>
                    <li><a class="active" href=""> <img src="./assets/ikon/active-dashboard.svg" alt=""> Dashboard</a></li>
                    <li><a href="./OOP/pembayaran/index.php"> <img src="./assets/ikon/payment.svg" alt=""> Pembayaran</a></li>
                    <li><a href="./OOP/member/member.php"> <img src="./assets/ikon/Siswa.svg" alt=""> Siswa</a></li>
                    <li><a href="./OOP/peket_kelas/index.php"> <img src="./assets/ikon/Pkt_kelas.svg" alt=""> Paket Kelas</a></li>
                    <li><a href="./OOP/mentor/index.php"> <img src="./assets/ikon/Mentor.svg" alt=""> Mentor</a></li>
                    <li><a href="./OOP/jadwal/index_jadwal.php"> <img src="./assets/ikon/Jadwal.svg" alt=""> Jadwal</a></li>
                    <li><a href="./OOP/fasilitas/index.php"> <img src="./assets/ikon/fasilitas.svg" alt=""> Fasilitas</a></li>
                    <li><a class="log-out-btn"> <img src="./assets/ikon/logout.svg" alt=""> Logout</a></li>
                </ul>
            </div>
        </section>
        <section class="right">
            <div class="dashboard">
                <div class="top">
                    <h1>Dashboard</h1>
                </div>
                <div class="bottom">
                    <div class="content content-left">
                        <div class="left-top">
                            <div class="col-left-top">
                                <p>Jumlah Siswa</p>
                                <h1><?php echo $jumlahSiswa ?></h1>
                            </div>
                            <div class="col-left-top">
                                <p>Paket Kelas</p>
                                <h1><?php echo $jumlahKelas ?></h1>
                            </div>
                            <div class="col-left-top">
                                <p>Jumlah Mentor</p>
                                <h1><?php echo $jumlahMentor ?></h1>
                            </div>
                        </div>
                        <div class="left-bottom">
                            <h1>Kehadiran Mentor</h1>
                            <div class="scroll-mentor">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="no">No</th>
                                            <th>Nama</th>
                                            <th>Total Pertemuan</th>
                                            <th>Kehadiran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = $_ViewMentor->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td class="no"><?php echo $no; ?></td>
                                                <td class="nama_mentor"><?php echo $row['nama_mentor']; ?></td>
                                                <td>25</td>
                                                <td>20</td>
                                            <?php $no += 1;
                                        } ?>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="content content-right">
                        <div class="col-right-top">
                            <h3>Statistik Pendaftar</h3>
                            <div class="histogram">
                                <div class="histo-left">
                                    <ul>
                                        <li>15</li>
                                        <li>10</li>
                                        <li>5</li>
                                        <li>1</li>
                                    </ul>
                                </div>
                                <div class="histo-right">
                                    <div class="histo-btm">
                                        <?php
                                        // Proses pembuatan histogram dari data database
                                        foreach ($_ViewChart as $bulan => $data) {
                                            $value = $data['total_pendaftar'];
                                            $nama_bulan = $data['nama_bulan'];

                                            echo '<div class="bar-out">';
                                            echo '<div class="bar" style="height: ' . $value * 10 . 'px;"></div>';
                                            echo '<div class="bln-histo">' . $nama_bulan . '</div>';
                                            echo '</div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-right-bottom">
                            <p class="jadwal-p">Jadwal Kelas</p>
                            <div class="col-hari-jadwal">
                                <a href="#Senin" class="col-jadwal">
                                    <p>Sen</p>
                                </a>
                                <a href="#Selasa" class="col-jadwal">
                                    <p>Sel</p>
                                </a>
                                <a href="#Rabu" class="col-jadwal">
                                    <p>Rab</p>
                                </a>
                                <a href="#Kamis" class="col-jadwal">
                                    <p>Kam</p>
                                </a>
                                <a href="#Jumat" class="col-jadwal">
                                    <p>Jum</p>
                                </a>
                                <a href="#Sabtu" class="col-jadwal">
                                    <p>Sab</p>
                                </a>
                                <a href="#Minggu" class="col-jadwal">
                                    <p>Min</p>
                                </a>
                            </div>
                            <div class="col-isi-jadwal hidden-section" id="Senin"> <!-- Hapus kelas hidden-section -->
                                <?php
                                foreach ($_ViewJadwal as $item) {
                                    if ($item['hari'] == 'Senin') {
                                ?>
                                        <div class="jadwal-bimbel">
                                            <div class="col-jadwal-left">
                                                <p class="jadwal-pri">Ruang <?php echo $item['no_ruang']; ?></p>
                                                <p class="jadwal-sec">
                                                    <?php
                                                    $jam_kelas = $item['jam_kelas'];
                                                    $jam_mulai = date('H:i -', strtotime($jam_kelas));
                                                    echo $jam_mulai;

                                                    $waktu_tambahan = strtotime($jam_kelas) + (6000); // detik (100 Menit)
                                                    $jam_selesai = date(' H:i', $waktu_tambahan);
                                                    echo $jam_selesai;
                                                    ?>
                                                </p>
                                            </div>
                                            <!-- <hr> -->
                                            <div class="col-jadwal-right">
                                                <p class="jadwal-pri"><?php echo $item['nama_kelas']; ?></p>
                                                <p class="jadwal-sec"><?php echo $item['nama_mentor']; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="col-isi-jadwal hidden-section" id="Selasa">
                                <?php
                                foreach ($_ViewJadwal as $item) {
                                    if ($item['hari'] == 'Selasa') {
                                ?>
                                        <div class="jadwal-bimbel">
                                            <div class="col-jadwal-left">
                                                <p class="jadwal-pri">Ruang <?php echo $item['no_ruang']; ?></p>
                                                <p class="jadwal-sec">
                                                    <?php
                                                    $jam_kelas = $item['jam_kelas'];
                                                    $jam_mulai = date('H:i -', strtotime($jam_kelas));
                                                    echo $jam_mulai;

                                                    $waktu_tambahan = strtotime($jam_kelas) + (6000); // detik (100 Menit)
                                                    $jam_selesai = date(' H:i', $waktu_tambahan);
                                                    echo $jam_selesai;
                                                    ?>
                                                </p>
                                            </div>
                                            <!-- <hr> -->
                                            <div class="col-jadwal-right">
                                                <p class="jadwal-pri"><?php echo $item['nama_kelas']; ?></p>
                                                <p class="jadwal-sec"><?php echo $item['nama_mentor']; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                <?php
                                    }
                                }
                                ?>
                            </div>

                            <div class="col-isi-jadwal hidden-section" id="Rabu">
                                <?php
                                foreach ($_ViewJadwal as $item) {
                                    if ($item['hari'] == 'Rabu') {
                                ?>
                                        <div class="jadwal-bimbel">
                                            <div class="col-jadwal-left">
                                                <p class="jadwal-pri">Ruang <?php echo $item['no_ruang']; ?></p>
                                                <p class="jadwal-sec">
                                                    <?php
                                                    $jam_kelas = $item['jam_kelas'];
                                                    $jam_mulai = date('H:i -', strtotime($jam_kelas));
                                                    echo $jam_mulai;

                                                    $waktu_tambahan = strtotime($jam_kelas) + (6000); // detik (100 Menit)
                                                    $jam_selesai = date(' H:i', $waktu_tambahan);
                                                    echo $jam_selesai;
                                                    ?>
                                                </p>
                                            </div>
                                            <!-- <hr> -->
                                            <div class="col-jadwal-right">
                                                <p class="jadwal-pri"><?php echo $item['nama_kelas']; ?></p>
                                                <p class="jadwal-sec"><?php echo $item['nama_mentor']; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                <?php
                                    }
                                }
                                ?>
                            </div>

                            <div class="col-isi-jadwal hidden-section" id="Kamis">
                                <?php
                                foreach ($_ViewJadwal as $item) {
                                    if ($item['hari'] == 'Kamis') {
                                ?>
                                        <div class="jadwal-bimbel">
                                            <div class="col-jadwal-left">
                                                <p class="jadwal-pri">Ruang <?php echo $item['no_ruang']; ?></p>
                                                <p class="jadwal-sec">
                                                    <?php
                                                    $jam_kelas = $item['jam_kelas'];
                                                    $jam_mulai = date('H:i -', strtotime($jam_kelas));
                                                    echo $jam_mulai;

                                                    $waktu_tambahan = strtotime($jam_kelas) + (6000); // detik (100 Menit)
                                                    $jam_selesai = date(' H:i', $waktu_tambahan);
                                                    echo $jam_selesai;
                                                    ?>
                                                </p>
                                            </div>
                                            <!-- <hr> -->
                                            <div class="col-jadwal-right">
                                                <p class="jadwal-pri"><?php echo $item['nama_kelas']; ?></p>
                                                <p class="jadwal-sec"><?php echo $item['nama_mentor']; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                <?php
                                    }
                                }
                                ?>
                            </div>

                            <div class="col-isi-jadwal hidden-section" id="Jumat">
                                <?php
                                foreach ($_ViewJadwal as $item) {
                                    if ($item['hari'] == 'Jumat') {
                                ?>
                                        <div class="jadwal-bimbel">
                                            <div class="col-jadwal-left">
                                                <p class="jadwal-pri">Ruang <?php echo $item['no_ruang']; ?></p>
                                                <p class="jadwal-sec">
                                                    <?php
                                                    $jam_kelas = $item['jam_kelas'];
                                                    $jam_mulai = date('H:i -', strtotime($jam_kelas));
                                                    echo $jam_mulai;

                                                    $waktu_tambahan = strtotime($jam_kelas) + (6000); // detik (100 Menit)
                                                    $jam_selesai = date(' H:i', $waktu_tambahan);
                                                    echo $jam_selesai;
                                                    ?>
                                                </p>
                                            </div>
                                            <!-- <hr> -->
                                            <div class="col-jadwal-right">
                                                <p class="jadwal-pri"><?php echo $item['nama_kelas']; ?></p>
                                                <p class="jadwal-sec"><?php echo $item['nama_mentor']; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                <?php
                                    }
                                }
                                ?>
                            </div>

                            <div class="col-isi-jadwal hidden-section" id="Sabtu">
                                <?php
                                foreach ($_ViewJadwal as $item) {
                                    if ($item['hari'] == 'Sabtu') {
                                ?>
                                        <div class="jadwal-bimbel">
                                            <div class="col-jadwal-left">
                                                <p class="jadwal-pri">Ruang <?php echo $item['no_ruang']; ?></p>
                                                <p class="jadwal-sec">
                                                    <?php
                                                    $jam_kelas = $item['jam_kelas'];
                                                    $jam_mulai = date('H:i -', strtotime($jam_kelas));
                                                    echo $jam_mulai;

                                                    $waktu_tambahan = strtotime($jam_kelas) + (6000); // detik (100 Menit)
                                                    $jam_selesai = date(' H:i', $waktu_tambahan);
                                                    echo $jam_selesai;
                                                    ?>
                                                </p>
                                            </div>
                                            <!-- <hr> -->
                                            <div class="col-jadwal-right">
                                                <p class="jadwal-pri"><?php echo $item['nama_kelas']; ?></p>
                                                <p class="jadwal-sec"><?php echo $item['nama_mentor']; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                <?php
                                    }
                                }
                                ?>
                            </div>

                            <div class="col-isi-jadwal hidden-section" id="Minggu">
                                <?php
                                foreach ($_ViewJadwal as $item) {
                                    if ($item['hari'] == 'Minggu') {
                                ?>
                                        <div class="jadwal-bimbel">
                                            <div class="col-jadwal-left">
                                                <p class="jadwal-pri">Ruang <?php echo $item['no_ruang']; ?></p>
                                                <p class="jadwal-sec">
                                                    <?php
                                                    $jam_kelas = $item['jam_kelas'];
                                                    $jam_mulai = date('H:i -', strtotime($jam_kelas));
                                                    echo $jam_mulai;

                                                    $waktu_tambahan = strtotime($jam_kelas) + (6000); // detik (100 Menit)
                                                    $jam_selesai = date(' H:i', $waktu_tambahan);
                                                    echo $jam_selesai;
                                                    ?>
                                                </p>
                                            </div>
                                            <!-- <hr> -->
                                            <div class="col-jadwal-right">
                                                <p class="jadwal-pri"><?php echo $item['nama_kelas']; ?></p>
                                                <p class="jadwal-sec"><?php echo $item['nama_mentor']; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                <?php
                                    }
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector('#Senin').style.display = 'block';
            document.querySelector('.col-jadwal[href="#Senin"]').classList.add('active');

            var links = document.getElementsByClassName("col-jadwal");
            for (var i = 0; i < links.length; i++) {
                links[i].addEventListener("click", function(e) {
                    e.preventDefault();

                    var allSections = document.getElementsByClassName("hidden-section");
                    for (var j = 0; j < allSections.length; j++) {
                        allSections[j].style.display = "none";
                    }

                    var allLinks = document.getElementsByClassName("col-jadwal");
                    for (var k = 0; k < allLinks.length; k++) {
                        allLinks[k].classList.remove('active');
                    }

                    this.classList.add('active');

                    var targetId = this.getAttribute("href");
                    document.querySelector(targetId).style.display = "block";
                });
            }
        });


        //KONFIRMASI LOGOUT
        const logoutButton = document.querySelector('.log-out-btn');

        logoutButton.addEventListener('click', function(event) {
            event.preventDefault();
            const confirmation = confirm('Apakah Anda yakin untuk keluar?');
            if (confirmation) {
                window.location.href = './OOP/logout.php';
            }
        });
    </script>

</body>

</html>