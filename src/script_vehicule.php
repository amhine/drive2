<?php
include './conexion.php';
require './../class/vehicule.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $marque = htmlspecialchars($_POST['marque']);
    $modele = htmlspecialchars($_POST['madele']);
    $prix = htmlspecialchars($_POST['prix']);
    $id_categorie = $_POST['id_categorie'];

    $image = $_FILES['image'];
    $upload = "uploads/";
    $images = $upload . basename($image["name"]);

    if (move_uploaded_file($image["tmp_name"], $images)) {
        $db = new Database();
        $vehicule = new Vehicule($db);

        $vehicule->addVehicule($marque, $modele, $prix, $id_categorie, $images);
        header("Location: dashbord.php");
        exit();
    } else {
        echo "Erreur lors du téléchargement de l'image.";
    }
}

?>
