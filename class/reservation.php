<?php
class Reservation {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addReservation($date_reservation, $prix, $lieu, $id_user, $id_vehicule) {
        try {
            $query = "INSERT INTO reservation (date_reservation, prix, lieu, id_user, id_vehicule)
                      VALUES (:date_reservation, :prix, :lieu, :id_user, :id_vehicule)";
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                'date_reservation' => $date_reservation,
                'prix' => $prix,
                'lieu' => $lieu,
                'id_user' => $id_user,
                'id_vehicule' => $id_vehicule
            ]);
            return $this->db->lastInsertId(); 
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de la réservation : " . $e->getMessage();
            return false;
        }
    }

    public function getAllReservations() {
        try {
            $query = "SELECT * FROM reservation";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des réservations : " . $e->getMessage();
            return [];
        }
    }

    // Récupérer une réservation par son ID
    public function getReservationById($id_reservation) {
        try {
            $query = "SELECT * FROM reservation WHERE id_reservation = :id_reservation";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_reservation', $id_reservation, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération de la réservation : " . $e->getMessage();
            return null;
        }
    }

    // Mettre à jour une réservation
    public function updateReservation($id_reservation, $date_reservation, $prix, $lieu, $id_user, $id_vehicule) {
        try {
            $query = "UPDATE reservation 
                      SET date_reservation = :date_reservation, prix = :prix, lieu = :lieu, 
                          id_user = :id_user, id_vehicule = :id_vehicule
                      WHERE id_reservation = :id_reservation";
            $stmt = $this->db->prepare($query);
            return $stmt->execute([
                'id_reservation' => $id_reservation,
                'date_reservation' => $date_reservation,
                'prix' => $prix,
                'lieu' => $lieu,
                'id_user' => $id_user,
                'id_vehicule' => $id_vehicule
            ]);
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour de la réservation : " . $e->getMessage();
            return false;
        }
    }

    // Supprimer une réservation
    public function deleteReservation($id_reservation) {
        try {
            $query = "DELETE FROM reservation WHERE id_reservation = :id_reservation";
            $stmt = $this->db->prepare($query);
            return $stmt->execute(['id_reservation' => $id_reservation]);
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression de la réservation : " . $e->getMessage();
            return false;
        }
    }
}
?>
