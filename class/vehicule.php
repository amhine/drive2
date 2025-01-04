<?php
class Vehicule {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getVehiculeById($id_vehicule) {
        $query = "SELECT * FROM vehicule WHERE id_vehicule = $id_vehicule";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
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
            $sql = "SELECT * FROM vehicule WHERE id_categorie = $id_categorie";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des véhicules : " . $e->getMessage();
            return [];
        }
    }
    public function addVehicule($marque, $modele, $prix, $id_categorie, $image) {
        $query = "INSERT INTO vehicule (marque, madele, prix, id_categorie, image) 
                  VALUES ('$marque', '$modele', '$prix', '$id_categorie', '$image')";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
    }

    public function updateVehicule($id_vehicule, $marque, $modele, $prix, $id_categorie, $image) {
        $query = "UPDATE vehicule SET marque = '$marque', madele = '$modele', prix = '$prix', id_categorie = '$id_categorie', image = '$image' WHERE id_vehicule = $id_vehicule";
        $stmt = $this->db->prepare($query);
        return $stmt->execute();
    }

    public function deleteVehicule($id_vehicule) {
        $query = "DELETE FROM vehicule WHERE id_vehicule = $id_vehicule";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
    }

    // pagination
    public function getvehiculee($start_from, $limit) {
        try {
            $sql = "SELECT * FROM vehicule LIMIT $start_from, $limit";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error retrieving vehicles: " . $e->getMessage();
            return [];
        }
    }

    // filtrage
    public function getCount($id_categorie = 0, $search = '') {
        $query = "SELECT COUNT(*) as total FROM vehicule";
        
        if ($id_categorie > 0) {
            $query .= " WHERE id_categorie = $id_categorie";
        }

        if (!empty($search)) {
            $query .= ($id_categorie > 0 ? " AND" : " WHERE") . " (marque LIKE '%$search%' OR madele LIKE '%$search%')";
        }

        $stmt = $this->db->connect->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // filtres et pagination
    public function getVehicules($id_categorie = 0, $search = '', $start_from = 0, $limit = 4) {
        $query = "SELECT * FROM vehicule";
        if ($id_categorie > 0) {
            $query .= " WHERE id_categorie = $id_categorie";
        }
        if (!empty($search)) {
            $query .= ($id_categorie > 0 ? " AND" : " WHERE") . " (marque LIKE '%$search%' OR madele LIKE '%$search%')";
        }
        $query .= " LIMIT $start_from, $limit";

        $stmt = $this->db->connect->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
