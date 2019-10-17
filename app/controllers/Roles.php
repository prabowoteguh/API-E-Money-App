<?php

class Roles extends Controller
{
    public function index()
    {
        $data = array();

        $data['status'] = "OK";
        $data['status_code'] = "200";
        $data['Message'] = "Berhasil";

        $data['role'] = $this->model('RolesModel')->show();
        echo json_encode($data);
    }

    public function insert()
    {
        $data = [];
        if ($this->model('RolesModel')->insert($_POST) >= 0) {
            $data['status'] = "OK";
            $data['status_code'] = "200";
            $data['Message'] = "Insert Data Berhasil";
        } else {
            $data['status'] = "BAD REQUEST";
            $data['status_code'] = "400";
            $data['Message'] = "Insert Data Gagal";
        }
        // $data['insert'] = $this->model('RolesModel')->insert($_POST);
        echo json_encode($data);
    }

    public function getDataById()
    {
        if ($this->model('RolesModel')->getDataById($_POST['Roles_Id']) >= 0) {
            echo json_encode($this->model('RolesModel')->getDataById($_POST['Roles_Id']));
        } else {
            $data = [];
            $data['status'] = "NULL";
            $data['status_code'] = "400";
            $data['Message'] = "Data tidak ditemukan";

            echo json_encode($data);
        }
    }

    public function update()
    {
        $data = [];
        if ($this->model('RolesModel')->update($_POST) >= 0) {
            $data['status'] = "OK";
            $data['status_code'] = "200";
            $data['Message'] = "Update Data Berhasil";
        } else {
            $data['status'] = "BAD REQUEST";
            $data['status_code'] = "400";
            $data['Message'] = "Update Data Gagal";
        }
        echo json_encode($data);
    }

    public function delete()
    {
        $data = [];
        if ($this->model('RolesModel')->delete($_POST) >= 0) {
            $data['status'] = "OK";
            $data['status_code'] = "200";
            $data['Message'] = "Delete Data Berhasil";
        } else {
            $data['status'] = "BAD REQUEST";
            $data['status_code'] = "400";
            $data['Message'] = "Delete Data Gagal";
        }
        echo json_encode($data);
    }
}
