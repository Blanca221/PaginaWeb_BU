<?php
require_once 'model/Usuario.php';

class AuthController {
    private $model;
    
    public function __construct() {
        $this->model = new Usuario();
    }

    public function showLogin() {
        require_once 'views/auth/login.php';
    }

    public function showRegister() {
        require_once 'views/auth/register.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $result = $this->model->validateLogin($email, $password);
            
            if ($result) {
                $_SESSION['user_id'] = $result['id_cliente'];
                $_SESSION['user_role'] = $result['rol'];
                $_SESSION['user_name'] = $result['nombre'];
                
                header('Location: index.php?action=home');
            } else {
                $_SESSION['error'] = "Credenciales inválidas";
                header('Location: index.php?action=login');
            }
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userData = [
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
            ];
            
            if ($this->model->createUser($userData)) {
                $_SESSION['success'] = "Registro exitoso. Por favor, inicia sesión.";
                header('Location: index.php?action=login');
            } else {
                $_SESSION['error'] = "Error en el registro";
                header('Location: index.php?action=register');
            }
        }
    }

    public function checkEmail() {
        if (isset($_POST['email'])) {
            $exists = $this->model->emailExists($_POST['email']);
            echo json_encode(['exists' => $exists]);
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php');
    }
}