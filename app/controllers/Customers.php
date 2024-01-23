<?php

class Customers extends Controller {

    public function index() {
        if(isset($_SESSION['is_admin'])) {
            $data['title'] = 'Customers List';
            $data['customers'] = $this->model('Customers_model')->getAllCustomers();

            $this->view('templates/header', $data);
            $this->view('customers/index', $data);
            $this->view('templates/footer');
        } else {
            header('Location: '.BASEURL.'orders');
            exit();
        }
    }

    public function form($id = '') {
        $data['title'] = 'Add New Customers';
        
        if(isset($_SESSION['is_admin'])) {
            if (!empty($id)) {
                $data['customers'] = $this->model('Customers_model')->getCustomersById($id);
            } 
                
            $this->view('templates/header', $data);
            $this->view('customers/add', $data);
            $this->view('templates/footer');
        } else {
            header('Location: '.BASEURL.'orders');
            exit();
        }

    }

    public function add() {
        if(isset($_SESSION['is_admin'])) {

            if($this->model('Customers_model')->addCustomers($_POST) > 0) {
                Flasher::setFlash('already', 'added', 'success');
                
                header('Location: '.BASEURL.'customers');
                exit;
            } else {
                Flasher::setFlash('failed', 'to be added', 'danger');
                
                header('Location: '.BASEURL.'customers');
                exit;
            }
        } else {
            header('Location: '.BASEURL.'orders');
            exit();
        }
    }

    public function delete($id = '') {
        if(isset($_SESSION['is_admin'])) {

            if($this->model('Customers_model')->deleteCustomers($id) > 0) {
                Flasher::setFlash('already', 'deleted', 'success');
                
                header('Location: '.BASEURL.'customers');
                exit();
            } else {
                Flasher::setFlash('failed', 'to be deleted', 'danger');
                
                header('Location: '.BASEURL.'customers');
                exit();
            }
        } else {
            header('Location: '.BASEURL.'orders');
            exit();
        }
    }

    public function update() {
        
        if($this->model('Customers_model')->updateCustomers($_POST) > 0) {
            Flasher::setFlash('alreay', 'updated', 'success');

            if(!isset($_SESSION['is_admin'])) {
                $_SESSION['username'] = $_POST['name'];
            }
            
            header('Location: '.BASEURL.'customers');
            exit();
        } else {
            Flasher::setFlash('failed', 'to be updated', 'danger');
            
            header('Location: '.BASEURL.'customers');
            exit();
        }
    }

    public function profile($id) {
        if(isset($_SESSION['is_admin'])) {
            header('Location: '.BASEURL.'orders');
            exit();
        } else {
            $data['title'] = 'Update Your Profile';
            $data['customers'] = $this->model('Customers_model')->getCustomersById($id);
            $this->view('templates/header', $data);
            $this->view('profile/update_profile', $data);
            $this->view('templates/footer');
        }
    }
}