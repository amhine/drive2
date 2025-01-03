<?php
include './conexion.php';
require './../class/reservation.php';

$db = new Database();
$reservation = new Reservation($db); 
$reservations = $reservation->getAllReservations();
session_start();

$id_user = $_SESSION['id_user'] ?? null; // Vérifiez si l'utilisateur est connecté
$id_vehicule = $_POST['id_vehicule'] ?? null; // Récupérer l'ID du véhicule de manière sécurisée

// Vérifiez que l'utilisateur et le véhicule sont bien définis
if (!$id_user) {
    header("Location: login.php"); // Rediriger vers la page de connexion
    exit();
}

if (!$id_vehicule) {
    die('Erreur : ID du véhicule non transmis.');
}


// Logique pour traiter la réservation
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une reservation</title>
    <link rel="stylesheet" href="input.css">
    <link rel="stylesheet" href="output.css">
</head>
<body>
    <form action="script_vreservation.php" method="POST" enctype="multipart/form-data" id="addreservationForm">
        <div class="max-w-[800px] w-full max-h-[500px] bg-white rounded-lg shadow-lg ">
            <div class="px-8 py-4 bg-blue-400 text-white">
                <h1 class="flex justify-center font-bold text-white text-3xl">Ajouter une reservation</h1>
            </div>
            <div class="px-8 py-6">
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="date">date :</label>
                    <input class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="date" name="date" type="date" placeholder="date" required>
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="prix">Prix :</label>
                    <input class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="prix" name="prix" type="text" placeholder="Prix" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="lieu">lieu :</label>
                    <input class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="lieu" name="lieu" type="text" placeholder="lieu" required>

                </div>


                
            <input type="hidden" name="id_vehicule" value="<?php echo $id_vehicule; ?>">
            <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>">
                
                <div class="flex justify-between mt-8">
                    <a href="vehicule.php" class="text-white bg-red-600 w-40 rounded-lg py-3 hover:bg-red-800 cursor-pointer flex justify-center">Annuler</a>
                    <button type="submit" class="text-white bg-blue-600 w-40 rounded-lg py-3 hover:bg-blue-800 cursor-pointer">Ajouter</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
