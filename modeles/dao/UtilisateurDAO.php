<?php
class UtilisateurDAO {
    public static function authentification($login, $mdp) {
        try {
            $sql = "SELECT idUtilisateur, nomUtilisateur, prenomUtilisateur, idRole 
                    FROM Utilisateur 
                    WHERE loginUtilisateur = :login AND mdpUtilisateur = :mdp";
            $requetePrepa = DBConnex::getInstance()->prepare($sql);
            $mdp = md5($mdp);
            $requetePrepa->bindParam("login", $login);
            $requetePrepa->bindParam("mdp", $mdp);
            $requetePrepa->execute();
            $reponse = $requetePrepa->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $reponse = $e->getMessage();
        }
        return $reponse;
    }

    // Nouvelle méthode pour récupérer les serveurs présents à une date et un service donnés
    public static function getServeurs() {
        $connexion = DBConnex::getInstance();
        $sql = "SELECT Utilisateur.idUtilisateur, nomUtilisateur, prenomUtilisateur
                FROM Utilisateur 
                JOIN Present ON Utilisateur.idUtilisateur = Present.idUtilisateur
                WHERE idRole = 3 AND datePresent = '2025-05-28' AND idService = 1;";
        $stmt = $connexion->prepare($sql);
      //  $stmt->bindParam(":date", $date);
      //  $stmt->bindParam(":idService", $idService);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
