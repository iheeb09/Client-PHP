<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une Personne</title>
    <link rel="stylesheet" type="text/css"
	href="css/style.css" />
</head>
<body>
<?php require_once('RESTClient.php'); ?>
<!-- inclure la barre de navigation -->
<?php include 'navBar.html'; ?>
<!-- Contenu principal -->
<div class="content">

<form action="add.php" method="POST">
    <label for="id">ID :</label>
    <input type="number" id="id" name="id" required>

    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>

    <label for="age">Âge :</label>
    <input type="number" id="age" name="age" required>

    <input type="submit" value="Ajouter">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $age = $_POST['age'];

    // Préparer les données à envoyer à l'API
    $personneData = [
        'id' => $id,
        'nom' => $nom,
        'age' => $age
    ];

     // insérer la personne à travers l'API REST
     $responsePost = $client->post("add", $personneData);

      
    // redirection vers une page de liste
    header("Location: list.php");      
    exit();
}
?>
</div>
</body>
</html>