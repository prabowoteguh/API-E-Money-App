<?php

class ProductsModel
{
    private $table = 'products';
    private $db;


    public function __construct()
    {
        $this->db = new Database;
    }

    public function index()
    {
        $this->db->query("SELECT * FROM  $this->table WHERE Produk_Deleted_Status = 0");
        return $this->db->banyakData();
    }

    public function show()
    {
        $this->db->query("SELECT * FROM  $this->table");
        return $this->db->banyakData();
    }

    public function insert($request)
    {
        $query = "INSERT INTO " . $this->table . " VALUE ('', :Produk_Code, :Produk_Nama, :Produk_Merk, :Produk_Kategori, :Produk_Harga, :Produk_Foto, :Produk_Deskripsi, :Produk_Stok, :Produk_Created_By, :Produk_Created_Date, :Produk_Updated_By, :Produk_Updated_Date, :Produk_Deleted_Status, :Produk_Deleted_By, :Produk_Deleted_Date)";

        $this->db->query($query);
        $this->db->bind('Produk_Code', $request['Produk_Code']);
        $this->db->bind('Produk_Nama', $request['Produk_Nama']);
        $this->db->bind('Produk_Merk', $request['Produk_Merk']);
        $this->db->bind('Produk_Kategori', $request['Produk_Kategori']);
        $this->db->bind('Produk_Harga', $request['Produk_Harga']);
        $this->db->bind('Produk_Foto', $request['Produk_Foto']);
        $this->db->bind('Produk_Deskripsi', $request['Produk_Deskripsi']);
        $this->db->bind('Produk_Stok', $request['Produk_Stok']);
        $this->db->bind('Produk_Created_By', $request['Produk_Created_By']);
        $this->db->bind('Produk_Created_Date', date("Y-m-d H:i:s"));
        $this->db->bind('Produk_Updated_By', '');
        $this->db->bind('Produk_Updated_Date', date("0000-00-00 00:00:00"));
        $this->db->bind('Produk_Deleted_Status', 0);
        $this->db->bind('Produk_Deleted_By', '');
        $this->db->bind('Produk_Deleted_Date', date("0000-00-00 00:00:00"));

        $this->db->execute();
        $result = $this->db->rowCount();
        echo $result;
    }

    public function getDataById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE Produk_Id=:Produk_Id');
        $this->db->bind('Produk_Id', $id);
        return $this->db->singleData();
    }

    public function update($request)
    {
        $query = "UPDATE $this->table SET 
            Produk_Nama= :Produk_Nama, 
            Produk_Merk= :Produk_Merk, 
            Produk_Kategori= :Produk_Kategori, 
            Produk_Harga= :Produk_Harga, 
            Produk_Foto= :Produk_Foto, 
            Produk_Deskripsi= :Produk_Deskripsi, 
            Produk_Stok= :Produk_Stok
            WHERE Produk_Id = :Produk_Id";

        $this->db->query($query);
        $this->db->bind('Produk_Nama', $request['Produk_Nama']);
        $this->db->bind('Produk_Merk', $request['Produk_Merk']);
        $this->db->bind('Produk_Kategori', $request['Produk_Kategori']);
        $this->db->bind('Produk_Harga', $request['Produk_Harga']);
        $this->db->bind('Produk_Foto', $request['Produk_Foto']);
        $this->db->bind('Produk_Deskripsi', $request['Produk_Deskripsi']);
        $this->db->bind('Produk_Stok', $request['Produk_Stok']);
        $this->db->bind('Produk_Updated_By', $request['Produk_Created_By']);
        $this->db->bind('Produk_Updated_Date', date("Y-m-d H:i:s"));
        $this->db->bind('Produk_Id', (int) $request['Produk_Id']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function delete($request)
    {
        $query = "UPDATE $this->table SET 
        Produk_Deleted_Status = :Produk_Deleted_Status,
        Produk_Deleted_By = :Produk_Deleted_By,
        Role_Deleted_Date = :Role_Deleted_Date
        WHERE Produk_Id = :Produk_Id";

        $this->db->query($query);
        $this->db->bind('Produk_Deleted_Status', 1);
        $this->db->bind('Role_Deleted_By', (int) $request['Role_Deleted_By']);
        $this->db->bind('Produk_Deleted_Date', date("Y-m-d H:i:s"));
        $this->db->bind('Produk_Id', (int) $request['Produk_Id']);

        $this->db->execute();

        return $this->db->rowCount();
    }
}
