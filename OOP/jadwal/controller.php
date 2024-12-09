<?php

include_once '../koneksi.php';

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

    public function ViewKelas()
    {
        $member = 'SELECT * FROM table_paket_kls';
        $perintah = $this->query($member);
        if (!$perintah) {
            die("Error : " . $this->koneksi->error);
        }
        return $perintah;
    }

    public function ViewMentor()
    {
        $sqlMentor = 'SELECT * FROM table_mentor';
        $perintah = $this->query($sqlMentor);
        if (!$perintah) {
            die("Error : " . $this->koneksi->error);
        }
        return $perintah;
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

    public function AddJadwal($id_jadwal, $nama_kelas, $nama_mentor, $no_ruangan, $hari, $jam_kelas)
    {
        $check_query = "SELECT id_jadwal FROM table_jadwal WHERE id_jadwal = ?";
        $check_statement = $this->prepare($check_query);
        $check_statement->bind_param("s", $id_jadwal);
        $check_statement->execute();
        $check_statement->store_result();

        if ($check_statement->num_rows > 0) {
            echo "<script> alert('Maaf, Id Sudah ada'); </script>";
            return false;
        } else {
            $_AddJadwal = "INSERT INTO table_jadwal (id_jadwal, id_mentor, id_kelas, no_ruang, hari ,jam_kelas) VALUES (?, ?, ?, ?, ?, ?)";

            if ($_statement = $this->prepare($_AddJadwal)) {
                $_statement->bind_param("ssssss", $param_id_jadwal, $param_id_mentor, $param_id_kelas, $param_no_ruang, $param_hari, $param_jam_kelas);

                $param_id_jadwal = $id_jadwal;
                $param_id_mentor = $nama_mentor;
                $param_id_kelas = $nama_kelas;
                $param_no_ruang = $no_ruangan;
                $param_hari = $hari;
                $param_jam_kelas = $jam_kelas;

                if ($_statement->execute()) {
                    $_statement->close();
                    return true;
                } else {
                    $_statement->close();
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    public function Edit($id_jadwal, $nama_kelas, $nama_mentor, $no_ruangan, $hari, $jam_kelas)
    {
        $_Edit = "UPDATE table_jadwal SET id_mentor=?, id_kelas=?, no_ruang=?, hari=? ,jam_kelas=? WHERE id_jadwal=?";
        if ($_statement = $this->prepare($_Edit)) {
            $_statement->bind_param("sssssi", $param_id_mentor, $param_id_kelas, $param_no_ruang, $param_hari, $param_jam_kelas, $param_id_jadwal);

            $param_id_jadwal = $id_jadwal;
            $param_id_mentor = $nama_mentor;
            $param_id_kelas = $nama_kelas;
            $param_no_ruang = $no_ruangan;
            $param_hari = $hari;
            $param_jam_kelas = $jam_kelas;
            if ($_statement->execute()) {
                echo "<script> alert('Data berhasil diubah!'); window.location='index_jadwal.php'; </script>";
                // $_statement->close();
                exit();
            } else {
                return false;
            }
        }
        $_statement->close();
    }

    public function GetSiswaByNim($nim)
    {
        $query = "SELECT * FROM table_siswa WHERE nim = ?";
        if ($_statement = $this->prepare($query)) {
            $_statement->bind_param("s", $nim);
            $_statement->execute();
            $result = $_statement->get_result();
            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function DeleteById($id_jadwal)
    {
        $_DeleteByid_jadwal = "DELETE FROM table_jadwal WHERE id_jadwal=?";
        if ($_statement = $this->prepare($_DeleteByid_jadwal)) {
            $_statement->bind_param("i", $param_id_jadwal);
            $param_id_jadwal = $id_jadwal;
            if ($_statement->execute()) {
                echo "<script> alert('Data Telah Dihapus!'); window.location='index_jadwal.php'; </script>";
                $_statement->close();
                exit();
            } else {
                return false;
            }
        }
        $_statement->close();
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
