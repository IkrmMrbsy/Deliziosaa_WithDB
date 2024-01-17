<?php

class Customers_model {

    private $table = 'customers';
    private $db;
    
    public function __construct() {
        $this->db = new Database;
    }

    public function getAllCustomers($id = '') {
        if (!empty($id)) {
            $query = 'SELECT * FROM customers ORDER BY CASE WHEN id_customers = :id_customers THEN 0 ELSE 1 END, id_customers';
            $this->db->query($query);
            $this->db->bind(':id_customers', $id);
        } else {
            $this->db->query('SELECT id_customers, name FROM customers');
        }
    
        return $this->db->resultSet();
    }

    public function getCustomersById($id) {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE id_customers=:id_customers');
        $this->db->bind('id_customers', $id);

        return $this->db->single();
    }

    // public function tambahDataMahasiswa($data) {
    //     $query = 'INSERT INTO mahasiswa VALUES
    //             ("", :nama, :nrp, :email, :jurusan);';

    //     $this->db->query($query);

    //     $this->db->bind('nama', $data['nama']);
    //     $this->db->bind('nrp', $data['nrp']);
    //     $this->db->bind('email', $data['email']);
    //     $this->db->bind('jurusan', $data['jurusan']);

    //     $this->db->execute();

    //     return $this->db->rowCount();
    // }

    // public function hapusDataMahasiswa($id) {
    //     $query = 'DELETE FROM mahasiswa WHERE
    //             id=:id';

    //     $this->db->query($query);

    //     $this->db->bind('id', $id);

    //     $this->db->execute();

    //     return $this->db->rowCount();
    // }

    // public function updateOrders($data) {
    //     $query = 'UPDATE mahasiswa SET 
    //                 nama=:nama, 
    //                 nrp=:nrp, 
    //                 email=:email,
    //                 jurusan =:jurusan 
    //                 WHERE id=:id;';

    //     $this->db->query($query);

    //     $this->db->bind('nama', $data['nama']);
    //     $this->db->bind('nrp', $data['nrp']);
    //     $this->db->bind('email', $data['email']);
    //     $this->db->bind('jurusan', $data['jurusan']);
    //     $this->db->bind('id', $data['id']);

    //     $this->db->execute();

    //     return $this->db->rowCount();
    // }

    // public function cariDataMahasiswa() {
    //     $keyword = $_POST['keyword'];

    //     $query = 'SELECT * FROM mahasiswa WHERE nama LIKE :keyword'; // tanda % di dalam PDO tidak akan berjalan jika langsung dimasukkan ke query

    //     $this->db->query($query);
    //     $this->db->bind('keyword', "%$keyword%");

    //     return $this->db->resultSet();
    // }
}