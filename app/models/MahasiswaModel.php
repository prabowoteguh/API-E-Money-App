<?php

class MahasiswaModel
{
    private $table = 'mahasiswas';
    private $db;


    public function __construct()
    {
        $this->db = new Database;
    }

    public function index()
    {
        # code...
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('mahasiswa.tambah_mahasiswa');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {
        $query = "INSERT INTO " . $this->table . " VALUE ('', :Mahasiswa_Npm, :Mahasiswa_Nama, :Mahasiswa_Jurusan, :Mahasiswa_Foto)";

        $this->db->query($query);
        $this->db->bind('Mahasiswa_Npm', $request['Mahasiswa_Npm']);
        $this->db->bind('Mahasiswa_Nama', $request['Mahasiswa_Nama']);
        $this->db->bind('Mahasiswa_Jurusan', $request['Mahasiswa_Jurusan']);
        $this->db->bind('Mahasiswa_Foto', $request['Mahasiswa_Npm']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function show()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->banyakData();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE Mahasiswa_ID=:Mahasiswa_ID');
        $this->db->bind('Mahasiswa_ID', $id);
        return $this->db->singleData();
    }

    public function update(Request $request, $id)
    {
        // code
    }

    public function destroy(Request $request)
    {
        // code
    }
}
