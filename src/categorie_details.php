<?php
// require './conexion.php';
// require './../class/categorier.php';

// $db = new Database();
// $categorie = new Categorie($db);

// Vérifier si l'ID de catégorie est passé dans l'URL
// if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $cat = $categorie->getCategorieById($id);
    
    if ($cat) {
        // Affichage des informations de la catégorie si trouvée
        echo "<h1>" . htmlspecialchars($cat['nom']) . "</h1>";
        echo "<p>" . htmlspecialchars($cat['description']) . "</p>";
    
        // Vérifier si l'ID du véhicule est passé dans l'URL
        if (isset($_GET['id_vehicule']) && !empty($_GET['id_vehicule'])) {
            $id_vehicule = $_GET['id_vehicule'];
        
            // Récupérer les détails du véhicule à partir de l'ID
            $query = "SELECT * FROM vehicule WHERE id_vehicule = :id_vehicule AND id_categorie = :id_categorie";
            $stmt = $db->prepare($query);
            $stmt->execute(['id_vehicule' => $id_vehicule, 'id_categorie' => $id]);
            $vehicule = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($vehicule) {
                // Affichage des détails du véhicule
                echo "<h2>Réservation pour " . htmlspecialchars($vehicule['marque']) . " " . htmlspecialchars($vehicule['modele']) . "</h2>";
                echo "<p>Prix: " . htmlspecialchars($vehicule['prix']) . " €</p>";
                echo "<img src='" . htmlspecialchars($vehicule['image']) . "' alt='" . htmlspecialchars($vehicule['marque']) . "' class='w-36 h-24 object-cover'>";
        
                // Ajouter un formulaire de réservation
                echo '<form action="confirmer_reservation.php" method="POST">';
                echo '<input type="hidden" name="id_vehicule" value="' . $vehicule['id_vehicule'] . '">';
                echo '<button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Confirmer la réservation</button>';
                echo '</form>';
            } else {
                echo "Véhicule non trouvé.";
            }
        } else {
            echo "ID de véhicule manquant.";
        }
    } else {
        echo "Catégorie non trouvée.";
    }
// } else {
//     echo "ID de catégorie manquant.";
// }
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
    <nav class="bg-gray-800 mb-14 ">
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
                <a href="categorier.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">categorier</a>
                <a href="vehicule.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">vehicule</a>
                <a href="reservation.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">reservation</a>
                <a href="avis.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">avis</a>
            </div>
            </div>
        </div>
    
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-gray-800">
            <a href="index.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>
            <a href=" categorier.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">categorier</a>
            <a href="vehicule.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">vehicule</a>
            <a href="reservation.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">reservation</a>
            <a href="avis.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">avis</a>
        </div>
    </nav>

    <div id="21lgba2puTpseL0QbjNZv9" class="flex flex-col md:flex-row bg-white shadow-lg mt-8 rounded-lg overflow-hidden">
        <!-- Texte -->
        <div class="flex-1 p-6">
            <p class="text-xs font-bold text-blue-500 uppercase mb-2">
                Allez plus loin
            </p>
            <h2 class="text-xl font-bold text-gray-900 mb-4">
                Voitures par modèle
            </h2>
            <div class="text-sm text-gray-600 mb-4">
                Découvrez nos différents modèles de voitures !
            </div>
            <a href="/fr-fr/p/location-voiture/flotte/type/premium/par-modele" class="inline-block bg-blue-500 text-white text-lg font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                Réservez maintenant
            </a>
        </div>

        <!-- Image -->
        <div class="h-48 md:h-auto md:w-1/3 bg-cover bg-center" style="background-image: url('https://images.ctfassets.net/wmdwnw6l5vg5/7uJ4ZSSInsxyWFZKPlm5DQ/355d7afdd59d2cfe616e99360f299eb1/278d45da-ab62-4310-9c3e-c8371bf3c0e1-min.png');"></div>
    </div>
   
  
    <div class="flex flex-col md:flex-row bg-white shadow-lg rounded-lg overflow-hidden md:gap-x-96 mt-8">
        <!-- Image -->
        <div class="h-48 md:h-auto md:w-1/3 bg-cover bg-center" style="background-image: url('https://images.ctfassets.net/wmdwnw6l5vg5/6T17VrZY8nkVjE31TZlY53/4bf3eddd6b435ede9b3e2b7eb00e16e4/43400_GWY_R__1_.png');"></div>

        <!-- Texte -->
        <div class="flex-1 p-6 justify-end ">
            <p class="text-xs font-bold text-blue-500 uppercase  mb-2">
                Déplacez-vous partout
            </p>
            <h2 class="text-xl font-bold text-gray-900 mb-4">
                Voitures par marque
            </h2>
            <div class="text-sm text-gray-600 mb-4">
                Découvrez nos différentes marques de voitures de luxe !
            </div>
            <a href="/fr-fr/p/location-voiture/flotte/type/premium/par-marque" class="inline-block bg-blue-500 text-white text-lg font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                Réservez maintenant
            </a>
        </div>
    </div>

    <div id="21lgba2puTpseL0QbjNZv9" class="flex flex-col md:flex-row bg-white shadow-lg mt-8 rounded-lg overflow-hidden">
        <!-- Texte -->
        <div class="flex-1 p-6">
            <p class="text-xs font-bold text-blue-500 uppercase mb-2">
                Allez plus loin
            </p>
            <h2 class="text-xl font-bold text-gray-900 mb-4">
                Voitures par modèle
            </h2>
            <div class="text-sm text-gray-600 mb-4">
                Découvrez nos différents modèles de voitures !
            </div>
            <a href="/fr-fr/p/location-voiture/flotte/type/premium/par-modele" class="inline-block bg-blue-500 text-white text-lg font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                Réservez maintenant
            </a>
        </div>

        <!-- Image -->
        <div class="h-48 md:h-auto md:w-1/3 bg-cover bg-center" style="background-image: url('https://images.ctfassets.net/wmdwnw6l5vg5/7uJ4ZSSInsxyWFZKPlm5DQ/355d7afdd59d2cfe616e99360f299eb1/278d45da-ab62-4310-9c3e-c8371bf3c0e1-min.png');"></div>
    </div>
   
  
    <div class="flex flex-col md:flex-row bg-white shadow-lg rounded-lg overflow-hidden md:gap-x-96 mt-8">
        <!-- Image -->
        <div class="h-48 md:h-auto md:w-1/3 bg-cover bg-center" style="background-image: url('https://images.ctfassets.net/wmdwnw6l5vg5/6T17VrZY8nkVjE31TZlY53/4bf3eddd6b435ede9b3e2b7eb00e16e4/43400_GWY_R__1_.png');"></div>

        <!-- Texte -->
        <div class="flex-1 p-6 justify-end ">
            <p class="text-xs font-bold text-blue-500 uppercase  mb-2">
                Déplacez-vous partout
            </p>
            <h2 class="text-xl font-bold text-gray-900 mb-4">
                Voitures par marque
            </h2>
            <div class="text-sm text-gray-600 mb-4">
                Découvrez nos différentes marques de voitures de luxe !
            </div>
            <a href="/fr-fr/p/location-voiture/flotte/type/premium/par-marque" class="inline-block bg-blue-500 text-white text-lg font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                Réservez maintenant
            </a>
        </div>
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



