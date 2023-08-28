
<?php
class UserModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function getUserByUsername($username) {
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        return $user;
    }
}
?>