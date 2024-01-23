<?php

class User_model {
    private $table = 'customers';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getUserByEmail($email, $password) {
        $query = 'SELECT * FROM customers ' . $this->table . ' WHERE email = :email AND password=:password';
        $this->db->query($query);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $password);
        return $this->db->single();
    }

    public function registerUser($data) {
        $query = 'INSERT INTO ' . $this->table . ' (name, email, numbers_phone, password) VALUES (:name, :email, :numbers_phone, :password)';
        $this->db->query($query);
        $this->db->bind(':name', $data['fullname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':numbers_phone', $data['phoneNumbers']);
        $this->db->bind(':password', $data['password']);
        $this->db->execute();
    
        $this->db->query('SELECT id_customers FROM '.$this->table.' WHERE email = :email');
        $this->db->bind(':email', $data['email']);
        $result = $this->db->single();
    
        $customersId = $result['id_customers'];
    
        return [
            'rowCount' => $this->db->rowCount(),
            'id' => $customersId,
            'name' => $data['fullname'],
        ];
    }    
    
}

