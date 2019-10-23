<?php

class Moneys extends Controller
{
    public function index()
    {
        $data = array();

        $data['Status'] = "OK";
        $data['Status_Code'] = "200";
        $data['Message'] = "Berhasil";

        $data['Moneys'] = $this->model('MoneysModel')->index();
        echo json_encode($data);
    }

    public function show()
    {
        $data = array();

        $data['Status'] = "OK";
        $data['Status_Code'] = "200";
        $data['Message'] = "Berhasil";

        $data['Moneys'] = $this->model('MoneysModel')->show();
        echo json_encode($data);
    }

    public function insert()
    {
        $data = [];
        $data['Money'] = $this->model('MoneysModel')->insert($_POST);
        if ($data['Money'] >= 0) {
            $data['Mahasiswa'] = $this->model('MahasiswasModel')->updateSaldo($_POST);
            if ($data['Mahasiswa'] >= 0) {
                $data['Status'] = "OK";
                $data['Status_Code'] = "200";
                $data['Message'] = "TopUp Berhasil";
            } else {
                $data['Status'] = "BAD REQUEST";
                $data['Status_Code'] = "400";
                $data['Message'] = "Top up gagal, bad server";
            }
        } else {
            $data['Status'] = "BAD REQUEST";
            $data['Status_Code'] = "400";
            $data['Message'] = "Top up gagal, bad server";
        }
        echo json_encode($data);
    }

    public function laporanPerHari()
    {
        $data = [];
        $data['Money'] = $this->model('MoneysModel')->laporanPerHari();
        if ($data['Money'] >= 0) {
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

    public function laporanPerMinggu()
    {
        $data = [];
        $data['Money'] = $this->model('MoneysModel')->laporanPerMinggu();
        if ($data['Money'] >= 0) {
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
}
