<?php
require_once 'config/Database.php';

class Usuario {
    private $conn;
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function validateLogin($email, $password) {
        $query = "SELECT id_cliente, nombre, email, contrasena, rol FROM Cliente WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$email]);
        
        if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($password, $user['contrasena'])) {
                return $user;
            }
        }
        return false;
    }

    public function createUser($userData) {
        $query = "INSERT INTO Cliente (nombre, apellido, email, contrasena) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        
        return $stmt->execute([
            $userData['nombre'],
            $userData['apellido'],
            $userData['email'],
            $userData['password']
        ]);
    }

    public function emailExists($email) {
        $query = "SELECT COUNT(*) FROM Cliente WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }
}