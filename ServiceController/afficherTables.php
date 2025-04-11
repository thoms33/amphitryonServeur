<?php
require_once("../lib/AutoLoader.php");
header('Content-Type: application/json');

if (!isset($_POST['dateCommande']) || !isset($_POST['idService'])) {
    echo json_encode([]);
    exit;
}

$date = $_POST['dateCommande'];
$service = $_POST['idService'];

try {
    $tables = TableDAO::afficherTables($date, $service);
    echo json_encode($tables);
} catch (Exception $e) {
    echo json_encode([]);
}
