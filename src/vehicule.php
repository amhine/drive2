<?php
include './conexion.php';
require './../class/categorier.php';
require './../class/vehicule.php';

$db = new Database();
$categorie = new Categorie($db); 
$categories = $categorie->getCategories();
$vehicule = new Vehicule($db); 
$vehicules = $vehicule->getvehicule(); // Récupère tous les véhicules
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="input.css">
    <link rel="stylesheet" href="output.css">
</head>
<body>
    <nav class="bg-gray-800 mb-14">
        <!-- Votre menu de navigation ici -->
    </nav>

    <div class="reservation-card bg-white border border-gray-300 rounded-lg shadow-lg p-6 hover:shadow-xl transition-transform transform hover:-translate-y-2">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid gap-6">
            <?php foreach ($vehicules as $vehicule): ?>
            <div class="flex flex-col items-center text-center bg-white shadow-md rounded-lg p-4 transition-transform transform hover:scale-105">
                <img src="<?php echo ($vehicule['image']); ?>" alt="vehicle-<?php echo strtolower($vehicule['marque']); ?>" class="w-36 h-24 object-cover mx-auto mb-4">
                
                <h3 class="text-lg font-bold text-gray-900 mb-2"><?php echo ($vehicule['marque'] . ' ' . $vehicule['madele']); ?></h3>
                
                <p class="text-sm text-gray-600 mb-4">Prix : <?php echo ($vehicule['prix']); ?> DH</p>
                 
                <form action="reservation_vehicule.php" method="POST">
    <!-- ID du véhicule unique -->
    <input type="hidden" name="id_vehicule" value="<?php echo $vehicule['id_vehicule']; ?>">
    <!-- ID de l'utilisateur -->
    <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>"> <!-- ID utilisateur dynamique -->
    <button type="submit" class="text-white bg-red-600 rounded-lg w-56 h-10 text-lg font-bold hover:bg-red-700 transition-colors">
        Reserved
    </button>
</form>

            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer class="bg-gray-800 text-gray-300 py-10 mt-12">
        <!-- Votre footer ici -->
    </footer>
</body>
</html>
