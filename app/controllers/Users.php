<?php

class Users extends Controller
{
    public function index()
    {
        $data = array();

        $data['status'] = "OK";
        $data['status_code'] = "200";
        $data['Message'] = "Berhasil";

        $data['mahasiswa'] = $this->model('RolesModel')->show();
        echo json_encode($data);
    }
}
