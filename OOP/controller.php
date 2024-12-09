<?php

include_once 'koneksi.php';

class Controller extends koneksi
{
    public function prepare($data)
    {
        $perintah_data = $this->koneksi->prepare($data);
        if (!$perintah_data) {
            die("Terjadi Kesalahan pada Prepare Statement" . $this->koneksi->error);
        }
        return $perintah_data;
    }

    public function query($data)
    {
        $perintah_data = $this->koneksi->query($data);
        if (!$perintah_data) {
            die("Terjadi Kesalahan pada Prepare Statement" . $this->koneksi->error);
        }
        return $perintah_data;
    }

    public function login($username, $pass)
    {
        $username = $this->koneksi->real_escape_string($username);
        $pass = $this->koneksi->real_escape_string($pass);

        $query = "SELECT * FROM table_user WHERE username = '$username' AND pass = '$pass'";
        $result = $this->koneksi->query($query);

        if (!$result) {
            die("Error : " . $this->koneksi->error);
        }

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            return $user;
        } else {
            return null;
        }
    }





    //VIEW MENTOR
    public function ViewMentor()
    {
        $member = 'SELECT * FROM table_mentor';
        $perintah = $this->query($member);
        if (!$perintah) {
            die("Error : " . $this->koneksi->error);
        }
        return $perintah;
    }

    //VIEW JADWAL
    public function ViewJadwal()
    {
        $sql_jadwal = 'SELECT * FROM table_jadwal';
        $perintah = $this->query($sql_jadwal);
        if (!$perintah) {
            die("Error : " . $this->koneksi->error);
        }
        return $perintah;
    }
    public function ViewRelasiJadwal()
    {
        $_ViewRelasi = "SELECT * FROM table_jadwal 
                        INNER JOIN table_mentor ON table_jadwal.id_mentor = table_mentor.id_mentor
                        INNER JOIN table_paket_kls ON table_jadwal.id_kelas = table_paket_kls.id_kelas";
        $perintah = $this->query($_ViewRelasi);
        if (!$perintah) {
            die("Error : " . $this->koneksi->error);
        }
        return $perintah;
    }

    public function CountRegistrationsByMonth()
    {
        $sql = "SELECT MONTH(tgl_daftar) AS bulan, 
                   DATE_FORMAT(tgl_daftar, '%b') AS nama_bulan, 
                   COUNT(*) AS total_pendaftar 
            FROM table_siswa 
            GROUP BY bulan, nama_bulan"; // Add nama_bulan to GROUP BY

        $result = $this->koneksi->query($sql);

        if ($result) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[$row['bulan']] = [
                    'total_pendaftar' => $row['total_pendaftar'],
                    'nama_bulan' => $row['nama_bulan']
                ];
            }
            return $data;
        } else {
            die("Error: " . $this->koneksi->error);
        }
    }


    public function JumlahSiswa()
    {
        $sql_ViewSiswa = 'SELECT * FROM table_siswa';
        $perintah = $this->query($sql_ViewSiswa);
        if (!$perintah) {
            die("Error : " . $this->koneksi->error);
        }
        $_jumlahSiswa = $perintah->num_rows;
        return $_jumlahSiswa;
    }

    public function JumlahKelas()
    {
        $sql_ViewKelas = 'SELECT * FROM table_paket_kls';
        $perintah = $this->query($sql_ViewKelas);
        if (!$perintah) {
            die("Error : " . $this->koneksi->error);
        }
        $_jumlahKelas = $perintah->num_rows;
        return $_jumlahKelas;
    }

    public function JumlahMentor()
    {
        $sqlMentor = 'SELECT * FROM table_mentor';
        $perintah = $this->query($sqlMentor);
        if (!$perintah) {
            die("Error : " . $this->koneksi->error);
        }
        $_jumlahMentor = $perintah->num_rows;
        return $_jumlahMentor;
    }

    public function ViewById($data)
    {
        $_ViewById = "SELECT * FROM table_jadwal WHERE id_jadwal=?";
        if ($statement = $this->prepare($_ViewById)) {
            $statement->bind_param("i", $id_jadwal);
            $id_jadwal = $data;
            if ($statement->execute()) {
                $statement->store_result();
                $statement->bind_result($this->id_jadwal, $this->id_mentor, $this->id_kelas, $this->no_ruang, $this->hari, $this->jam_kelas);
                $statement->fetch();
                if ($statement->num_rows == 1) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        $statement->close();
    }

    public function ViewRelasi()
    {
        $_ViewRelasi = "SELECT * FROM table_jadwal 
                        INNER JOIN table_mentor ON table_jadwal.id_mentor = table_mentor.id_mentor
                        INNER JOIN table_paket_kls ON table_jadwal.id_kelas = table_paket_kls.id_kelas";
        $perintah = $this->query($_ViewRelasi);
        if (!$perintah) {
            die("Error : " . $this->koneksi->error);
        }
        return $perintah;
    }
}
