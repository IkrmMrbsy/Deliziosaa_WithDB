<?php

class Party_model {
    private $table = 'party';
    private $db;
    
    public function __construct() {
        $this->db = new Database;
    }

    public function getAllParty($id = '') {
        if (!empty($id)) {
            $query = 'SELECT * FROM party ORDER BY CASE WHEN id_party = :id_party THEN 0 ELSE 1 END, id_party';
            $this->db->query($query);
            $this->db->bind(':id_party', $id);
        } else {
            $this->db->query('SELECT * FROM party');
        }

        return $this->db->resultSet();
    }

    public function getPartyById($id) {
        
        $query = 'SELECT * FROM party WHERE id_party = :id_party';
        $this->db->query($query);
        $this->db->bind(':id_party', $id);

        return $this->db->single();
    }

    public function addParty($data) {
        
        $query = 'INSERT INTO party (party_type, capacity, price) VALUES(:party_type, :capacity, :price)';
        $this->db->query($query);
        $this->db->bind(':party_type', $data['party_type']);
        $this->db->bind(':capacity', $data['capacity']);
        $this->db->bind(':price', $data['price']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteParty($id) {
        $query = 'DELETE FROM party WHERE
                id_party=:id_party';

        $this->db->query($query);

        $this->db->bind('id_party', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateParty($data) {
        $query = 'UPDATE party SET 
                    party_type = :party_type,
                    capacity = :capacity, 
                    price=:price
                    WHERE id_party=:id_party;';

        $this->db->query($query);

        $this->db->bind('party_type', $data['party_type']);
        $this->db->bind('capacity', $data['capacity']);
        $this->db->bind('price', $data['price']);
        $this->db->bind('id_party', $data['id_party']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function searchParty() {
        $keyword = $_POST['keyword'];

        $query = 'SELECT * FROM party WHERE party_type LIKE :keyword'; // tanda % di dalam PDO tidak akan berjalan jika langsung dimasukkan ke query

        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");

        return $this->db->resultSet();
    }
}