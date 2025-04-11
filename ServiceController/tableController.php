<?php
require_once("../lib/AutoLoader.php");
header('Content-Type: application/json');

// ROUTAGE PAR ACTION
$action = $_GET['action'] ?? null;

switch ($action) {
    case 'getServeurs':
        getServeurs();
        break;

    case 'getTablesParDate':
        getTablesParDate();
        break;

    case 'getTableById':
        getTableById();
        break;

    case 'modifierTable':
        modifierTable();
        break;

    case 'supprimerTable':
        supprimerTable();
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Action inconnue']);
}


// FONCTIONS


function getServeurs() {
    try {
        $connexion = DBConnex::getInstance();
        $sql = "SELECT idUtilisateur, nomUtilisateur FROM utilisateur WHERE idRole = 3";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function getTablesParDate() {
    if (!isset($_POST['dateCommande'])) {
        echo json_encode(['success' => false, 'message' => 'Date manquante']);
        return;
    }

    $date = $_POST['dateCommande'];

    try {
        $result = TableDAO::afficherTablesParDate($date); 
        echo json_encode($result);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}


function getTableById() {
    if (!isset($_POST['idTable'])) {
        echo json_encode(['success' => false, 'message' => 'ID table manquant']);
        return;
    }

    $idTable = $_POST['idTable'];

    try {
        $connexion = DBConnex::getInstance();
        $sql = "SELECT * FROM Tables WHERE idTable = :idTable";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(":idTable", $idTable);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($result);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function modifierTable() {
    if (!isset($_POST['idTable'], $_POST['nombrePlace'], $_POST['idServeur'])) {
        echo json_encode(['success' => false, 'message' => 'Paramètres manquants']);
        return;
    }

    $idTable = $_POST['idTable'];
    $nombrePlace = $_POST['nombrePlace'];
    $idServeur = $_POST['idServeur'];

    try {
        $connexion = DBConnex::getInstance();
        $sql = "UPDATE Tables SET nombrePlace = :nombrePlace, idServeur = :idServeur WHERE idTable = :idTable";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(":nombrePlace", $nombrePlace);
        $stmt->bindParam(":idServeur", $idServeur);
        $stmt->bindParam(":idTable", $idTable);
        $success = $stmt->execute();
        echo json_encode(['success' => $success]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function supprimerTable() {
    if (!isset($_POST['idTable'])) {
        echo json_encode(['success' => false, 'message' => 'ID table manquant']);
        return;
    }

    $idTable = $_POST['idTable'];

    try {
        $connexion = DBConnex::getInstance();
        $sql = "DELETE FROM Tables WHERE idTable = :idTable";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(":idTable", $idTable);
        $success = $stmt->execute();
        echo json_encode(['success' => $success]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    
}
