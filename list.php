<?php
require_once('RESTClient.php');
// récupérer tous les objets de type "Personne"
$dataGetAll = $client->get("getAll");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produits</title>
    <link rel="stylesheet" type="text/css"
	href="css/style.css" />
</head>
<body>
<!-- inclure la barre de navigation -->
<?php include 'navBar.html'; ?>

<!-- Contenu principal -->
<div class="content">
<?php if ($dataGetAll === null ): ?>
        <p>Aucune personne trouvée.</p>
<?php else: ?>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Age</th>
            <th colspan="2" >Actions</th>
        </tr>
    </thead>
    <tbody>
   
    <?php if (isset($dataGetAll['person']) && !isset($dataGetAll['person']['id'])): ?>
        <!-- en cas de l'existence de plusieurs objets -->
        <?php foreach ($dataGetAll['person'] as $person): ?>
            
            <tr>
                <td><?php echo htmlspecialchars(isset($person['id']) ? $person['id'] : $person); ?></td>
                <td><?php echo htmlspecialchars(isset($person['nom']) ? $person['nom'] : $person); ?></td>
                <td><?php echo htmlspecialchars(isset($person['age']) ? $person['age'] : $person); ?></td>
                <td>
                    <!-- Lien vers le formulaire d'édition -->
                    <a href="edit.php?id=<?php echo isset($person['id']) ? $person['id'] : $person; ?>">Éditer</a>
        </td>  
        <td>  
                    <!-- Lien pour supprimer avec confirmation -->
                    <a href="delete.php?id=<?php echo isset($person['id']) ? $person['id'] : $person; ?>" 
                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette personne ?');">
                        Supprimer
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?> <!-- en cas de l'existence d'un seul objet -->
        <?php $person = $dataGetAll[0]; ?>
        <tr>
                <td><?php echo htmlspecialchars($person['id']); ?></td>
                <td><?php echo htmlspecialchars($person['nom']); ?></td>
                <td><?php echo htmlspecialchars($person['age']); ?></td>
                <td>
                    <!-- Lien vers le formulaire d'édition -->
                    <a href="edit.php?id=<?php echo $person['id']; ?>">Éditer</a>
        </td>  
        <td>  
                    <!-- Lien pour supprimer avec confirmation -->
                    <a href="delete.php?id=<?php echo $person['id']; ?>" 
                       onclick="return confirm('Êtes-vous sûr de supprimer cette personne ?');">
                        Supprimer
                    </a>
                </td>
            </tr>
     <?php endif; ?>

        
    </tbody>
</table>
<?php endif; ?>
</div>
</body>
</html>