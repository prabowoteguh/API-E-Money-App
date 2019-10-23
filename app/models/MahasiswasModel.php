<?php

class MahasiswasModel
{
    private $table = 'mahasiswas';
    private $db;


    public function __construct()
    {
        $this->db = new Database;
    }

    public function index()
    {
        $this->db->query("SELECT * FROM  $this->table WHERE Mahasiswa_Deleted_Status = 0 AND Mahasiswa_Status_Aktif = 1");
        return $this->db->banyakData();
    }

    public function show()
    {
        $this->db->query("SELECT * FROM  $this->table");
        return $this->db->banyakData();
    }

    public function insert($request)
    {
        $query = "INSERT INTO " . $this->table . " VALUE ('', :Mahasiswa_Npm, :Mahasiswa_Nama, :Mahasiswa_Jurusan, :Mahasiswa_Tahun_Angkatan, :Mahasiswa_Foto, :Mahasiswa_Qr_Code, :Mahasiswa_Saldo, :Mahasiswa_Status_Aktif, :Mahasiswa_Created_By, NOW(), :Mahasiswa_Updated_By, :Mahasiswa_Updated_Date, :Mahasiswa_Deleted_Status, :Mahasiswa_Deleted_By, :Mahasiswa_Deleted_Date)";

        $this->db->query($query);
        $this->db->bind('Mahasiswa_Npm', $request['Mahasiswa_Npm']);
        $this->db->bind('Mahasiswa_Nama', $request['Mahasiswa_Nama']);
        $this->db->bind('Mahasiswa_Jurusan', $request['Mahasiswa_Jurusan']);
        $this->db->bind('Mahasiswa_Tahun_Angkatan', $request['Mahasiswa_Tahun_Angkatan']);
        $this->db->bind('Mahasiswa_Foto', $request['Mahasiswa_Foto']);
        $this->db->bind('Mahasiswa_Qr_Code', '');
        $this->db->bind('Mahasiswa_Saldo', 0);
        $this->db->bind('Mahasiswa_Status_Aktif', 1);
        $this->db->bind('Mahasiswa_Created_By', $request['Mahasiswa_Created_By']);
        // $this->db->bind('Mahasiswa_Created_Date', date("Y-m-d H:i:s"));
        $this->db->bind('Mahasiswa_Updated_By', '');
        $this->db->bind('Mahasiswa_Updated_Date', date("0000-00-00 00:00:00"));
        $this->db->bind('Mahasiswa_Deleted_Status', 0);
        $this->db->bind('Mahasiswa_Deleted_By', '');
        $this->db->bind('Mahasiswa_Deleted_Date', date("0000-00-00 00:00:00"));

        $this->db->execute();
        $result = $this->db->rowCount();
        echo $result;
    }

    public function getDataById($id)
    {
        $this->db->query("SELECT * FROM $this->table WHERE Mahasiswa_Id = :Mahasiswa_Id");
        $this->db->bind('Mahasiswa_Id', (int) $id);
        return $this->db->singleData();
    }

    public function getDataByNpm($Npm)
    {
        $this->db->query("SELECT * FROM $this->table WHERE Mahasiswa_Npm = :Mahasiswa_Npm");
        $this->db->bind('Mahasiswa_Npm', $Npm);
        return $this->db->singleData();
    }

    public function getDataTotalMahasiswa($Mahasiswa_Jurusan)
    {
        $query = "SELECT Mahasiswa_Jurusan, Mahasiswa_Tahun_Angkatan, COUNT(Mahasiswa_Tahun_Angkatan) AS Data_Mahasiswa FROM $this->table WHERE Mahasiswa_Jurusan= :Mahasiswa_Jurusan GROUP BY Mahasiswa_Tahun_Angkatan ORDER BY Mahasiswa_Tahun_Angkatan DESC LIMIT 3";
        $this->db->query($query);
        $this->db->bind('Mahasiswa_Jurusan', $Mahasiswa_Jurusan);
        return $this->db->banyakData();
    }

    public function getDataLikeNpm($Npm)
    {
        $this->db->query("SELECT * FROM $this->table WHERE Mahasiswa_Npm LIKE '%$Npm%'");
        // $this->db->bind('Mahasiswa_Npm', $Npm);
        return $this->db->banyakData();
    }

    public function getDataNpm($request)
    {
        $this->db->query("SELECT COUNT(*) AS Npm FROM $this->table WHERE Mahasiswa_Jurusan = :Mahasiswa_Jurusan AND Mahasiswa_Tahun_Angkatan = :Mahasiswa_Tahun_Angkatan");
        $this->db->bind('Mahasiswa_Jurusan', $request['Mahasiswa_Jurusan']);
        $this->db->bind('Mahasiswa_Tahun_Angkatan', $request['Mahasiswa_Tahun_Angkatan']);
        return $this->db->singleData();
    }

    public function update($request)
    {
        $query = "UPDATE $this->table SET 
            Mahasiswa_Nama= :Mahasiswa_Nama, 
            Mahasiswa_Jurusan= :Mahasiswa_Jurusan, 
            -- Mahasiswa_Tahun_Angkatan= :Mahasiswa_Tahun_Angkatan, 
            Mahasiswa_Foto= :Mahasiswa_Foto,
            Mahasiswa_Updated_By= :Mahasiswa_Updated_By, 
            Mahasiswa_Updated_Date= NOW()
            WHERE Mahasiswa_Id = :Mahasiswa_Id";

        $this->db->query($query);
        $this->db->bind('Mahasiswa_Nama', $request['Mahasiswa_Nama']);
        $this->db->bind('Mahasiswa_Jurusan', $request['Mahasiswa_Jurusan']);
        // $this->db->bind('Mahasiswa_Tahun_Angkatan', $request['Mahasiswa_Tahun_Angkatan']);
        $this->db->bind('Mahasiswa_Foto', $request['Mahasiswa_Foto']);
        $this->db->bind('Mahasiswa_Updated_By', $request['Mahasiswa_Updated_By']);
        // $this->db->bind('Mahasiswa_Updated_Date', date("Y-m-d H:i:s"));
        $this->db->bind('Mahasiswa_Id', (int) $request['Mahasiswa_Id']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function delete($request)
    {
        $query = "UPDATE $this->table SET 
        Mahasiswa_Deleted_Status = :Mahasiswa_Deleted_Status,
        Mahasiswa_Deleted_By = :Mahasiswa_Deleted_By,
        Mahasiswa_Deleted_Date = NOW()
        WHERE Mahasiswa_Id = :Mahasiswa_Id";

        $this->db->query($query);
        $this->db->bind('Mahasiswa_Deleted_Status', 1);
        $this->db->bind('Mahasiswa_Deleted_By', $request['Mahasiswa_Deleted_By']);
        // $this->db->bind('Mahasiswa_Deleted_Date', date("Y-m-d H:i:s"));
        $this->db->bind('Mahasiswa_Id', (int) $request['Mahasiswa_Id']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateSaldo($request)
    {
        $query = "UPDATE $this->table SET 
            Mahasiswa_Saldo= :Mahasiswa_Saldo
            WHERE Mahasiswa_Id = :Mahasiswa_Id";

        $this->db->query($query);
        $this->db->bind('Mahasiswa_Saldo', (int) $request['Mahasiswa_Saldo']);
        $this->db->bind('Mahasiswa_Id', (int) $request['Mahasiswa_Id']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function recover($request)
    {
        $query = "UPDATE $this->table SET 
        Mahasiswa_Deleted_Status = :Mahasiswa_Deleted_Status,
        Mahasiswa_Deleted_By = :Mahasiswa_Deleted_By,
        Mahasiswa_Deleted_Date = :Mahasiswa_Deleted_Date WHERE Mahasiswa_Id = :Mahasiswa_Id";

        $this->db->query($query);
        $this->db->bind('Mahasiswa_Deleted_Status', 0);
        $this->db->bind('Mahasiswa_Deleted_By', '');
        $this->db->bind('Mahasiswa_Deleted_Date', "0000-00-00 00:00:00");
        $this->db->bind('Mahasiswa_Id', (int) $request['Mahasiswa_Id']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function ubahStatusAktif($request)
    {
        $query = "UPDATE $this->table SET 
        Mahasiswa_Status_Aktif = :Mahasiswa_Status_Aktif
        WHERE Mahasiswa_Id = :Mahasiswa_Id";

        $this->db->query($query);

        if ($request['Mahasiswa_Status_Aktif'] == 0) {
            $this->db->bind('Mahasiswa_Status_Aktif', 1);
            # code...
        } else {
            $this->db->bind('Mahasiswa_Status_Aktif', 0);
            # code...
        }

        $this->db->bind('Mahasiswa_Id', (int) $request['Mahasiswa_Id']);

        $this->db->execute();

        return $this->db->rowCount();
    }
}
