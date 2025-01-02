<?php
include './conexion.php'; 
require './../class/vehicule.php';
require './../class/categorier.php'; 
$db = new Database();
$vehicule = new Vehicule($db);
$categorie = new Categorie($db);

if (isset($_GET['id_vehicule'])) {
    $id_vehicule = intval($_GET['id_vehicule']);

    $cat = $vehicule->getVehiculeById($id_vehicule); 
    if (!$cat) {
        echo "Véhicule non trouvé.";
        exit();
    }

    $categories = $categorie->getAllCategories();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $marque = $_POST['marque'];
        $madele = $_POST['madele'];
        $prix = $_POST['prix'];
        $id_categorie = $_POST['id_categorie'];
        $image = $_FILES['image']['name']; 

        if (!empty($image)) {
            $image_tmp = $_FILES['image']['tmp_name'];
            $image_path = "uploads/" . basename($image);
            move_uploaded_file($image_tmp, $image_path);
        } else {
            $image_path = $cat['image'];
        }
        $updateSuccess = $vehicule->updateVehicule($id_vehicule, $marque, $madele, $prix, $id_categorie, $image_path);
        
        if ($updateSuccess) {
            echo "Véhicule mis à jour avec succès.";
            header('Location: dashbord.php');
            exit();
        } else {
            echo "Erreur lors de la mise à jour du véhicule.";
        }
    }
} else {
    echo "Aucun véhicule sélectionné.";
    exit;
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le véhicule</title>
    <link rel="stylesheet" href="input.css">
    <link rel="stylesheet" href="output.css">
</head>
<body>
    <!-- Formulaire de modification -->
    <form action="modifier_vehicule.php?id_vehicule=<?php echo $cat['id_vehicule']; ?>" method="POST"  class="fixed top-0 left-0 w-full h-full bg-white bg-opacity-90 z-50  flex items-center justify-center animate-slide-in">
        <div class="max-w-[800px] w-full max-h-[500px] bg-white rounded-lg shadow-lg  overflow-y-scroll">
            <div class="px-8 py-4 bg-blue-400 text-white">
                <h1 class="flex justify-center font-bold text-white text-3xl">Véhicule</h1>
            </div>
            <div class="px-8 py-6">
                <!-- Marque -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="marque">Marque :</label>
                    <input type="text" id="marque" name="marque" value="<?php echo ($cat['marque']); ?>" class="w-full p-3 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Modèle -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="madele">Modèle :</label>
                    <input type="text" id="madele" name="madele" value="<?php echo ($cat['madele']); ?>" class="w-full p-3 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Prix -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="prix">Prix :</label>
                    <input type="text" id="prix" name="prix" value="<?php echo ($cat['prix']); ?>" class="w-full p-3 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Catégorie -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="id_categorie">Catégorie :</label>
                    <select id="id_categorie" name="id_categorie" class="w-full p-3 border border-gray-300 rounded-lg" required>
                        <?php
                        if (empty($categories)) {
                            echo "<option>Aucune catégorie trouvée.</option>";
                        } else {
                            foreach ($categories as $categorie):
                                ?>
                                <option value="<?php echo $categorie['id_categorie']; ?>" <?php echo $categorie['id_categorie'] == $cat['id_categorie'] ? 'selected' : ''; ?>>
                                    <?php echo ($categorie['nom']); ?>
                                </option>
                                <?php
                            endforeach;
                        }
                        ?>
                    </select>
                </div>

                <!-- Image actuelle -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Image actuelle :</label>
                    <img src="<?php echo ($cat['image']); ?>" alt="Image du véhicule" class="w-48 h-32 object-cover rounded-lg">
                </div>

                <!-- Nouvelle image -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="image">Remplacer l'image :</label>
                    <input type="file" id="image" name="image" class="w-full p-3 border border-gray-300 rounded-lg">
                </div>

                <!-- Boutons d'action -->
                <div class="flex justify-between mt-8">
                        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Enregistrer</button>

                        <a href="dashbord.php" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">Annuler</a>

                    </div>
            </div>
        </div>
    </form>
</body>
</html>

