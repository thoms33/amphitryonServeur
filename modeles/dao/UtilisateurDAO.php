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

    // Nouvelle méthode pour récupérer les serveurs
    public function getServeurs() {
        $connexion = DBConnex::getInstance();
        $sql = "SELECT idUtilisateur, nomUtilisateur, prenomUtilisateur FROM Utilisateur WHERE idRole = 3";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>
