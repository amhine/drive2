<?php
class Avis {
    private $db;
    private $id_avis;
    private $note;
    private $id_vehicule;

    // Constructeur pour la classe Avis
    public function __construct($db) {
        $this->db = $db;
    }

    // Méthode pour ajouter un avis
    public function ajouterAvis($note, $id_vehicule, $id_user) {
        // Échappement des valeurs pour éviter les injections SQL
        $note = intval($note); // Convertit en entier
        $id_vehicule = intval($id_vehicule); // Convertit en entier
        $id_user = intval($id_user); // Convertit en entier
        
        $query = "INSERT INTO `avis`( `note`, `id_vehicule`, `id_user`)VALUES ($note, $id_vehicule, $id_user)";
        
        return $this->db->query($query);
    }

    // Méthode pour obtenir les avis d'un véhicule spécifique
    public function getAvisParVehicule($id_vehicule) {
        $id_vehicule = intval($id_vehicule); // Convertit en entier
        $query = "SELECT * FROM avis WHERE id_vehicule = $id_vehicule";
        $stmt = $this->db->query($query);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupère les résultats sous forme de tableau associatif
    }

    // Méthode pour supprimer un avis
    public function supprimerAvis($id_avis) {
        $id_avis = intval($id_avis); // Convertit en entier
        $query = "DELETE FROM avis WHERE id_avis = $id_avis";
        return $this->db->exec($query);
    }

    // Méthode pour modifier un avis
    public function modifierAvis($id_avis, $note) {
        $id_avis = intval($id_avis); // Convertit en entier
        $note = intval($note); // Convertit en entier
        
        $query = "UPDATE avis SET note = $note WHERE id_avis = $id_avis";
        return $this->db->exec($query);
    }

    // Méthode pour obtenir tous les avis
    public function getAllAvis() {
        try {
            $query = "SELECT * FROM avis";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des avis : " . $e->getMessage();
            return [];
        }
    }
}
?>
