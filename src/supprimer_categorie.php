<?php
include './conexion.php';
require './../class/categorier.php';

$db = new Database();
$categorie = new Categorie($db);

if (isset($_POST['id_categorie']) && !empty($_POST['id_categorie'])) {
    $id = $_POST['id_categorie'];
    $categorie->deleteCategorie($id);

    header('Location: dashbord.php'); 
    exit();
} else {
    echo "Erreur : ID de la catégorie manquant.";
}
?>
