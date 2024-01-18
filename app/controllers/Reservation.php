<?php

class Reservation extends Controller {
    public function formByOrder($idOrders = '', $idReservation = '') {
        $data['title'] = 'Get Your Table!';
        $data['orders_id'] = $idOrders;
        $data['class'] = $this->model('Class_model')->getAllClass();
        $data['party'] = $this->model('Party_model')->getAllParty();
        $data['reservation'] = [];
    
        if (!empty($idReservation)) {
            $data['reservation'] = $this->model('Reservation_model')->getReservationById($idReservation);
        }
    
        $this->view('templates/header', $data);
        $this->view('reservation/add_by_order', $data);
        $this->view('templates/footer');
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

            header('Location: '.BASEURL.'orders');
            exit;
        } else {
            Flasher::setFlash('failed', 'to be deleted', 'danger');

            header('Location: '.BASEURL.'orders');
            exit;
        }
    }

    public function update() {
        
        if($this->model('Reservation_model')->updateReservation($_POST) > 0) {
            Flasher::setFlash('alreay', 'updated', 'success');

            header('Location: '.BASEURL.'orders');
            exit();
        } else {
            Flasher::setFlash('failed', 'to be updated', 'danger');

            header('Location: '.BASEURL.'orders');
            exit();
        }
    }

    public function search() {
        $data['title'] = 'Reservation List';
        $data['reservation'] = $this->model('reservation_model')->searchreservation();

        $this->view('templates/header', $data);
        $this->view('reservation/index', $data);
        $this->view('templates/footer');
    }
}