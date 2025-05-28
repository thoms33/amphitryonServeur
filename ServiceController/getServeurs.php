<?php
require_once("../lib/AutoLoader.php");
header('Content-Type: application/json');

// Vérifie que les paramètres sont bien envoyés
if (!isset($_POST['date']) || !isset($_POST['idService'])) {
    echo json_encode(['success' => false, 'message' => 'Paramètres manquants']);
    exit;
}
//récupere les paramètres reçus
$date = $_POST['date'];
$idService = $_POST['idService'];


//appel DAO pour recuperer les serveurs présents ce jour-là pour ce service
$dao = new UtilisateurDAO();
$date = "2025-05-28";
$idService = 1;
$serveurs = $dao->getServeurs($date, $idService);

echo json_encode($serveurs);
?>
