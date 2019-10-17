<?php

class UsersModel
{

    private $table = 'users';
    private $db;


    public function __construct()
    {
        $this->db = new Database;
    }

    public function login($param)
    {
        // users.User_Id, 
        // users.User_Email, 
        // users.User_Nama,
        // users.User_Kelamin,
        // users.User_Status_Aktif,
        // users.User_No_Hp,
        // roles.Role_Id,
        // roles.Role_Nama
        $query = "SELECT * FROM $this->table RIGHT JOIN roles ON users.User_Role_Id = roles.Role_Id WHERE User_Email = :User_Email AND User_Password = :User_Password";

        $this->db->query($query);
        $this->db->bind('User_Email', $param['email']);
        $this->db->bind('User_Password', $param['password']);
        return $this->db->singleData();
    }
}
