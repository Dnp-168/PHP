<?php
require __DIR__ . '/../models/User.php';

class UserController {
    private $userModel;

    public function __construct($conn) {
        $this->userModel = new User($conn);
    }

    public function login() {
        $requestData = json_decode(file_get_contents('php://input'), true);
        if ($requestData && isset($requestData['username']) && isset($requestData['password'])) {
            $username = $requestData['username'];
            $password = $requestData['password'];

            if ($this->userModel->authenticate($username, $password)) {
                $response = array('success' => true, 'message' => 'Login successful');
            } else {
                $response = array('success' => false, 'message' => 'Invalid credentials');
            }
        } else {
            $response = array('success' => false, 'message' => 'Invalid request');
        }
        require __DIR__ . '/../views/json_response.php';

    }
}
?>
