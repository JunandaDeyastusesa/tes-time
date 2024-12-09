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

    public function ViewSiswa()
    {
        $member = 'SELECT * FROM table_siswa';
        $perintah = $this->query($member);
        if (!$perintah) {
            die("Error : " . $this->koneksi->error);
        }
        return $perintah;
    }

    public function ViewKelas()
    {
        $sqlMentor = 'SELECT * FROM table_paket_kls';
        $perintah = $this->query($sqlMentor);
        if (!$perintah) {
            die("Error : " . $this->koneksi->error);
        }
        return $perintah;
    }

    public function ViewById($data)
    {
        $_ViewById = "SELECT * FROM table_pembayaran WHERE id_bayar=?";
        if ($statement = $this->prepare($_ViewById)) {
            $statement->bind_param("i", $id_bayar);
            $id_bayar = $data;
            if ($statement->execute()) {
                $statement->store_result();
                $statement->bind_result($this->id_bayar, $this->tanggal, $this->id_siswa, $this->id_kelas);
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


    public function AddBayar($id_bayar, $tanggal, $id_siswa, $id_kelas)
    {
        $check_query = "SELECT id_bayar FROM table_pembayaran WHERE id_bayar = ?";
        $check_statement = $this->prepare($check_query);
        $check_statement->bind_param("s", $id_bayar);
        $check_statement->execute();
        $check_statement->store_result();
        
        if ($check_statement->num_rows > 0) {
            echo "<script> alert('Maaf, Id Sudah ada'); </script>";
            return false;
        } else {
            $_AddBayar = "INSERT INTO table_pembayaran (id_bayar, tanggal, id_siswa, id_kelas) VALUES (?, ?, ?, ?)";

            if ($_statement = $this->prepare($_AddBayar)) {
                $_statement->bind_param("ssss", $param_id_bayar, $param_tanggal, $param_id_siswa, $param_id_kelas);

                $param_id_bayar = $id_bayar;
                $param_tanggal = $tanggal;
                $param_id_siswa = $id_siswa;
                $param_id_kelas = $id_kelas;

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

    public function Edit($id_bayar, $tanggal, $id_siswa, $id_kelas)
    {
        $_Edit = "UPDATE table_pembayaran SET tanggal=?, id_siswa=?, id_kelas=? WHERE id_bayar=?";
        if ($_statement = $this->prepare($_Edit)) {
            $_statement->bind_param("sssi", $param_tanggal, $param_id_siswa, $param_id_kelas, $param_id_bayar);

            $param_id_bayar = $id_bayar;
            $param_tanggal = $tanggal;
            $param_id_siswa = $id_siswa;
            $param_id_kelas = $id_kelas;

            if ($_statement->execute()) {
                echo "<script> alert('Data berhasil diubah!'); window.location='index.php'; </script>";
                // $_statement->close();
                exit();
            } else {
                return false;
            }
        }
        $_statement->close();
    }

    public function DeleteById($id_bayar)
    {
        $_DeleteByid_bayar = "DELETE FROM table_pembayaran WHERE id_bayar=?";
        if ($_statement = $this->prepare($_DeleteByid_bayar)) {
            $_statement->bind_param("i", $param_id_bayar);
            $param_id_bayar = $id_bayar;
            if ($_statement->execute()) {
                echo "<script> alert('Data Telah Dihapus!'); window.location='index.php'; </script>";
                $_statement->close();
                exit();
            } else {
                return false;
            }
        }
        $_statement->close();
    }

    public function ViewRelasiBayar()
    {
        $_ViewRelasi = "SELECT * FROM table_pembayaran 
                        INNER JOIN table_siswa ON table_pembayaran.id_siswa = table_siswa.id_siswa
                        INNER JOIN table_paket_kls ON table_pembayaran.id_kelas = table_paket_kls.id_kelas ORDER BY id_bayar ASC";
        $perintah = $this->query($_ViewRelasi);
        if (!$perintah) {
            die("Error : " . $this->koneksi->error);
        }
        return $perintah;
    }
}
