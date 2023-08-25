<?php
require_once 'controllers/UsersController.php';

$controller = new UsersController();

if (isset($_GET['action'])) {
    if ($_GET['action'] === 'index') {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            $controller->indexView();
        }
    } elseif ($_GET['action'] === 'create') {
        $controller->createView();
    } elseif ($_GET['action'] === 'delete') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        $controller->deleteView($id);
        }
    } elseif ($_GET['action'] === 'edit') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $controller->editView($id);
        }
    } else {
        echo "Invalid action.";
    }
} else {
    // Default action when no action is specified
    $controller->indexView();
}
?> 


<!-- if (isset($_GET['action'])) {
    if ($_GET['action'] === 'index') {
        // Handle index action
    } elseif ($_GET['action'] === 'create') {
        // Handle create action
    } elseif ($_GET['action'] === 'delete') {
        // Handle delete action
    } else {
        echo "Invalid action.";
    }
} else {
    // Default action when no action is specified
    // Handle default action here
} -->

