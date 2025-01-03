<?php
include './conexion.php';
require './../class/reservation.php';

$db = new Database();
$categorie = new Reservation($db);

if (isset($_POST['id_reservation']) && !empty($_POST['id_reservation'])) {
    $id = $_POST['id_reservation'];
    $categorie->deleteReservation( $id);

    header('Location: dashbord.php'); 
    exit();
} else {
    echo "Erreur : ID de la catégorie manquant.";
}
?>
