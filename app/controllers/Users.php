<?php

class Users extends Controller
{
    public function index()
    {
        $data = array();

        $data['Status'] = "OK";
        $data['Status_Code'] = "200";
        $data['Message'] = "Berhasil";

        $data['users'] = $this->model('UsersModel')->index();
        echo json_encode($data);
    }

    public function show()
    {
        $data = array();

        $data['Status'] = "OK";
        $data['Status_Code'] = "200";
        $data['Message'] = "Berhasil";

        $data['users'] = $this->model('UsersModel')->show();
        echo json_encode($data);
    }

    public function insert()
    {
        $data = [];
        if ($this->model('UsersModel')->insert($_POST) >= 0) {
            $data['Status'] = "OK";
            $data['Status_Code'] = "200";
            $data['Message'] = "Insert Data Berhasil";
        } else {
            $data['Status'] = "BAD REQUEST";
            $data['Status_Code'] = "400";
            $data['Message'] = "Insert Data Gagal";
        }
        // $data['insert'] = $this->model('UsersModel')->insert($_POST);
        echo json_encode($data);
    }

    public function getDataById()
    {
        $data = [];
        $data['User'] = $this->model('UsersModel')->getDataById($_POST['User_Id']);
        if ($data['User'] >= 0) {
            $data['Status'] = "HTTP OK";
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
        if ($this->model('UsersModel')->update($_POST) >= 0) {
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

    public function ubahPassword()
    {
        $data = [];
        if ($this->model('UsersModel')->ubahPassword($_POST) >= 0) {
            $data['Status'] = "OK";
            $data['Status_Code'] = "200";
            $data['Message'] = "Password berhasil diubah!";
        } else {
            $data['Status'] = "BAD REQUEST";
            $data['Status_Code'] = "400";
            $data['Message'] = "Ubah password Data Gagal";
        }
        echo json_encode($data);
    }

    public function delete()
    {
        $data = [];
        if ($this->model('UsersModel')->delete($_POST) >= 0) {
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

    public function recover()
    {
        $data = [];
        if ($this->model('UsersModel')->recover($_POST) >= 0) {
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
        if ($this->model('UsersModel')->ubahStatusAktif($_POST) >= 0) {
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
