<?php
require_once 'controllers/UsersController.php';

if (isset($_GET['page'])) {
    $page = intval($_GET['page']);
    $controller = new UsersController();
    $controller->loadUsers($page);
}
?>
