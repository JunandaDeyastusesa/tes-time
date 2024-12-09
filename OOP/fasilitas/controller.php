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
        $fasilitas = 'SELECT * FROM table_fasilitas';
        $perintah = $this->query($fasilitas);
        if (!$perintah) {
            die("Error : " . $this->koneksi->error);
        }
        return $perintah;
    }

    public function ViewById($data)
    {
        $_ViewById = "SELECT * FROM table_fasilitas WHERE id_fasilitas=?";
        if ($statement = $this->prepare($_ViewById)) {
            $statement->bind_param("i", $id_fasilitas);
            $id_fasilitas = $data;
            if ($statement->execute()) {
                $statement->store_result();
                $statement->bind_result($this->id_fasilitas, $this->nama_fasilitas, $this->jumlah, $this->status_fasilitas);
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

    public function Add($id_fasilitas, $nama_fasilitas, $jumlah, $status_fasilitas)
    {
        $check_query = "SELECT id_fasilitas FROM table_fasilitas WHERE id_fasilitas = ?";
        $check_statement = $this->prepare($check_query);
        $check_statement->bind_param("s", $id_fasilitas);
        $check_statement->execute();
        $check_statement->store_result();

        if ($check_statement->num_rows > 0) {
            echo "<script> alert('Maaf, Id Sudah ada'); </script>";
            return false;
        } else {
            // If id_fasilitas doesn't exist, proceed with insertion
            $_Add = "INSERT INTO table_fasilitas (id_fasilitas, nama_fasilitas, jumlah, status_fasilitas) VALUES (?, ?, ?, ?)";

            if ($_statement = $this->prepare($_Add)) {
                $_statement->bind_param("ssss", $param_id_fasilitas, $param_nama_fasilitas, $param_jumlah, $param_status_fasilitas);

                $param_id_fasilitas = $id_fasilitas;
                $param_nama_fasilitas = $nama_fasilitas;
                $param_jumlah = $jumlah;
                $param_status_fasilitas = $status_fasilitas;

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


    public function Edit($id_fasilitas, $nama_fasilitas, $jumlah, $status_fasilitas)
    {
        $_Edit = "UPDATE table_fasilitas SET nama_fasilitas=?, jumlah=?, status_fasilitas=? WHERE id_fasilitas=?";
        if ($_statement = $this->prepare($_Edit)) {
            $_statement->bind_param("sssi", $param_nama_fasilitas, $param_jumlah, $param_status_fasilitas, $param_id_fasilitas);
            $param_id_fasilitas = $id_fasilitas;
            $param_nama_fasilitas = $nama_fasilitas;
            $param_jumlah = $jumlah;
            $param_status_fasilitas = $status_fasilitas;
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

    public function DeleteById($id_fasilitas)
    {
        $_DeleteByid_fasilitas = "DELETE FROM table_fasilitas WHERE id_fasilitas=?";
        if ($_statement = $this->prepare($_DeleteByid_fasilitas)) {
            $_statement->bind_param("i", $param_id_fasilitas);
            $param_id_fasilitas = $id_fasilitas;
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
