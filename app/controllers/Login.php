<?php

class Login extends Controller
{
    public function index()
    {
        // session_start();
        $data = [];
        $login = $this->model('UsersModel')->login($_POST);

        if ($login) {
            if ($login['User_Status_Aktif'] == 1) {
                $data['Status_Code'] = 200;
                $data['Status'] = 'HTTP_OK';
                $data['Data_User'] = $login;
            } else {
                $data['Status_Code'] = 401;
                $data['Status'] = 'HTTP_UNAUTHORIZED';
                $data['Message'] = 'User belum aktif, silahkan hubungi admin!';
            }
        } else {
            $data['Status_Code'] = 404;
            $data['Status'] = 'HTTP_NOT_FOUND';
            $data['Message'] = 'Email tidak terdaftar atau password salah!';
        }

        echo json_encode($data);
    }

    public function setSession()
    {
        # code...
    }
}
