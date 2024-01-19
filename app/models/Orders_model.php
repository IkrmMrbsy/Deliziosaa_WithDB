<?php

class Orders_model {

    private $table = 'orders';
    private $db;
    
    public function __construct() {
        $this->db = new Database;
    }

    public function getAllOrders() {

        $this->db->query('SELECT c.name, o.*, m.meals_type 
                                    FROM '.$this->table.' o 
                                    JOIN customers c ON c.id_customers = o.customers_id 
                                    JOIN meals m ON m.id_meals = o.meals_id');

        return $this->db->resultSet();
    }

    public function getAllOrdersId($id = '') {
        if (!empty($id)) {
            $query = 'SELECT id_orders FROM orders ORDER BY CASE WHEN id_orders = :id_orders THEN 0 ELSE 1 END, id_orders';
            $this->db->query($query);
            $this->db->bind(':id_orders', $id);
        } else {
            $this->db->query('SELECT id_orders FROM orders');
        }

        return $this->db->resultSet();
    }

    public function getAllOrdersIdByUser($id = '') {
        if (!empty($id)) {
            $query = 'SELECT id_orders FROM orders WHERE customers_id = :customers_id ORDER BY CASE WHEN id_orders = :id_orders THEN 0 ELSE 1 END, id_orders;';
            $this->db->query($query);
            $this->db->bind(':id_orders', $id);
            $this->db->bind(':customers_id', $_SESSION['id_user']);
        } else {
            $this->db->query('SELECT id_orders FROM orders WHERE customers_id = :customers_id');
            $this->db->bind(':customers_id', $_SESSION['id_user']);
        }

        return $this->db->resultSet();
    }

    public function getOrdersDetail($id) {
        $this->db->query('SELECT c.name, o.*, m.meals_type, m.time_desc 
                                    FROM '.$this->table.' o 
                                    JOIN customers c ON c.id_customers = o.customers_id 
                                    JOIN meals m ON m.id_meals = o.meals_id WHERE id_orders = :id_orders');
        $this->db->bind('id_orders', $id);

        return $this->db->single();
    }

    public function getRelatedReservation($id) {
        $this->db->query('SELECT rsv.*, c.class_type, c.price class_price, p.party_type, p.capacity, p.price party_price
        FROM reservation rsv JOIN class c ON (c.id_class = rsv.class_id) 
            JOIN party p ON (p.id_party = rsv.party_id) WHERE orders_id = :orders_id');

        $this->db->bind('orders_id', $id);

        return $this->db->resultSet();
    }

    public function getOrdersById($id) {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE id_orders=:id_orders');
        $this->db->bind('id_orders', $id);

        return $this->db->single();
    }

    public function getOrdersByCustomer($id) {
        $this->db->query('SELECT c.name, o.*, m.meals_type 
                        FROM '.$this->table.' o 
                        JOIN customers c ON c.id_customers = o.customers_id 
                        JOIN meals m ON m.id_meals = o.meals_id WHERE customers_id=:customers_id');
        $this->db->bind('customers_id', $id);

        return $this->db->resultSet();
    }

    public function addOrders($data) {
        $query = 'INSERT INTO orders (customers_id, meals_id, date_reservation) VALUES
                (:customers_id, :meals_id, :date_reservation);';

        $this->db->query($query);

        $this->db->bind('customers_id', $data['id_customers']);
        $this->db->bind('meals_id', $data['id_meals']);
        $this->db->bind('date_reservation', $data['date_reservation']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteOrders($id) {
        $query = 'DELETE FROM orders WHERE
                id_orders=:id_orders';

        $this->db->query($query);

        $this->db->bind('id_orders', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateOrders($data) {
        $query = 'UPDATE orders SET 
                    customers_id = :customers_id,
                    meals_id = :meals_id, 
                    paid_stat=:paid_stat, 
                    date_reservation=:date_reservation
                    WHERE id_orders=:id_orders;';

        $this->db->query($query);

        $this->db->bind('customers_id', $data['id_customers']);
        $this->db->bind('meals_id', $data['id_meals']);
        $this->db->bind('paid_stat', $data['paid_stat']);
        $this->db->bind('date_reservation', $data['date_reservation']);
        $this->db->bind('id_orders', $data['id_orders']);

        $this->db->execute();

        $query = 'SELECT * FROM wallet WHERE customers_id = :customers_id';

        $this->db->query($query);

        $this->db->bind('customers_id', $data['id_customers']);
        $this->db->single();

        return $this->db->rowCount();
    }

    public function searchOrders() {
        $keyword = $_POST['keyword'];

        $query = 'SELECT c.name, o.*, m.meals_type, m.time_desc 
          FROM '.$this->table.' o 
          JOIN customers c ON c.id_customers = o.customers_id 
          JOIN meals m ON m.id_meals = o.meals_id WHERE c.name LIKE :keyword';

        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");

        return $this->db->resultSet();
    }
}