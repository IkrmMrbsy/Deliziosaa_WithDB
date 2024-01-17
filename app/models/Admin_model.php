<?php
class Admin_model {
    private $table = 'admin';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAdminByUsername($username, $password) {
        $query = 'SELECT * FROM  ' . $this->table . ' WHERE username = :username AND password=:password';
        $this->db->query($query);
        $this->db->bind(':username', $username);
        $this->db->bind(':password', $password);
        return $this->db->single();
    }
}