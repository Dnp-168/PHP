<?php
class UsersModel
{
    private $db;

    public function __construct()
    {
        $this->db = new mysqli('localhost', 'root', '', 'oops_crud');
    }

    public function createUser($POST)
    {
        $name = $this->db->real_escape_string($POST['name']);
        $email = $this->db->real_escape_string($POST['email']);
        $phone = $this->db->real_escape_string($POST['phone']);
        $gender = $this->db->real_escape_string($POST['gender']);

        $query = "INSERT INTO user1(name, email, gender, phone) VALUES('$name', '$email', '$gender', '$phone')";
        $sql = $this->db->query($query);

        if ($sql) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllUsers()
    {
        $query = "SELECT * FROM user1";
        $result = $this->db->query($query);
        if ($result->num_rows > 0) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            echo "No data Found";
        }
    }


    public function deleteUser($id)
    {
        $id = $this->db->real_escape_string($id);

        $query = "DELETE FROM user1 WHERE id = '$id'";
        $sql = $this->db->query($query);

        if ($sql) {
            echo "User deleted Successfully";
        } else {
            echo "Deletion failed: " . $this->db->error;
        }
    }

    public function getUserById($id)
    {
        $id = $this->db->real_escape_string($id);
        $query = "SELECT * FROM user1 WHERE id = '$id'";
        $result = $this->db->query($query);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function updateUser($data)
    {
        $id = $this->db->real_escape_string($data['id']);
        $name = $this->db->real_escape_string($data['name']);
        $email = $this->db->real_escape_string($data['email']);
        $gender = $this->db->real_escape_string($data['gender']);
        $phone = $this->db->real_escape_string($data['phone']);
        // Add other fields for email, gender, phone
        $query =  "UPDATE user1 SET name = '$name', email = '$email', gender = '$gender', phone = '$phone' WHERE id = '$id'";;
        $sql = $this->db->query($query);
        if ($sql) {
            return true;
        } else {
            return false;
        }
    }
    public function getPaginatedUsers($page, $perPage) {
        $start = ($page - 1) * $perPage;
        $query = "SELECT * FROM user1 LIMIT $start, $perPage";
        $result = $this->db->query($query);

        if ($result->num_rows > 0) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return array(); // Return an empty array if no data found
        }
    }

    public function getTotalPages($perPage) {
        $query = "SELECT COUNT(id) AS total FROM user1";
        $result = $this->db->query($query);

        if ($result->num_rows > 0) {
            $total = $result->fetch_assoc()['total'];
            return ceil($total / $perPage);
        } else {
            return 0; // Return 0 if no data found
        }
    }
}
    


