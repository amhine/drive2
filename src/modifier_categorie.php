
<?php
include './conexion.php';
require './../class/categorier.php';

$db = new Database();
$categorie = new Categorie($db);

if (isset($_GET['id_categorie']) && !empty($_GET['id_categorie'])) {
    $id = $_GET['id_categorie'];
    $cat = $categorie->getCategorieById($id);
    
    if (!$cat) {
        echo "Catégorie non trouvée.";
        exit();
    }
} else {
    echo "ID de la catégorie manquant.";
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $image = $_POST['image']; 

    if (!empty($nom) && !empty($description) && !empty($image)) {
        $categorie->updateCategorie($id, $nom, $description, $image);
        
        header('Location: dashbord.php');
        exit();
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
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
   <!-- Formulaire de modification -->
 

<form action="modifier_categorie.php?id_categorie=<?php echo $cat['id_categorie']; ?>" method="POST" class="fixed top-0 left-0 w-full h-full bg-white bg-opacity-90 z-50  flex items-center justify-center animate-slide-in">
            <div class="max-w-[800px] w-full max-h-[500px] bg-white rounded-lg shadow-lg ">
                <div class="px-8 py-4 bg-blue-400 text-white">
                    <h1 class="flex justify-center font-bold text-white text-3xl">Categorier</h1>
                </div>
                <div class="px-8 py-6">
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="nom">Nom :</label>
                        <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($cat['nom']); ?>" class="w-full p-3 border border-gray-300 rounded-lg" required>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="description">Description :</label>
                        <input class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="description" name="description" type="text" placeholder="Description" required value=" <?php echo htmlspecialchars($cat['description']); ?>">
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="url" id="photo">Images :</label>
                        <input type="text" id="image" name="image" value="<?php echo htmlspecialchars($cat['image']); ?>" class="w-full p-3 border border-gray-300 rounded-lg" required>
                    </div>
                   

                   

                    <div class="flex justify-between mt-8">
                        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Enregistrer</button>

                        <a href="dashbord.php" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">Annuler</a>

                    </div>
                </div>
            </div>
        </form>
</body>
</html>

