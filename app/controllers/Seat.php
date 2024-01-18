<?php

class Seat extends Controller {
    public function index() {
        $data['title'] = 'Class List';
        $data['class'] = $this->model('Class_model')->getAllClass();

        $this->view('templates/header', $data);
        $this->view('seat/index', $data);
        $this->view('templates/footer');
    }

    public function form($id = '') {
        if(isset($_SESSION['is_admin'])) {
            $data['title'] = 'Add New Class Category';
            
            if (!empty($id)) {
                $data['class'] = $this->model('Class_model')->getClassById($id);
            } 
                
            $this->view('templates/header', $data);
            $this->view('seat/add', $data);
            $this->view('templates/footer');
        } else {
            header('Location: '.BASEURL.'seat');
            exit();
        }

    }

    public function add() {
        if(isset($_SESSION['is_admin'])) {
            if($this->model('Class_model')->addClass($_POST) > 0) {
                Flasher::setFlash('already', 'added', 'success');

                header('Location: '.BASEURL.'seat');
                exit();
            } else {
                header('Location: '.BASEURL.'seat');
                exit();
            }
        } else {
                header('Location: '.BASEURL.'seat');
                exit();
        }
    }

    public function delete($id) {
        if(isset($_SESSION['is_admin'])) {
            if($this->model('Class_model')->deleteClass($id) > 0) {
                Flasher::setFlash('already', 'deleted', 'success');

                header('Location: '.BASEURL.'seat');
                exit();
            } else {
                Flasher::setFlash('failed', 'to be deleted', 'danger');

                header('Location: '.BASEURL.'seat');
                exit();
            }
        } else {
                header('Location: '.BASEURL.'seat');
                exit();
        }
    }

    public function update() {
        if(isset($_SESSION['is_admin'])) {
            if($this->model('Class_model')->updateClass($_POST) > 0) {
                Flasher::setFlash('already', 'updated', 'success');

                header('Location: '.BASEURL.'seat');
                exit();
            } else {
                Flasher::setFlash('failed', 'to be updated', 'danger');

                header('Location: '.BASEURL.'seat');
                exit();
            }
        } else {
                header('Location: '.BASEURL.'seat');
                exit();
        }
    }

    public function search() {
        $data['title'] = 'class List';
        $data['class'] = $this->model('Class_model')->searchClass();

        $this->view('templates/header', $data);
        $this->view('seat/index', $data);
        $this->view('templates/footer');
    }
}