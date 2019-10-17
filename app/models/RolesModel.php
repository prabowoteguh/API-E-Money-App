<?php

class RolesModel
{
    private $table = 'roles';
    private $db;


    public function __construct()
    {
        $this->db = new Database;
    }

    public function show()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->banyakData();
    }

    public function insert($request)
    {
        $query = "INSERT INTO " . $this->table . " VALUE ('', :Role_Nama, :Role_Created_By, :Role_Created_Date, :Role_Updated_By,:Role_Updated_Date,:Role_Deleted_Status,:Role_Deleted_By,:Role_Deleted_Date)";

        $this->db->query($query);
        $this->db->bind('Role_Nama', $request['Role_Nama']);
        $this->db->bind('Role_Created_By', $request['Role_Created_By']);
        $this->db->bind('Role_Created_Date', date("Y-m-d H:i:s"));
        $this->db->bind('Role_Updated_By', '');
        $this->db->bind('Role_Updated_Date', date("0000-00-00 00:00:00"));
        $this->db->bind('Role_Deleted_Status', 0);
        $this->db->bind('Role_Deleted_By', '');
        $this->db->bind('Role_Deleted_Date', date("0000-00-00 00:00:00"));

        $this->db->execute();
        $result = $this->db->rowCount();
        echo $result;
    }

    public function getDataById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE Role_Id=:Role_Id');
        $this->db->bind('Role_Id', $id);
        return $this->db->singleData();
    }

    public function update($request)
    {
        $query = "UPDATE roles SET 
            Role_Nama = :Role_Nama, 
            Role_Updated_By = :Role_Updated_By,
            Role_Updated_Date = :Role_Updated_Date
            WHERE Role_Id = :Role_Id";

        $this->db->query($query);
        $this->db->bind('Role_Nama', $request['Role_Nama']);
        $this->db->bind('Role_Updated_By', $request['Role_Updated_By']);
        $this->db->bind('Role_Updated_Date', date("Y-m-d H:i:s"));
        $this->db->bind('Role_Id', (int) $request['Role_Id']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function delete($request)
    {
        $query = "DELETE FROM roles WHERE Role_Id = :Role_Id";

        $this->db->query($query);
        $this->db->bind('Role_Id', (int) $request['Role_Id']);

        $this->db->execute();

        return $this->db->rowCount();
    }
}
