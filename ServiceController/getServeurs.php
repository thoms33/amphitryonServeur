<?php
require_once("../lib/AutoLoader.php");
header('Content-Type: application/json');

$dao = new UtilisateurDAO();
$serveurs = $dao->getServeurs();

echo json_encode($serveurs);
?>
