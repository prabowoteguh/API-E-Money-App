<?php

class Mahasiswas extends Controller
{
    public function index()
    {
        $data = array();

        $data['Status'] = "OK";
        $data['Status_Code'] = "200";
        $data['Message'] = "Berhasil";

        $data['Mahasiswa'] = $this->model('MahasiswasModel')->index();
        echo json_encode($data);
    }

    public function show()
    {
        $data = array();

        $data['Status'] = "OK";
        $data['Status_Code'] = "200";
        $data['Message'] = "Berhasil";

        $data['Mahasiswa'] = $this->model('MahasiswasModel')->show();
        echo json_encode($data);
    }

    public function insert()
    {
        $data = [];
        if ($this->model('MahasiswasModel')->insert($_POST) >= 0) {
            $data['Status'] = "OK";
            $data['Status_Code'] = "200";
            $data['Message'] = "Insert Data Berhasil";
        } else {
            $data['Status'] = "BAD REQUEST";
            $data['Status_Code'] = "400";
            $data['Message'] = "Insert Data Gagal";
        }
        // $data['insert'] = $this->model('MahasiswasModel')->insert($_POST);
        echo json_encode($data);
    }

    public function getDataById()
    {
        $data = [];
        $data['Mahasiswa'] = $this->model('MahasiswasModel')->getDataById($_POST['Mahasiswa_Id']);
        if ($data['Mahasiswa'] >= 0) {
            $data['Status'] = "OK";
            $data['Status_Code'] = "200";
            $data['Message'] = "Data ditemukan";
        } else {
            $data['Status'] = "NULL";
            $data['Status_Code'] = "400";
            $data['Message'] = "Data tidak ditemukan";
        }
        echo json_encode($data);
    }

    public function getDataTotalMahasiswa()
    {
        $data = [];
        $data['Mahasiswa'] = $this->model('MahasiswasModel')->getDataTotalMahasiswa($_POST['Mahasiswa_Jurusan']);
        if ($data['Mahasiswa'] >= 0) {
            $data['Status'] = "OK";
            $data['Status_Code'] = "200";
            $data['Message'] = "Data ditemukan";
        } else {
            $data['Status'] = "NULL";
            $data['Status_Code'] = "400";
            $data['Message'] = "Data tidak ditemukan";
        }
        echo json_encode($data);
    }

    public function getDataByNpm()
    {
        $data = [];
        $data['Mahasiswa'] = $this->model('MahasiswasModel')->getDataByNpm($_POST['Mahasiswa_Npm']);
        if ($data['Mahasiswa'] >= 0) {
            $data['Status'] = "OK";
            $data['Status_Code'] = "200";
            $data['Message'] = "Data ditemukan";
        } else {
            $data['Status'] = "NULL";
            $data['Status_Code'] = "400";
            $data['Message'] = "Data tidak ditemukan";
        }
        echo json_encode($data);
    }

    public function getDataLikeNpm()
    {
        $data = [];
        $data['Mahasiswa'] = $this->model('MahasiswasModel')->getDataLikeNpm($_POST['Mahasiswa_Npm']);
        if ($data['Mahasiswa'] >= 0) {
            $data['Status'] = "OK";
            $data['Status_Code'] = "200";
            $data['Message'] = "Data ditemukan";
        } else {
            $data['Status'] = "NULL";
            $data['Status_Code'] = "400";
            $data['Message'] = "Data tidak ditemukan";
        }
        echo json_encode($data);
    }

    public function getDataNpm()
    {
        $data = [];
        $data['Mahasiswa'] = $this->model('MahasiswasModel')->getDataNpm($_POST);
        if ($data['Mahasiswa'] >= 0) {
            $data['Status'] = "OK";
            $data['Status_Code'] = "200";
            $data['Message'] = "Data ditemukan";
        } else {
            $data['Status'] = "NULL";
            $data['Status_Code'] = "400";
            $data['Message'] = "Data tidak ditemukan";
        }
        echo json_encode($data);
    }

    public function update()
    {
        $data = [];
        if ($this->model('MahasiswasModel')->update($_POST) >= 0) {
            $data['Status'] = "OK";
            $data['Status_Code'] = "200";
            $data['Message'] = "Update Data Berhasil";
        } else {
            $data['Status'] = "BAD REQUEST";
            $data['Status_Code'] = "400";
            $data['Message'] = "Update Data Gagal";
        }
        echo json_encode($data);
    }

    public function delete()
    {
        $data = [];
        if ($this->model('MahasiswasModel')->delete($_POST) >= 0) {
            $data['Status'] = "OK";
            $data['Status_Code'] = "200";
            $data['Message'] = "Delete Data Berhasil";
        } else {
            $data['Status'] = "BAD REQUEST";
            $data['Status_Code'] = "400";
            $data['Message'] = "Delete Data Gagal";
        }
        echo json_encode($data);
    }

    public function updateSaldo()
    {
        $data = [];
        if ($this->model('MahasiswasModel')->updateSaldo($_POST) >= 0) {
            $data['Status'] = "OK";
            $data['Status_Code'] = "200";
            $data['Message'] = "Update Data Berhasil";
        } else {
            $data['Status'] = "BAD REQUEST";
            $data['Status_Code'] = "400";
            $data['Message'] = "Update Data Gagal";
        }
        echo json_encode($data);
    }

    public function recover()
    {
        $data = [];
        if ($this->model('MahasiswasModel')->recover($_POST) >= 0) {
            $data['Status'] = "OK";
            $data['Status_Code'] = "200";
            $data['Message'] = "Your file has been recovered.";
        } else {
            $data['Status'] = "BAD REQUEST";
            $data['Status_Code'] = "400";
            $data['Message'] = "Recover Data Gagal";
        }
        echo json_encode($data);
    }

    public function ubahStatusAktif()
    {
        $data = [];
        if ($this->model('MahasiswasModel')->ubahStatusAktif($_POST) >= 0) {
            $data['Status'] = "OK";
            $data['Status_Code'] = "200";
            $data['Message'] = "User has been changed.";
        } else {
            $data['Status'] = "BAD REQUEST";
            $data['Status_Code'] = "400";
            $data['Message'] = "Ubah status user gagal";
        }
        echo json_encode($data);
    }
}
