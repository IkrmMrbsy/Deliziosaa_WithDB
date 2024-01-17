<?php

class Meals_model {
    private $table = 'meals';
    private $db;
    
    public function __construct() {
        $this->db = new Database;
    }

    public function getAllMeals($id = '') {
        if (!empty($id)) {
            $query = 'SELECT * FROM meals ORDER BY CASE WHEN id_meals = :id_meals THEN 0 ELSE 1 END, id_meals';
            $this->db->query($query);
            $this->db->bind(':id_meals', $id);
        } else {
            $this->db->query('SELECT * FROM meals');
        }

        return $this->db->resultSet();
    }

    public function getMealsById($id) {
        
        $query = 'SELECT * FROM meals WHERE id_meals = :id_meals';
        $this->db->query($query);
        $this->db->bind(':id_meals', $id);

        return $this->db->single();
    }

    public function addMeals($data) {
        
        $query = 'INSERT INTO meals (meals_type, time_desc) VALUES(:meals_type, :time_desc)';
        $this->db->query($query);
        $this->db->bind(':meals_type', $data['meals_type']);
        $this->db->bind(':time_desc', $data['time_desc']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteMeals($id) {
        $query = 'DELETE FROM meals WHERE
                id_meals=:id_meals';

        $this->db->query($query);

        $this->db->bind('id_meals', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateMeals($data) {
        $query = 'UPDATE meals SET 
                meals_type = :meals_type,
                time_desc = :time_desc
                WHERE id_meals = :id_meals;';

        $this->db->query($query);

        $this->db->bind('meals_type', $data['meals_type']);
        $this->db->bind('time_desc', $data['time_desc']);
        $this->db->bind('id_meals', $data['id_meals']);

        $this->db->execute();

        return $this->db->rowCount();

    }

    public function searchMeals() {
        $keyword = $_POST['keyword'];

        $query = 'SELECT * FROM meals WHERE meals_type LIKE :keyword'; // tanda % di dalam PDO tidak akan berjalan jika langsung dimasukkan ke query

        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");

        return $this->db->resultSet();
    }
}