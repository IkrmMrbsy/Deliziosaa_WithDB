<?php

class Meals extends Controller {
    public function index() {
        $data['title'] = 'Meals List';
        $data['meals'] = $this->model('Meals_model')->getAllMeals();

        $this->view('templates/header', $data);
        $this->view('meals/index', $data);
        $this->view('templates/footer');
    }

    public function form($id = '') {
        if(isset($_SESSION['is_admin'])) {
            $data['title'] = 'Add New Meals Category';
            
            if (!empty($id)) {
                $data['meals'] = $this->model('Meals_model')->getMealsById($id);
            } 
                
            $this->view('templates/header', $data);
            $this->view('meals/add', $data);
            $this->view('templates/footer');
        } else {
            header('Location: '.BASEURL.'meals');
            exit();
        }
    }

    public function add() {
        if(isset($_SESSION['is_admin'])) {
            if($this->model('Meals_model')->addMeals($_POST) > 0) {
                Flasher::setFlash('already', 'added', 'success');

                header('Location: '.BASEURL.'meals');
                exit();
            } else {
                Flasher::setFlash('failed', 'to be added', 'danger');

                header('Location: '.BASEURL.'meals');
                exit();
            }
        } else {
            header('Location: '.BASEURL.'meals');
            exit();
        }
    }

    public function delete($id) {
        if(isset($_SESSION['is_admin'])) {
            if($this->model('Meals_model')->deleteMeals($id) > 0) {
                Flasher::setFlash('already', 'deleted', 'success');

                header('Location: '.BASEURL.'meals');
                exit();
            } else {
                Flasher::setFlash('failed', 'to be deleted', 'danger');

                header('Location: '.BASEURL.'meals');
                exit();
            }
        } else {
            header('Location: '.BASEURL.'meals');
            exit();
        }
    }

    public function update() {
        if(isset($_SESSION['is_admin'])) {
            if($this->model('Meals_model')->updateMeals($_POST) > 0) {
                Flasher::setFlash('alreay', 'updated', 'success');

                header('Location: '.BASEURL.'meals');
                exit();
            } else {
                Flasher::setFlash('failed', 'to be updated', 'danger');

                header('Location: '.BASEURL.'meals');
                exit();
            }
        } else {
            header('Location: '.BASEURL.'meals');
            exit();
        }
    }

    public function search() {
        $data['title'] = 'Meals List';
        $data['meals'] = $this->model('Meals_model')->searchMeals();

        $this->view('templates/header', $data);
        $this->view('meals/index', $data);
        $this->view('templates/footer');
    }
}