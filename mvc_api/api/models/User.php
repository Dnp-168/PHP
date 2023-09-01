<?php
require __DIR__ . '/../../config.php';


class User {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function authenticate($username, $password) {
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($this->conn, $query);

        if (mysqli_num_rows($result) === 1) {
            return true;
        }
        return false;
    }
}
?>
