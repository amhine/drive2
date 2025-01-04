<?php
include './conexion.php';
require './../class/avis.php';

$db = new Database();
$avis = new avis($db);

if (isset($_POST['id_avis']) && !empty($_POST['id_avis'])) {
    $id = $_POST['id_avis'];
    $avis->supprimerAvis($id);

    header('Location: avis.php'); 
    exit();
} else {
    echo "Erreur : ID de la catégorie manquant.";
}
?>
