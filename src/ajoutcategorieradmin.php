


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une catégorie</title>
    <link rel="stylesheet" href="input.css">
    <link rel="stylesheet" href="output.css">
</head>
<body>
    <div class="container">

        <!-- Formulaire pour ajouter une catégorie -->
        <form action="script_categorie.php" method="POST" id="addCategoryForm">
            <div class="max-w-[800px] w-full max-h-[500px] bg-white rounded-lg shadow-lg ">
                <div class="px-8 py-4 bg-blue-400 text-white">
                    <h1 class="flex justify-center font-bold text-white text-3xl">Categorier</h1>
                </div>
                <div class="px-8 py-6">
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="nom">Nom :</label>
                        <input class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="nom" name="nom" type="text" placeholder="Nom" required>
                        <span id="nameError" class="text-red-500 text-sm hidden">Name invalid</span>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="description">Description :</label>
                        <input class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="description" name="description" type="text" placeholder="Description" required>
                        <span id="descriptionError" class="text-red-500 text-sm hidden">Description invalid</span>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="url" id="photo">Images :</label>
                        <input class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="url" name="image" type="text" placeholder="https://" required>
                        <span id="photoError" class="text-red-500 text-sm hidden">Image invalid</span>
                    </div>
                   

                   

                    <div class="flex justify-between mt-8">
                        <a href="dashbord.php" class="text-white bg-red-600 w-40 rounded-lg py-3 hover:bg-red-800 cursor-pointer flex justify-center">
                            Cancel
                        </a>
                        <button type="submit" class="text-white bg-blue-600 w-40 rounded-lg py-3 hover:bg-blue-800 cursor-pointer">
                            Add
                        </button>
                    </div>
                </div>
            </div>
            
        </form>
    </div>
</body>
</html>
