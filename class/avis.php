<?php
class Avis {
    private $db;
    private $id_avis;
    private $note;
    private $id_vehicule;
    private $id_user;

     // Constructeur pour la classe Avis
     public function __construct($db, $avisData = null) {
        $this->db = $db;
        if ($avisData) {
            $this->id_avis = $avisData['id_avis'];
            $this->note = $avisData['note'];
            $this->id_vehicule = $avisData['id_vehicule'];
            $this->id_user = $avisData['id_user'];
        }
    }
// Méthode pour obtenir le nom de l'utilisateur
        public function Nomutilisateur() {
            
            $sql = "SELECT u.nom_user AS Nom
                    FROM utilisateur u
                    JOIN avis a ON u.id_user = a.id_user
                    WHERE a.id_user = :id_user";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_user', $this->id_user, PDO::PARAM_INT); 
            $stmt->execute(); 
            
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                return $row['Nom']; 
            }
            return 0; 
        }

        public function Nomvehicule() {
            
            $sql = "SELECT v.marque AS Nom
                    FROM vehicule v
                    JOIN avis a ON v.id_vehicule = a.id_vehicule
                    WHERE a.id_vehicule = :id_vehicule;";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_vehicule', $this->id_vehicule, PDO::PARAM_INT); 
            $stmt->execute(); 
            
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                return $row['Nom']; 
            }
            return 0; 
        }


    // Méthode pour ajouter un avis
    public function ajouterAvis($note, $id_vehicule, $id_user) {
        $note = intval($note); 
        $id_vehicule = intval($id_vehicule); 
        $id_user = intval($id_user); 
        
        $query = "INSERT INTO `avis`( `note`, `id_vehicule`, `id_user`)VALUES ($note, $id_vehicule, $id_user)";
        
        return $this->db->query($query);
    }

    // Méthode pour obtenir les avis d'un véhicule spécifique
    public function getAvisParVehicule($id_vehicule) {
        $id_vehicule = intval($id_vehicule); 
        $query = "SELECT * FROM avis WHERE id_vehicule = $id_vehicule";
        $stmt = $this->db->query($query);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    // Méthode pour supprimer un avis
    public function supprimerAvis($id_avis) {
        $id_avis = intval($id_avis); 
        $query = "DELETE FROM avis WHERE id_avis = $id_avis";
        return $this->db->exec($query);
    }

    // Méthode pour modifier un avis
    public function modifierAvis($id_avis, $note) {
        $id_avis = intval($id_avis); 
        $note = intval($note); 
        
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
