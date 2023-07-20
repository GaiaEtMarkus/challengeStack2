<?php

// Récupérer les données du tableau $_SESSION['postData']
$configData = $_SESSION['postData'];

// Vérifier si la clé 'initialized' est définie et a la valeur 'false' dans le fichier config.json existant
$configFilePath = './config.json';

if (isset($configFilePath)) {
    // Générer le contenu du fichier config.json à partir des données
    $configContent = json_encode($configData, JSON_PRETTY_PRINT);

    // Créer le fichier config.json
    if (file_put_contents($configFilePath, $configContent) !== false) {
        // Le fichier config.json a été créé avec succès
        // Vous pouvez envoyer une réponse JSON appropriée si nécessaire
        echo json_encode(['message' => 'Le fichier config.json a été créé avec succès.']);
    } else {
        // Une erreur s'est produite lors de la création du fichier config.json
        // Vous pouvez envoyer une réponse JSON appropriée si nécessaire
        echo json_encode(['error' => 'Erreur lors de la création du fichier config.json.']);
    }
    
}

session_unset()
?>
