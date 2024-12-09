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

    public function ViewById($data)
    {
        $ViewByid_siswa = "SELECT * FROM table_siswa WHERE id_siswa=?";
        if ($statement = $this->prepare($ViewByid_siswa)) {
            $statement->bind_param("i", $id_siswa);
            $id_siswa = $data;
            if ($statement->execute()) {
                $statement->store_result();
                $statement->bind_result($this->id_siswa, $this->nama, $this->siswa_no_telp, $this->tanggal_lahir, $this->alamat, $this->tgl_daftar);
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

    public function AddSiswa($id_siswa, $nama, $siswa_no_telp, $tanggal_lahir, $alamat, $tgl_daftar)
    {
        $check_query = "SELECT id_siswa FROM table_siswa WHERE id_siswa = ?";
        $check_statement = $this->prepare($check_query);
        $check_statement->bind_param("s", $id_siswa);
        $check_statement->execute();
        $check_statement->store_result();

        if ($check_statement->num_rows > 0) {
            echo "<script> alert('Maaf, Id Sudah ada'); </script>";
            return false;
        } else {
            $_AddSiswa = "INSERT INTO table_siswa (id_siswa, nama, siswa_no_telp, tanggal_lahir, alamat, tgl_daftar) VALUES (?, ?, ?, ?, ?, ?)";

            if ($_statement = $this->prepare($_AddSiswa)) {
                $_statement->bind_param("ssssss", $param_id_siswa, $param_nama, $param_siswa_no_telp, $param_tanggal_lahir, $param_alamat, $param_tgl_daftar);

                $param_id_siswa = $id_siswa;
                $param_nama = $nama;
                $param_siswa_no_telp = $siswa_no_telp;
                $param_tanggal_lahir = $tanggal_lahir;
                $param_alamat = $alamat;
                $param_tgl_daftar = $tgl_daftar;

                if ($_statement->execute()) {
                    echo "<script> alert('Data berhasil ditambahkan!'); </script>";
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


    public function EditSiswa($id_siswa, $nama, $siswa_no_telp, $tanggal_lahir, $alamat, $tgl_daftar)
    {
        $_EditSiswa = "UPDATE table_siswa SET nama=?, siswa_no_telp=?, tanggal_lahir=?, alamat=?, tgl_daftar=? WHERE id_siswa=?";
        if ($_statement = $this->prepare($_EditSiswa)) {
            $_statement->bind_param("sssssi", $param_nama, $param_siswa_no_telp, $param_tanggal_lahir, $param_alamat, $param_tgl_daftar, $param_id_siswa);

            $param_id_siswa = $id_siswa;
            $param_nama = $nama;
            $param_siswa_no_telp = $siswa_no_telp;
            $param_tanggal_lahir = $tanggal_lahir;
            $param_alamat = $alamat;
            $param_tgl_daftar = $tgl_daftar;
            if ($_statement->execute()) {
                echo "<script> alert('Data berhasil diubah!'); window.location='member.php'; </script>";
                // $_statement->close();
                exit();
            } else {
                return false;
            }
        }
        $_statement->close();
    }

    public function DeleteById($id_siswa)
    {
        $_DeleteById = "DELETE FROM table_siswa WHERE id_siswa=?";
        if ($_statement = $this->prepare($_DeleteById)) {
            $_statement->bind_param("i", $param_id_siswa);
            $param_id_siswa = $id_siswa;
            if ($_statement->execute()) {
                echo "<script> alert('Data Telah Dihapus!'); window.location='member.php'; </script>";
                $_statement->close();
                exit();
            } else {
                return false;
            }
        }
        $_statement->close();
    }
}
