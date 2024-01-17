<?php

class Reservation extends Controller {
    public function index() {
        $data['title'] = 'Reservation List';

        if(isset($_SESSION['is_admin'])) {
            $data['reservation'] = $this->model('Reservation_model')->getAllReservations();
        } else {
            $data['reservation'] = $this->model('Reservation_model')->getReservationsByUser();
        }
        
        $this->view('templates/header', $data);
        $this->view('reservation/index', $data);
        $this->view('templates/footer');

        // var_dump($data['reservation']);
    }

    public function form($id = '') {

        $data['title'] = 'Get Your Table!';

        // if(isset($_SESSION['is_admin'])) {
        //     if (!empty($id)) {
        //         $data['reservation'] = $this->model('Reservation_model')->getReservationById($id);
        //         $data['class'] = $this->model('Class_model')->getAllClass($data['reservation']['class_id']);
        //         $data['party'] = $this->model('Party_model')->getAllParty($data['reservation']['party_id']);
        //         $data['id_orders'] = $this->model('Orders_model')->getAllOrdersId($data['reservation']['orders_id']);
        //     } else {
        //         $data['reservation'] = $this->model('Reservation_model')->getReservationById($id);
        //         $data['class'] = $this->model('Class_model')->getAllClass();
        //         $data['party'] = $this->model('Party_model')->getAllParty();
        //         $data['id_orders'] = $this->model('Orders_model')->getAllOrdersId();
        //     }
        // } else {
        //     if (!empty($id)) {
        //         $data['reservation'] = $this->model('Reservation_model')->getReservationById($id);
        //         $data['class'] = $this->model('Class_model')->getAllClass($data['reservation']['class_id']);
        //         $data['party'] = $this->model('Party_model')->getAllParty($data['reservation']['party_id']);
        //         $data['id_orders'] = $this->model('Orders_model')->getAllOrdersIdByUser($id);
        //     } else {
        //         $data['reservation'] = $this->model('Reservation_model')->getReservationById($id);
        //         $data['class'] = $this->model('Class_model')->getAllClass();
        //         $data['party'] = $this->model('Party_model')->getAllParty();
        //         $data['id_orders'] = $this->model('Orders_model')->getAllOrdersIdByUser();
        //     }
        // }

        if(isset($_SESSION['is_admin'])) {
            if (!empty($id)) {
                $data['reservation'] = $this->model('Reservation_model')->getReservationById($id);
                $data['class'] = $this->model('Class_model')->getAllClass($data['reservation']['class_id']);
                $data['party'] = $this->model('Party_model')->getAllParty($data['reservation']['party_id']);
                $data['id_orders'] = $this->model('Orders_model')->getOrdersById($id);
            } else {
                $data['reservation'] = $this->model('Reservation_model')->getReservationById($id);
                $data['class'] = $this->model('Class_model')->getAllClass();
                $data['party'] = $this->model('Party_model')->getAllParty();
                $data['id_orders'] = $this->model('Orders_model')->getAllOrdersId();
            }
        } else {
            if (!empty($id)) {
                $data['reservation'] = $this->model('Reservation_model')->getReservationById($id);
                $data['class'] = $this->model('Class_model')->getAllClass($data['reservation']['class_id']);
                $data['party'] = $this->model('Party_model')->getAllParty($data['reservation']['party_id']);
                $data['id_orders'] = $this->model('Orders_model')->getOrdersById($id);
            } else {
                $data['reservation'] = $this->model('Reservation_model')->getReservationById($id);
                $data['class'] = $this->model('Class_model')->getAllClass();
                $data['party'] = $this->model('Party_model')->getAllParty();
                $data['id_orders'] = $this->model('Orders_model')->getAllOrdersIdByUser();
            }
        }
        
            
        $this->view('templates/header', $data);
        $this->view('reservation/add', $data);
        $this->view('templates/footer');
    }

    public function formByOrder($id = '') {

        $data['title'] = 'Get Your Table!';
        
        $data['orders_id'] = $id;
        $data['class'] = $this->model('Class_model')->getAllClass();
        $data['party'] = $this->model('Party_model')->getAllParty();
            
        $this->view('templates/header', $data);
        $this->view('reservation/add_by_order', $data);
        $this->view('templates/footer');
    }

    public function add() {
        if($this->model('Reservation_model')->addReservation($_POST) > 0) {
            Flasher::setFlash('already', 'added', 'success');

            header('Location: '.BASEURL.'reservation');
            exit;
        } else {
            Flasher::setFlash('failed', 'to be added', 'danger');

            header('Location: '.BASEURL.'reservation');
            exit;
        }
    }

    public function addByOrders() {
        if($this->model('Reservation_model')->addReservation($_POST) > 0) {
            Flasher::setFlash('already', 'added', 'success');

            header('Location: '.BASEURL.'orders');
            exit;
        } else {
            Flasher::setFlash('failed', 'to be added', 'danger');

            header('Location: '.BASEURL.'orders');
            exit;
        }
    }

    public function delete($id) {
        if($this->model('Reservation_model')->deleteReservation($id) > 0) {
            Flasher::setFlash('already', 'deleted', 'success');

            header('Location: '.BASEURL.'reservation');
            exit;
        } else {
            Flasher::setFlash('failed', 'to be deleted', 'danger');

            header('Location: '.BASEURL.'reservation');
            exit;
        }
    }

    public function update() {
        
        if($this->model('Reservation_model')->updateReservation($_POST) > 0) {
            Flasher::setFlash('alreay', 'updated', 'success');

            header('Location: '.BASEURL.'reservation');
            exit;
        } else {
            Flasher::setFlash('failed', 'to be updated', 'danger');

            header('Location: '.BASEURL.'reservation');
            exit;
        }
    }
}