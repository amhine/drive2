<?php

class Categorie {
    public $connect;

    public $id_categorie;
    public $nom;
    public $description;
    public $image;

    // Constructeur pour initialiser la connexion à la base de données
    public function __construct($connect) {
        $this->connect = $connect;
    }

    // Récupérer toutes les catégories
    public function getCategories() {
        try {
            $sql = "SELECT * FROM categorie";
            $stmt = $this->connect->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error retrieving categories: " . $e->getMessage();
            return [];
        }
    }

    // Récupérer une catégorie par son ID
    public function getCategorieById($id) {
        try {
            $sql = "SELECT * FROM categorie WHERE id_categorie = :id";
            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error retrieving category by ID: " . $e->getMessage();
            return null;
        }
    }

    // Ajouter une nouvelle catégorie
    public function addCategorie($nom, $description, $image) {
        try {
            $sql = "INSERT INTO categorie (nom, description, image) VALUES (:nom, :description, :image)";
            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $image);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error adding category: " . $e->getMessage();
        }
    }

    // Mettre à jour une catégorie existante
    public function updateCategorie($id, $nom, $description, $image) {
        try {
            $sql = "UPDATE categorie SET nom = :nom, description = :description, image = :image WHERE id_categorie = :id";
            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $image);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error updating category: " . $e->getMessage();
        }
    }

    // Supprimer une catégorie
    public function deleteCategorie($id) {
        try {
            $sql = "DELETE FROM categorie WHERE id_categorie = :id";
            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error deleting category: " . $e->getMessage();
        }
    }
}
?>
