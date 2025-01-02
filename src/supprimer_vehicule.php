<?php
include './conexion.php';
require './../class/vehicule.php';

$db = new Database();
$categorie = new Vehicule($db);

if (isset($_POST['id_vehicule']) && !empty($_POST['id_vehicule'])) {
    $id = $_POST['id_vehicule'];
    $categorie->deleteVehicule($id);

    header('Location: dashbord.php'); 
    exit();
} else {
    echo "Erreur : ID de la catégorie manquant.";
}
?>
