<?php
include './conexion.php';
session_start();

if (!isset($_SESSION['id_user'])) {
    die('L\'utilisateur n\'est pas connecté.');
}

$note = $_POST['note'] ?? null; 
$id_vehicule = $_POST['id_vehicule'] ?? null; 
$id_reservation = $_POST['id_reservation'] ?? null; 
$id_user = $_SESSION['id_user'] ?? null; 
// Afficher les valeurs pour débogage
var_dump($note, $id_vehicule, $id_reservation, $id_user);

if (!$note || !$id_vehicule || !$id_reservation || !$id_user) {
    die('Erreur : données manquantes.');
}
// Vérification des données manquantes
if (!$note || !$id_vehicule || !$id_reservation || !$id_user) {
    die('Erreur : données manquantes.');
}

$db = new Database();
$query = "INSERT INTO avis (note, id_vehicule, id_user) VALUES ($note, $id_vehicule, $id_user)";
$stmt = $db->getConnection()->prepare($query);

if ($stmt->execute([$note, $id_vehicule, $id_user])) {
    echo "Avis ajouté avec succès.";
    header('Location: avis_reservation.php');
    exit;
} else {
    echo "Erreur lors de l'ajout de l'avis.";
}



?>
