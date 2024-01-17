<?php

class Reservation_model {

    private $table = 'reservation';
    private $db;
    
    public function __construct() {
        $this->db = new Database;
    }

    public function getAllReservations() {

        $this->db->query('SELECT c.class_type, p.party_type, rsv.* FROM reservation rsv JOIN class c ON (c.id_class = rsv.class_id) JOIN party p ON (p.id_party = rsv.party_id);');

        return $this->db->resultSet();
    }

    public function getReservationById($id) {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE id_reservation=:id_reservation');
        $this->db->bind('id_reservation', $id);

        return $this->db->single();
    }

    public function getReservationsByUser() {
        $this->db->query('SELECT cst.id_customers, c.class_type, p.party_type, rsv.*
                        FROM reservation rsv JOIN class c ON (c.id_class = rsv.class_id) 
                        JOIN party p ON (p.id_party = rsv.party_id) JOIN orders o 
                        ON (o.id_orders = rsv.orders_id) JOIN customers cst ON (cst.id_customers = o.customers_id) WHERE id_customers = :id_customers;');
        $this->db->bind('id_customers', $_SESSION['id_user']);

        return $this->db->resultSet();
    }

    public function addReservation($data) {
        $query = 'CALL reservation_price(:party_id, :class_id, :quantity, :orders_id);';

        $this->db->query($query);

        $this->db->bind('party_id', $data['id_party']);
        $this->db->bind('class_id', $data['id_class']);
        $this->db->bind('quantity', $data['quantity']);
        $this->db->bind('orders_id', $data['id_orders']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteReservation($id) {
        $query = 'DELETE FROM reservation WHERE
                id_reservation=:id_reservation';

        $this->db->query($query);

        $this->db->bind('id_reservation', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateReservation($data) {
        

        $query = 'CALL update_reservation_price(:idReservation, :idParty, :idClass, :revsQuantity, :idOrder);';

        $this->db->query($query);

        $this->db->bind('idParty', $data['id_party']);
        $this->db->bind('idClass', $data['id_class']);
        $this->db->bind('revsQuantity', $data['quantity']);
        $this->db->bind('idOrder', $data['id_orders']);
        $this->db->bind('idReservation', $data['id_reservation']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    // public function cariDataMahasiswa() {
    //     $keyword = $_POST['keyword'];

    //     $query = 'SELECT * FROM mahasiswa WHERE nama LIKE :keyword'; // tanda % di dalam PDO tidak akan berjalan jika langsung dimasukkan ke query

    //     $this->db->query($query);
    //     $this->db->bind('keyword', "%$keyword%");

    //     return $this->db->resultSet();
    // }
}