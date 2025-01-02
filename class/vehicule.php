<?php
class Vehicule {
    private $db;
    
    // Constructeur pour initialiser la connexion à la base de données
    public function __construct($db) {
        $this->db = $db;
    }

    // Récupérer les détails d'un véhicule par son ID
    // public function getVehiculeById($id_vehicule) {
    //     $query = "SELECT * FROM vehicule WHERE id_vehicule = :id_vehicule";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->execute(['id_vehicule' => $id_vehicule]);
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }

    public function getvehicule() {
        try {
            $sql = "SELECT * FROM vehicule";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error retrieving categories: " . $e->getMessage();
            return [];
        }
    }

    // Récupérer tous les véhicules d'une catégorie donnée
    public function getVehiculesByCategorie($id_categorie) {
        $query = "SELECT * FROM vehicule WHERE id_categorie = :id_categorie";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id_categorie' => $id_categorie]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    // Ajouter un véhicule dans la base de données
    public function addVehicule($marque, $modele, $prix, $id_categorie) {
        $query = "INSERT INTO vehicule (marque, madele, prix, id_categorie) 
                  VALUES (:marque, :madele, :prix, :id_categorie)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            'marque' => $marque,
            'madele' => $modele,
            'prix' => $prix,
            'id_categorie' => $id_categorie
            
        ]);
    }

    // Mettre à jour un véhicule
    public function updateVehicule($id_vehicule, $marque, $modele, $prix, $id_categorie) {
        $query = "UPDATE vehicule SET marque = :marque, madele = :madele, prix = :prix, 
                  id_categorie = :id_categorie WHERE id_vehicule = :id_vehicule";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            'id_vehicule' => $id_vehicule,
            'marque' => $marque,
            'madele' => $modele,
            'prix' => $prix,
            'id_categorie' => $id_categorie,
            
        ]);
    }

    // Supprimer un véhicule
    public function deleteVehicule($id_vehicule) {
        $query = "DELETE FROM vehicule WHERE id_vehicule = :id_vehicule";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id_vehicule' => $id_vehicule]);
    }
}
?>
