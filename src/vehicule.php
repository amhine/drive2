<?php
include './conexion.php';
require './../class/categorier.php';
require './../class/vehicule.php';

$db = new Database();
$categorie = new Categorie($db);
$categories = $categorie->getCategories();
$vehicule = new Vehicule($db);

$limit = 4;
$id_categorie = isset($_GET['id_categorie']) ? (int)$_GET['id_categorie'] : 0;
$search = isset($_GET['search']) ? $_GET['search'] : '';
$total_records = $vehicule->getCount($id_categorie, $search);

$total_pages = ceil($total_records / $limit);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;  
$start_from = ($page - 1) * $limit;

$vehicules = $vehicule->getVehicules($id_categorie, $search, $start_from, $limit);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Véhicules</title>
    <link rel="stylesheet" href="input.css">
    <link rel="stylesheet" href="output.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="bg-gray-800 mb-12">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <div class="flex-shrink-0">
                    <a href="index.html" class="text-white text-2xl font-bold">
                        Voi<span class="text-blue-400">Ture</span>
                    </a>
                </div>
                <div class="md:hidden">
                    <button id="menu-toggle" class="text-gray-300 focus:outline-none focus:text-white">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>
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

    <!-- Formulaire de recherche -->
    <div class="flex justify-end my-4 mr-6">
        <form action="vehicule.php" method="GET" class="flex items-center space-x-2">
            <input type="text" name="search" id="search" placeholder="Rechercher par modèle" class="px-4 py-2 border border-gray-300 rounded-md" value="<?=($search); ?>">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                <i class="fa-solid fa-search"></i>
            </button>
        </form>
    </div>

        <!-- Filtrage par catégorie -->
        <div class="flex justify-center my-4">
            <form action="vehicule.php" method="GET" class="flex items-center space-x-2">
                <select id="category-filter" name="id_categorie" class="px-4 py-2 border border-r-teal-950 rounded-md" onchange="this.form.submit()">
                    <option value="0">Sélectionner une catégorie</option>
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?php echo $categorie['id_categorie']; ?>" <?php echo ($id_categorie == $categorie['id_categorie']) ? 'selected' : ''; ?>>
                            <?php echo $categorie['nom']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            
            </form>
        </div>




        <!-- Affichage des véhicules -->
        <div id="vehicles-container" class="reservation-card bg-white border border-gray-300 rounded-lg shadow-lg p-6 hover:shadow-xl transition-transform transform hover:-translate-y-2">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid gap-6">
                <?php foreach ($vehicules as $vehicule): ?>
                <div class="flex flex-col items-center text-center bg-white shadow-md rounded-lg p-4 transition-transform transform hover:scale-105">
                    <img src="<?php echo ($vehicule['image']); ?>" alt="vehicle-<?php echo ($vehicule['marque']); ?>" class="w-36 h-24 object-cover mx-auto mb-4">
                    <h3 class="text-lg font-bold text-gray-900 mb-2"><?php echo ($vehicule['marque'] . ' ' . $vehicule['madele']); ?></h3>
                    <p class="text-sm text-gray-600 mb-4">Prix : <?php echo ($vehicule['prix']); ?> DH</p>
                    <form action="reservation_vehicule.php" method="POST">
                        <input type="hidden" name="id_vehicule" value="<?php echo $vehicule['id_vehicule']; ?>">
                        <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>"> 
                        <button type="submit" class="text-white bg-red-600 rounded-lg w-56 h-10 text-lg font-bold hover:bg-red-700 transition-colors">
                            Reserved
                        </button>
                    </form>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center items-center space-x-2 mt-8">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 transition-colors">
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            <?php else: ?>
                <span class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md cursor-not-allowed">
                    <i class="fa-solid fa-chevron-left"></i>
                </span>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?php echo $i; ?>" class="px-4 py-2 <?php echo $i == $page ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800'; ?> rounded-md hover:bg-blue-500 hover:text-white transition-colors">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
            <?php if ($page < $total_pages): ?>
                <a href="?page=<?php echo $page + 1; ?>" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 transition-colors">
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            <?php else: ?>
                <span class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md cursor-not-allowed">
                    <i class="fa-solid fa-chevron-right"></i>
                </span>
            <?php endif; ?>
        </div>

    <footer class="bg-gray-800 text-gray-300 py-10 mt-12">
        <div class="container mx-auto px-4">
            <!-- Section principale -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
            <!-- Logo et description -->
            <div>
                <h2 class="text-2xl font-bold text-white">
                <a href="#" class="hover:text-amber-500">Voi<span class="text-blue-400">Ture</span></a>
                </h2>
                <p class="mt-4 text-gray-400">
                Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.
                </p>
                <ul class="flex space-x-4 mt-5">
                <li><a href="#" class="text-gray-400 hover:text-white"><span class="icon-twitter"></span></a></li>
                <li><a href="#" class="text-gray-400 hover:text-white"><span class="icon-facebook"></span></a></li>
                <li><a href="#" class="text-gray-400 hover:text-white"><span class="icon-instagram"></span></a></li>
                </ul>
            </div>
            <!-- Section Information -->
            <div>
                <h2 class="text-lg font-bold text-white">Information</h2>
                <ul class="mt-4 space-y-2">
                <li><a href="#" class="hover:text-white">About</a></li>
                <li><a href="#" class="hover:text-white">Services</a></li>
                <li><a href="#" class="hover:text-white">Terms and Conditions</a></li>
                <li><a href="#" class="hover:text-white">Best Price Guarantee</a></li>
                <li><a href="#" class="hover:text-white">Privacy & Cookies Policy</a></li>
                </ul>
            </div>
            <!-- Section Support Client -->
            <div>
                <h2 class="text-lg font-bold text-white">Customer Support</h2>
                <ul class="mt-4 space-y-2">
                <li><a href="#" class="hover:text-white">FAQ</a></li>
                <li><a href="#" class="hover:text-white">Payment Option</a></li>
                <li><a href="#" class="hover:text-white">Booking Tips</a></li>
                <li><a href="#" class="hover:text-white">How it Works</a></li>
                <li><a href="#" class="hover:text-white">Contact Us</a></li>
                </ul>
            </div>
            <!-- Section Questions -->
            <div>
                <h2 class="text-lg font-bold text-white">Have a Question?</h2>
                <ul class="mt-4 space-y-3">
                <li class="flex items-start">
                    <span class="icon-map-marker text-amber-500 mr-3"></span>
                    <span>203 Fake St. Mountain View, San Francisco, California, USA</span>
                </li>
                <li class="flex items-start">
                    <span class="icon-phone text-amber-500 mr-3"></span>
                    <a href="tel:+23923929210" class="hover:text-white">+2 392 3929 210</a>
                </li>
                <li class="flex items-start">
                    <span class="icon-envelope text-amber-500 mr-3"></span>
                    <a href="mailto:info@yourdomain.com" class="hover:text-white">info@yourdomain.com</a>
                </li>
                </ul>
            </div>
            </div>
            <!-- Copyright -->
            <div class="text-center border-t border-gray-700 pt-6">
            <p class="text-sm text-gray-400">
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with 
                <i class="icon-heart text-amber-500"></i> by 
                <a href="https://colorlib.com" target="_blank" class="hover:text-amber-500">Colorlib</a>
            </p>
            </div>
        </div>
    </footer>
</body>
</html>