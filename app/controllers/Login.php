<?php

class Login extends Controller {
    public function index() {
        $this->view('login/index');
    }

    public function login() {
        $email = strtolower($_POST["email"]);
        $password = $_POST["password"];
        $data['user'] = $this->model('User_model')->getUserByEmail($email, $password);

        if ($data['user']) {
            // Login berhasil
            $_SESSION['username'] = $data['user']['name'];
            $_SESSION['id_user'] = $data['user']['id_customers'];
            $data['wallet'] = $this->model('Wallet_model')->getWalletByCustomer($_SESSION['id_user']);
            $_SESSION['customer_wallet'] = $data['wallet'];
            header("Location: " . BASEURL . "orders/index");
            exit();
        } else {
            header('Location: '.BASEURL."login/login");
            exit();
        }
    }
    

    public function register() {
        $data = $this->model('User_model')->registerUser($_POST);
        
        if ($data['rowCount'] > 0) {
            $id = $data['id'];
            $name = $data['name'];
        
            $_SESSION['username'] = $name;
            $_SESSION['id_user'] = $id;
            header('Location: '.BASEURL.'orders');
            exit();
        } else {
            header('Location: '.BASEURL."login/login");
            exit();
        }
    }
        

    public function admin(){
        if (isset($_POST["username"]) && isset($_POST["password"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];
    
            $data['admin'] = $this->model('Admin_model')->getAdminByUsername($username, $password);
    
            if ($data['admin']) {
                $_SESSION['username'] = $data['admin']['username'];
                $_SESSION['id_user'] = $data['admin']['id_admin'];
                $_SESSION['is_admin'] = true;
                header("Location: " . BASEURL . "orders/index");
                exit();
            } else {
                header('Location: '.BASEURL."admin/login");
                exit();
            }
        } 
    }    

    public function logout() {
        session_unset();
        session_destroy(); 
        header("Location: " . BASEURL);
        exit();
    }    
}
