<?php

class MoneysModel
{

    private $table = 'emoneys';
    private $db;


    public function __construct()
    {
        $this->db = new Database;
    }

    public function index()
    {
        $this->db->query("SELECT * FROM  $this->table INNER JOIN mahasiswas ON mahasiswas.Mahasiswa_Npm = emoneys.Money_Mahasiswa_Npm WHERE Money_Deleted_Status = 0");
        return $this->db->banyakData();
    }

    public function show()
    {
        $this->db->query("SELECT * FROM  $this->table INNER JOIN mahasiswas ON mahasiswas.Mahasiswa_Npm = emoneys.Money_Mahasiswa_Npm");
        return $this->db->banyakData();
    }

    public function insert($request)
    {
        $query = "INSERT INTO $this->table VALUE ('', 
        :Money_Mahasiswa_Npm, 
        :Money_Nominal, 
        :Money_Created_By,
        NOW(),
        :Money_Updated_By,
        :Money_Updated_Date,
        :Money_Deleted_Status,
        :Money_Deleted_By,
        :Money_Deleted_Date
        )";

        $this->db->query($query);
        $this->db->bind('Money_Mahasiswa_Npm', $request['Money_Mahasiswa_Npm']);
        $this->db->bind('Money_Nominal', $request['Money_Nominal']);
        $this->db->bind('Money_Created_By', $request['Money_Created_By']);
        // $this->db->bind('Money_Created_Date', date("Y-m-d H:i:s"));
        $this->db->bind('Money_Updated_By', '');
        $this->db->bind('Money_Updated_Date', date("0000-00-00 00:00:00"));
        $this->db->bind('Money_Deleted_Status', 0);
        $this->db->bind('Money_Deleted_By', '');
        $this->db->bind('Money_Deleted_Date', date("0000-00-00 00:00:00"));

        $this->db->execute();
        $result = $this->db->rowCount();
        echo $result;
    }

    public function laporanPerHari()
    {
        $query = "SELECT SUM(Money_Nominal) AS Total_Nominal, COUNT(*) AS Total_Mahasiswa FROM $this->table WHERE Money_Created_Date LIKE CONCAT('%', CURRENT_DATE(), '%')";
        $this->db->query($query);
        return $this->db->singleData();
    }

    public function laporanPerMinggu()
    {
        $query = "SELECT SUM(Money_Nominal) AS Total_Nominal, COUNT(*) AS Total_Mahasiswa FROM $this->table WHERE Money_Created_Date BETWEEN DATE_ADD(NOW(), INTERVAL -7 DAY) AND NOW()";
        $this->db->query($query);
        return $this->db->singleData();
    }
}
