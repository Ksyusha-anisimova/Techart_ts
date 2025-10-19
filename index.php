<?php
require_once 'config.php';
require_once 'app/controllers/NewsController.php';

$controller = new NewsController($pdo);

$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $controller->detail($id);
} else {
    $controller->list($page);
}
