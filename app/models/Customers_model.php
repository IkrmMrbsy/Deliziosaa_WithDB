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
            $this->db->query('SELECT * FROM customers');
        }
    
        return $this->db->resultSet();
    }

    public function getCustomersById($id) {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE id_customers=:id_customers');
        $this->db->bind('id_customers', $id);

        return $this->db->single();
    }

    public function addCustomers($data) {

        $query = 'INSERT INTO customers (name, numbers_phone, email, password) VALUES
                (:name, :numbers_phone, :email, :password);';

        $this->db->query($query);

        $this->db->bind('name', $data['name']);
        $this->db->bind('numbers_phone', $data['numbers_phone']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('password', $data['password']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteCustomers($id) {
        $query = 'DELETE FROM customers WHERE
                id_customers=:id_customers';

        $this->db->query($query);

        $this->db->bind('id_customers', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateCustomers($data) {
        if(isset($data['password'])) {
            $query = 'UPDATE customers SET 
                        name=:name, 
                        password=:password, 
                        email=:email,
                        numbers_phone =:numbers_phone 
                        WHERE id_customers=:id_customers;';
        } else {
            $query = 'UPDATE customers SET 
                        name=:name, 
                        email=:email,
                        numbers_phone =:numbers_phone 
                        WHERE id_customers=:id_customers;';
    
            $this->db->query($query);
    
            $this->db->bind('name', $data['name']);
            $this->db->bind('email', $data['email']);
            $this->db->bind('numbers_phone', $data['numbers_phone']);
            $this->db->bind('id_customers', $data['id_customers']);
        }

        $this->db->query($query);
    
        $this->db->bind('name', $data['name']);

        if(isset($data['password'])) {
            $this->db->bind('password', $data['password']);
        }
        
        $this->db->bind('email', $data['email']);
        $this->db->bind('numbers_phone', $data['numbers_phone']);
        $this->db->bind('id_customers', $data['id_customers']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function searchCustomers() {
        $keyword = $_POST['keyword'];

        $query = 'SELECT * FROM customers WHERE name LIKE :keyword';
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");

        return $this->db->resultSet();
    }
}