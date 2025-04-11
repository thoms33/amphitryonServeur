<?php
class TableDAO {

// Ajouter une table avec les détails
public static function ajouterTable($nombrePlace, $idServeur, $idService, $dateCommande) {
    try {
        $sql = "INSERT INTO Tables (nombrePlace, idServeur, idService, dateCommande) VALUES (:nombrePlace, :idServeur, :idService, :dateCommande)";
        $requetePrepa = DBConnex::getInstance()->prepare($sql);
        $requetePrepa->bindParam(":nombrePlace", $nombrePlace);
        $requetePrepa->bindParam(":idServeur", $idServeur);
        $requetePrepa->bindParam(":idService", $idService);
        $requetePrepa->bindParam(":dateCommande", $dateCommande);
        return $requetePrepa->execute();
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

// Modifier une table
public static function modifierTable($idTable, $nombrePlace, $idServeur, $idService, $dateCommande) {
    try {
        $sql = "UPDATE Tables SET nombrePlace = :nombrePlace, idServeur = :idServeur, idService = :idService, dateCommande = :dateCommande WHERE idTable = :idTable";
        $requetePrepa = DBConnex::getInstance()->prepare($sql);
        $requetePrepa->bindParam(":idTable", $idTable);
        $requetePrepa->bindParam(":nombrePlace", $nombrePlace);
        $requetePrepa->bindParam(":idServeur", $idServeur);
        $requetePrepa->bindParam(":idService", $idService);
        $requetePrepa->bindParam(":dateCommande", $dateCommande);
        return $requetePrepa->execute();
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

// Supprimer une table
public static function supprimerTable($idTable) {
    try {
        $sql = "DELETE FROM Tables WHERE idTable = :idTable";
        $requetePrepa = DBConnex::getInstance()->prepare($sql);
        $requetePrepa->bindParam(":idTable", $idTable);
        return $requetePrepa->execute();
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

// Afficher les tables en fonction d'une date uniquement 
public static function afficherTablesParDate($dateCommande) {
    try {
        $sql = "SELECT * FROM Tables WHERE dateCommande = :dateCommande ORDER BY idTable";
        $requetePrepa = DBConnex::getInstance()->prepare($sql);
        $requetePrepa->bindParam(":dateCommande", $dateCommande);
        $requetePrepa->execute();
        return $requetePrepa->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        return [];
    }
}


// Sélectionner les serveurs disponibles pour une date et un service
public static function afficherServeurs($dateCommande, $idService) {
    try {
        $sql = "SELECT * FROM Serveur WHERE idService = :idService AND dateDisponible = :dateCommande";
        $requetePrepa = DBConnex::getInstance()->prepare($sql);
        $requetePrepa->bindParam(":dateCommande", $dateCommande);
        $requetePrepa->bindParam(":idService", $idService);
        $requetePrepa->execute();
        return $requetePrepa->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

// Pour le bouton afficher Table
public static function afficherTables($dateCommande, $idService) {
    try {
        $sql = "SELECT t.*, u.nomUtilisateur, u.prenomUtilisateur 
                FROM Tables t 
                JOIN Utilisateur u ON t.idServeur = u.idUtilisateur
                WHERE t.dateCommande = :dateCommande AND t.idService = :idService 
                ORDER BY t.idTable";
        $requetePrepa = DBConnex::getInstance()->prepare($sql);
        $requetePrepa->bindParam(":dateCommande", $dateCommande);
        $requetePrepa->bindParam(":idService", $idService);
        $requetePrepa->execute();
        return $requetePrepa->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        return [];
    }
}


}
?>