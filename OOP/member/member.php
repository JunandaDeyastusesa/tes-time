<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/style.css">
    <title>Kelas</title>
</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Data Kelas</title>
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../../assets/style.css">
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                <nav class="col-md-2 col-lg-2 d-md-block sidebar">
                    <div class="sidebar-menu position-sticky pt-3">
                        <div class="text-center mb-4">
                            <img src="../../assets/ikon/Logo-MEC.png" alt="Logo" class="img-fluid" style="max-width: 120px; padding-top: 30px">
                        </div>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="../../index.php">
                                    <img src="../../assets/ikon/Dashboard.svg" alt="">Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../pembayaran/index.php">
                                    <img src="../../assets/ikon/payment.svg" alt="">Pembayaran
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="../member/member.php">
                                    <img src="../../assets/ikon/Siswa.svg" alt="">Siswa
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../peket_kelas/index.php">
                                    <img src="../../assets/ikon/active-pkt-kls.svg" alt="">Paket Kelas
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../mentor/index.php">
                                    <img src="../../assets/ikon/Mentor.svg" alt="">Mentor
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../jadwal/index_jadwal.php">
                                    <img src="../../assets/ikon/Jadwal.svg" alt="">Jadwal
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../fasilitas/index.php">
                                    <img src="../../assets/ikon/fasilitas.svg" alt="">Fasilitas
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link log-out-btn">
                                    <img src="../../assets/ikon/logout.svg" alt="">Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <!-- Main Content -->
                <main class="content col-md-10 ms-sm-auto col-lg-10 px-md-4">
                    <div class="title-page d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3 mb-3">
                        <h1>Data Kelas</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKelasModal">
                                Tambah
                            </button>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="py-2">No</th>
                                    <th class="py-2">ID Member</th>
                                    <th class="py-2">Tanggal Daftar</th>
                                    <th class="py-2">Nama Siswa</th>
                                    <th class="py-2">No. Telepon</th>
                                    <th class="py-2">Tgl Lahir</th>
                                    <th class="py-2">Alamat</th>
                                    <th class="py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td class="text-center">001</td>
                                    <td class="text-center">12 Juli 2023</td>
                                    <td class="text-center">Anang Sunanto</td>
                                    <td class="text-center">08562134646</td>
                                    <td class="text-center">16 Mei 2005</td>
                                    <td class="text-center">Jl. Manukan Gg. Besar Surabaya</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-warning me-2" data-bs-toggle="modal" data-bs-target="#editKelasModal">Edit</button>
                                        <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteKelasModal">Hapus</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>

        <!-- Tambah Kelas Modal -->
        <div class="modal fade modal-add" id="tambahKelasModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Kelas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="id_kelas" class="form-label">ID Kelas:</label>
                                <input type="number" class="form-control" id="id_kelas" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_daftar" class="form-label">Tanggal Daftar:</label>
                                <input type="date" class="form-control" id="tanggal_daftar" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama:</label>
                                <input type="text" class="form-control" id="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="no_telepon" class="form-label">No Telepon:</label>
                                <input type="text" class="form-control" id="no_telepon" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir:</label>
                                <input type="date" class="form-control" id="kapasitas_kelas" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat:</label>
                                <input type="text" class="form-control" id="alamat" required>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary px-4 mt-3">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Kelas Modal -->
        <div class="modal fade" id="editKelasModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Kelas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="id_siswa" class="form-label">ID Siswa:</label>
                                <input type="number" class="form-control" id="id_siswa" placeholder="id siswa" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_daftar" class="form-label">Tanggal Daftar:</label>
                                <input type="date" class="form-control" id="tanggal_daftar" placeholder="tanggal daftar" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama:</label>
                                <input type="text" class="form-control" id="nama" placeholder="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="no_telepon" class="form-label">No Telepon:</label>
                                <input type="number" class="form-control" id="no_telepon" placeholder="08655556646" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir:</label>
                                <input type="date" class="form-control" id="tanggal_lahir" placeholder="tanggal lahir" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat:</label>
                                <input type="text" class="form-control" id="alamat" placeholder="alamat" required>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary px-4 mt-3">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Kelas Modal -->
        <div class="modal fade" id="deleteKelasModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Kelas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Yakin Mau Hapus?</p>
                        <button class="btn btn-danger">Hapus</button>
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap 5 JS and Popper.js -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    </body>

    </html>

</body>

</html>