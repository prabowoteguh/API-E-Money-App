<?php

class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $database = DB_NAME;

    private $dbh; /* Database Handler */
    private $statement; /* QUERY */

    public function __construct()
    {
        /* === Koneksi menggunakan PDO === */
        /* Data Source Name */
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->database;

        /* === OPTION PDO === */
        $option = [
            PDO::ATTR_PERSISTENT => true, /* agar koneksi nya terjaga terus menerus */
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION /* untuk menampilkan error message nya berupa exception */
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass);
        } catch (PDOExeption $e) {
            die($e->getMessage);
        }
    }

    public function query($query)
    {
        $this->statement = $this->dbh->prepare($query);
    }

    /* set data params dan set where */
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;

                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }

        $this->statement->bindValue($param, $value, $type);
    }

    public function execute()
    {
        $this->statement->execute();
    }

    public function banyakData()
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function singleData()
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount()
    {
        $this->statement->rowCount();
    }
}
