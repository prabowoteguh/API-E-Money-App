<?php

class HomeController extends Controller
{
    public function index()
    {
        $data = array();

        $data['status'] = "OK";
        $data['status_code'] = "200";
        $data['Message'] = "Welcome to my API";

        // $data['mahasiswa'] = $this->model('RolesModel')->show();
        echo json_encode($data);
    }
}
