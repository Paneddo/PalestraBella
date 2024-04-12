<?php
session_start();
session_destroy();
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = './index.php';
}

header('Location: ' . $page);
exit();
