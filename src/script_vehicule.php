<?php
include './conexion.php';
require './../class/vehicule.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire et les sécuriser
    $marque = htmlspecialchars($_POST['marque']);
    $modele = htmlspecialchars($_POST['madele']);
    $prix = htmlspecialchars($_POST['prix']);
    $id_categorie = htmlspecialchars($_POST['id_categorie']);

    // Vérifier que tous les champs sont remplis
    if (!empty($marque) && !empty($modele) && !empty($prix) && !empty($id_categorie)) {
        // Créer une instance de la base de données
        $db = new Database();
        $vehicule = new Vehicule($db);

        // Appeler la méthode pour ajouter le véhicule
        $vehicule->addVehicule($marque, $modele, $prix, $id_categorie);

        // Rediriger vers le tableau de bord après l'ajout
        header("Location: dashbord.php");
        exit();
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>
