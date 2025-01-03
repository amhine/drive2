<?php
include './conexion.php';
require './../class/avis.php';

session_start(); 

$id_user = $_SESSION['id_user'] ?? null; 

$id_reservation = $_POST['id_reservation'] ?? null; 

$id_vehicule = $_GET['id_vehicule'] ?? null;

if ($id_vehicule === null) {
    die("Erreur : ID du véhicule manquant.");
}

if (!$id_user) {
    die('Erreur : ID du user non transmis.');
}

if (!$id_reservation) {
    die('Erreur : ID du reservation non transmis.');
}

$db = new Database();
$avis = new Avis($db); 
$aviss = $avis->getAllAvis();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Avis</title>
    <link rel="stylesheet" href="input.css">
    <link rel="stylesheet" href="output.css">
</head>
<body>
    <!-- <form action="script_avis.php" method="POST" enctype="multipart/form-data" id="addavisForm">
        <div class="max-w-[800px] w-full max-h-[500px] bg-white rounded-lg shadow-lg ">
            <div class="px-8 py-4 bg-blue-400 text-white">
                <h1 class="flex justify-center font-bold text-white text-3xl">Ajouter un Avis</h1>
            </div>
            <div class="px-8 py-6">
                
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="note">Note (1 à 5) :</label>
                    <select class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="note" name="note" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>

                <input type="hidden" name="id_reservation" value="<?php echo $id_reservation; ?>">
                <input type="hidden" name="id_vehicule" value="<?php echo $id_vehicule; ?>">
                <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">

                <div class="flex justify-between mt-8">
                    <a href="vehicule.php" class="text-white bg-red-600 w-40 rounded-lg py-3 hover:bg-red-800 cursor-pointer flex justify-center">Annuler</a>
                    <button type="submit" class="text-white bg-blue-600 w-40 rounded-lg py-3 hover:bg-blue-800 cursor-pointer">Ajouter</button>
                </div>
            </div>
        </div>
    </form> -->

    <form action="script_avis.php" method="POST">
    <!-- Autres champs du formulaire -->

    <!-- Note -->
    <select name="note" required>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>

    <!-- Champs cachés -->
    <input type="hidden" name="id_vehicule" value="<?php echo $id_vehicule; ?>">


    <input type="hidden" name="id_reservation" value="<?php echo $id_reservation; ?>">
    <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>">

    <button type="submit">Ajouter</button>
</form>

</body>
</html>

