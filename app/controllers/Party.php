<?php

class Party extends Controller {
    public function index() {
        $data['title'] = 'Party List';
        $data['party'] = $this->model('Party_model')->getAllParty();

        $this->view('templates/header', $data);
        $this->view('party/index', $data);
        $this->view('templates/footer');
    }

    public function form($id = '') {
        if(isset($_SESSION['is_admin'])) {
            $data['title'] = 'Add New Party Category';
            
            if (!empty($id)) {
                $data['party'] = $this->model('Party_model')->getPartyById($id);
            } 
                
            $this->view('templates/header', $data);
            $this->view('party/add', $data);
            $this->view('templates/footer');
        } else {
            header('Location: '.BASEURL.'party');
            exit();
        }
    }

    public function add() {
        if(isset($_SESSION['is_admin'])) {
            if($this->model('Party_model')->addParty($_POST) > 0) {
                Flasher::setFlash('already', 'added', 'success');
    
                header('Location: '.BASEURL.'party');
                exit();
            } else {
                Flasher::setFlash('failed', 'to be added', 'danger');
    
                header('Location: '.BASEURL.'party');
                exit();
            }
        } else {
            header('Location: '.BASEURL.'party');
            exit();
        }
    }    

    public function delete($id) {
        if(isset($_SESSION['is_admin'])) {
            if($this->model('Party_model')->deleteParty($id) > 0) {
                Flasher::setFlash('already', 'deleted', 'success');

                header('Location: '.BASEURL.'party');
                exit();
            } else {
                Flasher::setFlash('failed', 'to be deleted', 'danger');

                header('Location: '.BASEURL.'party');
                exit();
            }
        } else {
            header('Location: '.BASEURL.'party');
            exit();
        }
    }

    public function update() {
        if(isset($_SESSION['is_admin'])) {
            if($this->model('Party_model')->updateParty($_POST) > 0) {
                Flasher::setFlash('alreay', 'updated', 'success');

                header('Location: '.BASEURL.'party');
                exit();
            } else {
                Flasher::setFlash('failed', 'to be updated', 'danger');

                header('Location: '.BASEURL.'party');
                exit();
            }
        } else {
            header('Location: '.BASEURL.'party');
            exit();
        }
    }

    public function search() {
        $data['title'] = 'Party List';
        $data['party'] = $this->model('Party_model')->searchParty();

        $this->view('templates/header', $data);
        $this->view('party/index', $data);
        $this->view('templates/footer');
    }
}