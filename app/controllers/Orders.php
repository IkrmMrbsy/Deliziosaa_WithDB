<?php

class Orders extends Controller {
    public function index() {
        if(isset($_SESSION['is_admin'])) {
            $data['title'] = 'Order List';
            $data['orders'] = $this->model('Orders_model')->getAllOrders();
        } else {
            $data['title'] = 'Order List';
            $data['orders'] = $this->model('Orders_model')->getOrdersByCustomer($_SESSION['id_user']);
        }

        $this->view('templates/header', $data);
        $this->view('orders/index', $data);
        $this->view('templates/footer');
    }

    public function form($id = '') {

        $data['title'] = 'Place Your Order!';
        if(isset($_SESSION['is_admin'])) {
            if (!empty($id)) {
                $data['orders'] = $this->model('Orders_model')->getOrdersById($id);
                $data['customers'] = $this->model('Customers_model')->getAllCustomers($data['orders']['customers_id']);
                $data['meals'] = $this->model('Meals_model')->getAllMeals($data['orders']['meals_id']);
            } else {
                $data['orders'] = $this->model('Orders_model')->getAllOrders();
                $data['customers'] = $this->model('Customers_model')->getAllCustomers();
                $data['meals'] = $this->model('Meals_model')->getAllMeals();
            }
        } else {
            if (!empty($id)) {
                $data['orders'] = $this->model('Orders_model')->getOrdersById($id);
                $data['customers'] = $this->model('Customers_model')->getCustomersById($_SESSION['id_user']);
                $data['meals'] = $this->model('Meals_model')->getAllMeals($data['orders']['meals_id']);
            } else {
                $data['orders'] = $this->model('Orders_model')->getAllOrders();
                $data['customers'] = $this->model('Customers_model')->getCustomersById($_SESSION['id_user']);
                $data['meals'] = $this->model('Meals_model')->getAllMeals();
            }
        }
        
            
        $this->view('templates/header', $data);
        $this->view('orders/add', $data);
        $this->view('templates/footer');
    }

    public function add() {
        if($this->model('Orders_model')->addOrders($_POST) > 0) {
            Flasher::setFlash('alreay', 'added', 'success');

            header('Location: '.BASEURL.'orders');
            exit();
        } else {
            Flasher::setFlash('failed', 'to be added', 'danger');

            header('Location: '.BASEURL.'orders');
            exit();
        }
    }

    public function update() {
        if($this->model('Orders_model')->updateOrders($_POST) > 0) {
            Flasher::setFlash('alreay', 'updated', 'success');

            header('Location: '.BASEURL.'orders');
            exit();
        } else {
            Flasher::setFlash('failed', 'to be updated', 'danger');

            header('Location: '.BASEURL.'orders');
            exit();
        }
    }

    public function delete($id) {
        if($this->model('Orders_model')->deleteOrders($id) > 0) {
            Flasher::setFlash('already', 'deleted', 'success');

            header('Location: '.BASEURL.'orders');
            exit();
        } else {
            Flasher::setFlash('failed', 'to be deleted', 'danger');

            header('Location: '.BASEURL.'orders');
            exit();
        }
    }

    public function getDetail($id) {
        // Assuming $id is provided in the URL
        $reservation = $this->model('Orders_model')->getRelatedReservation($id);
        $orders = $this->model('Orders_model')->getOrdersDetail($id);
        
        $data = [
            'reservation' => $reservation,
            'orders' => $orders
        ];
    
        // Return the result as JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    }     

    public function search() {
        $data['title'] = 'Orders List';
        $data['orders'] = $this->model('Orders_model')->searchOrders();

        $this->view('templates/header', $data);
        $this->view('orders/index', $data);
        $this->view('templates/footer');
    }
}