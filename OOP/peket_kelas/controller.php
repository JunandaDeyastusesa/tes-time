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
        $member = 'SELECT * FROM table_paket_kls';
        $perintah = $this->query($member);
        if (!$perintah) {
            die("Error : " . $this->koneksi->error);
        }
        return $perintah;
    }

    public function ViewById($data)
    {
        $_ViewById = "SELECT * FROM table_paket_kls WHERE id_kelas =?";
        if ($statement = $this->prepare($_ViewById)) {
            $statement->bind_param("i", $id_kelas );
            $id_kelas  = $data;
            if ($statement->execute()) {
                $statement->store_result();
                $statement->bind_result($this->id_kelas , $this->nama_kelas, $this->kapasitas_kelas, $this->harga);
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

    public function Add($id_kelas , $nama_kelas, $kapasitas_kelas, $harga)
    {
        $check_query = "SELECT id_kelas  FROM table_paket_kls WHERE id_kelas  = ?";
        $check_statement = $this->prepare($check_query);
        $check_statement->bind_param("s", $id_kelas );
        $check_statement->execute();
        $check_statement->store_result();

        if ($check_statement->num_rows > 0) {
            echo "<script> alert('Maaf, Id Sudah ada'); </script>";
            return false;
        } else {
            // If id_kelas  doesn't exist, proceed with insertion
            $_Add = "INSERT INTO table_paket_kls (id_kelas , nama_kelas, kapasitas_kelas, harga) VALUES (?, ?, ?, ?)";

            if ($_statement = $this->prepare($_Add)) {
                $_statement->bind_param("ssss", $param_id_kelas , $param_nama_kelas, $param_kapasitas_kelas, $param_harga);

                $param_id_kelas  = $id_kelas ;
                $param_nama_kelas = $nama_kelas;
                $param_kapasitas_kelas = $kapasitas_kelas;
                $param_harga = $harga;

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


    public function Edit($id_kelas , $nama_kelas, $kapasitas_kelas, $harga)
    {
        $_Edit = "UPDATE table_paket_kls SET nama_kelas=?, kapasitas_kelas=?, harga=? WHERE id_kelas =?";
        if ($_statement = $this->prepare($_Edit)) {
            $_statement->bind_param("sssi", $param_nama_kelas, $param_kapasitas_kelas, $param_harga, $param_id_kelas );
            $param_id_kelas  = $id_kelas ;
            $param_nama_kelas = $nama_kelas;
            $param_kapasitas_kelas = $kapasitas_kelas;
            $param_harga = $harga;
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

    public function DeleteById($id_kelas )
    {
        $_DeleteByid_kelas  = "DELETE FROM table_paket_kls WHERE id_kelas =?";
        if ($_statement = $this->prepare($_DeleteByid_kelas )) {
            $_statement->bind_param("i", $param_id_kelas );
            $param_id_kelas  = $id_kelas ;
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
