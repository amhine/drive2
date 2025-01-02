<?php
class Vehicule {
    private $db;
    
    // Constructeur pour initialiser la connexion à la base de données
    public function __construct($db) {
        $this->db = $db;
    }

    // Récupérer les détails d'un véhicule par son ID
    public function getVehiculeById($id_vehicule) {
        $query = "SELECT * FROM vehicule WHERE id_vehicule = :id_vehicule";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id_vehicule' => $id_vehicule]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

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

   

    public function getVehiculesByCategorie($id_categorie) {
        try {
            $sql = "SELECT * FROM vehicule WHERE id_categorie = :id_categorie";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_categorie', $id_categorie, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des véhicules : " . $e->getMessage();
            return [];
        }
    }
    
    
    

    // Ajouter un véhicule dans la base de données
    public function addVehicule($marque, $modele, $prix, $id_categorie, $image) {
        $query = "INSERT INTO vehicule (marque, madele, prix, id_categorie, image) 
                  VALUES (:marque, :madele, :prix, :id_categorie, :image)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            'marque' => $marque,
            'madele' => $modele,
            'prix' => $prix,
            'id_categorie' => $id_categorie,
            'image' => $image
        ]);
    }

    // Mettre à jour un véhicule
    public function updateVehicule($id_vehicule, $marque, $madele, $prix, $id_categorie, $image) {
        // Requête SQL pour mettre à jour le véhicule
        $query = "UPDATE vehicule SET marque = :marque, madele = :madele, prix = :prix, id_categorie = :id_categorie, image = :image WHERE id_vehicule = :id_vehicule";

        $stmt = $this->db->prepare($query);

        // Lier les paramètres
        $stmt->bindParam(':id_vehicule', $id_vehicule);
        $stmt->bindParam(':marque', $marque);
        $stmt->bindParam(':madele', $madele);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':id_categorie', $id_categorie);
        $stmt->bindParam(':image', $image);

        // Exécuter la requête
        return $stmt->execute();
    }
    
    // Supprimer un véhicule
    public function deleteVehicule($id_vehicule) {
        $query = "DELETE FROM vehicule WHERE id_vehicule = :id_vehicule";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id_vehicule' => $id_vehicule]);
    }
}
?>
