<?php
session_start();
include './conexion.php';
require './../class/reservation.php';
require './../class/vehicule.php';

$db = new Database();
$Reservation = new Reservation($db); 
$vehicule = new Vehicule($db); 
$vehicules = $vehicule->getvehicule(); 
$Reservations = $Reservation->getAllReservations();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="input.css">
    <link rel="stylesheet" href="output.css">
</head>
<body>
<nav class="bg-gray-800 mb-12">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="index.html" class="text-white text-2xl font-bold">
                    Voi<span class="text-blue-400">Ture</span>
                </a>
            </div>
            <!-- Hamburger Menu (mobile) -->
            <div class="md:hidden">
                <button id="menu-toggle" class="text-gray-300 focus:outline-none focus:text-white">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
            <!-- Nav Links -->
            <div id="menu" class="hidden md:flex space-x-4">
                <a href="index.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>
                <a href="categorier.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Categories</a>
                <a href="vehicule.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Vehicles</a>
                <a href="reservation.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Reservations</a>
                <a href="avis.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Feedback</a>
            </div>
        </div>
    </div>
</nav>

<div class="reservation-card bg-white border border-gray-300 rounded-lg shadow-lg p-6 hover:shadow-xl transition-transform transform hover:-translate-y-2">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($Reservations as $Reservation): ?>
        <div class="flex flex-col items-center text-center bg-white shadow-md rounded-lg p-4 transition-transform transform hover:scale-105">
            <h3 class="text-lg font-bold text-gray-900 mb-2"><?php echo htmlspecialchars($Reservation['date']); ?></h3>
            <p class="text-sm text-gray-600 mb-4">Lieu : <?php echo htmlspecialchars($Reservation['lieu']); ?></p>
            <p class="text-sm text-gray-600 mb-4">Prix : <?php echo htmlspecialchars($Reservation['prix']); ?> DH</p>
            <form action="avis_reservation.php" method="GET">
                <input type="hidden" name="id_reservation" value="<?php echo htmlspecialchars($Reservation['id_reservation']); ?>">
                <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($_SESSION['id_user'] ?? ''); ?>">
                <input type="hidden" name="id_vehicule" value="<?php echo htmlspecialchars($Reservation['id_vehicule']); ?>">
                <button type="submit" name="avis" class="text-white bg-red-600 rounded-lg w-56 h-10 text-lg font-bold hover:bg-red-700 transition-colors">
                    Votre avis
                </button>
            </form>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<footer class="bg-gray-800 text-gray-300 py-10 mt-12">
    <div class="container mx-auto px-4">
        <!-- Footer content here -->
    </div>
</footer>
</body>
</html>
