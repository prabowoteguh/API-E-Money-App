<?php

class Products extends Controller
{
    public function index()
    {
        $data = array();

        $data['Status'] = "OK";
        $data['Status_Code'] = "200";
        $data['Message'] = "Berhasil";

        $data['Products'] = $this->model('ProductsModel')->index();
        echo json_encode($data);
    }

    public function show()
    {
        $data = array();

        $data['Status'] = "OK";
        $data['Status_Code'] = "200";
        $data['Message'] = "Berhasil";

        $data['Products'] = $this->model('ProductsModel')->show();
        echo json_encode($data);
    }

    public function insert()
    {
        $data = [];
        if ($this->model('ProductsModel')->insert($_POST) >= 0) {
            $data['Status'] = "OK";
            $data['Status_Code'] = "200";
            $data['Message'] = "Insert Data Berhasil";
        } else {
            $data['Status'] = "BAD REQUEST";
            $data['Status_Code'] = "400";
            $data['Message'] = "Insert Data Gagal";
        }
        // $data['insert'] = $this->model('ProductsModel')->insert($_POST);
        echo json_encode($data);
    }

    public function getDataById()
    {
        if ($this->model('ProductsModel')->getDataById($_POST['Products_Id']) >= 0) {
            echo json_encode($this->model('ProductsModel')->getDataById($_POST['Products_Id']));
        } else {
            $data = [];
            $data['Status'] = "NULL";
            $data['Status_Code'] = "400";
            $data['Message'] = "Data tidak ditemukan";

            echo json_encode($data);
        }
    }

    public function update()
    {
        $data = [];
        if ($this->model('ProductsModel')->update($_POST) >= 0) {
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
        if ($this->model('RolesModel')->delete($_POST) >= 0) {
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
}
