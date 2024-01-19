<?php

class Wallet_model {
    private $table = 'wallet';
    private $db;
    
    public function __construct() {
        $this->db = new Database;
    }

    public function getAllWallet() {
        $query = 'SELECT w.*, c.name FROM '.$this->table.' w JOIN customers c ON c.id_customers = w.customers_id';
        $this->db->query($query);

        return $this->db->resultSet();
    }

    public function getWalletByCustomer($id) {
        $query = 'SELECT * FROM '.$this->table.' WHERE customers_id = :customers_id';
        $this->db->query($query);
        $this->db->bind('customers_id', $id);

        return $this->db->single();
    }

    public function getWalletById($id) {
        $query = 'SELECT * FROM '.$this->table.' WHERE id_wallet = :id_wallet';
        $this->db->query($query);
        $this->db->bind('id_wallet', $id);

        return $this->db->single();
    }

    public function updateWallet($data) {
        $query = 'UPDATE '.$this->table.' SET 
                    wallet = :wallet
                    WHERE id_wallet=:id_wallet;';

        $this->db->query($query);

        $this->db->bind('wallet', $data['wallet']);
        $this->db->bind('id_wallet', $data['id_wallet']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function searchWallet() {
        $keyword = $_POST['keyword'];

        $query = 'SELECT w.*, c.name FROM '.$this->table.' w JOIN customers c 
          ON c.id_customers = w.customers_id WHERE c.name LIKE :keyword';

        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");

        return $this->db->resultSet();
    }
}