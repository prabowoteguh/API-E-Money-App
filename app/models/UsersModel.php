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
        $query = "SELECT * FROM $this->table RIGHT JOIN roles ON users.User_Role_Id = roles.Role_Id WHERE User_Email = :User_Email AND User_Password = :User_Password";

        $this->db->query($query);
        $this->db->bind('User_Email', $param['email']);
        $this->db->bind('User_Password', $param['password']);
        return $this->db->singleData();
    }

    public function index()
    {
        $this->db->query("SELECT * FROM  $this->table INNER JOIN roles ON users.User_Role_Id = roles.Role_Id WHERE User_Deleted_Status = 0");
        return $this->db->banyakData();
    }

    public function show()
    {
        $this->db->query("SELECT * FROM  $this->table INNER JOIN roles ON users.User_Role_Id = roles.Role_Id");
        return $this->db->banyakData();
    }

    public function insert($request)
    {
        $query = "INSERT INTO $this->table VALUE ('', 
        :User_Email, 
        :User_Password, 
        :User_Nama, 
        :User_Kelamin, 
        :User_Foto, 
        :User_Status_Aktif, 
        :User_No_Hp, 
        :User_Role_Id, 
        :User_Created_By,
        :User_Created_Date,
        :User_Updated_By,
        :User_Updated_Date,
        :User_Deleted_Status,
        :User_Deleted_By,
        :User_Deleted_Date
        )";

        $this->db->query($query);
        $this->db->bind('User_Email', $request['User_Email']);
        $this->db->bind('User_Password', $request['User_Password']);
        $this->db->bind('User_Nama', $request['User_Nama']);
        $this->db->bind('User_Kelamin', $request['User_Kelamin']);
        $this->db->bind('User_Foto', $request['User_Foto']);
        $this->db->bind('User_Status_Aktif', 0);
        $this->db->bind('User_No_Hp', $request['User_No_Hp']);
        $this->db->bind('User_Role_Id', $request['User_Role_Id']);
        $this->db->bind('User_Created_By', $request['User_Created_By']);
        $this->db->bind('User_Created_Date', date("Y-m-d H:i:s"));
        $this->db->bind('User_Updated_By', '');
        $this->db->bind('User_Updated_Date', date("0000-00-00 00:00:00"));
        $this->db->bind('User_Deleted_Status', 0);
        $this->db->bind('User_Deleted_By', '');
        $this->db->bind('User_Deleted_Date', date("0000-00-00 00:00:00"));

        $this->db->execute();
        $result = $this->db->rowCount();
        echo $result;
    }

    public function getDataById($id)
    {
        $this->db->query("SELECT * FROM $this->table INNER JOIN roles ON users.User_Role_Id = roles.Role_Id WHERE User_Id=:User_Id");
        $this->db->bind('User_Id', (int) $id);
        return $this->db->singleData();
    }

    public function update($request)
    {
        $query = "UPDATE $this->table SET 
            User_Email = :User_Email, 
            User_Password = :User_Password, 
            User_Nama = :User_Nama, 
            User_Kelamin = :User_Kelamin, 
            User_Foto = :User_Foto, 
            User_No_Hp = :User_No_Hp, 
            User_Role_Id = :User_Role_Id, 
            User_Updated_By = :User_Updated_By,
            User_Updated_Date = :User_Updated_Date
            WHERE User_Id = :User_Id";

        $this->db->query($query);
        $this->db->bind('User_Email', $request['User_Email']);
        $this->db->bind('User_Password', $request['User_Password']);
        $this->db->bind('User_Nama', $request['User_Nama']);
        $this->db->bind('User_Kelamin', $request['User_Kelamin']);
        $this->db->bind('User_Foto', $request['User_Foto']);
        $this->db->bind('User_No_Hp', $request['User_No_Hp']);
        $this->db->bind('User_Role_Id', $request['User_Role_Id']);
        $this->db->bind('User_Updated_By', $request['User_Updated_By']);
        $this->db->bind('User_Updated_Date', date("Y-m-d H:i:s"));
        $this->db->bind('User_Id', (int) $request['User_Id']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function delete($request)
    {
        $query = "UPDATE users SET 
        User_Deleted_Status = :User_Deleted_Status,
        User_Status_Aktif = :User_Status_Aktif,
        User_Deleted_By = :User_Deleted_By,
        User_Deleted_Date = :User_Deleted_Date
        WHERE User_Id = :User_Id";

        $this->db->query($query);
        $this->db->bind('User_Deleted_Status', 1);
        $this->db->bind('User_Status_Aktif', 0);
        $this->db->bind('User_Deleted_By', $request['User_Deleted_By']);
        $this->db->bind('User_Deleted_Date', date("Y-m-d H:i:s"));
        $this->db->bind('User_Id', (int) $request['User_Id']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function recover($request)
    {
        $query = "UPDATE users SET 
        User_Deleted_Status = :User_Deleted_Status,
        User_Deleted_By = :User_Deleted_By,
        User_Deleted_Date = :User_Deleted_Date WHERE User_Id = :User_Id";

        $this->db->query($query);
        $this->db->bind('User_Deleted_Status', 0);
        $this->db->bind('User_Deleted_By', '');
        $this->db->bind('User_Deleted_Date', "0000-00-00 00:00:00");
        $this->db->bind('User_Id', (int) $request['User_Id']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function ubahStatusAktif($request)
    {
        $query = "UPDATE users SET 
        User_Status_Aktif = :User_Status_Aktif
        WHERE User_Id = :User_Id";

        $this->db->query($query);

        if ($request['User_Status_Aktif'] == 0) {
            $this->db->bind('User_Status_Aktif', 1);
            # code...
        } else {
            $this->db->bind('User_Status_Aktif', 0);
            # code...
        }

        $this->db->bind('User_Id', (int) $request['User_Id']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function ubahPassword($request)
    {
        $query = "UPDATE users SET 
        User_Password = :User_Password
        WHERE User_Id = :User_Id";

        $this->db->query($query);
        $this->db->bind('User_Password', $request['User_Password']);
        $this->db->bind('User_Id', (int) $request['User_Id']);

        $this->db->execute();

        return $this->db->rowCount();
    }
}
