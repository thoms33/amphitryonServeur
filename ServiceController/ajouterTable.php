<?php
require_once("../lib/AutoLoader.php");
header('Content-Type: application/json');

if (
    isset($_POST['nombrePlace']) &&
    isset($_POST['idServeur']) &&
    isset($_POST['idService']) &&
    isset($_POST['dateCommande'])
) {
    $nombrePlace = $_POST['nombrePlace'];
    $idServeur = $_POST['idServeur'];
    $idService = $_POST['idService'];
    $dateCommande = $_POST['dateCommande'];

    // Appel DAO
    $result = TableDAO::ajouterTable($nombrePlace, $idServeur, $idService, $dateCommande);

    if ($result === true) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Erreur BDD : ' . $result
        ]);
    }
}

