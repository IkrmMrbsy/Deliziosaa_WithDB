<?php

class Wallet extends Controller {
    public function index() {
        if(isset($_SESSION['is_admin'])) {
            $data['title'] = 'Wallet List';
            $data['wallet'] = $this->model('Wallet_model')->getAllWallet();
    
            $this->view('templates/header', $data);
            $this->view('wallet/index', $data);
            $this->view('templates/footer');

        } else {
            header('Location: '.BASEURL.'orders');
            exit();
        }
    }

    public function form($id = '') {
        $data['title'] = 'Fill the Wallet!';
        
        if (!empty($id)) {
            $data['wallet'] = $this->model('Wallet_model')->getWalletById($id);
            // $data['customers'] = $this->model('Customers_model')->getCustomersById($data['wallet']['customers_id']);
        } 
            
        $this->view('templates/header', $data);
        $this->view('wallet/add', $data);
        $this->view('templates/footer');

    }

    public function update() {
        if($this->model('Wallet_model')->updateWallet($_POST) > 0) {
            Flasher::setFlash('already', 'updated', 'success');

            $_SESSION['customer_wallet']['wallet'] = $_POST['wallet'];

            if(isset($_SESSION['is_admin'])) {
                header('Location: '.BASEURL.'wallet');
                exit();

            } else {
                header('Location: '.BASEURL.'orders');
                exit();
            }
        } else {
            Flasher::setFlash('failed', 'to be updated', 'danger');

            header('Location: '.BASEURL.'orders');
            exit();
        }
    }

    public function search() {
        $data['title'] = 'wallet List';
        $data['wallet'] = $this->model('Wallet_model')->searchWallet();

        $this->view('templates/header', $data);
        $this->view('wallet/index', $data);
        $this->view('templates/footer');
    }
}