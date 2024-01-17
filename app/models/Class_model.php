<?php

class Class_model {
    private $table = 'meals';
    private $db;
    
    public function __construct() {
        $this->db = new Database;
    }

    public function getAllClass($id = '') {
        if (!empty($id)) {
            $query = 'SELECT * FROM class ORDER BY CASE WHEN id_class = :id_class THEN 0 ELSE 1 END, id_class';
            $this->db->query($query);
            $this->db->bind(':id_class', $id);
        } else {
            $this->db->query('SELECT * FROM class');
        }

        return $this->db->resultSet();
    }

    public function getClassById($id) {
        
        $query = 'SELECT * FROM class WHERE id_class = :id_class';
        $this->db->query($query);
        $this->db->bind(':id_class', $id);

        return $this->db->single();
    }

    public function addClass($data) {
        
        $query = 'INSERT INTO class (class_type, price) VALUES(:class_type, :price)';
        $this->db->query($query);
        $this->db->bind(':class_type', $data['class_type']);
        $this->db->bind(':price', $data['price']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteClass($id) {
        $query = 'DELETE FROM class WHERE
                id_class=:id_class';

        $this->db->query($query);

        $this->db->bind('id_class', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateClass($data) {
        $query = 'UPDATE class SET 
                    class_type = :class_type,
                    price=:price
                    WHERE id_class=:id_class;';
    
        $this->db->query($query);
    
        $this->db->bind('class_type', $data['class_type']);
        $this->db->bind('price', $data['price']);
        $this->db->bind('id_class', $data['id_class']);
    
        $this->db->execute();
    
        return $this->db->rowCount();
    }
    

    public function searchClass() {
        $keyword = $_POST['keyword'];

        $query = 'SELECT * FROM class WHERE class_type LIKE :keyword';

        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");

        return $this->db->resultSet();
    }
}