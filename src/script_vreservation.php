<?php
include './conexion.php';

$db = new Database();
session_start();

if (!isset($_SESSION['id_user'])) {
    die('L\'utilisateur n\'est pas connecté.');
}

$date = $_POST['date'];
$prix = $_POST['prix'];
$lieu = $_POST['lieu'];
$id_user = $_SESSION['id_user']; 
$id_vehicule = $_POST['id_vehicule'];

if (!$date || !$prix || !$lieu || !$id_user || !$id_vehicule) {
    die('Erreur : données manquantes.');
}

$sql = "INSERT INTO reservation (date, prix, lieu, id_user, id_vehicule) VALUES (?, ?, ?, ?, ?)";
$stmt = $db->getConnection()->prepare($sql);

if ($stmt->execute([$date, $prix, $lieu, $id_user, $id_vehicule])) {
    echo "Réservation ajoutée avec succès.";
    header('Location: reservation.php'); 
    exit;
} else {
    echo "Erreur lors de l'ajout de la réservation.";
}
?>
