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

    public function View()
    {
        $member = 'SELECT * FROM table_mentor';
        $perintah = $this->query($member);
        if (!$perintah) {
            die("Error : " . $this->koneksi->error);
        }
        return $perintah;
    }

    public function ViewById($data)
    {
        $_ViewById = "SELECT * FROM table_mentor WHERE id_mentor=?";
        if ($statement = $this->prepare($_ViewById)) {
            $statement->bind_param("i", $id_mentor);
            $id_mentor = $data;
            if ($statement->execute()) {
                $statement->store_result();
                $statement->bind_result($this->id_mentor, $this->nama_mentor, $this->email, $this->telp, $this->tgl_lahir, $this->alamat);
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

    public function Add($id_mentor, $nama_mentor, $email, $telp, $tgl_lahir, $alamat)
    {
        $check_query = "SELECT id_mentor FROM table_mentor WHERE id_mentor = ?";
        $check_statement = $this->prepare($check_query);
        $check_statement->bind_param("s", $id_mentor);
        $check_statement->execute();
        $check_statement->store_result();

        if ($check_statement->num_rows > 0) {
            echo "<script> alert('Maaf, Id Sudah ada'); </script>";
            return false;
        } else {
            // If id_mentor doesn't exist, proceed with insertion
            $_Add = "INSERT INTO table_mentor (id_mentor, nama_mentor, email, telp, tgl_lahir, alamat) VALUES (?, ?, ?, ?, ?, ?)";

            if ($_statement = $this->prepare($_Add)) {
                $_statement->bind_param("ssssss", $param_id_mentor, $param_nama_mentor, $param_email, $param_telp, $param_tgl_lahir, $param_alamat);

                $param_id_mentor = $id_mentor;
                $param_nama_mentor = $nama_mentor;
                $param_email = $email;
                $param_telp = $telp;
                $param_tgl_lahir = $tgl_lahir;
                $param_alamat = $alamat;

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


    public function Edit($id_mentor, $nama_mentor, $email, $telp, $tgl_lahir, $alamat)
    {
        $_Edit = "UPDATE table_mentor SET nama_mentor=?, email=?, telp=?, tgl_lahir=?, alamat=? WHERE id_mentor=?";
        if ($_statement = $this->prepare($_Edit)) {
            $_statement->bind_param("sssssi", $param_nama_mentor, $param_email, $param_telp, $param_tgl_lahir, $param_alamat, $param_id_mentor);
            $param_id_mentor = $id_mentor;
            $param_nama_mentor = $nama_mentor;
            $param_email = $email;
            $param_telp = $telp;
            $param_tgl_lahir = $tgl_lahir;
            $param_alamat = $alamat;
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

    public function DeleteById($id_mentor)
    {
        $_DeleteByid_mentor = "DELETE FROM table_mentor WHERE id_mentor=?";
        if ($_statement = $this->prepare($_DeleteByid_mentor)) {
            $_statement->bind_param("i", $param_id_mentor);
            $param_id_mentor = $id_mentor;
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
}
