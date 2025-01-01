<?php
require_once './conexion.php';
require './../class/Utilisateur.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $db = new Database();
    $utilisateur = new Utilisateur($db);
    
    $resultat = $utilisateur->connexion($email, $password);
    
    if($resultat == "Connexion réussie") {
        // Redirection basée sur le rôle stocké dans la session
        if($_SESSION['role'] == 1) { 
            header("Location: ajoutadmin.php");
        } else { 
            header("Location: index.php");
        }
        exit();
    } else {
        header("Location: login.php?error=" . urlencode($resultat));
        exit();
    }
}
?>