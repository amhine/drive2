<?php
include './conexion.php';
require './../class/categorier.php';

$db = new Database();
$categorie = new Categorie($db); 
$categories = $categorie->getCategories();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un véhicule</title>
    <link rel="stylesheet" href="input.css">
    <link rel="stylesheet" href="output.css">
</head>
<body>
    <form action="script_vehicule.php" method="POST" enctype="multipart/form-data" id="addvehiculeForm">
        <div class="max-w-[800px] w-full max-h-[500px] bg-white rounded-lg shadow-lg overflow-y-scroll">
            <div class="px-8 py-4 bg-blue-400 text-white">
                <h1 class="flex justify-center font-bold text-white text-3xl">Ajouter un véhicule</h1>
            </div>
            <div class="px-8 py-6">
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="marque">Marque :</label>
                    <input class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="marque" name="marque" type="text" placeholder="Marque" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="madele">Modèle :</label>
                    <input class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="madele" name="madele" type="text" placeholder="Modèle" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="prix">Prix :</label>
                    <input class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="prix" name="prix" type="text" placeholder="Prix" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="id_categorie">Catégorie :</label>
                    <select name="id_categorie" id="id_categorie" class="w-full p-2 mb-4 rounded-md bg-gray-100" required>
                        <option value="" disabled selected>Sélectionner une catégorie</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?php echo htmlspecialchars($cat['id_categorie']); ?>">
                                <?php echo htmlspecialchars($cat['nom']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-6">
        <label class="block text-gray-700 font-semibold mb-2" for="image">Image :</label>
        <input type="file" name="image" id="image" class="w-full p-2 rounded-md bg-gray-100" required>
    </div>
                
                <div class="flex justify-between mt-8">
                    <a href="dashbord.php" class="text-white bg-red-600 w-40 rounded-lg py-3 hover:bg-red-800 cursor-pointer flex justify-center">Annuler</a>
                    <button type="submit" class="text-white bg-blue-600 w-40 rounded-lg py-3 hover:bg-blue-800 cursor-pointer">Ajouter</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
