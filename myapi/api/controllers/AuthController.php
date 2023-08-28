<?php
class AuthController {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function index() {
        echo "Welcome to the login API!";
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userModel = new UserModel();
            $user = $userModel->getUserByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                echo json_encode(array('message' => 'Login successful'));
            } else {
                echo json_encode(array('message' => 'Login failed'));
            }
        } else {
            echo json_encode(array('message' => 'Invalid request method'));
        }
    }
}
?>