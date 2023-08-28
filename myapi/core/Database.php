
<?php
class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = 'your_password'; // Set your database password here
    private $database = 'login_api';
    private $conn;

    public function __construct() {
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            die("Database connection error: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>