<?php

include './conexion.php';


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
<body class="bg-indigo-50 min-h-screen overflow-x-hidden">
   

    
    <header class="fixed w-full bg-white text-indigo-800 z-50 shadow-lg animate-slide-down">
        <div class="max-w-7xl mx-auto px-4 py-2 flex items-center justify-between h-16">
            <button class="mobile-menu-button p-2 lg:hidden">
                    <span class="block w-6 h-0.5 bg-gray-700 mb-1"></span>
                    <span class="block w-6 h-0.5 bg-gray-700 mb-1"></span>
                    <span class="block w-6 h-0.5 bg-gray-700"></span>
                
            </button>
            <div class="text-xl font-bold text-amber-600">
                Admin<span class="text-amber-600">Restaurante</span>
            </div>
            <div class="flex items-center space-x-2">
                <img class="w-10 h-10 rounded-full transition-transform duration-300 hover:scale-110 object-cover" 
                     src="https://th.bing.com/th/id/R.b6350e5011a7b61996efada66d100575?rik=7D6Ni11ELDKMoA&pid=ImgRaw&r=0" 
                     alt="Profile">
            </div>
        </div>
    </header>
    <div class="overlay fixed inset-0 bg-indigo-900/50 z-40 hidden opacity-0 transition-opacity duration-300"></div>
        <form id="formulair" class="fixed top-0 left-0 w-full h-full bg-white bg-opacity-90 z-50 hidden flex items-center justify-center animate-slide-in" method="POST" onsubmit="return validateForm(event)">
            <div class="max-w-[800px] w-full max-h-[500px] bg-white rounded-lg shadow-lg overflow-y-scroll">
                <div class="px-8 py-4 bg-amber-600 text-white">
                    <h1 class="flex justify-center font-bold text-white text-3xl">Menu</h1>
                </div>
                <div class="px-8 py-6">
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="nom">Nom :</label>
                        <input class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-transparent" id="nom" name="nom" type="text" placeholder="Nom" required>
                        <span id="nameError" class="text-red-500 text-sm hidden">Name invalid</span>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="description">Description :</label>
                        <input class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-transparent" id="description" name="description" type="text" placeholder="Description" required>
                        <span id="descriptionError" class="text-red-500 text-sm hidden">Description invalid</span>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="url" id="photo">URL :</label>
                        <input class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-transparent" id="url" name="url" type="text" placeholder="https://" required>
                        <span id="photoError" class="text-red-500 text-sm hidden">Image invalid</span>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="prix">Prix :</label>
                        <input class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-transparent" id="prix" name="prix" type="number" placeholder="Prix" required>
                        <span id="prixError" class="text-red-500 text-sm hidden">Prix invalid</span>
                    </div>

                    <div class="mb-6">
                        <label for="food" class="block text-gray-700 font-semibold mb-2">Food:</label>
                        <select id="food" name="food" class="w-full p-2 mb-4 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="1">Plats principaux</option>
                            <option value="2">Salad</option>
                            <option value="3">Dessert</option>
                        </select>
                    </div>

                    <div class="flex justify-between mt-8">
                        <a id="hideForm" class="text-white bg-red-600 w-40 rounded-lg py-3 hover:bg-red-800 cursor-pointer flex justify-center">
                            Cancel
                        </a>
                        <button type="submit" class="text-white bg-blue-600 w-40 rounded-lg py-3 hover:bg-blue-800 cursor-pointer">
                            Add
                        </button>
                    </div>
                </div>
            </div>
        </form>




        <div class="pt-16 max-w-7xl mx-auto flex">
            <aside class="sidebar fixed lg:static w-[240px] bg-indigo-50 h-[calc(100vh-4rem)] lg:h-auto transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-45 overflow-y-auto p-4">
                <div class="bg-white rounded-xl shadow-lg mb-6 p-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <a href="#"  class="flex items-center text-gray-600 hover:text-amber-600 py-4 transition-all duration-300 hover:translate-x-1">
                    
                        <img src="../img/renomer.png" alt="renomer Icon" class="w-6 h-6 mr-2">
                            Home
                   
                    </a>
                    <a href="#" class="flex items-center text-gray-600 hover:text-amber-600 py-4 transition-all duration-300 hover:translate-x-1">
                    
                        <img src="../img/menu.png" alt="menu Icon" class="w-6 h-6 mr-2">
                            Some menu item
                   
                    </a>
                    <a href="#"   class="flex items-center text-gray-600 hover:text-indigo-800 py-4 transition-all duration-300 hover:translate-x-1 men">
                   
                        <img src="../img/fichier.png" alt="Settings Icon" class="w-6 h-6 mr-2">
                        Another menu 
                   
                    </a>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <a href="#" class="flex items-center text-gray-600 hover:text-indigo-800 py-4 transition-all duration-300 hover:translate-x-1">
                        <img src="../img/profile.png" alt="Profile Icon" class="w-6 h-6 mr-2">
                        Profile
                    </a>
                    <a href="#" class="flex items-center text-gray-600 hover:text-indigo-800 py-4 transition-all duration-300 hover:translate-x-1">
                        <img src="../img/settings.png" alt="Settings Icon" class="w-6 h-6 mr-2">
                            Settings
                    </a>
                    <a href="login.php" class="flex items-center text-gray-600 hover:text-indigo-800 py-4 transition-all duration-300 hover:translate-x-1">
                        <img src="../img/log.png" alt="Log Out Icon" class="w-6 h-6 mr-2">
                        Log out
                    </a>
                </div>

            </aside>

            <main class="flex-1 p-4">
                <div class="flex flex-col lg:flex-row gap-4 mb-6">
                    <div class="flex-1 bg-amber-600 border border-indigo-200 rounded-xl p-6 animate-fade-in">
                        <h2 class="text-sm md:text-xl text-white font-bold">
                            Welcome Dash
                        </h2>
                        <span class="inline-block mt-8 px-8 py-2 rounded-full text-xl font-bold text-amber-600 bg-white">
                            01:51
                        </span>
                    </div>

                    <div class="flex-1 bg-amber-600 border border-blue-200 rounded-xl p-6 animate-fade-in">
                        <h2 class="text-sm md:text-xl text-white font-bold">
                            Clients inscrits <br></strong>
                        </h2>
                        <a href="#" class="inline-block mt-8 px-8 py-2 rounded-full text-xl font-bold text-amber-600 bg-white hover:bg-amber-500 transition-transform duration-300 hover:scale-105">
                            See 
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    

                   
                   
                </div>

                <div class="reservations-container container mx-auto flex flex-col gap-8 py-8">
                    <div class="reservation-card bg-white border border-gray-300 rounded-lg shadow-lg p-6 hover:shadow-xl transition-transform transform hover:-translate-y-2">
                        <h1 class="text-center text-4xl font-bold text-amber-600 mt-4 mb-4">Nouvelle Menu</h1>
                    
                                
                        

                    </div>
                </div>
            </main>
        </div> 
    </div>   

    <script>
 
        
        const menuLinks = document.querySelectorAll('.flex.items-center.text-gray-600.hover\\:text-indigo-800.py-4.transition-all.duration-300.hover\\:translate-x-1');
        menuLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                document.getElementById('formulair').classList.remove('hidden');
            });
        });

        
        document.getElementById('hideForm').addEventListener('click', function () {
            document.getElementById('formulair').classList.add('hidden');
            document.getElementById('formulair').reset();
        });
        
        function validateForm(event) {
        event.preventDefault(); 

    
        document.getElementById("nameError").classList.add("hidden");
        document.getElementById("photoError").classList.add("hidden");
        document.getElementById("descriptionError").classList.add("hidden");
        document.getElementById("prixError").classList.add("hidden");

        let valid = true;

    
        const name = document.getElementById("nom").value;
        const nameRegex = /^[a-zA-Z\s]+$/;  
        if (!nameRegex.test(name)) {
            document.getElementById("nameError").classList.remove("hidden");
            valid = false;
        }

        
        const url = document.getElementById("url").value;
        const urlRegex = /^https:\/\//;
        if (!urlRegex.test(url)) {
            document.getElementById("photoError").classList.remove("hidden");
            valid = false;
        }

        
        const description = document.getElementById("description").value;
        const descriptionRegex = /^[a-zA-Z\s]+$/;
        if (!descriptionRegex.test(description)) { 
            document.getElementById("descriptionError").classList.remove("hidden");
            valid = false;
        }

        
        const prix = document.getElementById("prix").value;
        const prixRegex = /^\d{1,3}$/;

        if (!prixRegex.test(prix) || parseInt(prix) <= 0) {
        document.getElementById("prixError").classList.remove("hidden");
        valid = false;
        }

        
        if (valid) {
            document.getElementById("formulair").submit(); 
        }

        return valid;
        }



    </script>
</body>
</html>